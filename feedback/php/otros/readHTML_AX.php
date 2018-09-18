<?php
	include("configBD.php");
	
	$boleta = $_POST["boleta"];
	$sqlVer = "SELECT * FROM estudiantes WHERE boleta = '$boleta'";
	$resVer = mysqli_query($conexion, $sqlVer);
	$estudiante = mysqli_fetch_row($resVer);
	$htmlEstudiante = "<p class='flow-text'>
		<i class='fa fa-id-card blue-text'></i> $estudiante[0]<br>
		<i class='fa fa-user-circle-o blue-text'></i> $estudiante[1] $estudiante[2] $estudiante[3]<br>
		<i class='fa fa-venus-mars blue-text'></i> $estudiante[4]<br>
		<i class='fa fa-envelope blue-text'></i> $estudiante[5]
 		</span>
	</p>";
 
 	echo $htmlEstudiante;
?>