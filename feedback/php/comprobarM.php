<?php
	include("configBD.php");
	include("getPosts.php");
	
	$q= $_POST["queries"];
	$queries = explode("$;", $queries);
	$qLen=count($queries);
	$i=0;
	$result_array=[];
	
	preg_match_all("/F{1}R{1}O{1}M{1}\s+(.*?)+\s+W{1}H{1}E{1}R{1}E{1}/", $queries[0], $result_array);
	$tabla= $result_array[0][0];
	$tabla = preg_replace("/(F{1}R{1}O{1}M{1}\s+)|(\s+W{1}H{1}E{1}R{1}E{1})/", "", $tabla);
	

	$query1 = "SELECT * FROM ".$tabla;

	$res1 = mysqli_query($conexion, $query1);
	$rows = [];

	while($row = mysqli_fetch_array($res1,MYSQLI_BOTH)){
		$rows[$row[0]]=False;
	}

	$m = []
	while($i<$qLen){
		$res = mysqli_query($conexion, $queries[$i]);
	

		while($row = mysqli_fetch_array($res,MYSQLI_BOTH)){
			if($rows[$row[0]]==False)
				$rows[$row[0]]=True;
		}
		$inf= mysqli_num_rows($res);
		if($inf<1)
			echo "{$i},";
		
		$i=$i+1;
	}

	$i=0;
	$rLen=count($rows);
	$val = True;

	foreach ($rows as $clave => $valor) {
		$val = $valor;
		if(!$valor){
			break;
		}
	}
	$i=0;

echo $val;

	