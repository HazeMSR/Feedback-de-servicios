<!--Verifica la sesion-->
<?php
	session_start();
	if($_SESSION["valido"] == "sesion"){
		include("crud_BDusuario.php");

		$sqlConf = "SELECT * FROM config WHERE idconfig=1";
		$resConf = mysqli_query($conexion, $sqlConf);
		$conf = mysqli_fetch_array($resConf,MYSQLI_BOTH);

		$sqlServ = "SELECT * FROM servicio";
		$resServ = mysqli_query($conexion, $sqlServ);

		$sqlTemas = "SELECT * FROM tema";
		$resTemas = mysqli_query($conexion, $sqlTemas);

?>
<!doctype html>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta charset="utf-8">
	<title>CRUD</title>
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
	<body>  
    
  	<div id="modalAX" class="modal">
        <div class="modal-content">
          	<h4 class="center-align blue white-text">Feedback</h4>
          	<div id="respAX" style="color:#333;"></div>
        </div>
        <div class="modal-footer">
          	<a href="" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
  	</div>
    <!--Modifica los datos del alumno con la instruccion update en el crud.js y update_AX-->
  	<div id="modalAddRev" class="modal">
  	<form id="formAddRev">
  		<input type="hidden" id="id" name="id" value="<?php echo $filasA[0];?>">
        <div class="modal-content">
         	<h4 class="center-align blue white-text">A&ntilde;adir Rese&ntilde;a</h4>
         	<br>
         	<!--Selector del servicio-->
         	<div class="row">
  				<div class="input-field col s12">
    				<select id="servicio" name="servicio">
      					<option value="" disabled selected>Selecciona el servicio:</option>
      					<?php 
							while($filas = mysqli_fetch_array($resServ,MYSQLI_BOTH)){
								echo "<option value='$filas[0]'>$filas[1]</option>";     					
      						}	
      					?>
    				</select>
  				</div>         		
         	</div>
         	<!--Autocomplete del tema-->
            <div class="row">
    			<div class="col s12">
    			  <div class="row">
    			    <div class="input-field col s12">
    			      <i class="material-icons prefix"></i>
    			      <input type="hidden" id="valida" name="valida" value="0">
    			      <input type="text" id="tema" name="tema" class="autocomplete" data-validetta="required maxLength[100]">
    			      <label for="tema">Tema:</label>
    			    </div>
    			  </div>
    			</div>
  			</div>
  			<!--Calificacion en estrellas-->
  			<div class="row center">
  				<h4>Calificaci&oacute;n:</h4>
  				<input type="hidden" id="estrellas" name="estrellas" value="0">
					<i class="fa fa-star fa-3x" id="star1" value="1"></i>
					<i class="fa fa-star fa-3x" id="star2" value="2"></i>
					<i class="fa fa-star fa-3x" id="star3" value="3"></i>  
					<i class="fa fa-star fa-3x" id="star4" value="4"></i>
					<i class="fa fa-star fa-3x" id="star5" value="5"></i>     
            </div>
            <div class="row center">
              <div class="col s12 l12 input-field">
                
                <label for="coment">Comentario:</label>
                <input type="text" id="coment" name="coment" data-validetta="maxLength[250]">
              </div>
            </div>
            <div class="row center">
              <div class="col s12 l12 input-field">
                <button type="submit" class="btn blue" style="width:100%;">Enviar Reseña</button>
              </div>
            </div>
            </form>
        </div>
  	</div>
  <div class="parallax-container valign-wrapper" id="banner">
        
    <div class="section ">
      <div class="container">
        <div class="row center">
          <div id="addRes" class="btn green">Redactar reseña</div>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="../img/waves1.gif" alt="Unsplashed background img 2"></div>
  </div>


  <footer class="page-footer teal">
    <div class="container">
    <div class="section no-pad-bot">
      <div class="container">
        <br><br>
        <div class="row center">
        </div>
        <div class="container">
          <form id="formAcc">
            <div class="row center">
              <div class="col s12 l12 input-field">
                <a href="cerrarSesion.php?nombSesion=valido" class="btn red">Cerrar Sesi&oacute;n</a> 
              </div>
            </div>
          </form>
        </div>
        <br><br>

      </div>
    </div>
    </div>
  </footer>
  <?php if($conf[1] == 1){?>
  <div class="parallax-container valign-wrapper" id="mostrar">
    <div class="section ">
      <div class="container">
        <div class="row center">
          <a href="cerrarSesion.php?nombSesion=valido" class="btn blue">Ver reseñas</a>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="../img/waves.jpg" alt="Unsplashed background img 2"></div>
  </div>
	</body>
</html>
<?php
		}

	}else{
		header("location:../index.php");
	}
?>