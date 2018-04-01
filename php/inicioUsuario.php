<!--Verifica la sesion-->
<?php
	session_start();
	if($_SESSION["valido"] == "sesion"){
		include("crud_BD.php");
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
    <script>
        $(document).ready(function() {
        	$('select').material_select();
        });
    </script>
	</head>
	<body>  
  <div id="modalAX" class="modal">
      <div class="modal-content">
          <!--<h4 class="center-align blue white-text"></h4>-->
        </div>
      </div>
  </div>

  <div class="parallax-container valign-wrapper" id="banner">
    <div class="section ">
      <div class="container">
        <div class="row center">
          <a href="cerrarSesion.php?nombSesion=valido" class="btn green">Redactar reseña</a>
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
  <div class="parallax-container valign-wrapper" id="banner">
    <div class="section ">
      <div class="container">
        <div class="row center">
          <a href="cerrarSesion.php?nombSesion=valido" class="btn blue">Redactar reseña</a>
        </div>
      </div>
    </div>
    <div class="parallax"><img src="../img/waves.jpg" alt="Unsplashed background img 2"></div>
  </div>
	</body>
</html>
<?php
	}else{
		header("location:../index.php");
	}
?>