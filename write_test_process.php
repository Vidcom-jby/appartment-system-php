<?php
require_once 'db_connect.php';
$stmt= null;
$error=array();
$stmt = $conn->prepare("SELECT * FROM question_table WHERE course_code=:course_code AND department=:department AND level=:level");
$stmt->execute(array(":course_code"=>$test_course,":department" => $department, ":level"=>$level));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(!empty($row)){
	$stmt = $conn->prepare("SELECT * FROM result_table WHERE matric_number=:matric_number AND user_group=:user_group AND course_code=:course_code AND level=:level");
	$stmt->execute(array(":matric_number" => $matric_number, ":user_group" => $user_group,":course_code"=>$test_course,":level"=>$level));
	$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
	if(!empty($row2)) {
		$errors['user_data']="<p>Sorry, you have already submitted Test for this Course</p>";
	}else {
		$level_courses = $course_department = null;
		$course_code = $row['course_code'];
		$course_title = $row['course_title'];
		$course_unit = $row['course_unit'];
		$questions = $row['questions'];
		$question_options = $row['question_options'];
		$question_answers = $row['question_answers'];
		
		$question_option_array = $question_array = $question_answer_array = $question_details = $question_temp = array();
		
		if (!empty($question_options)) {
			$question_option_array = explode(';', $question_options);
		}
		if (!empty($questions)) {
			$question_array = explode(';', $questions);
		}
		if (!empty($question_answers)) {
			$question_answer_array = explode(';', $question_answers);
		}
		
		$index = 0;
		if (!empty($question_array)) {
			foreach ($question_array as $key => $value) {
				if (!empty($value)) {
					$question_temp[$index]['question_title'] = $value;
					if (!empty($question_option_array)) {
						$new_temp = explode('.', $question_option_array[$index]);
						$question_temp[$index]['question_options'] = $new_temp;
					}
					if (!empty($question_answer_array)) {
						$question_temp[$index]['question_answer'] = $question_answer_array[$index];
					}
				}
				$index++;
			}
		}
		if (!empty($question_temp)) {
			$question_details = $question_temp;
		}
	}

}else{
	$errors['user_data']="<p>Sorry, CBT Test is not  available for your course... Please try again!</p>";
}

if ($_POST) {
	$stmt = $conn->prepare("SELECT * FROM question_table WHERE course_code=:course_code AND department=:department AND level=:level");
	$stmt->execute(array(":course_code"=>$test_course,":department" => $department, ":level"=>$level));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if(!empty($row)){
			$level_courses = $course_department = null;
			$course_code = $row['course_code'];
			$course_title = $row['course_title'];
			$course_unit = $row['course_unit'];
			$questions = $row['questions'];
			$question_options = $row['question_options'];
			$question_answers = $row['question_answers'];
	}
			if(!empty($_POST['test_question'])) {
		$test_question = $_POST['test_question'];
		$temp_score = $total_score = 0;
		foreach ($test_question as $value) {
			if (!empty($value['question_option'])) {
				if (trim($value['question_option']) === trim($value['question_answer'])) {
					$temp_score += 1;
				}
			}
		}
		$total_score = intval($temp_score) * 10;
		$stmt = $conn->prepare("SELECT * FROM result_table WHERE matric_number=:matric_number AND user_group=:user_group AND course_code=:course_code AND level=:level");
		$stmt->execute(array(":matric_number" => $matric_number, ":user_group" => $user_group,":course_code"=>$course_code,":level"=>$level));
		$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
		if(empty($row2)) {
			$user_query = "INSERT INTO result_table SET department='$department', level='$level', matric_number='$matric_number', user_group='$user_group', course_title='$course_title' , course_code='$course_code' , course_unit='$course_unit', score=$total_score";
			if ($conn->query($user_query)) {
				$success['data'] = "<p>Your Test has been Submitted.</p><p>You Scored <b>$total_score</b> Out of <b>100</b>.</p>";
				$test_question = $question_details = array();
			} else {
				$errors['failure'] = "<h4>Sorry, Your Submission could not be completed. please try again later!</h4>";
			}
		}
	}
}

