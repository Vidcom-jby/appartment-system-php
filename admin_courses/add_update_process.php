<?php
require_once '../db_connect.php';

$stmt = $conn->prepare("SELECT * FROM dept_table");
$stmt->execute(array());
$dept_list=array();
while( $data=$stmt->fetch(PDO::FETCH_ASSOC)){
	$dept_list[]=$data;
}

if (!$_POST) {
	$id=!empty($_GET['id'])?$_GET['id']:'';
	if(!empty($id)){
		$stmt = $conn->prepare("SELECT * FROM course_table WHERE id=:id");
		$stmt->execute(array(":id" => $id));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($row)){
			foreach ($row as $field=>$value){
				${'' . $field} = $value;
			}
		}
	}
}else{

	if(!empty($_POST)){
		foreach ($_POST as $field_key => $field_value) {
			${'' . $field_key} = $field_value;
		}
	}
	$post_data=$_POST;
	$user_group=strtoupper(trim($_POST['user_group']));
	$errors=$success=array();
	$regex = '/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';
	$required_fields=array('title'=>'The Course Title field is required','code'=>"The Course Code field is required",'unit'=>"The Credit Unit field is required",'department'=>"The Department field is required",'semester'=>"The Course Semester field is required",'level'=>"The Course Level field is required",'status'=>"The Course Status field is required");
	
	foreach ($required_fields as $field_key => $field_text) {
		if (empty($_POST[$field_key])) {
			$errors[$field_key] =$field_text;
		}
	}
	
	if(empty($errors)) {
		$post_data = array_map('trim', $post_data);
		foreach ($post_data as $field_key => $field_value) {
			${'' . $field_key} = $field_value;
		}
		$stmt = null;
		
		$stmt = $conn->prepare("SELECT * FROM course_table WHERE code=:code");
		$stmt->execute(array(":code" => !empty($code)?$code:''));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!empty($row) && (empty($post_data['id']) || $post_data['id'] !== $row['id'])) {
			$errors['code'] = "The Course Code (<strong>".(!empty($code)?$code:'')."</strong>) already exists</span></font>";
		}
		if(empty($errors)){
			$stmt = $conn->prepare("SELECT * FROM course_table WHERE title=:title");
			$stmt->execute(array(":title" => !empty($title)?$title:''));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if (!empty($row) && (empty($post_data['id']) || $post_data['id'] !== $row['id'])) {
				$errors['title'] = "The Course Title (<strong>".(!empty($title)?$title:'')."</strong>) already exists</span></font>";
			}
		}
	}

	if(empty($errors)) {
		$new_unique_hash = sha1(uniqid(rand(), true));
		$title=!empty($title)?ucwords(strtolower($title)):'';
		if (!empty($post_data['id'])) {
			$old_id=$post_data['id'];
			$conn_query = "UPDATE course_table SET title='$title',  code='$code', department='$department',status='$status',semester='$semester',level='$level',unit='$unit', updated=now() WHERE id='$old_id'";
		} else {
			$conn_query = "INSERT INTO course_table SET title='$title',  code='$code', department='$department',status='$status',semester='$semester',level='$level',unit='$unit', created=now(), id='$new_unique_hash'";
		}
		if ($conn->query($conn_query)){
			$_SESSION['success']= "The Course (<strong>".(!empty($title)?$title:'')."</strong>) was Successfully ".(!empty($post_data['id'])?' updated ':' added ');
			header('Location: '.$url.'admin_courses/');
			exit();
		}else{
			$errors['failure']="<h4>An error occurred while processing your request, please refresh the page and try again!</h4>";
		}
	}
	else{
		return;
	}
}


?>