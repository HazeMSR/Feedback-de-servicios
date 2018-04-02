<?php
	include("configBD.php");
	include("getPosts.php");
	$id = $_POST["id"];

	$sqlUpd = "UPDATE servicio SET idservicio='$id2',nombre='$nombre'WHERE idservicio='$id'";
	
	$resUpd = mysqli_query($conexion, $sqlUpd);
	$infUpd = mysqli_affected_rows($conexion);
	if($infUpd == 1){
		echo 1; //OK. Se realizó la actualización del registro
	}else{
		echo $sqlUpd; //ERROR. No se pudo realizar la actualización
	}
?>