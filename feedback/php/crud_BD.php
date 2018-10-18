<?php
	include("configBD.php");
	include("getPosts.php");
	

	$sqlEst = "SHOW TABLES";
	$resEst = mysqli_query($conexion, $sqlEst);
	
	$regEst2 = "";
	while($filas = mysqli_fetch_array($resEst,MYSQLI_BOTH)){
		$regEst2 .= "
				<option value='$filas[0]'>$filas[0]</option>
		";
	}

	$sqlEst = "SELECT * FROM usuario";
	$resEst = mysqli_query($conexion, $sqlEst);
	
	$regEst = "";
	$a=0;
	while($filas = mysqli_fetch_array($resEst,MYSQLI_BOTH)){
		$regEst .= "
		<tr>
			<td align='center'>$filas[0]</td>

			<td align='center'>
				<i class='fa fa-close eliminar' data-eliminar='$filas[0]'></i>
				<i class='fa fa-pencil editar' data-editar='$filas[0]'></i>
				<i class='fa fa-eye ver' data-ver='$filas[0]'></i>
			</td>
		</tr>
		";
		$a+=1;
	}

?>