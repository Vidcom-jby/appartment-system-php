<?php
require_once '../db_connect.php';

$id=!empty($_GET['id'])?$_GET['id']:'';
if(empty($id)){
	header('Location: ./');
	exit();
}

$course_details=$exam_details=array();
$stmt = $conn->prepare("SELECT * FROM user_table WHERE id=:id");
$stmt->execute(array(':id'=>$id));
$data=$stmt->fetch(PDO::FETCH_ASSOC);
if(empty($data)){
	header('Location: ./');
	exit();
}
$student_data=$data;
$user_courses=!empty($data['registered_courses'])?$data['registered_courses']:'';
$user_courses_temp=explode(';',$user_courses);


if(!empty($user_courses_temp)){
	$user_courses_temp=array_map('trim',$user_courses_temp);
	foreach ($user_courses_temp as $code){
		if(!empty($code)){
			$stmt = $conn->prepare("SELECT * FROM course_table WHERE code=:code");
			$stmt->execute(array(':code'=>$code));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			if(!empty($row['unit']) && intval($row['unit'])>2){
				$row['cost']=2500;
			}else{
				$row['cost']=2000;
			}
			$course_details[]=$row;
		}
	}
}

$stmt = $conn->prepare("SELECT * FROM user_table WHERE id=:id");
$stmt->execute(array(':id'=>$id));
$data=$stmt->fetch(PDO::FETCH_ASSOC);
if(empty($data)){
	header('Location: ./');
	exit();
}
$user_courses=!empty($data['registered_exam_courses'])?$data['registered_exam_courses']:'';
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
				$exam_details[]=$row;
			}
		}
	}
}


?>