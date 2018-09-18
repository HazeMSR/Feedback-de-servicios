<?php
	include("configBD.php");
	include("getPosts.php");

	$nombre = $_POST["nombre"];
	$sqlIns = "INSERT INTO servicio (nombre) VALUES ('$nombre')";

	$resIns = mysqli_query($conexion, $sqlIns);
	$infIns = mysqli_affected_rows($conexion);

	if($infIns == 1){//OK. Se realizó el registro del alumno
		echo 1;
	}else{
		echo $sqlIns;
	}


?>