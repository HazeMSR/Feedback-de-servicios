<?php
	include("configBD.php");
	include("getPosts.php");
	
	/*Selecciona de la base de datos la curp que se envio en los
	formularios.*/
	//$curp = $_POST["curp"];
	//$pass = $_POST["pass"];
	$sqlEst = "SELECT * FROM usuario";
	$resEst = mysqli_query($conexion, $sqlEst);
	
	$regEst = "";
	$a=0;
	while($filas = mysqli_fetch_array($resEst,MYSQLI_BOTH)){
		$regEst .= "
		<tr>
			<td>$filas[0]</td>

			<td>
				<i class='fa fa-close eliminar' data-eliminar='$filas[0]'></i>
				<i class='fa fa-pencil editar' data-editar='$filas[0]'></i>
				<i class='fa fa-eye ver' data-ver='$filas[0]'></i>
			</td>
		</tr>
		";
		$a+=1;
	}
	$cadenaHTML1 = " ";
	$i = 2000;
    while($i>=1917){
        $cadenaHTML1=$cadenaHTML1+"<option value='"+$i+"'>"+$i+"</option>";
        $i-=1;
    }
	$cadenaHTML2 = " ";
	$j = 12;
    while($j>=1){
        $cadenaHTML2=$cadenaHTML2+"<option value='"+$j+"'>"+$j+"</option>";
        $j-=1;
    }
	$cadenaHTML3 = " ";
		
?>