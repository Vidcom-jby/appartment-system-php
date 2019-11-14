<?php
require_once 'db_connect.php';
$stmt= null;
$error=array();
$stmt = $conn->prepare("SELECT * FROM dept_course_table WHERE department=:department AND available_for_test=:available");
$stmt->execute(array(":department" => $department, ":available"=>strtoupper('yes')));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(!empty($row)){
	$stmt = $conn->prepare("SELECT * FROM user_table WHERE matric_number=:matric_number AND user_group=:user_group");
	$stmt->execute(array(":matric_number" => $matric_number, ":user_group" => $user_group));
	$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
	if(!empty($row2)){
		$reg_temp_courses=trim($row2['registered_courses']);
		if(empty($reg_temp_courses)){
			$_SESSION['registered_courses']=null;
		}
	}
	$level_courses=$course_department=null;
	$course_array=$course_details=$course_temp=array();
	if(!empty($level)) {
		$level_courses = $row['' . $level . '_level_course'];
		$course_department=$row['department'];
	}
	if(!empty($level_courses)){
		$course_array=explode(';',$level_courses);
	}
	if(!empty($course_array)){
		$index=0;
		foreach ($course_array as $value){
			if(!empty($value)) {
				$course_temp = explode(':', $value);
				if (!empty($course_temp)) {
					$course_details[$index]['course_code'] = !empty($course_temp[0]) ? trim($course_temp[0]) : '';
					$course_details[$index]['course_title'] = !empty($course_temp[1]) ? trim($course_temp[1]) : '';
					$course_details[$index]['course_unit'] = !empty($course_temp[2]) ? trim($course_temp[2]) : '';
					$index++;
				}
			}
		}
	}
}else{
	$errors['user_data']="<p>Sorry, CBT Test is not  available for your Department yet... Please try again!</p>";
}

if ($_POST) {
$_SESSION['reg_status']="";
$test_course=!empty($_POST['test_course'])?$_POST['test_course']:array();
$check_all=!empty($_POST['check_all'])?$_POST['check_all']:'';
	$error=array();
	$error_check=array();
	$index=0;
	foreach ($test_course as $value){
		if(!empty($value['course_title'])){
			$error_check[$index]=$value['course_title'];
		}
		$index++;
	}
	if(empty($error_check)){
		$errors['test_course']="<font color='#a94442'><span style='color:#a94442'>Please select at least one course to register.</span></font>";
	}
	if(empty($error)){
		$selected_courses=$registered_courses="";
		foreach ($test_course as $value){
			if(!empty($value)){
				if(!empty($value['course_title'])) {
					$selected_courses .= $value['course_code'] . ': ' . $value['course_title'] . ': ' . $value['course_unit'] . '; ';
					$registered_courses .= $value['course_code'] . ';';
				}
			}
		}
		if(!empty($selected_courses)) {
			$stmt = $conn->prepare("SELECT * FROM test_course_table WHERE matric_number=:matric_number AND user_group=:user_group");
			$stmt->execute(array(":matric_number" => $matric_number, ":user_group" => $user_group));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if(!empty($row)){
				$update_courses=trim($row['registered_courses']);
				if(substr($update_courses,(strlen($update_courses)-1))===";")
				$update_courses .=" ".$selected_courses;
				else{
					$update_courses .=";".$selected_courses;
				}
				if(!empty($update_courses)){
					$course_array=explode(';',$update_courses);
					$new_registered_courses="";
					if(!empty($course_array)){
						$index=0;
						foreach ($course_array as $value){
							if(!empty($value)) {
								$course_temp = explode(':', $value);
								if (!empty($course_temp)) {
									$course_temp[0]=trim($course_temp[0]);
									if(!empty($course_temp[0])) {
										$new_registered_courses .= trim($course_temp[0]).((count($course_array)==$index)?"":"; ");
										$index++;
									}
								}
							}
						}
					}
				}
				$user_query = "UPDATE test_course_table SET registered_courses='$update_courses' WHERE matric_number='$matric_number'";
				if ($conn->query($user_query)) {
					if(!empty($new_registered_courses)) {
						$user_query = "UPDATE user_table SET registered_courses='$new_registered_courses' WHERE matric_number='$matric_number'";
						if ($conn->query($user_query)) {
							$success['data'] = "<p>Your Registration was Successful. Click <span><a href='start_test.php?user_group=client'>here</a> to Start your Test</span></p>";
							$_SESSION['reg_status'] = "<p>Your Registration was Successful. Select your course below to start Test</span></p>";
							$test_course = array();
							$check_all = null;
							$_SESSION['registered_courses'] = $new_registered_courses;
							header("Location: start_test.php");
						} else {
							$errors['failure'] = "<h4>Sorry, Your Registration could not be completed. please try again later!</h4>";
						}
					}
				}
				else {
					$errors['failure'] = "<h4>Sorry, Your Registration could not be completed. please try again later!</h4>";
				}
			}else {
				$user_query = "INSERT INTO test_course_table SET department='$department', level='$level', matric_number='$matric_number', user_group='$user_group', registered_courses='$selected_courses' ";
				if ($conn->query($user_query)) {
					$user_query = "UPDATE user_table SET registered_courses='$registered_courses' WHERE matric_number='$matric_number'";
					if ($conn->query($user_query)) {
						$success['data'] = "<p>Your Registration was Successful. Click <span><a href='start_test.php?user_group=client'>here</a> to Start your Test</span></p>";
						$test_course = array();
						$check_all = null;
						$_SESSION['registered_courses'] = $registered_courses;
						$_SESSION['reg_status'] = "<p>Your Registration was Successful. Select your course below to start Test</span></p>";
						header("Location: start_test.php");
					}
					else {
						$errors['failure'] = "<h4>Sorry, Your Registration could not be completed. please try again later!</h4>";
					}
				} else {
					$errors['failure'] = "<h4>Sorry, Your Registration could not be completed. please try again later!</h4>";
				}
			}
		}
	}else{
		return;
	}
}

if(!empty($_SESSION['registered_courses'])){
	$reg_courses=explode(';',$_SESSION['registered_courses']);
	if(!empty($reg_courses)) {
		if(!empty($course_details)) {
			foreach ($course_details as $key => $course_detail) {
				if (!empty($course_detail)) {
					foreach ($reg_courses as $value){
						if(!empty($value) && trim($value)===trim($course_detail['course_code'])){
							unset($course_details[$key]);
						}
					}
				}
			}
		}
	}
}
