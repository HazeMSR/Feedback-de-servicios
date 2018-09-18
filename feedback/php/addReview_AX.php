<?php
	include("configBD.php");
	include("getPosts.php");
	
	$valida = $_POST["valida"];
	$servicio = $_POST["servicio"];
	$tema = $_POST["tema"];
	$estrellas = $_POST["estrellas"];
	$coment = $_POST["coment"];
	$id=$_POST["id"];
	$infTema=0;
	$sqlTemaIns = " ";
	
	if($valida==1){  //Si se uso el autocomplete
		$sqlTema = "SELECT * FROM tema WHERE nombre='$tema' AND idS='$servicio'";
		$resTema = mysqli_query($conexion, $sqlTema);
		$rowTema = mysqli_fetch_array($resTema,MYSQLI_BOTH);
		$infTema = mysqli_num_rows($resTema);	
	}
	if($valida==0 || $infTema<1){  //Si el tema no está en la base

		$sqlTemaIns = "INSERT INTO tema (nombre,idS) VALUES ('$tema','$servicio')";
	
		$resTemaIns = mysqli_query($conexion, $sqlTemaIns);
		$infTemaIns = mysqli_affected_rows($conexion);
	
		if($infTemaIns == 1){//OK. Se realizó el registro del alumno
			$sqlTema = "SELECT * FROM tema WHERE nombre='$tema' AND idS='$servicio'";
			$resTema = mysqli_query($conexion, $sqlTema);
			$rowTema = mysqli_fetch_array($resTema,MYSQLI_BOTH);
			$infTema = mysqli_num_rows($resTema);		
		}else{
			echo -1; //Error al leer el tema
		}
	}

		//Inserta la opinion la base
		$sqlOpi = "INSERT INTO opinion (calificacion,comentario,idT,idU,idS) VALUES ('$estrellas','$coment','$rowTema[0]','$id','$servicio')";
	
		$resOpi = mysqli_query($conexion, $sqlOpi);
		$infOpi = mysqli_affected_rows($conexion);
	
		if($infOpi == 1){//OK. Se realizó el registro de la opinion
			echo 1;
		}else{
			echo -2; //Error al insertar la opinion
		}
?>