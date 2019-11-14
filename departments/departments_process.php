<?php
require_once '../db_connect.php';
$stmt = null;
$stmt = $conn->prepare("SELECT * FROM dept_table");
$stmt->execute(array());

?>
