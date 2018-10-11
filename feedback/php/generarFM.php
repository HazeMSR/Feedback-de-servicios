<?php
	include("configBD.php");
	include("getPosts.php");
	
	$relacion = $_POST["relacion"];
	$atributo = $_POST["atributo"];
	$operador = $_POST["operador"];
	$valor = $_POST["valor"];

	$query = "SELECT * FROM ".$relacion." WHERE ".$atributo." ".$operador." '".$valor."'";

	$res = mysqli_query($conexion, $query);
	$row = mysqli_fetch_array($res,MYSQLI_BOTH);
	$inf = mysqli_num_rows($res);	

	echo $inf;