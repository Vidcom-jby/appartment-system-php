<?php
session_start();
if(empty($_SESSION['user']) || ( !empty($_SESSION['user']) && $_SESSION['user']['user_group'] !== strtoupper('administrator'))){
    return header('Location:index.php');
}else{
    $user_group=$_SESSION['user']['user_group'];
}
$old_email=$_GET['email'];
$old_callup_number=$_GET['callup_number'];

if(empty($old_email) && empty($old_callup_number)){
    header("Location: index.php");
}
require_once 'db_connect.php';
$stmt= null;
$error=array();
$stmt = $conn->prepare("SELECT * FROM user_table WHERE email=:email AND user_group=:user_group");
$stmt->execute(array(":email" => $old_email, ":user_group" => strtoupper('client')));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if(empty($row)){
    header("Location: index.php");
}else{
    $user_query = "DELETE FROM user_table WHERE email='$old_email' ";
    if ($conn->query($user_query)) {
        header("Location: members.php");
    }else{
        header("Location: index.php");
    }
}

?>