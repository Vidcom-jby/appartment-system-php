<?php
require_once 'db_connect.php';
$stmt= null;
$error=array();
$stmt = $conn->prepare("SELECT * FROM result_table WHERE matric_number=:matric_number AND user_group=:user_group AND level=:level");
$stmt->execute(array(":matric_number" => $matric_number, ":user_group" => $user_group,":level"=>$level));

