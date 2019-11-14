<?php
require_once 'db_connect.php';
$stmt= null;
$error=array();
$stmt = $conn->prepare("SELECT * FROM test_course_table WHERE department=:department AND matric_number=:matric_number");
$stmt->execute(array(":department" => $department, ":matric_number"=>$matric_number));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(!empty($row)){
	$level_courses=$course_department=null;
	$course_array=$course_details=$course_temp=array();
	if(!empty($level)) {
		$registered_courses = $row['registered_courses'];
		$course_department=$row['department'];
	}
	if(!empty($registered_courses)){
		$course_array=explode(';',$registered_courses);
	}
	if(!empty($course_array)){
		$index=0;
		foreach ($course_array as $value){
			if(!empty($value)) {
				$course_temp = explode(':', $value);
				if (!empty($course_temp)) {
					$course_temp[0]=!empty($course_temp[0])?trim($course_temp[0]):'';
					$course_temp[1]=!empty($course_temp[1])?trim($course_temp[1]):'';
					$course_temp[2]=!empty($course_temp[2])?trim($course_temp[2]):'';
					if(!empty($course_temp[0])){
						$course_details[$index]['course_code'] = $course_temp[0] ;
					}
					if(!empty($course_temp[1])){
						$course_details[$index]['course_title'] = $course_temp[1] ;
					}
					if(!empty($course_temp[2])){
						$course_details[$index]['course_unit'] = $course_temp[2] ;
					}
					$index++;
				}
			}
		}
	}
}else{
	$errors['user_data']="<p>Sorry, no Registered Courses available for Test... Please register your courses and try again!</p>";
}



