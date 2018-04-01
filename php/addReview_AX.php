<?php
	include("configBD.php");
	include("getPosts.php");
	
	$valida = $_POST["valida"];
	$servicio = $_POST["servicio"];
	$tema = $_POST["tema"];
	$estrellas = $_POST["estrellas"];
	$coment = $_POST["coment"];
	$id=$_SESSION["id"];
	$infTema=0;

	if($valida==1){
		temas:
		$sqlTema = "SELECT * FROM tema WHERE nombre='$tema' AND idS='$servicio'";
		$resTema = mysqli_query($conexion, $sqlTema);
		$rowTema = mysqli_fetch_array($resTema,MYSQLI_BOTH);
		$infTema = mysqli_num_rows($resTema);		
	}
	else if($valida==0 || $infTema<1){

		$sqlTemaIns = "INSERT INTO tema (nombre,idS) VALUES ('$tema','$servicio')";
	
		$resTemaIns = mysqli_query($conexion, $sqlTemaIns);
		$infTemaIns = mysqli_affected_rows($conexion);
	
		if($infTemaIns == 1){//OK. Se realizó el registro del alumno
			goto temas;
		}else{
			echo -1;
		}
	}
		$sqlOpi = "INSERT INTO opinion (calificacion,comentario,idT,idU,idS) VALUES ('$estrellas','$coment','$rowTema[0]','$id','$servicio')";
	
		$resOpi = mysqli_query($conexion, $sqlOpi);
		$infOpi = mysqli_affected_rows($conexion);
	
		if($infOpi == 1){//OK. Se realizó el registro del alumno
			echo 1;
		}else{
			echo -2;
		}
?>