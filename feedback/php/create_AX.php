<?php
	include("configBD.php");
	include("getPosts.php");

	$id = $_POST["id"];
	$contra = $_POST["contra"];
	$tipo = $_POST["tipo"];

	$sqlIns = "INSERT INTO usuario VALUES ('$id','$contra','$tipo')";

	$resIns = mysqli_query($conexion, $sqlIns);
	$infIns = mysqli_affected_rows($conexion);

	if($infIns == 1){//OK. Se realizó el registro del alumno
		echo 1;
	}else{
		echo 2;
	}


?>