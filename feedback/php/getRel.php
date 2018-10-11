<?php
	include("configBD.php");
	include("getPosts.php");
	
	$relacion = $_POST["rel"];
	$val = (int) $_POST["val"];
	$rLen = 0;

	if($val == 0){
		$sqlEst = "SHOW CREATE TABLE ".$relacion;
		$resEst = mysqli_query($conexion, $sqlEst);
		
		$regEst = "";
	
		while($filas = mysqli_fetch_array($resEst,MYSQLI_BOTH)){
			$regEst =$filas[1];
		}
	
	preg_match_all("/\`(.*?)\`\s{1}\w+\((.*?)\)(\s{1}\w+)*/", $regEst, $result_array);
	$rLen = count($result_array[0]);
	$i=0;
	$regEst ="<br><table class='centered responsive-table black'><thead><tr>";
	
	while($i<$rLen){
	
		$regEst.="
				<th>Atributo <sub>$i</sub></th>
			";
		$i = $i+1;
	}
	$i=0;
	$regEst .="</tr></thead><tbody><tr>";
	while($i<$rLen){
		$aux = (string) $result_array[0][$i];
		$regEst.="
				<td>
					$aux
				</td>
			";
		$i = $i+1;
	}
	$regEst.="</tr></tbody></table>";
	
	echo $regEst; 
	}
	if($val == 1){
		$i=0;
		$atributos=" <div class='input-field col s12 white-text' id='atributo' name='atributo'>
                    <select id='atributosel' class='white-text'>
                      <option value='' disabled selected>Escoja el atributo</option>'";
		preg_match_all("/\`(.*?)\`\s{1}\w+\((.*?)\)(\s{1}\w+)*/", $relacion, $aux);
		$rLen=count($aux[0]);
		while($i<$rLen){
			$atr=$aux[0][$i];
			$atributos .= "<option class='white-text' value='$atr'>$atr</option>";
			$i = $i+1;
		}
		$atributos.="</select>
                  </div>";
		echo $atributos;
	}
	if($val == 2){
		echo $rLen;
	}
