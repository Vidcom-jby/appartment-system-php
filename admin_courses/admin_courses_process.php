<?php
require_once '../db_connect.php';
$stmt = null;
$stmt = $conn->prepare("SELECT * FROM course_table");
$stmt->execute(array());

?>
