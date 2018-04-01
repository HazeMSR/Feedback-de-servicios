<?php
	session_start();
	include("configBD.php");
	include("getPosts.php");
	

	/*Selecciona de la base de datos la curp que se envio en los
	formularios.*/
	$usuario = $_POST["usuario"];
	$contra = $_POST["contra"];
	$sqlAcc = "SELECT * FROM usuario WHERE id='$usuario' AND pass='$contra'";
	$resAcc = mysqli_query($conexion, $sqlAcc);
	$row = mysqli_fetch_array($resAcc,MYSQLI_BOTH);
	$infAcc = mysqli_num_rows($resAcc);	
	
	if($infAcc >= 1){
		$_SESSION["valido"] = "sesion";
		$_SESSION["id"] = $usuario;
		echo $row[2]; //Si es correcto regresa el nivel de permiso que tiene el usuario al ajax de index.js
	}else{
		echo -1;
	}

?>