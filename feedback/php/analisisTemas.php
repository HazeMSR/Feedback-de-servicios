<!--Verifica la sesion-->
<?php
	session_start();
	if($_SESSION["valido"] == "sesion"){
		include("crud_BDusuario.php");


		$sqlServ = "SELECT * FROM servicio";
		$resServ = mysqli_query($conexion, $sqlServ);

		$sqlTemas = "SELECT * FROM tema";
		$resTemas = mysqli_query($conexion, $sqlTemas);

		$sqlOpi = "SELECT * FROM opinion";
		$resOpi = mysqli_query($conexion, $sqlOpi);
		$infOpi = mysqli_num_rows($resOpi);

?>
<!doctype html>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta charset="utf-8">
	<title>Rese&ntilde;as</title>
	<link rel="stylesheet" type="text/css" href="../materialize/css/materialize.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../fontAwesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../js/confirm/jquery-confirm.min.css">
	<link rel="stylesheet" type="text/css" href="../js/validetta101/validetta.min.css">
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../materialize/js/materialize.min.js"></script>
	<script src="../js/init.js"></script>
	<script src="../js/confirm/jquery-confirm.min.js"></script>
	<script src="../js/validetta101/validetta.min.js"></script>
	<script src="../js/validetta101/localization/validettaLang-es-ES.js"></script>
	<script src="../js/Chart.bundle.js"></script>
	<script src="../js/crud.js"></script>
	<script src="../js/reviewUsuario.js"></script>
    <script>
        $(document).ready(function() {
        	//Select
        	$('select').material_select();
        	   

        	//Autocomplete			
        	$('#tema').autocomplete({
			    data: {
			    	<?php
			    		$a=0;
			    		while($filas = mysqli_fetch_array($resTemas,MYSQLI_BOTH)){
			    			if($a!=0)
			    				echo ",";
							echo "'$filas[1]':null";     					
      						$a+=1;
      					}	
			    	?>
			      },
			     onAutocomplete:function(e){
			     	$("#valida").val(1);
			     },
			});

			//Abre el formulario 
			$("#addRes").on("click",function(){
				$("#modalAddRev").modal("open");
			});

			//Abre las reseñas 
			$("#openRev").on("click",function(){
				$("#modalReviews").modal("open");
			});
			//Cierra las reseñas 
			$(".cerrar").on("click",function(){
				$("#modalReviews").modal("close");
			});
			//Estrellas de calificación
			$("#star1").on("click",function(){
				$("#star1").css({"color":"yellow"});
				$("#star2").css({"color":"black"});
				$("#star3").css({"color":"black"});
				$("#star4").css({"color":"black"});
				$("#star5").css({"color":"black"});
				$("#estrellas").val(1);
			});
			$("#star2").on("click",function(){
				$("#star1").css({"color":"yellow"});
				$("#star2").css({"color":"yellow"});
				$("#star3").css({"color":"black"});
				$("#star4").css({"color":"black"});
				$("#star5").css({"color":"black"});
				$("#estrellas").val(2);
			});
			$("#star3").on("click",function(){
				$("#star1").css({"color":"yellow"});
				$("#star2").css({"color":"yellow"});
				$("#star3").css({"color":"yellow"});
				$("#star4").css({"color":"black"});
				$("#star5").css({"color":"black"});
				$("#estrellas").val(3);
			});
			$("#star4").on("click",function(){
				$("#star1").css({"color":"yellow"});
				$("#star2").css({"color":"yellow"});
				$("#star3").css({"color":"yellow"});
				$("#star4").css({"color":"yellow"});
				$("#star5").css({"color":"black"});
				$("#estrellas").val(4);
			});
			$("#star5").on("click",function(){
				$("#star1").css({"color":"yellow"});
				$("#star2").css({"color":"yellow"});
				$("#star3").css({"color":"yellow"});
				$("#star4").css({"color":"yellow"});
				$("#star5").css({"color":"yellow"});
				$("#estrellas").val(5);
			});

        });
    </script>
	</head>
	<body style="background-color:#FAFAFA;">  

    <div class="container">
    <div class="section no-pad-bot">
      <div class="container">
	        <div class="row center">
	            <div class="col s12 l6 input-field">
	                <a href="inicioUsuario.php" class="btn green">Regresar</a>
	             </div>
	            <div class="col s12 l6 input-field">
	                <a href="cerrarSesion.php?nombSesion=valido" class="btn red">Cerrar Sesi&oacute;n</a> 
	             </div>
	        </div>
	  		<div class="row center">
	  			<div class="col s12 l12">
	  				<div class="chart-container" style="position: relative;">
	    			<canvas id="myChart"></canvas>
					<script>
					var ctx = document.getElementById("myChart");
	
					var myChart = new Chart(ctx, {
					    type: 'bar',
					    data: {
					    	labels: ['Red','Green','Blue'],
					        datasets: [{
					            label: 'Promedio de estrellas recibidas',
					            <?php 	
									$sqlOpi = "SELECT * FROM opinion";
									$resOpi = mysqli_query($conexion, $sqlOpi);

					        		$data = "data: [";
					        		$arr = array(0,0,0);
					        		$veces = array(0,0,0);
					        		$aux = 0.0;
									while($filas = mysqli_fetch_array($resOpi,MYSQLI_BOTH)){
										if($filas[5]==1){
											$arr[0]+=$filas[1];
											$veces[0]+=1;
										}
										else if($filas[5]==2){
											$arr[1]+=$filas[1]; 
											$veces[1]+=1;  
										}
										else if($filas[5]==3){
											$arr[2]+=$filas[1];
											$veces[2]+=1;   					
										}
      								}
      								foreach ($arr as $i => $value) {
      									if($i!=0)
											$data .=",";
										if($veces[$i]!=0)
      										$aux = $arr[$i]/(float) ($veces[$i]);
      									$data .= "$aux";
      								}
      								$data .= "],";
      								echo $data; 
      							?>
					            backgroundColor: [
					                'rgba(255, 99, 132, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(75, 192, 192, 0.2)',
					                'rgba(255, 206, 86, 0.2)',
					                'rgba(153, 102, 255, 0.2)',
					                'rgba(255, 159, 64, 0.2)'
					            ],
					            borderColor: [
					                'rgba(255,99,132,1)',
					                'rgba(54, 162, 235, 1)',
					                'rgba(75, 192, 192, 1)',
					                'rgba(255, 206, 86, 1)',
					                'rgba(153, 102, 255, 1)',
					                'rgba(255, 159, 64, 1)'
					            ],
					            borderWidth: 1
					        }]
					    },
					    options: {
					        scales: {
					            xAxes: [{
					                ticks: {
					                    beginAtZero:true
					                }
					            }]
					        }
					    }
					});
					</script>
					</div>
				</div>
			</div>
      </div>

      <div class="container">
	        <div class="row center">
	            <div class="col s12 l6 input-field">
	                <a href="inicioUsuario.php" class="btn green">Regresar</a>
	             </div>
	            <div class="col s12 l6 input-field">
	                <a href="cerrarSesion.php?nombSesion=valido" class="btn red">Cerrar Sesi&oacute;n</a> 
	             </div>
	        </div>
	  		<div class="row center">
	  			<div class="col s12 l12">
	  				<div class="chart-container" style="position: relative; ">
	    			<canvas id="myChart2"></canvas>
					<script>
					var ctx = document.getElementById("myChart2");
	
					var myChart = new Chart(ctx, {
					    type: 'bar',
					    data: {
					    	labels: ['Red','Green','Blue'],
					        datasets: [{
					            label: 'Promedio de estrellas recibidas',
					            <?php 	
									$sqlOpi = "SELECT * FROM opinion";
									$resOpi = mysqli_query($conexion, $sqlOpi);

					        		$data = "data: [";
					        		$arr = array(0,0,0);
					        		$veces = array(0,0,0);
					        		$aux = 0.0;
									while($filas = mysqli_fetch_array($resOpi,MYSQLI_BOTH)){
										if($filas[5]==1){
											$arr[0]+=$filas[1];
											$veces[0]+=1;
										}
										else if($filas[5]==2){
											$arr[1]+=$filas[1]; 
											$veces[1]+=1;  
										}
										else if($filas[5]==3){
											$arr[2]+=$filas[1];
											$veces[2]+=1;   					
										}
      								}
      								foreach ($arr as $i => $value) {
      									if($i!=0)
											$data .=",";
										if($veces[$i]!=0)
      										$aux = $arr[$i]/(float) ($veces[$i]);
      									$data .= "$aux";
      								}
      								$data .= "],";
      								echo $data; 
      							?>
					            backgroundColor: [
					                'rgba(255, 99, 132, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(75, 192, 192, 0.2)',
					                'rgba(255, 206, 86, 0.2)',
					                'rgba(153, 102, 255, 0.2)',
					                'rgba(255, 159, 64, 0.2)'
					            ],
					            borderColor: [
					                'rgba(255,99,132,1)',
					                'rgba(54, 162, 235, 1)',
					                'rgba(75, 192, 192, 1)',
					                'rgba(255, 206, 86, 1)',
					                'rgba(153, 102, 255, 1)',
					                'rgba(255, 159, 64, 1)'
					            ],
					            borderWidth: 1
					        }]
					    },
					    options: {
					        scales: {
					            xAxes: [{
					                ticks: {
					                    beginAtZero:true
					                }
					            }]
					        }
					    }
					});
					</script>
					</div>
				</div>
			</div>
      </div>    </div>
    </div>

	</body>
</html>
<?php

	}else{
		header("location:../index.php");
	}
?>