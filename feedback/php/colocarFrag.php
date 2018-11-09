<?php
	include("conectarBD.php");
	include("getPosts.php");
	
//	Conecta con el sitio escogido previamente, con los datos de MySQL del usuario (Hazel, Bejar o Juel)
	$sitio= $_POST["sitio"];
	$servidor= $_POST["servidor"];
	$usuario= $_POST["usuario"];
	$pass= $_POST["pass"];
	$bd= $_POST["bd"];
	$conexion = conectar($servidor,$usuario,$pass,$bd);


//Obtiene el tipo de Fragmento
	$tipoFrag = $_POST["tipoFrag"];
	$q = $_POST["queries"];
	$queries = explode("$;", $queries);
	$qLen=count($queries);
	$i=0;
	$result_array=[];

//Selecciona de la tabla fragmento el sitio escogido para saber cómo numerar la tabla del fragmento a insertar.
	$query = "SELECT * FROM fragmentos WHERE servidor='$sitio'";
	$res = mysqli_query($conexion, $query);
	$row = mysqli_fetch_array($res,MYSQLI_BOTH);
//	echo $row[0];
	$noF = 0;

	if($tipoFrag[0]=="H"){
		$noF=intval($row[1]);
	}
	else if($tipoFrag[0]=="V"){
		$noF=intval($row[2]);
	}
	else{
		$noF=intval($row[3]);
	}

//Obtiene la tabla de dónde se van a sacar los fragmentos
	preg_match_all("/F{1}R{1}O{1}M{1}\s+(.*?)+\s+W{1}H{1}E{1}R{1}E{1}/", $queries[0], $result_array);
	$tabla= $result_array[0][0];
	$tabla = preg_replace("/(F{1}R{1}O{1}M{1}\s+)|(\s+W{1}H{1}E{1}R{1}E{1})/", "", $tabla);
//	echo $tabla;

//Obtiene el query para crear la nueva tabla

	$query2 = "SHOW CREATE TABLE $tabla";
	$res2 = mysqli_query($conexion, $query2);
	$row2 = mysqli_fetch_array($res2,MYSQLI_BOTH);
/*	echo "\nSHOW CREATE TABLE\n";
	echo $row2[1];
	echo "\n";
*/

//Crea el nombre y el query de la nueva tabla	

	$newTabla = "Fragmento".$tipoFrag[0].$noF;
	$query3 = preg_replace("/CREATE TABLE [\`]*(.*?)[\`]* [\(]/", "CREATE TABLE `$newTabla` (", $row2[1]);
	preg_match_all("/CONSTRAINT `(.*?)`/", $query3, $result_array);
	$constr= $result_array[0][0];
	$constr = preg_replace("/(CONSTRAINT `)|(`)/", "", $constr);
	$query3 = preg_replace("/CONSTRAINT `(.*?)`/", "CONSTRAINT `".$constr."$noF`", $query3);
	echo $query3;
	$res3 = mysqli_query($conexion, $query3);


//Inserta los valores obtenidos de los fragmentos minitérminos en la nueva tabla creada
/*
	$i=0;
	$inf = 1;
	$err = [];
	while($i<$qLen){
		$queryW = "INSERT INTO $newTabla ".$queries[$i];
		echo "\n QUERY W:\n";
		echo $queryW;
		$resQ = mysqli_query($conexion, $queryW);
		if(mysqli_num_rows($resQ)<1){
			$inf = mysqli_num_rows($resQ);
			$err[]=$queryW;
		}

		$i+=1;
	}
*/
//Aumenta en 1 el valor de los fragmentos para la generación de la proxima tabla
	if($tipoFrag[0]=="H"){
		$sqlUpd = "UPDATE fragmentos SET fragmentosH = ".($noF+1)." WHERE servidor = '$sitio'" ;
	}
	else if($tipoFrag[0]=="V"){
		$sqlUpd = "UPDATE fragmentos SET fragmentosV = ".($noF+1)." WHERE servidor = '$sitio'" ;
	}
	else{
		$sqlUpd = "UPDATE fragmentos SET fragmentosM = ".($noF+1)." WHERE servidor = '$sitio'" ;
	}
		
	$resUpd = mysqli_query($conexion, $sqlUpd);

//Regresa ok o los errores que se generaron
/*	if ($inf<1)
		echo $err;
	else
		echo "ok";
*/
