<?php
    include("configBD.php");
    include("getPosts.php");

    $id = $_POST["id"]; //Parametro que se paso atraves de crud.js en .eliminar()
    
    $sqlDel = "DELETE FROM usuario WHERE id = '$id'";
    
    //Verifica si hubo un error al eliminar de la tabla usuario
    echo 1;




?>