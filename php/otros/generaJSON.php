<?php
	include("configBD.php");
	
	$sqlVer = "SELECT * FROM alumno";
	$resVer = mysqli_query($conexion, $sqlVer);
	
	$regEsts = array();
	while($filas = mysqli_fetch_assoc($resVer)){
		$regEsts[] = $filas;
	}
	
	$json = json_encode($regEsts);
 
 	echo $json;
?>