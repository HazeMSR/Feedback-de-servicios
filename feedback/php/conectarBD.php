<?php	
	function conectar($servBD,$usrBD,$passBD,$nombreBD){
		$conexion = mysqli_connect($servBD, $usrBD, $passBD, $nombreBD);
		mysqli_set_charset($conexion, "utf8");
		return $conexion;
	}

