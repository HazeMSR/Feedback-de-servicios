<?php
	include("configBD.php");
	include("getPosts.php");
	
	$sqlEst = "Show create table usuario";
	$resEst = mysqli_query($conexion, $sqlEst);
	
	$regEst = "";
	$a=0;
	while($filas = mysqli_fetch_array($resEst,MYSQLI_BOTH)){
		echo $filas[0];
	}
