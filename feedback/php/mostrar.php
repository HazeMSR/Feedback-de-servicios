<?php
	include("configBD.php");
	include("getPosts.php");
	$mostrar = $_POST["mostrar"];
	$sqlUpd = "UPDATE config SET mostrar='$mostrar' WHERE idconfig='1'";
	
	$resUpd = mysqli_query($conexion, $sqlUpd);
	$infUpd = mysqli_affected_rows($conexion);
	if($infUpd == 1){
		echo $sqlUpd; //OK. Se realizó la actualización del registro
	}else{
		echo $sqlUpd; //ERROR. No se pudo realizar la actualización
	}
	
?>