<?php
	include("configBD.php");
	include("getPosts.php");

	$relacion= $_POST["relacion"];
	$atrib= $_POST["atributos"];


// Selecciona todos los atributos de la tabla 


	$query1 = "SELECT * FROM ".$relacion;
	$res1 = mysqli_query($conexion, $query1);
	$rows1 = mysqli_fetch_array($res1,MYSQLI_BOTH);

// Selecciona todos los atributos mandados por fragVert.js 

	$query2 = "SELECT ".$atrib." FROM ".$relacion;
	$res2 = mysqli_query($conexion, $query2);
	$rows2 = mysqli_fetch_array($res2,MYSQLI_BOTH);

//Compara si tienen el mismo número de columnas los resultSets de los queries anteriores
	if (count($rows1) == count($rows2))
		echo 1;
	else
		echo 0;
