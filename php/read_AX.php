<?php
	include("configBD.php");
	
	$id = $_POST["id"];
	$sqlVer = "SELECT * FROM usuario WHERE id='$id'";
	$resVer = mysqli_query($conexion, $sqlVer);
	
	$estudiante = mysqli_fetch_assoc($resVer);
	
	$json = json_encode($estudiante);
 
 	echo $json;
?>