<?php
	session_start();
	$temp = $_REQUEST["nombSesion"];
	unset($_SESSION[$temp]);
	header("location:../index.php");
?>