<?php
if ($_POST) {
    require_once 'db_connect.php';

    $user_group=strtoupper(trim($_POST['user_group']));
    $error=$success=array();
    $regex = '/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';
    if(empty($_POST['email'])){
        $errors['email']="<font color='#a94442'><span style='color:#a94442'>The Email field is required</span></font>";
    }
    elseif(!empty($email) && !preg_match($regex,trim($email))){
        $errors['email']= "<font color='#a94442'><span style='color:#a94442'>Please enter a valid Email Address</span></font>";
    }
    if(empty($_POST['last_name'])){
        $errors['last_name']="<font color='#a94442'><span style='color:#a94442'>The Last Name field is required</span></font>";
    }
    if(empty($_POST['other_name'])){
        $errors['other_name']="<font color='#a94442'><span style='color:#a94442'>The Other Names field is required</span></font>";
    }
    if(empty($_POST['phone'])){
        $errors['phone']="<font color='#a94442'><span style='color:#a94442'>The Phone Number field is required</span></font>";
    }
    if(empty($_POST['matric_number'])){
        $errors['matric_number']="<font color='#a94442'><span style='color:#a94442'>The Matric Number field is required</span></font>";
    }
    if(empty($_POST['department'])){
        $errors['department']="<font color='#a94442'><span style='color:#a94442'>The Department field is required</span></font>";
    }
    if(empty($_POST['level'])){
        $errors['level']="<font color='#a94442'><span style='color:#a94442'>The Level field is required</span></font>";
    }
	if(empty($_POST['password'])){
		$errors['password']="<font color='#a94442'><span style='color:#a94442'>Please enter your password</span></font>";
	}
	if(empty($_POST['cpassword'])){
		$errors['cpassword']="<font color='#a94442'><span style='color:#a94442'>Please confirm your password</span></font>";
	}
	if(!empty($_POST['password']) && !empty($_POST['cpassword']) && $_POST['password'] !== $_POST['cpassword']){
		$errors['password']="<font color='#a94442'><span style='color:#a94442'>Passwords do not match</span></font>";
	}
	
    $last_name=trim($_POST['last_name']);
    $other_name=trim($_POST['other_name']);
    $matric_number=trim($_POST['matric_number']);
    $matric_number=strtolower($matric_number);
    $email=trim($_POST['email']);
    $department=trim($_POST['department']);
    $phone=trim($_POST['phone']);
    $password=trim($_POST['password']);
    $password=sha1($_POST['password']);
    $level=trim($_POST['level']);
    
    $stmt = null;
    $stmt = $conn->prepare("SELECT * FROM user_table WHERE matric_number=:matric_number AND user_group=:user_group");
    $stmt->execute(array(":matric_number" => $matric_number, ":user_group" => $user_group));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!empty($row)){
        $errors['matric_number']= "<font color='#a94442'><span style='color:#a94442'>Sorry, the Matric Number already Exists!</span></font>";
    }
    if(empty($error)) {
        $user_query = "INSERT INTO user_table SET last_name='$last_name', other_name='$other_name', email='$email',
         phone='$phone', department='$department', level='$level',  password='$password', matric_number='$matric_number', user_group='$user_group' ";
        if ($conn->query($user_query)){
            $success['data']="<p>Your Registration was Successful. Click <span><a href='login.php?user_group=client'>here</a> to login and register your courses for Test </span></p>";
            $last_name=$other_name=$department=$level=$matric_number=$email=$phone=null;
        }else{
            $errors['failure']="<h4>Sorry, Your Registration could not be completed. please try again later!</h4>";
        }
    }
    else{
        return;
    }
}


?>