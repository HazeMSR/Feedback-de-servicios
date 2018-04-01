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
<link rel="stylesheet" type="text/css" href="../css/materialize.css">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../fontAwesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../js/confirm/jquery-confirm.min.css">
<link rel="stylesheet" type="text/css" href="../js/validetta101/validetta.min.css">
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../materialize/js/materialize.min.js"></script>
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

<body class="page-footer teal" >
	<section id="encabezado">
    </section>
    <section id="contenidos">
    	<div class="container">
        <!--Para cerrar sesion cambia el valor de la variable de sesion nombSesion a invalido, para que ya no se pueda ingresar -->
        	<a href="cerrarSesion.php?nombSesion=valido" class="btn blue">Cerrar Sesi&oacute;n</a> 
            <button id="nvoEst" class="btn blue">Nuevo Estudiante</button>
        	<div class="row">
            	<div class="col s12">
                	<table class="responsive-table">
                    	<thead>
                        	<tr><th>ID:</th><th>Acci&oacute;n:</th>
                        </thead>
                        <tbody>
  							<div id="infoEstudiantes">
                            	<?php echo $regEst; ?>
                          	</div>                      	
                        </tbody>
                    </table>   
                </div>
            </div>
        </div>
    </section>
    <section id="pie">
    </section>
    
    <!-- Modals -->
    
  	<div id="modalAX" class="modal">
        <div class="modal-content">
          	<h4 class="center-align blue white-text">Feedback</h4>
          	<div id="respAX" style="color:#EEE;"></div>
        </div>
        <div class="modal-footer">
          	<a href="" class="modal-action modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
  	</div>
  
    <!--Modifica los datos del alumno con la instruccion update en el crud.js y update_AX-->
  	<div id="modalFormUpd" class="modal">
        <div class="modal-content">
          <h4 class="center-align blue white-text">Modifica usuario</h4>
            <form id="formUpd">
            <div class="row">
              <div class="col s12 l12 input-field">
                <input type="hidden" id="id" name="id">
                <label for="id">Identificador</label>
                <input type="text" id="id2" name="id2" data-validetta="required maxLength[50]">
              </div>
            </div>
            <div class="row">
              <div class="col s12 l12 input-field">
                <label for="contra">Contrase&ntilde;a</label>
                <input type="text" id="contra" name="contra" data-validetta="required maxLength[50]">
              </div>
            </div>
            <div class="row">
              <div class="col s12 l6 input-field">
                <label for="plan">Tipo de usuario</label>
                <input type="text" id="tipo" name="tipo" data-validetta="required number maxSelected[1]">
              </div>
              <div class="col s12 l6 input-field">
                <button type="submit" class="btn blue" style="width:100%;">Actualizar</button>
              </div>
            </div>
            </form>
        </div>
  	</div>
    
    <!--Modal que contiene el formulario para insertar un nuevo alumno-->
    <div id="modalFormIns" class="modal">
        <div class="modal-content">
          <h4 class="center-align blue white-text">Modifica usuario</h4>
            <form id="formIns" name="formIns">
            <div class="row">
              <div class="col s12 l12 input-field">
                <label for="id">Identificador</label>
                <input type="text" id="id" name="id" data-validetta="required maxLength[50]">
              </div>
            </div>
            <div class="row">
              <div class="col s12 l12 input-field">
                <label for="contra">Contrase&ntilde;a</label>
                <input type="text" id="contra" name="contra" data-validetta="required maxLength[50]">
              </div>
            </div>
            <div class="row">
              <div class="col s12 l6 input-field">
                <label for="plan">Tipo de usuario</label>
                <input type="text" id="tipo" name="tipo" data-validetta="required number maxSelected[1]">
              </div>
              <div class="col s12 l6 input-field">
                <button type="submit" class="btn blue" style="width:100%;">Actualizar</button>
              </div>
            </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
	}else{
		header("location:../index.php");
	}
?>