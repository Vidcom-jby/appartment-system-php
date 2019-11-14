<?php
require_once '../db_connect.php';

$stmt = $conn->prepare("SELECT * FROM user_table WHERE id=:id");
$stmt->execute(array(':id'=>$_SESSION['user']['id']));
$course_details=array();
$data=$stmt->fetch(PDO::FETCH_ASSOC);
$user_courses=!empty($data['registered_courses'])?$data['registered_courses']:'';
$user_courses_temp=explode(';',$user_courses);
if(!empty($user_courses_temp)){
	$user_courses_temp=array_map('trim',$user_courses_temp);
	foreach ($user_courses_temp as $code){
		if(!empty($code)){
			$stmt = $conn->prepare("SELECT * FROM course_table WHERE code=:code");
			$stmt->execute(array(':code'=>$code));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			if(!empty($row)){
				$row['cost']=1000;
				$course_details[]=$row;
			}
		}
	}
}

if(empty($course_details)) {
	$errors['no_course_available'] = "<p>Sorry, you have no Registered Course(s). Please click<span><a href='students/register_courses.php'>here</a> to register Courses before returning to this page.</span> </p>";
}

if(empty($errors['no_course_available'])) {
	if (!$_POST) {
		$id = !empty($_GET['id']) ? $_GET['id'] : '';
		if (!empty($id)) {
			$stmt = $conn->prepare("SELECT * FROM user_table WHERE id=:id");
			$stmt->execute(array(":id" => $id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if (!empty($row)) {
				foreach ($row as $field => $value) {
					${'' . $field} = $value;
				}
			}
		}
	} else {
		if (!empty($_POST)) {
			foreach ($_POST as $field_key => $field_value) {
				${'' . $field_key} = $field_value;
			}
		}
		$post_data = $_POST;
		$user_group = strtoupper(trim($_POST['user_group']));
		$errors = $success = array();
		$regex = '/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';
		$required_fields = array('matric_number' => 'The Matric Number  field is required', 'surname' => "The Surname field is required", 'level' => "The Level of Study field is required", 'department' => "The Department field is required", 'other_name' => "The Other Names field is required", 'email' => "The Email field is required", 'phone_number' => "The Phone Number field is required", 'password' => "The Password field is required", 'confirm_password' => "The Confirm password field is required", 'state' => "The State of Origin field is required", 'lga' => "The LGA of origin field is required", 'study_centre' => "The Study Centre field is required");
		
		$courses = !empty($_POST['courses']) ? $_POST['courses'] : array();
		$check_all = !empty($_POST['check_all']) ? $_POST['check_all'] : '';
		$error = array();
		$error_check = array();
		$index = 0;
		
		foreach ($courses as $value) {
			if (!empty($value['title'])) {
				$error_check[$index] = $value['title'];
			}
			$index++;
		}
		if (empty($error_check)) {
			$errors['test_course'] = "Please select at least one course to register.";
		}
		
		
		if (empty($errors)) {
			if (!empty($_SESSION['user'])) {
				foreach ($_SESSION['user'] as $field_key => $field_value) {
					${'' . $field_key} = $field_value;
				}
			}
			$stmt = null;
		}
		if (empty($errors)) {
			$selected_courses = $registered_courses = "";
			foreach ($courses as $value) {
				if (!empty($value)) {
					if (!empty($value['title'])) {
						$selected_courses .= $value['code'] . ': ' . $value['title'] . ': ' . $value['unit'] . '; ';
						$registered_courses .= $value['code'] . ';';
					}
				}
			}
			if (!empty($selected_courses)) {
				$total_amount = 0;
				foreach ($courses as $value) {
					if (!empty($value)) {
						if (!empty($value['title'])) {
							if (!empty($value['cost'])) {
								$total_amount += floatval($value['cost']);
							} else {
								$total_amount += 0;
							}
						}
					}
				}
				if (empty($wallet_balance) || $total_amount > $wallet_balance) {
					$errors['test_course'] = "You have Insufficient balance in your Wallet. Please fund wallet to  continue";
				}
				if (empty($errors)) {
					$stmt = $conn->prepare("SELECT * FROM exam_reg_table WHERE user_id=:user_id");
					$stmt->execute(array(":user_id" => $id));
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					if (!empty($row)) {
						$update_courses = trim($row['registered_exam_courses']);
						if (substr($update_courses, (strlen($update_courses) - 1)) === ";")
							$update_courses .= " " . $selected_courses;
						else {
							$update_courses .= ";" . $selected_courses;
						}
						
						if (!empty($update_courses)) {
							$course_array = explode(';', $update_courses);
							$new_registered_courses = "";
							if (!empty($course_array)) {
								$index = 0;
								foreach ($course_array as $value) {
									if (!empty($value)) {
										$course_temp = explode(':', $value);
										if (!empty($course_temp)) {
											$course_temp[0] = trim($course_temp[0]);
											if (!empty($course_temp[0])) {
												$new_registered_courses .= trim($course_temp[0]) . ((count($course_array) == $index) ? "" : "; ");
												$index++;
											}
										}
									}
								}
							}
						}
						
						$new_amount=!empty($row['amount'])?(floatval($row['amount'])+$total_amount):$total_amount;
						$user_query = "UPDATE exam_reg_table SET user_id='$id', department='$department', level='$level', amount=$new_amount, matric_number='$matric_number', registered_exam_courses='$update_courses' WHERE id='" . $row['id'] . "'";
						if ($conn->query($user_query)) {
							$wallet_balance = !empty($wallet_balance) ? ($wallet_balance - $total_amount) : 0;
							$wallet_balance = ($wallet_balance < 0) ? 0 : $wallet_balance;
							$total_expenses = !empty($total_expenses) ? ($total_expenses + $total_amount) : $total_amount;
							$user_query = "UPDATE user_table SET registered_exam_courses='$new_registered_courses',total_expenses='$total_expenses',wallet_balance='$wallet_balance' WHERE id='$id'";
							if ($conn->query($user_query)) {
								$_SESSION['success'] = "<p>Your Exam Registration was Successful. Click <span><a href='students/registered_courses.php'>here</a> to view registered courses/exams</span></p>";
								$test_course = array();
								$check_all = null;
								$stmt = $conn->prepare("SELECT * FROM user_table WHERE id=:user_id");
								$stmt->execute(array(":user_id" => $_SESSION['user']['id']));
								$row = $stmt->fetch(PDO::FETCH_ASSOC);
								if (!empty($row)) {
									$_SESSION['user'] = $row;
								}
								$_SESSION['registered_exam_courses'] = $new_registered_courses;
								header("Location: ./register_exams.php");
								exit();
							} else {
								$error['failure'] = "<h4>Sorry, Your Exam Registration could not be completed. please try again later!</h4>";
							}
							
						}
						else {
							$error['failure'] = "<h4>Sorry, Your Exam Registration could not be completed. please try again later!</h4>";
						}
					} else {
						$new_unique_hash = sha1(uniqid(rand(), true));
						$wallet_balance = !empty($wallet_balance)?($wallet_balance - $total_amount):0;
						$wallet_balance = ($wallet_balance < 0) ? 0 : $wallet_balance;
						$total_expenses = !empty($total_expenses)?($total_expenses + $total_amount):$total_amount;
						$user_query = "INSERT INTO exam_reg_table SET user_id='$id', department='$department', level='$level', amount=$total_amount, matric_number='$matric_number', id='$new_unique_hash', registered_exam_courses='$selected_courses' ";
						if ($conn->query($user_query)) {
							$user_query = "UPDATE user_table SET registered_exam_courses='$registered_courses',total_expenses='$total_expenses',wallet_balance=$wallet_balance WHERE id ='$id'";
							if ($conn->query($user_query)) {
								$_SESSION['success'] = "<p>Your Exam Registration was Successful. Click <span><a href='students/registered_courses.php'>here</a> to view registered courses/exams</span></p>";
								$test_course = array();
								$check_all = null;
								$stmt = $conn->prepare("SELECT * FROM user_table WHERE id=:user_id");
								$stmt->execute(array(":user_id" => $_SESSION['user']['id']));
								$row = $stmt->fetch(PDO::FETCH_ASSOC);
								if (!empty($row)) {
									$_SESSION['user'] = $row;
								}
								$_SESSION['registered_exam_courses'] = $registered_courses;
								header("Location: ./register_exams.php");
								exit();
								
							} else {
								$errors['failure'] = "<h4>Sorry, Exam Your Registration could not be completed. please try again later!</h4>";
							}
						} else {
							$errors['failure'] = "<h4>Sorry, Exam Your Registration could not be completed. please try again later!</h4>";
						}
					}
				}
			}
		}
		
	}
	$_SESSION['registered_exam_courses']=empty($_SESSION['registered_exam_courses'])?(!empty($_SESSION['user']['registered_exam_courses'])?$_SESSION['user']['registered_exam_courses']:''):$_SESSION['registered_exam_courses'];
	if (!empty($_SESSION['registered_exam_courses'])) {
		$reg_courses = explode(';', $_SESSION['registered_exam_courses']);
		if (!empty($reg_courses)) {
			if (!empty($course_details)) {
				foreach ($course_details as $key => $course_detail) {
					if (!empty($course_detail)) {
						foreach ($reg_courses as $value) {
							if (!empty($value) && trim($value) === trim($course_detail['code'])) {
								unset($course_details[$key]);
							}
						}
					}
				}
			}
		}
	}
	$course_details = !empty($course_details) ? array_values($course_details) : array();
	
}
?>