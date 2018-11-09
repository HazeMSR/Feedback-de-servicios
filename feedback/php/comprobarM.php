<?php
	include("configBD.php");
	include("getPosts.php");
	
	//		Obtiene los queries mandados por fragHoriz.js
	$q= $_POST["queries"];

	//		Divide las queries para poder ejecutarlas cada una
	$queries = explode("$;", $queries);
	$qLen=count($queries);
	$i=0;
	$result_array=[];
	
	//		Obtiene el nombre de la tabla a las cuáles se va a seleccionar las tuplas de los fragmentos
	preg_match_all("/F{1}R{1}O{1}M{1}\s+(.*?)+\s+W{1}H{1}E{1}R{1}E{1}/", $queries[0], $result_array);
	$tabla= $result_array[0][0];
	$tabla = preg_replace("/(F{1}R{1}O{1}M{1}\s+)|(\s+W{1}H{1}E{1}R{1}E{1})/", "", $tabla);
	

	$query1 = "SELECT * FROM ".$tabla;

	$res1 = mysqli_query($conexion, $query1);
	$rows = [];

	// 		OBTIENE UN ARREGLO CON TODAS LAS TUPLAS PARA REALIZAR LA VALIDACIÓN DE COMPLETITUD
	while($row = mysqli_fetch_array($res1,MYSQLI_BOTH)){
		$rows[$row[0]]=False;
	}

	$inf=0;

	//		Ejecuta cada query que se dividió anteriormente
	while($i<$qLen){
		$res = mysqli_query($conexion, $queries[$i]);
	

		while($row = mysqli_fetch_array($res,MYSQLI_BOTH)){

	// AGREGA VALORES AL ARREGLO DE COMPLETITUD OBTENIDO ANTERIORMENTE
			if($rows[$row[0]]==False)
				$rows[$row[0]]=True;
		}
		$inf= mysqli_num_rows($res);
	//	^
	// SI OBTIENE UN "EMPTY SET" SIGNIFICA QUE EL FRAGMENTO NO ES MÍNIMO, ENTONCES MANDA DE REGRESO A LA FUNCIÓN AJAX EL 
	// NÚMERO DE LA TUPLA DE LA TABLA DEL PASO 4) PARA ELIMINARLA, PARA QUE LOS FRAGMENTOS SEAN MÍNIMOS.
		if($inf<1)
			echo "{$i},"; //<---- aquí lo manda de regreso al ajax
		$i=$i+1;
	}

	$i=0;
	$rLen=count($rows);
	$val = True;

	foreach ($rows as $clave => $valor) {
		$val = $valor;

	//		 ESTO REALIZA LA VALIDACIÓN DE COMPLETITUD CON EL ARREGLO OBTENIDO PREVIAMENTE
		if(!$valor){
			break;
		}
	}
	$i=0;

echo $val;

	