<?php
session_start();
session_destroy();
unset($_SESSION['user']);
unset($_SESSION);
if(empty($_SESSION)){
    header("Location: ./");
}
?>