<?php
require_once '../db_connect.php';

$stmt = $conn->prepare("SELECT * FROM dept_table");
$stmt->execute(array());
$dept_list=array();
while( $data=$stmt->fetch(PDO::FETCH_ASSOC)){
	$dept_list[]=$data;
}
$lgas = get_ng_lgas();
$states = array_keys($lgas);

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
	$required_fields=array('image_uploaded'=>'The Passport Photo field is required','matric_number'=>'The Matric Number  field is required','surname'=>"The Surname field is required",'level'=>"The Level of Study field is required",'department'=>"The Department field is required",'other_name'=>"The Other Names field is required",'email'=>"The Email field is required",'phone_number'=>"The Phone Number field is required",'password'=>"The Password field is required",'confirm_password'=>"The Confirm password field is required",'state'=>"The State of Origin field is required",'lga'=>"The LGA of origin field is required",'study_centre'=>"The Study Centre field is required");
	
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
		
		$stmt = $conn->prepare("SELECT * FROM user_table WHERE matric_number=:matric_number");
		$stmt->execute(array(":matric_number" => !empty($matric_number)?strtoupper($matric_number):''));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!empty($row) && (empty($post_data['id']) || $post_data['id'] !== $row['id'])) {
			$errors['matric_number'] = "The Matric Number (<strong>".(!empty($matric_number)?$matric_number:'')."</strong>) already exists</span></font>";
		}
	}
	/**** Uploading Teller Photo  ***/
	$new_unique_hash = sha1(uniqid(rand(), true));
	if (empty($errors)) {
		if (!empty($post_data['image_uploaded'])) {
			$res=is_dir(APPLICATION_PATH . "/uploads/");
			if(!is_dir(APPLICATION_PATH . "/uploads/")){
				mkdir(APPLICATION_PATH . "/uploads/");
			}
			$file_name=$new_unique_hash;
			$image_location = APPLICATION_PATH . "/uploads/" .  $file_name.".jpg";
			$image_url = $url ."/uploads/" . $file_name. ".jpg";
			$decoded = $post_data['image_uploaded'];
			$data = explode(',', $decoded);
			if (!empty($data[1])) {
				try {
					file_put_contents($image_location, base64_decode($data[1]));
				} catch (\Exception $e) {
					unset($data);
					return $errors['image_uploaded'] = 'A server error occurred while uploading Image';
				}
			}
			unset($data);
			if (!is_file($image_location)) {
				return $errors['image_uploaded'] = 'A server error occurred while uploading Image!';
			}else{
				$post_data['image'] = $image_url;
			}
		}
	}
	if(empty($errors)) {
		foreach ($post_data as $field_key => $field_value) {
			${'' . $field_key} = $field_value;
		}
		$matric_number=!empty($matric_number)?strtoupper($matric_number):'';
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
			$conn_query = "UPDATE user_table SET department='$department',   image='$image',level='$level', matric_number='$matric_number',surname='$surname',other_name='$other_name',email='$email',study_centre='$study_centre',password='$password',state='$state',lga='$lga', user_group='STUDENT', phone_number=$phone_number, updated=now() WHERE id='$old_id'";
		} else {
			$conn_query = "INSERT INTO user_table SET department='$department',  image='$image', level='$level', matric_number='$matric_number',surname='$surname',other_name='$other_name',email='$email',study_centre='$study_centre',password='$password',state='$state',lga='$lga', created=now(), user_group='STUDENT', phone_number=$phone_number, id='$new_unique_hash'";
		}
		if ($conn->query($conn_query)){
			$_SESSION['success']= "The Student (<strong>".(!empty($matric_number)?strtoupper($matric_number):'')."</strong>) was Successfully ".(!empty($post_data['id'])?' updated ':' added ');
			header('Location: ./');
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