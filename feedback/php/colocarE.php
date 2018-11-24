<?php
	include("conectarBD.php");
	include("getPosts.php");
	
//	Conecta con el sitio escogido previamente, con los datos de MySQL del usuario (Hazel, Bejar o Juel)
	$sitio= $_POST["sitio"];
	$servidor= $_POST["servidor"];
	$usuario= $_POST["usuario"];
	$pass= $_POST["pass"];
	$bd= $_POST["bd"];
	$tipoFrag = $_POST["tipoFrag"];
	$conexion = conectar($servidor,$usuario,$pass,$bd);

	$relacion= $_POST["relacion"];
	$atributos= $_POST["atributos"];

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

// Crea el querie para obtener los atributos completos de la tabla
	$query2 = "SHOW CREATE TABLE $relacion";
	$res2 = mysqli_query($conexion, $query2);
	$row2 = mysqli_fetch_array($res2,MYSQLI_BOTH);
	echo $row2[1]."<br>";
	$newTabla = "fragmento".$tipoFrag[0].$noF;
	$query3 = preg_replace("/CREATE TABLE [\`]*(.*?)[\`]* [\(]/", "CREATE TABLE `$newTabla` (", $row2[1]);
	
//Sustituye las comas de los atributos por or's para el siguiente regex
	$atr = preg_replace("/,+/", "|", $atributos);

//Elimina los saltos de línea
	$queryAtr = preg_replace("/\n/","",$query3);
	$queryAtr = explode(",",$queryAtr);
	$qaLen = count($queryAtr);
	$i = 0;
	$newQuery="";

//Verifica si una linea del query hace referencia a los atributos para añadirlos al nuevo query
//Si no, verifica que contenga la configuración final de la tabla.
	while($i<$qaLen){
		if (preg_match("/.+(".$atr.")+.+/",$queryAtr[$i])){
			preg_match_all("/.+(".$atr.")+.+/", $queryAtr[$i], $result_array);
			$newQuery.=$result_array[0][0].",";
		}
		else{	
			if(preg_match("/[)]+.+[;]+/",$queryAtr[$i])){
				preg_match_all("/[)]+.+[;]+/",$queryAtr[$i], $result_array);
				$newQuery.=$result_array[0][0];
			}
		}
		$i = $i+1;
	}
// Si termina en ,) la reemplaza por )
	$newQuery = preg_replace("/[,]+\W+[)]+/", ")", $newQuery);
	$newQuery = substr($newQuery, 0, -1);

//Cambia el nombre de los constraints para que sea viable para el compilador
	preg_match_all("/CONSTRAINT `(.*?)`/", $newQuery, $result_array);
	$cLen =count($result_array[0]);
	$i = 0;
	while($i<$cLen){
		$constr= $result_array[0][$i];
		$constr = preg_replace("/(CONSTRAINT `)|(`)/", "", $constr);
		$newQuery = preg_replace("/CONSTRAINT `$constr`/", "CONSTRAINT `".$constr."$noF`", $newQuery);
		$i=$i+1;
	}
	echo $newQuery;
	$res3 = mysqli_query($conexion, $newQuery);

	$err = [];
//Inserta los nuevos datos en la base
	$queryW = "INSERT INTO $newTabla SELECT ".$atributos." FROM ".$relacion;
	//echo $queryW;
	$resQ = mysqli_query($conexion, $queryW);
		if(mysqli_num_rows($resQ)<1){
			$inf = mysqli_num_rows($resQ);
			$err[]=$queryW;
		}

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
	if ($inf<1){
		foreach ($err as $e) {
			echo $e;
		}
	}
	else
		echo "ok";