<?php
	$servBD = "localhost";
	$usrBD = "root";
	$passBD = "n0m3l0";
	$nombreBD = "feedback";

	$newU="";
	$newP="";

	$handle = fopen("../db_config.txt", "r");
	$i = 0;
	if ($handle) {
    	while (($line = fgets($handle)) !== false) {
        	if($i == 0)
        		$newU = $line;
        	else
        		$newP = $line;
        	$i++;
    	}


    fclose($handle);
	} else {
    	// error opening the file.
	} 
	$usrBD = str_replace(["\r\n", "\r", "\n"], '',$newU);
	$passBD = str_replace(["\r\n", "\r", "\n"], '',$newP);
	/*
	echo "serv: ".$servBD."\n";
	echo "user: ".$usrBD."\n";
	echo "pass: ".$passBD."\n";
	echo "nombre: ".$nombreBD."\n";}*/
	$conexion = mysqli_connect($servBD, $usrBD, $passBD, $nombreBD);
	mysqli_set_charset($conexion, "utf8");
?>
