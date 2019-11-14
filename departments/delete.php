<?php
session_start();
require_once '../db_connect.php';
if(empty($_SESSION['user']) || ( !empty($_SESSION['user']) && $_SESSION['user']['user_group'] !== strtoupper('administrator'))){
     header('Location: ../');
	exit();
}else{
    $user_group=$_SESSION['user']['user_group'];
}

$id=!empty($_GET['id'])?$_GET['id']:'';
$stmt= null;
if(!empty($id)) {
	$stmt = $conn->prepare("SELECT * FROM dept_table WHERE id=:id");
	$stmt->execute(array(":id" => $id));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if (empty($row)) {
		$_SESSION['failure'] = "No Department was selected for Deletion or a server error occurred, please refresh the page and try again! ";
		header("Location:  ../departments");
		exit();
	} else {
		$query = "DELETE FROM dept_table WHERE id='$id' ";
		if ($conn->query($query)) {
			$_SESSION['success'] = "The Department (".(!empty($row['name'])?$row['name']:'').") was successfully Deleted";
			header("Location:  ../departments");
			exit();
		} else {
			$_SESSION['failure'] = "An error occurred while processing your request, please refresh the page and try again!";
			header("Location:  ../departments");
			exit();
		}
	}
}  else {
	$_SESSION['failure'] = "No Department was selected for Deletion or a server error occurred, please refresh the page and try again! ";
	header("Location: ../departments");
	exit();
}


?>