<?php
	/* Recupero todos los valores del arreglo POST
	=============================================== */
	//Obtiene los parametros de los formularios
    	foreach($_POST as $nombre_campo => $valor){ 
			$asignacion = "\$".$nombre_campo."='".trim($valor)."';"; 
			eval($asignacion); 
    	}
	/* ============================================ */
?>