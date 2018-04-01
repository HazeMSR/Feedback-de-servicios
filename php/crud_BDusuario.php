<?php
	include("configBD.php");
	include("getPosts.php");
	
	/*Selecciona de la base de datos la curp que se envio en los
	formularios.*/
	$usuario=$_SESSION["usuario"];
	$sqlEst = "SELECT * FROM alumno WHERE usuario='$usuario'";
	$resEst = mysqli_query($conexion, $sqlEst);
	$filasA = mysqli_fetch_array($resEst,MYSQLI_BOTH);


 	$sqlEst = "SELECT * FROM materiasinscritas WHERE alumno='$filasA[0]' AND materia='TT2'";
	$resEst = mysqli_query($conexion, $sqlEst);
	$infEst = mysqli_affected_rows($conexion);

	if($infEst == 1){
		$filasI = mysqli_fetch_array($resEst,MYSQLI_BOTH);
	}
	else{
		$filasI = array(0,0,0);
	}
	$sqlEst = "SELECT * FROM usuario WHERE usuario='$usuario'";
	$resEst = mysqli_query($conexion, $sqlEst);
	$filasU = mysqli_fetch_array($resEst,MYSQLI_BOTH);
	
?>