<?php
	session_start();
	include("configBD.php");
	include("getPosts.php");

	$file = $_POST["foto1"];
	$alumno = $_SESSION["usuario"];

	$sqlEst = "SELECT alumno FROM alumno WHERE usuario='$alumno'";
	$resEst = mysqli_query($conexion, $sqlEst);
	$filasA = mysqli_fetch_array($resEst,MYSQLI_BOTH);
	echo $sqlEst;
	$evento= "Excelencia 2017_2";

	$sqlIns = "INSERT INTO foto (link,alumno,evento) VALUES ('$file','$filasA[0]','$evento')";
	$resIns = mysqli_query($conexion, $sqlIns);
	$infIns = mysqli_affected_rows($conexion);

	echo $sqlIns;
?>
