<?php
require_once 'db_connect.php';
$stmt= null;
$error=array();
$stmt = $conn->prepare("SELECT * FROM user_table WHERE matric_number=:matric_number AND user_group=:user_group");
$stmt->execute(array(":matric_number" => strtolower($_SESSION['user']['matric_number']), ":user_group" => strtoupper($_SESSION['user']['user_group'])));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(!empty($row)){
	$last_name=trim($row['last_name']);
	$other_name=trim($row['other_name']);
	$department=trim($row['department']);
	$email=trim($row['email']);
	$matric_number=trim($row['matric_number']);
	$phone=trim($row['phone']);
	$level=trim($row['level']);
	
}else{
	$errors['user_data']="<p>Sorry no Data was Found. Please try again!</p>";
}

?>