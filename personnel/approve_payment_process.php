<?php
require_once '../db_connect.php';

if (!$_POST) {
	$id=!empty($_GET['id'])?$_GET['id']:'';
	$action=!empty($_GET['action'])?$_GET['action']:'';
	if(!empty($id)){
		$stmt = $conn->prepare("SELECT * FROM payment_table WHERE id=:id");
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
	$required_fields=array('date'=>'The Payment Date  field is required','amount'=>"The Amount field is required",'bank_name'=>"The Bank Name field is required",'bank_branch'=>"The Bank Branch field is required",'teller_image_uploaded'=>"The Bank Teller Image is required");
	
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
	}
	
	if(empty($errors)) {
		/**** Uploading Teller Photo  ***/
		$user_data=$_SESSION['user'];
		if (empty($errors)) {
			if (!empty($post_data['teller_image_uploaded'])) {
				$res=is_dir(APPLICATION_PATH . "/teller_uploads/");
				if(!is_dir(APPLICATION_PATH . "/teller_uploads/")){
					mkdir(APPLICATION_PATH . "/teller_uploads/");
				}
				$file_name=$user_data['id'].date('Y.m.d_his');
				$image_location = APPLICATION_PATH . "/teller_uploads/" .  $file_name.".jpg";
				$image_url = $url ."/teller_uploads/" . $file_name. ".jpg";
				$decoded = $post_data['teller_image_uploaded'];
				$data = explode(',', $decoded);
				if (!empty($data[1])) {
					try {
						file_put_contents($image_location, base64_decode($data[1]));
					} catch (\Exception $e) {
						unset($data);
						return $errors['teller_image_uploaded'] = 'A server error occurred while uploading Payment Teller!';
					}
				}
				unset($data);
				if (!is_file($image_location)) {
					return $errors['teller_image_uploaded'] = 'A server error occurred while uploading Payment Teller!';
				}else{
					$post_data['teller_image'] = $image_url;
				}
			}
		}
	}
	if(empty($errors)){
		
		foreach ($post_data as $field_key => $field_value) {
			${'' . $field_key} = $field_value;
		}
		$amount=!empty($amount)?filter_var($amount,FILTER_SANITIZE_NUMBER_FLOAT):0;
		$user_id=!empty($user_data['id'])?$user_data['id']:'';
		$new_unique_hash = sha1(uniqid(rand(), true));
		if (!empty($post_data['id'])) {
			$old_id = $post_data['id'];
			if (!empty($post_data['action']) && strtolower($post_data['action']) === "approve") {
				$status = "APPROVED";
			} else {
				$status = "PENDING";
			}
			$conn_query = "UPDATE payment_table SET status='$status', updated=now() WHERE id='$old_id'";
			
			if ($conn->query($conn_query)) {
				
				if (!empty($post_data['id'])) {
					$stmt = $conn->prepare("SELECT * FROM payment_table WHERE id=:id");
					$stmt->execute(array(":id" => $post_data['id']));
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					if (!empty($row['user_id'])) {
						$stmt = $conn->prepare("SELECT * FROM user_table WHERE id=:id");
						$stmt->execute(array(":id" => $row['user_id']));
						$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
						$wallet_balance = !empty($row2['wallet_balance']) ? floatval($row2['wallet_balance']) : 0;
						
						if (!empty($post_data['action']) && strtolower($post_data['action']) === "disapprove") {
							$wallet_balance = $wallet_balance - $amount;
							$wallet_balance = ($wallet_balance < 0) ? 0 : 0;
						} else {
							$wallet_balance = $wallet_balance + $amount;
						}
						$conn_query = "UPDATE user_table SET wallet_balance=$wallet_balance WHERE id='".$row2['id']."'";
						$conn->query($conn_query);
					}
				}
				if (!empty($post_data['action']) && strtolower($post_data['action']) === "disapprove") {
					$_SESSION['success'] = "The Payment Teller of  (<strong>#" . (!empty($amount) ? number_format($amount, 2, '.', ',') : 0) . "</strong>) was successfully  DISAPPROVED";
				}else{
					$_SESSION['success'] = "The Payment Teller of  (<strong>#" . (!empty($amount) ? number_format($amount, 2, '.', ',') : 0) . "</strong>) was successfully  APPROVED";
				}
				header('Location: ./manage_payments.php');
				exit();
			} else {
				$errors['failure'] = "<h4>An error occurred while processing your request, please refresh the page and try again!</h4>";
			}
		}
	}
	else{
		return;
	}
}


?>