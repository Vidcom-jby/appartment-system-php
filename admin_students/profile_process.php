<?php
require_once '../db_connect.php';

if (!$_POST) {
	$id=!empty($_GET['id'])?$_GET['id']:'';
	if(!empty($id)){
		$stmt = $conn->prepare("SELECT * FROM user_table WHERE id=:id");
		$stmt->execute(array(":id" => $id));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($row)){
			foreach ($row as $field=>$value){
				${'' . $field} = $value;
			}
		}else{
			header('Location: ../');
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
	$required_fields=array('surname'=>"The Surname field is required",'other_name'=>"The Other Names field is required",'email'=>"The Email field is required",'phone_number'=>"The Phone Number field is required",'password'=>"The Password field is required",'confirm_password'=>"The Confirm password field is required");
	
	if(!empty($post_data['id'])){
		if(empty($post_data['password']) && empty($password['confirm_password'])){
			unset($required_fields['password']);
			unset($required_fields['confirm_password']);
		}
	}
	foreach ($required_fields as $field_key => $field_text) {
		if (empty($_POST[$field_key])) {
			$errors[$field_key] =$field_text;
		}
	}
	if(empty($errors)){
		if(trim($post_data['password']) !== trim($post_data['confirm_password'])){
			$errors['password']="Passwords do not match!";
			$errors['confirm_password']="Passwords do not match!";
		}
	}
	if(empty($errors)) {
		$post_data = array_map('trim', $post_data);
		foreach ($post_data as $field_key => $field_value) {
			${'' . $field_key} = $field_value;
		}
		$stmt = null;
	
	}
	
	if(empty($errors)) {
		$new_unique_hash = sha1(uniqid(rand(), true));
		$email=!empty($email)?strtolower($email):'';
		$password=!empty($password)?sha1($password):'';
		if (!empty($post_data['id'])) {
			$stmt = $conn->prepare("SELECT * FROM user_table WHERE id=:id");
			$stmt->execute(array(":id" => $post_data['id']));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if(empty($post_data['password'])){
				$password=!empty($row['password'])?$row['password']:'';
			}
			$old_id=$post_data['id'];
			$conn_query = "UPDATE user_table SET surname='$surname',other_name='$other_name',email='$email',password='$password',user_group='ADMINISTRATOR', phone_number=$phone_number, updated=now() WHERE id='$old_id'";
		} else {
			$conn_query = "INSERT INTO user_table SET surname='$surname',other_name='$other_name',email='$email',password='$password',user_group='ADMINISTRATOR', phone_number=$phone_number, created=now(), id='$new_unique_hash'";
		}
		if ($conn->query($conn_query)){
			$_SESSION['success']= "Your Profile was successfully updated";
			if(!empty($_SESSION['user']['password']) && !empty($password) && $_SESSION['user']['password'] !==$password){
				header('Location: ../logout.php');
				exit();
			}else{
				header('Location: ./profile.php?id='.$_SESSION['user']['id']);
				exit();
			}
		
		}else{
			$errors['failure']="<h4>An error occurred while processing your request, please refresh the page and try again!</h4>";
		}
	}
	else{
		return;
	}
}


?>