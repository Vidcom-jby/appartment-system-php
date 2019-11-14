<?php
$url="";
if(stripos($_SERVER['SERVER_NAME'], "127.0") !==FALSE){
	$url="http://127.0.0.1/appartment_system/";
}elseif(stripos($_SERVER['SERVER_NAME'], "local.") !==FALSE){
	$url="http://localhost/appartment_system/";
}else{
	$url="http://".$_SERVER['SERVER_NAME']."/";
}