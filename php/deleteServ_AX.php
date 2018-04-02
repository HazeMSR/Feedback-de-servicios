<?php
    include("configBD.php");
    include("getPosts.php");

    $id = $_POST["id"]; //Parametro que se paso atraves de crud.js en .eliminar()
    
    $sqlDel = "DELETE FROM servicio WHERE idservicio = '$id'";
    
    //Verifica si hubo un error al eliminar de la tabla usuario
    if (!mysqli_query($conexion, $sqlDel)) {
        echo("Error description: " . mysqli_error($con));
    }
    else{//Se elimino exitosamente
        echo 1;
    }




?>