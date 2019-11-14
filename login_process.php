<?php
if ($_POST) {
    session_start();
    require_once 'db_connect.php';
	$_POST=array_map('trim',$_POST);
	$post_data=$_POST;
    $user_group=!empty($_POST['user_group'])?strtoupper(trim($_POST['user_group'])):'';
    $errors=array();
   
    $required_fields['email']="The Email field is required";
    $required_fields['password']="The Password field is required";
    if(!empty($user_group) && in_array(strtolower($user_group),array('administrator','personnel'))) {
	    if (empty($post_data['email'])) {
		    $errors['email'] = "The Email field is required";
	    } elseif (!empty($post_data['email']) && !filter_var($post_data['email'], FILTER_VALIDATE_EMAIL)) {
		    $errors['email'] = "Please enter a valid Email Address";
	    }
    }else{
	    if (empty($post_data['matric_number'])) {
		    $errors['matric_number'] = "The Matric Number field is required";
	    }
    }
    if(empty($post_data['password'])){
	    $errors['password']="The Password field is required";
    }
    if(empty($errors)) {
        $stmt = null;
	   if(!empty($user_group) && in_array(strtolower($user_group),array('administrator','personnel'))) {
		   $stmt = $conn->prepare("SELECT * FROM user_table WHERE email=:email  AND user_group=:user_group");
		   $stmt->execute(array(":email" => strtolower($post_data['email']), ":user_group" => $user_group));
		   $row = $stmt->fetch(PDO::FETCH_ASSOC);
	   }else{
		   $stmt = $conn->prepare("SELECT * FROM user_table WHERE matric_number=:matric_number  AND user_group=:user_group");
		   $stmt->execute(array(":matric_number" => strtoupper($post_data['matric_number']), ":user_group" => $user_group));
		   $row = $stmt->fetch(PDO::FETCH_ASSOC);
	   }
	    if (empty($row)) {
	   	if(in_array(strtolower($user_group),array('administrator','personnel'))){
			$errors['email'] = "We could not find your Account. please contact admin for more information";
		}else{
			$errors['matric_number'] = "We could not find your Account. please contact admin for more information";
		}
	    } elseif (!empty($row) && $row['password'] !== sha1($post_data['password'])) {
		    $errors['password'] = "The Password is not correct!</font>";
	    } else {
	   	
		    $_SESSION['user'] = $row;
		    header('Location: index.php');
		    exit();
	    }
    }
    else{
	  
        return;
    }

}


?>