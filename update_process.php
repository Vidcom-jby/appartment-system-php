<?php
require_once 'db_connect.php';
$stmt= null;
$error=array();
$stmt = $conn->prepare("SELECT * FROM user_table WHERE email=:email AND user_group=:user_group");
$stmt->execute(array(":email" => $old_email, ":user_group" => strtoupper('client')));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(!empty($row)){
	$name=trim($row['name']);
	$address=trim($row['address']);
	$email=trim($row['email']);
	$dob=trim($row['dob']);
	$phone=trim($row['phone']);
}else{
    $errors['user_data']="<p>Sorry no User was Selected. Please try again!</p>";
}
if ($_POST) {
    $user_group=strtoupper(trim($_POST['user_group']));
    $error=$success=array();
    $regex = '/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';
	if(empty($_POST['email'])){
		$errors['email']="<font color='#a94442'><span style='color:#a94442'>The Email field is required</span></font>";
	}
	elseif(!empty($email) && !preg_match($regex,trim($email))){
		$errors['email']= "<font color='#a94442'><span style='color:#a94442'>Please enter a valid Email Address</span></font>";
	}
	if(empty($_POST['name'])){
		$errors['name']="<font color='#a94442'><span style='color:#a94442'>The Name field is required</span></font>";
	}
	if(empty($_POST['phone'])){
		$errors['phone']="<font color='#a94442'><span style='color:#a94442'>The Phone Number field is required</span></font>";
	}
	if(empty($_POST['dob'])){
		$errors['dob']="<font color='#a94442'><span style='color:#a94442'>The Date of Birth field is required</span></font>";
	}
	if(empty($_POST['address'])){
		$errors['address']="<font color='#a94442'><span style='color:#a94442'>The Address of field is required</span></font>";
	}

	if(!empty($_POST['password']) && !empty($_POST['cpassword']) && $_POST['cpassword'] !== $_POST['password']){
		$errors['password']="<font color='#a94442'><span style='color:#a94442'>Passwords do not match</span></font>";
	}
	
	$name=trim($_POST['name']);
	$address=trim($_POST['address']);
	$email=trim($_POST['email']);
	$dob=trim($_POST['dob']);
	$phone=trim($_POST['phone']);
	if(!empty($_POST['password'])) {
		$password = trim($_POST['password']);
		$password = sha1($_POST['password']);
	}else{
		$password = ($row['password']);
	}
    $stmt = null;
    $stmt = $conn->prepare("SELECT * FROM user_table WHERE email=:email AND user_group=:user_group");
    $stmt->execute(array(":email" => $email, ":user_group" => $user_group));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!empty($row) && $row['email'] !==$old_email){
        $errors['email']= "<font color='#a94442'><h4 style='color:#a94442'>Sorry, the Email already Exists!</font>";
    }
    if(empty($error)) {
        $user_query = "UPDATE user_table SET name='$name', email='$email',
         phone='$phone', dob='$dob',  password='$password', address='$address',user_group='$user_group' WHERE email='$old_email'";
        if ($conn->query($user_query)){
            $success['data']="<p>User (".$email.") was Successfully Updated</p>";
       }else{
            $errors['failure']="<h4>Sorry, Your Update could not be completed. please try again later!</h4>";
        }
    }
    else{
        return;
    }
}

?>