<?php
	include("configBD.php");
	include("getPosts.php");
	
	/*Selecciona de la base de datos la curp que se envio en los
	formularios.*/
	$usuario=$_SESSION["usuario"];
	$sqlEst = "SELECT * FROM alumno WHERE usuario='$usuario'";
	$resEst = mysqli_query($conexion, $sqlEst);
	$filasA = mysqli_fetch_array($resEst,MYSQLI_BOTH);

	if($filasA[18]!=0){
		$sqlEst = "SELECT * FROM evento WHERE idEvento='Graduacion 2017_1'";
		$resEst = mysqli_query($conexion, $sqlEst);
		$filasE = mysqli_fetch_array($resEst,MYSQLI_BOTH);

		$sqlIns = "INSERT INTO alumnoevento (evento,alumno) VALUES ('$filasE[0]','$filasA[0]')";
		$resIns = mysqli_query($conexion, $sqlIns);

		$sqlUpd = "UPDATE alumno SET valida2='0' WHERE curp='$filasA[0]'";
		$resUpd = mysqli_query($conexion, $sqlUpd);
		$infUpd = mysqli_affected_rows($conexion);		
	}

	
?>