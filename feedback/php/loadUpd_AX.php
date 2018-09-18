<?php
	include("configBD.php");
	include("getPosts.php");
	
	$id = $_POST["id"];
	$sqlLoadUpd = "SELECT * FROM usuario WHERE id = '$id'";
	$resLoadUpd = mysqli_query($conexion, $sqlLoadUpd);
	$infBoleta = mysqli_fetch_assoc($resLoadUpd);
	$json = json_encode($infBoleta);
	echo $json;
?>