<?php
require_once 'db_connect.php';
$stmt = null;
$stmt = $conn->prepare("SELECT * FROM user_table WHERE user_group=:user_group");
$stmt->execute(array(":user_group" => strtoupper('client')));

?>
