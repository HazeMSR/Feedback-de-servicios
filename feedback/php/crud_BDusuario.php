<?php
	include("configBD.php");
	include("getPosts.php");
	
	/*Selecciona de la base de datos la curp que se envio en los
	formularios.*/
	$id=$_SESSION["id"];
	$sqlEst = "SELECT * FROM usuario WHERE id='$id'";
	$resEst = mysqli_query($conexion, $sqlEst);
	$filasA = mysqli_fetch_array($resEst,MYSQLI_BOTH);

?>