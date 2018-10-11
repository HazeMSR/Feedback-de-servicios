<!--Verifica la sesion-->
<?php
	session_start();
	if($_SESSION["valido"] == "sesion"){
		include("crud_BD.php");
    $sqlConf = "SELECT * FROM config WHERE idconfig=1";
    $resConf = mysqli_query($conexion, $sqlConf);
    $conf = mysqli_fetch_array($resConf,MYSQLI_BOTH);


    $sqlTemas = "SELECT * FROM tema";
    $resTemas = mysqli_query($conexion, $sqlTemas);

    $sqlOpi = "SELECT * FROM opinion";
    $resOpi = mysqli_query($conexion, $sqlOpi);
    $infOpi = mysqli_num_rows($resOpi);

    $sqlTemasDist = "SELECT DISTINCT nombre FROM tema";
    $resTemasDist = mysqli_query($conexion, $sqlTemasDist);
    $infTemasDist = mysqli_num_rows($resTemasDist);
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta charset="utf-8">
<title>CRUD</title>
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/confirm/jquery-confirm.min.js"></script>
<script src="../materialize/js/materialize.min.js"></script>
<script src="../js/validetta101/validetta.min.js"></script>
<script src="../js/validetta101/localization/validettaLang-es-ES.js"></script>
<script src="../js/crud.js"></script>
<script src="../js/Chart.bundle.js"></script>

<link rel="stylesheet" type="text/css" href="../css/materialize.css">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../fontAwesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../js/confirm/jquery-confirm.min.css">
<link rel="stylesheet" type="text/css" href="../js/validetta101/validetta.min.css">
<script src="../js/fragHoriz.js"></script>
    <script>

        
        $(document).ready(function() {


        $('select').material_select();


      //Abre las reseñas 
      $("#openRev").on("click",function(){
        $("#modalReviews").modal("open");
        $("#porEstrellas").css({"display":"initial"});
        $("#porTemas").css({"display":"none"});
        $("#porServicios").css({"display":"none"});
      });

      //Abre las opiniones 
      $("#viewRev").on("click",function(){
        $("#modalOpiniones").modal("open");
      });

      //Abre el form de insertar servicios
      $("#openServ").on("click",function(){
        $("#modalFormInsServ").modal("open");
      });

      //Abre el form de modificar servicios
      $("#openServMod").on("click",function(){
        $("#modalFormUpdServ").modal("open");
      });

      //Abre el form de eliminar servicios
      $("#openServDel").on("click",function(){
        $("#modalFormDelServ").modal("open");
      });

      //Abre las gráficas por estrellas
      $("#porEstrellasBoton").on("click",function(){
        $("#porEstrellas").css({"display":"initial"});
        $("#porTemas").css({"display":"none"});
        $("#porServicios").css({"display":"none"});
      });

      //Abre las gráficas por temas
      $("#porTemasBoton").on("click",function(){
        $("#porEstrellas").css({"display":"none"});
        $("#porTemas").css({"display":"initial"});
        $("#porServicios").css({"display":"none"});
      });

      //Abre las gráficas por servicios
      $("#porServiciosBoton").on("click",function(){
        $("#porEstrellas").css({"display":"none"});
        $("#porTemas").css({"display":"none"});
        $("#porServicios").css({"display":"initial"});
      });

      //Cierra las reseñas 
      $(".cerrar").on("click",function(){
        $("#modalReviews").modal("close");
        $("#modalOpiniones").modal("close");
      });

$("#config").click(function(e) {
    var c=$("#mostrar").val();
    console.log("1 "+c);
    if(c==1)
      c=0;
    else
      c=1;
    console.log("2 "+c);
    $.ajax({
      method:"post",
      url:"Mostrar.php",
      cache:false,
      data:{mostrar:c},
      success: function(respAX){
        console.log(respAX);
                    $.alert({
              title:"Feedback",
              content:"Se actualizo la configuracion",
              type:"green",
              useBootstrap:false,
              boxWidth:"50%"
            });
      }
    });
    });
  
        });
    </script>
</head>

<body class="page-footer teal" >
	<section id="encabezado">
    </section>
    <section id="contenidos">

        <div class="row center">
          <div class="col s12 l3">
              <div id="openRev" class="btn blue">An&aacute;lisis de las rese&ntilde;as</div>
           </div>

          <div class="col s12 l3"> 
            <div id="viewRev" class="btn green">Mostrar rese&ntilde;as</div>
          </div>

          <div class="col s12 l3">
            <div id="config" class="btn yellow black-text" >Mostrar/Ocultar rese&ntilde;as</div>
            <input type="hidden" name="mostrar" id="mostrar" value="<?php echo $conf[1]; ?>">
          </div>
          <div class="col s12 l3"> 
            <a href="cerrarSesion.php?nombSesion=valido" class="btn black">Cerrar Sesi&oacute;n</a> 
          </div>

        </div>
        <br>
        <!--Para cerrar sesion cambia el valor de la variable de sesion nombSesion a invalido, para que ya no se pueda ingresar -->
        <div class="row">
          <div class="col s12 l3">
              <div id="openServ" class="btn purple">Agregar Servicio</div>
           </div>
          <div class="col s12 l3">
              <div id="openServMod" class="btn pink">Modificar Servicio</div>
           </div>
          <div class="col s12 l3">
              <div id="openServDel" class="btn red">Eliminar Servicio</div>
           </div>
          <div class="col s12 l3"> 
            <button id="nvoEst" class="btn orange">Agregar Usuario</button>
      
          </div>

        </div>
        <br>
        <br>
        <form>
          <div class="row center">
            <h2 class="center-align white-text">Fragmentaci&oacute;n Horizontal</h2>
            <div class="col s12 m12 l6">
              <h4 class="center-align white-text">1) Definir condiciones de fragmentaci&oacute;n</h4>

              <h5 class="left-align">Leer esquema:</h5>

                <div class="input-field col s12">
                  <select id="relacion" name="relacion" class="white-text">
                    <option class='white-text' value="" disabled selected>Escoja la relaci&oacute;n</option>
                      <?php echo $regEst2; ?>
                  </select>
                  <label class="white-text">(Relaci&oacute;n)</label>
                </div>


                <div id="tabla">

                </div>
            </div>
            <div class="col s12 m12 l6">
              <h4 class="center-align white-text">3) Generar fragmentos minit&eacute;rminos</h4>
                <table class='centered responsive-table black'>
                  <thead>
                    <tr>
                      <th>ID del Predicado:</th>
                      <th>Relación:</th>
                      <th>Predicado:
                        <br>
                         (Atributo, Operador, Valor)
                      </th>
                    </tr>
                  </thead>
                  <tbody id="mostrarPredicados">

                  </tbody>
                </table>
                <br>
                  <div id="generarFM" class="btn cyan accent-2 black-text" predicados="0"> Generar F.M.</div>
            </div>
          </div>
          <div class="row center">
            <div class="col s12 m12 l6">
              <h4 class="center-align white-text">2) Definir predicados simples</h4>

                  <h5 class="left-align">
                    Atributo:
                  </h5>

                  <div id="atributo">
              
                  </div>

                  <h5 class="left-align">
                    Operador:
                  </h5>

                  <div id="operador">
              
                  </div>

                  <h5 class="left-align">
                    Valor:
                  </h5>

                  <div class='input-field col s12'>
                  <div id="valor">
                    

                  </div>
                  <label for='valor' class="white-text">Ingrese el valor:</label></div>
                <div class="col s12 l12"> 
                  <div id="agregarPredic" class="btn deep-purple darken-2 white-text" predicados="0"> Agregar predicado </div>
                </div>

            </div>
            <div class="col s12 m12 l6">
              <h4 class="center-align white-text">4) Colocar fragmentos minit&eacute;rminos</h4>
                    <div class="row">
        <div class="input-field col s12 white-text">
          <textarea id="textarea1" class="materialize-textarea white-text"></textarea>
          <label for="textarea1" class="white-text">Ingrese los enunciados Minit&eacute;rminos:</label>
        </div>
      </div>
            </div>
          </div>
        </form>
        <br>
        <br>
        	<div class="row">
            <h2 class="center-align white-text">Usuarios registrados en la base</h2>
            	<div class="col s12">
                	<table class="centered responsive-table stripped deep-purple darken-4 ">
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
   <div id="modalOpiniones" class="modal">
      <div class="modal-content">
          <div class="row center">
              <div class="col s12 l6 input-field">
                <button class="btn red cerrar" >Cerrar</button>
              </div>
          </div>
        <div class="row center" id="op">
            <table class="responsive-table highlight">
              <thead>
                <tr>
                    <th>Tema</th>
                    <th>Servicio</th>
                    <th>Calificaci&oacute;n</th>
                    <th>Comentario</th>
                    <th>Usuario</th>
                </tr>
              </thead>
              <tbody>


                <?php 
                  while($filas = mysqli_fetch_array($resOpi,MYSQLI_BOTH)){
                    echo "<tr>";
                    $sqlTemas = "SELECT * FROM tema WHERE idtema='$filas[3]'";
                    $resTemas = mysqli_query($conexion, $sqlTemas);
                    $temas = mysqli_fetch_array($resTemas,MYSQLI_BOTH);
                    echo "<td>$temas[1]</td>"; 

                    $sqlServ = "SELECT * FROM servicio WHERE idservicio='$filas[5]'";
                    $resServ = mysqli_query($conexion, $sqlServ);
                    $serv = mysqli_fetch_array($resServ,MYSQLI_BOTH);
                    echo "<td>$serv[1]</td>"; 

                    echo "<td>$filas[1]</td>"; 
                    echo "<td>$filas[2]</td>"; 

                    $sqlUsu = "SELECT * FROM usuario WHERE id='$filas[4]'";
                    $resUsu = mysqli_query($conexion, $sqlUsu);
                    $usu = mysqli_fetch_array($resUsu,MYSQLI_BOTH);
                    echo "<td>$usu[0]</td>";                     
                    echo "</tr>";
                  }
                ?>
              </tbody>
            
              </table>
        </div>
      </div>

  <!--Modal que contiene el analisis de las reseñas-->
    <div id="modalReviews" class="modal">
      <div class="modal-content">
          <div class="row center">
              <div class="col s12 l4 input-field">
                  <button id="porEstrellasBoton" class="btn blue" >Por Estrellas</button>
               </div>
              <div class="col s12 l4 input-field">
                  <button id="porTemasBoton" class="btn green" >Por Temas</button>
               </div>
              <div class="col s12 l4 input-field">
                  <button id="porServiciosBoton" class="btn orange" >Por Servicios</button>
               </div>
          </div>

        <div class="row center" id="porEstrellas">
          <div class="col s12 l12">
            <div class="chart-container" style="position: relative;">
            <canvas id="myChart"></canvas>
          <script>
          var ctx = document.getElementById("myChart");
  
          var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                <?php   
                  $labels = "labels: [";
                      $sqlServ = "SELECT * FROM servicio";
                  $resServ = mysqli_query($conexion, $sqlServ);

              while($filas = mysqli_fetch_array($resServ,MYSQLI_BOTH)){
                if($a!=0)
                  $labels.=",";
                $labels.= "'$filas[1]'";
                $a+=1;

                  }
                  $labels .= "],";  
                    echo $labels;
                  ?>
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
                              beginAtZero:true,
                              max:5
                          }
                      }],
                      yAxes: [{
                          ticks: {
                              beginAtZero:true,
                              max:5
                          }
                      }],
                  }
              }
          });
          </script>
          </div>
        </div>
      </div>
      <div id="porTemas">
        <?php 
          $t=0;

          while($filas = mysqli_fetch_array($resTemasDist,MYSQLI_BOTH)){
            $j=0;
            $arr[] = 0;
            $veces[] = 0;
            $sqlTemasT = "SELECT * FROM tema WHERE nombre ='$filas[0]'";
            $resTemasT = mysqli_query($conexion, $sqlTemasT);
        ?>
          <div class="row center">
          <div class="col s12 l12">
            <div class="chart-container" style="position: relative; ">
            <canvas id="myChartT<?php echo $t;?>"></canvas>
          <script>

          var ctx = document.getElementById("myChartT<?php echo $t;?>");
  
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                <?php  
                  $a=0;

                  $labelsT="labels: [";
                  while($filasD = mysqli_fetch_array($resTemasT,MYSQLI_BOTH)){
                      if($a!=0)
                    $labelsT .=",";
                  
                  $sqlServN = "SELECT nombre FROM servicio WHERE idservicio ='$filasD[2]'";
                  $resServN = mysqli_query($conexion, $sqlServN);
                  $nombreServicio = mysqli_fetch_array($resServN,MYSQLI_BOTH);
                  
                  $sqlOpi = "SELECT * FROM opinion WHERE idS='$filasD[2]' AND idT='$filasD[0]'";
                  $resOpi = mysqli_query($conexion, $sqlOpi);

                      $aux = 0.0;

                  while($filasO = mysqli_fetch_array($resOpi,MYSQLI_BOTH)){
                    $arr[$a]+=$filasO[1];
                    $veces[$a]+=1;            
                      }

                  $labelsT .="'$nombreServicio[0]'";
                  $a += 1;
                  } 
                     $data = "data:[";
                      foreach ($arr as $i => $value) {
                        if($i!=0)
                      $data .=",";
                    if($veces[$i]!=0)
                          $aux = $arr[$i]/(float) ($veces[$i]);
                        $data .= "$aux";
                      }
                      $data .= "],";
                    $labelsT .="],";
                    echo $labelsT;

                  ?>
                  datasets: [{
                      label: 'Promedio del tema: <?php echo $filas[0];?>',
                      <?php   

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
                      }],
                      yAxes: [{
                          ticks: {
                              beginAtZero:true,
                              max:5
                          }
                      }],
                  }
              }
          });
          </script>
          </div>
        </div>
        </div>
        <?php
          $t+=1;
        }
        ?>
      </div>
      <div id="porServicios">
        <?php 
          $t=0;
          $sqlServ = "SELECT * FROM servicio";
          $resServ = mysqli_query($conexion, $sqlServ);

          while($filas = mysqli_fetch_array($resServ,MYSQLI_BOTH)){
            $a=0;

        ?>
          <div class="row center">
          <div class="col s12 l12">
            <div class="chart-container" style="position: relative; ">
            <canvas id="myChartS<?php echo $t;?>"></canvas>
          <script>
          var ctx = document.getElementById("myChartS<?php echo $t;?>");
  
          var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                <?php   
                  $labelsS ="labels: [";
                  $data = "data: [";
                  $aux = 0.0;

                  $sqlTemasDist = "SELECT DISTINCT nombre FROM tema WHERE idS='$filas[0]'";
                $resTemasDist = mysqli_query($conexion, $sqlTemasDist);

                  while($filasDD = mysqli_fetch_array($resTemasDist,MYSQLI_BOTH)){
                    $arr[] = 0;
                    $veces[] = 0;

                    if($a!=0)
                      $labelsS .= ",";
                    $sqlTemasT = "SELECT * FROM tema WHERE nombre ='$filasDD[0]' AND idS='$filas[0]'";
                    $resTemasT = mysqli_query($conexion, $sqlTemasT);

                    while($filasD = mysqli_fetch_array($resTemasT,MYSQLI_BOTH)){
                      $sqlOpi = "SELECT * FROM opinion WHERE idS ='$filas[0]' AND idT ='$filasD[0]' ";
                      $resOpi = mysqli_query($conexion, $sqlOpi);

                      while($filasO = mysqli_fetch_array($resOpi,MYSQLI_BOTH)){
                        $arr[$a]+=$filasO[1];
                        $veces[$a]+= 1;
                      }   
                    }

                    $labelsS .= "'$filasDD[0]'";

                    $a+=1;
                  }

                  $labelsS .= "],";
                    echo $labelsS;
                  ?>
                  datasets: [{
                      label: 'Promedio del Servicio: <?php echo $filas[1];?>',
                      <?php   
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
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(238, 62, 172, 0.2)',
                          'rgba(100, 214, 56, 0.2)',
                          'rgba(168,115,35, 0.2)',
                          'rgba(39,80,215, 0.2)',
                          'rgba(20,183,77, 0.2)'
                      ],
                      borderColor: [
                          'rgba(255,99,132,1)',
                          'rgba(54, 162, 235, 1)',
                          'rgba(75, 192, 192, 1)',
                          'rgba(255, 206, 86, 1)',
                          'rgba(153, 102, 255, 1)',
                          'rgba(255, 159, 64, 1)',
                          'rgba(238, 62, 172, 1)',
                          'rgba(100, 214, 56, 1)',
                          'rgba(168,115,35, 1)',
                          'rgba(39,80,215, 1)',
                          'rgba(20,183,77, 1)'

                      ],
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      xAxes: [{
                          ticks: {
                              beginAtZero:true,
                              max:5
                          }
                      }],
                      yAxes: [{
                          ticks: {
                              beginAtZero:true,
                              max: 5
                          }
                      }]
                  }
              }
          });
          </script>
          </div>
        </div>
        </div>
        <?php
          $t+=1;
          }
        ?>
      </div>
          <div class="row center">
              <div class="col s12 l6 input-field">
                  <button class="btn red cerrar" >Cerrar</button>
               </div>
          </div>
      </div>
    </div>  


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
          <h4 class="center-align blue white-text">Agregar usuario</h4>
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

    <!--Modal que contiene el formulario para insertar un nuevo servicio-->
    <div id="modalFormInsServ" class="modal">
        <div class="modal-content">
          <h4 class="center-align blue white-text">Agregar servicio</h4>
            <form id="formInsServ" name="formInsServ">
            <div class="row">
              <div class="col s12 l12 input-field">
                <label for="id">Nombre</label>
                <input type="text" id="nombre" name="nombre" data-validetta="required maxLength[50]">
              </div>
            </div>
            <div class="row">
              <div class="col s12 l6 input-field">
                <button type="submit" class="btn blue" style="width:100%;">Agregar</button>
              </div>
            </div>
            </form>
        </div>
    </div>

  
    <!--Modifica los datos del servicio-->
    <div id="modalFormUpdServ" class="modal">
        <div class="modal-content">
          <h4 class="center-align blue white-text">Modifica servicio</h4>
            <form id="formUpdServ" name="formUpdServ">
            <div class="row">
                <label for="id">Nombre actual:</label>
                <input type="text" id="id" name="id" data-validetta="required number">
              </div>
            </div>
            <div class="row">
              <div class="col s12 l6 input-field">
                <label for="nombre">Nuevo nombre:</label>
                <input type="text" id="nombre" name="nombre" data-validetta="required maxLength[50]">
              </div>
              <div class="col s12 l6 input-field">
                <button type="submit" class="btn blue" style="width:100%;">Actualizar</button>
              </div>
            </div>
            </form>
        </div>
    </div>

    <!--Modal que contiene el formulario para eliminar un servicio-->
    <div id="modalFormDelServ" class="modal">
        <div class="modal-content">
          <h4 class="center-align blue white-text">Eliminar servicio</h4>
            <form id="formDelServ" name="formDelServ">
            <div class="row">
              <div class="col s12 l12 input-field">
                <label for="id">Nombre:</label>
                <input type="text" id="id" name="id" data-validetta="required number">
              </div>
            </div>
            <div class="row">
              <div class="col s12 l6 input-field">
                <button type="submit" class="btn blue" style="width:100%;">Eliminar</button>
              </div>
            </div>
            </form>
        </div>


</body>
</html>
<?php
	}else{
		header("location:../index.php");
	}
?>