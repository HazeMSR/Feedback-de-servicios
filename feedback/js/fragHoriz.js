 $(document).ready(function() {
 	// Obtiene la relación, el atributo, el operador y el valor para construir los queries de la tabla del paso 4
 	function getQueries(n){
	 	var i=0;
	 	var j=0;
	 	var pLen=0;
	 	var aux=[];
	 	var val=false;
	 	var comprueba="";
	 	var queryBuilder="";
	 	var queries=[];
	 	var predicados = [];
	 	var built_queries = [];
 		while(i<n){
 			console.log("i= "+i+" n = "+n);
 			var auxM=$("#m"+i).attr("query");
 			queries.push(auxM);
		 	
 			if(typeof auxM !== "undefined" && auxM !== false && auxM !== null && $("#checa"+i).is(':checked')){
 				console.log("auxM= "+auxM);
 			
 				predicados=queries[i].split("^");
		 		j = 0;
		 		pLen=predicados.length;
		 		queryBuilder="";
		 		while(j<pLen){
		 			val=/[\~]+/g.test(predicados[j]);
	
		 			if(!val){
		 				aux=predicados[j].match(/\d+/g);
		 				comprueba = $('#p'+aux[0]).attr('name');
	
		     			if( comprueba != null){
			     			auxR = $('#p'+aux[0]).attr('relacion');
			     			auxA = $('#p'+aux[0]).attr('atributo');
			     			auxO = $('#p'+aux[0]).attr('operador');
			     			auxV = $('#p'+aux[0]).attr('valor');
	
			     			if(queryBuilder.length<1){
			     				queryBuilder="SELECT * FROM "+auxR+" WHERE "+auxA+" "+auxO+" "+auxV;
			     			}
			     			else{
			     				queryBuilder+=" AND "+auxA+" "+auxO+" "+auxV;
			     			}
			     		}
		 			}
		 			else{
		 				aux=predicados[j].match(/\d+/g);
		 				comprueba = $('#p'+aux[0]).attr('name');
		     			if( comprueba != null){
			     			auxR = $('#p'+aux[0]).attr('relacion');
			     			auxA = $('#p'+aux[0]).attr('atributo');
			     			auxO = $('#p'+aux[0]).attr('operador');
			     			auxV = $('#p'+aux[0]).attr('valor');
	
			     			if(auxO==">")
			     				auxO="<=";
			     			else if(auxO=="<")
			     				auxO=">=";
			     			else if(auxO=="<=")
			     				auxO=">";
			     			else if(auxO==">=")
			     				auxO="<";
			     			else if(auxO=="=")
			     				auxO="!=";	
			     			else 
			     				auxO="=";

			     			if(queryBuilder.length<1){
			     				queryBuilder="SELECT * FROM "+auxR+" WHERE "+auxA+" "+auxO+" "+auxV;
			     			}
			     			else{
			     				queryBuilder+=" AND "+auxA+" "+auxO+" "+auxV;
			     			}
			     		}
		 			}
		 			j++;
	
		 		}
		 		built_queries.push(queryBuilder);
		 	}
		 		i++;
		 	}
		 return built_queries;
 	}

 	//Convierte de decimal a binario y de binario a String para las combinaciones de los minitérminos
 	function dec2bin(dec){
    	return (dec >>> 0).toString(2);
	}
	//Agrega padding a un número binario
	function addPadding(number,pad){
		var i=0;
		var ret="";
		while(i<pad){
			ret+="0";
			i++;
		}
		ret += number.toString();
		return ret;
	}
	// Comprueba si hay datos repetidos en un array
	function compruebaRepetidos(arr,elem){
		var i=0;
		var len= arr.length;

		while(i<len){
			if(arr[i]==elem)
				return true;
			i++;
		}
		return false;
	}
	// Realiza el post para mandar el AJAX al php generarFM.php para comprobar si los predicados ingresados están bien (Comprueba Empty set)
	// De lo contrario los elimina.
 	  function compruebaFM(aux,i,p,auxR,auxA,auxO,auxV){
 	  	var val=true;
 	  	$.ajax({
		    method:"post",
		      url:"generarFM.php",
		      cache:false,
		      data:{relacion:auxR,atributo:auxA,operador:auxO,valor:auxV},
		      success: function(res){ 
		      	if(!/[1-9]+/i.test(res)){
		      		alert('Su predicado #'+i+" esta mal. Por lo tanto, se eliminará.\nPuede agregar más predicados o en todo caso dar click en 'Generar F.M.' de nuevo.");
		      		val == false;
		      		$('#agregarPredic').attr('n',parseInt($('#agregarPredic').attr('n'))-1);
		      		$(aux).replaceWith("");
		      	}
		      },
		      async: false

		    });
 	  	return val;
 	  }
 	  // Para la función PRINCIPAL del paso 2: Convierte el dato de entrada a entero
 	  function getNumero(a){
        var inicio = a.search(/\({1}\d+\){1}/g);
        var val = true;
        var dec = '';
        while(val){
          inicio++;
          dec+=a.charAt(inicio);
          val=/\d+/i.test(a.charAt(inicio+1));
        }
        return parseInt(dec);
      }
      // Para la función PRINCIPAL del paso 2: Convierte el dato de entrada a un formato aceptable para el tipo de dato decimal,
      // ademas devuelve el número de pasos que debe realizar el navegador para validar una correcta inserción de datos.
      function getDecimal(a){
        var inicio = a.search(/[,]{1}|\({1}\d+\){1}/g);
        var val = true;
        var dec = '';
        while(val){
          inicio++;
          dec+=a.charAt(inicio);
          val=/\d+/i.test(a.charAt(inicio+1));
        }
        var pasos=1;
        var i=0;
        var decI= parseInt(dec);
        while(i<decI){
          pasos/=10;
          i++;
        }
        var ret = [decI,pasos]
        return ret;
      }
      //Para la función PRINCIPAL del paso 2: Obtiene el rango para un tipo de dato que acepta dos parámetros en mysql y lo valida 
      function getEntero(a,d){
        var inicio = a.search(/\({1}\d+[,]{1}/g);
        var val = true;
        var dec = '';
        while(val){
          inicio++;
          dec+=a.charAt(inicio);
          val=/\d+/i.test(a.charAt(inicio+1));
        }
        var rango = "";
        var i = 0;
        var ent =parseInt(dec)-d;
        while(i<ent){
          rango+="9";
          i++;
        }
        return rango;
      }
// Para la función PRINCIPAL del paso 2: ésta función comprueba si algún predicado ya se ha ingresado previamente para evitar que se agregue de nuevo 
// a la tabla del paso 3
      function validaRepetido(p,r,dec,o,v){
      	var i=0;
      	var auxR="";
      	var auxA="";
      	var auxO="";
      	var auxV="";
      	var aux="";

      	while(i<p){
      		aux = '#p'+i;
      		auxR = $(aux).attr('relacion');
      		auxA = $(aux).attr('atributo');
      		auxO = $(aux).attr('operador');
      		auxV = $(aux).attr('valor');

      		if(r==auxR && dec==auxA && o==auxO && v==auxV)
      			return true;
      		i++;
      	}
      	return false;
      }

//DEL PASO 2
//Obtiene los valores del atributo, el operador y el valor del predicado simple, dado por el usuario
//Esto también verifica el tipo de dato de MySQL
//Valida si el tipo de dato es valido con el operador dado
        $('#atributo').on("change",function(){
          var a =$('#atributosel').val();
          var pat = /([i]{1}[n]{1}[t]{1})|([f]{1}[l]{1}[o]{1}[a]{1}[t]{1})|([d]{1}[e]{1}[c]{1}[i]{1}[m]{1}[a]{1}[l]{1})|([d]{1}[o]{1}[u]{1}[b]{1}[l]{1}[e]{1})|([b]{1}[i]{1}[t]{1})|([d]{1}[a]{1}[t]{1}[e]{1})|([t]{1}[i]{1}[m]{1}[e]{1})|([y]{1}[e]{1}[a]{1}[r]{1})/i.test(a);
                if (pat){
                  $('#operador').html("<div class='input-field col s12 white-text' id='operador' name='operador'><select id='operadorsel' name='operador' class='white-text'><option value='' disabled selected>Escoja el operador</option><option class='white-text' value='<'><</option><option class='white-text' value='>'>></option><option class='white-text' value='<='><=</option><option class='white-text' value='>='>>=</option><option class='white-text' value='='>=</option><option class='white-text' value='!='>!=</option></div>");
                }
                else{
                  $('#operador').html("<div class='input-field col s12 white-text' id='operador' name='operador'><select id='operadorsel' name='operador' class='white-text'><option value='' disabled selected>Escoja el operador</option>><option class='white-text' value='='>=</option><option class='white-text' value='!='>!=</option></div>");
                }
          var isInt =/(\W+[i]{1}[n]{1}[t]{1})/gi.test(a);
          var isSmallint =/([s]{1}[m]{1}[a]{1}[l]{1}[l]{1}[i]{1}[n]{1}[t]{1})/gi.test(a);
          var isTinyint =/([t]{1}[i]{1}[n]{1}[y]{1}[i]{1}[n]{1}[t]{1})/gi.test(a);
          var isMediumint =/([m]{1}[e]{1}[d]{1}[i]{1}[u]{1}[m]{1}[i]{1}[n]{1}[t]{1})/gi.test(a);
          var isBigint =/([b]{1}[i]{1}[g]{1}[i]{1}[n]{1}[t]{1})/gi.test(a);
          var isDecimal =/([d]{1}[e]{1}[c]{1}[i]{1}[m]{1}[a]{1}[l]{1})|([n]{1}[u]{1}[m]{1}[e]{1}[r]{1}[i]{1}[c]{1})/gi.test(a);
          var isFloat =/([f]{1}[l]{1}[o]{1}[a]{1}[t]{1})/gi.test(a);
          var isDouble =/([d]{1}[o]{1}[u]{1}[b]{1}[l]{1}[e]{1}[l]{1})/gi.test(a);
          var isBit =/([b]{1}[i]{1}[t]{1})/gi.test(a);
          var isDate =/([d]{1}[a]{1}[t]{1}[e]{1}\W+)/gi.test(a);
          var isDatetime =/([d]{1}[a]{1}[t]{1}[e]{1}[t]{1}[i]{1}[m]{1}[e]{1})/gi.test(a);
          var isTime =/(\W+[t]{1}[i]{1}[m]{1}[e]{1}\W+)/gi.test(a);
          var isTimestamp =/([t]{1}[i]{1}[m]{1}[e]{1}[s]{1}[t]{1}[a]{1}[m]{1}[p]{1})/gi.test(a);
          var isYear =/([y]{1}[e]{1}[a]{1}[r]{1}\W+)/gi.test(a);
          var isChar =/([c]{1}[h]{1}[a]{1}[r]{1})/gi.test(a);
          var isVarchar =/([v]{1}[a]{1}[r]{1}[c]{1}[h]{1}[a]{1}[r]{1})/gi.test(a);
          var isTinyblob =/([t]{1}[i]{1}[n]{1}[y]{1}[b]{1}[l]{1}[o]{1}[b]{1})/gi.test(a);
          var isBlob =/([b]{1}[l]{1}[o]{1}[b]{1})/gi.test(a);
          var isMediumblob =/([m]{1}[e]{1}[d]{1}[i]{1}[u]{1}[m]{1}[b]{1}[l]{1}[o]{1}[b]{1})/gi.test(a);
          var isLongblob =/([l]{1}[o]{1}[n]{1}[g]{1}[b]{1}[l]{1}[o]{1}[b]{1})/gi.test(a);
          var isSet =/([s]{1}[e]{1}[t]{1})/gi.test(a);
          var isEnum =/([e]{1}[n]{1}[u]{1}[m]{1})/gi.test(a);
          var isTinytext =/([t]{1}[i]{1}[n]{1}[y]{1}[t]{1}[e]{1}[x]{1}[t]{1})/gi.test(a);
          var isText =/([t]{1}[e]{1}[x]{1}[t]{1})/gi.test(a);
          var isMediumtext =/([m]{1}[e]{1}[d]{1}[i]{1}[u]{1}[m]{1}[t]{1}[e]{1}[x]{1}[t]{1})/gi.test(a);
          var isLongtext =/([l]{1}[o]{1}[n]{1}[g]{1}[t]{1}[e]{1}[x]{1}[t]{1})/gi.test(a);
          var isUnsigned = /([u]{1}[n]{1}[s]{1}[i]{1}[g]{1}[e]{1}[d]{1})/gi.test(a);
          var isNotnull = /([n]{1}[o]{1}[t]{1}\s{1}[n]{1}[u]{1}[l]{1}[l]{1})/gi.test(a);
          var isNull = /([n]{1}[u]{1}[l]{1}[l]{1})/gi.test(a);
          if(isNull)
            isNull = !/([n]{1}[o]{1}[t]{1})/gi.test(a);
          var valor ="";

          if(isInt){
            if(isUnsigned)
              valor += "<input class='validate white-text' type='number' id='valor' name='valor' value='' name='valor' min='0' max='4294967295' ";
            else
              valor += "<input class='validate white-text' type='number' id='valor' name='valor' value='' name='valor' min='-2147483648' max='2147483647' ";
            if(isNotnull)
              valor += "required/>";
            else
              valor += ">";
          }
          if(isSmallint){
            if(isUnsigned)
              valor += "<input type='number' id='valor' name='valor' value='' name='valor' min='0' max='65535' ";
            else
              valor += "<input type='number' id='valor' name='valor' value='' name='valor' min='-32768' max='32767' ";
            if(isNotnull)
              valor += "required>";
            else
              valor += ">";
          }
          if(isTinyint){
            if(isUnsigned)
              valor += "<input type='number' id='valor' name='valor' value='' name='valor' min='0' max='255' ";
            else
              valor += "<input type='number' id='valor' name='valor' value='' name='valor' min='-128' max='127' ";
            if(isNotnull)
              valor += "required>";
            else
              valor += ">";
          }
          if(isMediumint){
            if(isUnsigned)
              valor += "<input type='number' id='valor' name='valor' value='' name='valor' min='0' max='16777215' ";
            else
              valor += "<input type='number' id='valor' name='valor' value='' name='valor' min='-8388608' max='8388607' ";
            if(isNotnull)
              valor += "required>";
            else
              valor += ">";
          }
          if(isBigint){
            if(isUnsigned)
              valor += "<input type='number' id='valor' name='valor' value='' name='valor' min='0' max='18446744073709551615' ";
            else
              valor += "<input type='number' id='valor' name='valor' value='' name='valor' min='-9223372036854775808' max='9223372036854775807' ";
            if(isNotnull)
              valor += "required>";
            else
              valor += ">";
          }
          if(isDecimal){
            var pasos = getDecimal(a);
            var rango = getEntero(a,pasos[0]);
            if (rango=="")
              rango="1";
            if(isUnsigned)
              valor += "<input type='number' id='valor' name='valor' value='' name='valor' min='-"+rango+"' max='"+rango+"' step='"+pasos[1].toString()+"' ";
            else
              valor += "<input type='number' id='valor' name='valor' value='' name='valor' min='0' max='"+rango+"' step='"+pasos[1].toString()+"' ";
            if(isNotnull)
              valor += "required>";
            else
              valor += ">";
          }
          if(isFloat){
            var hasRange =/\({1}\d+[,]{1}\d+\){1}/g.test(a);
            var hasPrecision = /\({1}\d+\){1}/g.test(a);
            if(hasRange||hasPrecision){
              var pasos = getDecimal(a);
              if(hasRange){
                var rango=getEntero(a,pasos[0]);
                if (rango=="")
                  rango="1";
                if(isUnsigned)
                  valor += "<input type='number' class='white-text' id='valor' name='valor' value='' name='valor' min='-"+rango+"' max='"+rango+"' step='"+pasos[1].toString()+"' ";
                else
                  valor += "<input type='number' class='white-text' id='valor' name='valor' value='' name='valor' min='0' max='"+rango+"' step='"+pasos[1].toString()+"' ";
              }
              else{
                if(isUnsigned)
                  valor += "<input type='number'class='white-text' id='valor' name='valor' value='' name='valor' step='"+pasos[1].toString()+"' ";
                else
                  valor += "<input type='number' class='white-text' id='valor' name='valor' value='' name='valor' step='"+pasos[1].toString()+"' ";
              }

            }else{
              if(isUnsigned)
                valor += "<input type='number' id='valor' name='valor' value='' name='valor' step='0.000001' ";
              else
                  valor += "<input type='number' id='valor' name='valor' value='' name='valor' step='0.000001' ";
            }

            if(isNotnull)
              valor += "required>";
            else
              valor += ">";
          }
          if(isDouble){
            var hasPrecision = /\({1}\d+\){1}/g.test(a);
            if(hasPrecision){
              var pasos = getDecimal(a);
              if(isUnsigned)
                valor += "<input type='number' id='valor' name='valor' value='' name='valor' step='"+pasos[1].toString()+"' ";
              else
                valor += "<input type='number' id='valor' name='valor' value='' name='valor' step='"+pasos[1].toString()+"' ";
            }
            if(isNotnull)
              valor += "required>";
            else
              valor += ">";          
          }
          if(isBit){
            valor += "<input type='number' id='valor' name='valor' value='' name='valor' min='0' max='1' ";
            if(isNotnull)
              valor += "required>";
            else
              valor += ">";    
          }
          if(isVarchar){
            var hasLength=/\({1}\d+\){1}/g.test(a);
            if(hasLength){
              var n = getNumero(a);
              valor+="<textarea class='materialize-textarea white-text validate' id='valor' name='valor' data-length='"+n.toString()+"' ";
            }else{
              valor+="<textarea class='materialize-textarea white-text validate' id='valor' name='valor' data-length='255' ";
            }
            if(isNotnull)
              valor += "required/>";
            else
              valor += ">";    
            
          }

          $('#valor').replaceWith(valor);
               $('select').material_select()
        });

 //     Del Paso 1)
 //     Esta función es la que obtiene los atributos de la tabla seleccionada

      $("#relacion").on("change",function(){
        $.ajax({
          method:"post",
          url:"getRel.php",
          cache:false,
          data:{rel:$("#relacion").val(),val:0},
          success: function(respAX){  
            $('#tabla').html(respAX);
            $v =JSON.stringify(respAX).replace('"', '');
            $v = $v.replace("'", "") ;
            $v = $v.replace("&lt;","");
            $v = $v.replace("\\","");
            $v = $v.replace("\'","");
            $v = $v.replace("/","");
            $v = $v.replace("\t","");
            $v = $v.replace("\n","");
            $v = $v.replace('\"','');
            $v = $v.replace("\<","");
            $v = $v.replace("\>","");

            $.ajax({
              method:"post",
              url:"getRel.php",
              cache:false,
              data:{rel:$v,val:1},
              success: function(respAX2){  
                $('#atributo').html(respAX2);
                $('select').material_select();

              }
             });

          }
         });
      });

//Continuando con el Paso 2: Comprueba que no haya predicados repetidos y los agrega a la tabla del Paso 3)
        $("#agregarPredic").on("click",function(){
          var r =$('#relacion').val();
          var a =$('#atributosel').val();
          var o =$('#operadorsel').val();
          var v =$('#valor').val();
          if(r == null || a == null|| o == null || v==null ){
            alert("No ha ingresado todos los campos");
          }
          else{

          		var p = parseInt($('#agregarPredic').attr('predicados'));
          		var inicio = a.search(/\`{1}(.*?)\`{1}/g);
        		var val = true;
        		var dec = '';
        		var repetido = false;
        		while(val){
        		  inicio++;
        		  dec+=a.charAt(inicio);
        		  val=!/\`+/i.test(a.charAt(inicio+1));
        		}
   				if(p!=0)
   					repetido = validaRepetido(p,r,dec,o,v);
        		
        		if(repetido)
        			alert('Ya ha ingresado ese predicado. Pruebe con otro');	
        		else{
        			var compruebaLongitud=false;
        			if(v.length>40)
        				compruebaLongitud=true;

        			var i=0;
        			var aux="";
        			var vBefore = v;
        			while(i<v.length){
        				if(v.charAt(i)=='`')
        					aux+="\`";
        				else if(v.charAt(i)=="'")
        					aux+="\'";
        				else if(v.charAt(i)=='"')
        					aux+="\"";
        				else
        					aux+=v.charAt(i);
        				
        				if(compruebaLongitud)
        					if(i%40==0 || v.charAt(i)=='\n')
        						aux+='\n';
       					i++;
       				}
       				v=aux;

          			$('#mostrarPredicados').append("<tr id='p"+p.toString()+"' name='p"+p.toString()+"' numero='"+p.toString()+"' relacion='"+r+"' atributo='"+dec+"' operador='"+o+"' valor='"+vBefore+"'><td><b>p <sub>"+p.toString()+" :</sub></b></td><td><b>"+r+"</b></td><td> "+dec+" "+o+" "+v+"</td></tr>");
          			$('#agregarPredic').attr('predicados',p+1);
          			$('#agregarPredic').attr('n',p+1);
        		}

          	}
            
          
          
        });


//		DEL PASO 3)   
//		Obtiene la relación, el atributo, operador y el valor para construir el query que se ejecutará en MySQL.
// 		También realiza las combinaciones de los predicados para formar los minitérminos (En sus formas positivas y negadas)
// 		según el número de predicados por minitérminos que se ingrese, y los agrega a la tabla del paso 4)

     $('#generarFM').on("click",function(){
     	var p = parseInt($('#agregarPredic').attr('predicados'));
     	var i = 0;
     	var aux="";
     	var auxR="";
     	var auxA="";
     	var auxO="";
     	var auxV="";
     	var val =true;
     	if(p!=0){
     		while(i<p && val){
	     		aux='#p'+i;
	     		var comprueba = $(aux).val();
	     		if( comprueba != null){
		     		auxR = $(aux).attr('relacion');
		     		auxA = $(aux).attr('atributo');
		     		auxO = $(aux).attr('operador');
		     		auxV = $(aux).attr('valor');
		     		val = compruebaFM(aux,i,p,auxR,auxA,auxO,auxV);		     			
	     		}	
	     		i++;
	     	}
	     	var noDeCombi=$("#numeroP").val();
	     	p = parseInt($('#agregarPredic').attr('n'));
	     	console.log(p);
	     	if(noDeCombi>p || noDeCombi<2){

	     		if(noDeCombi>p)
	     			alert("Ingrese más predicados antes de hacer los minitérminos.");
	     		else
	     			alert("Ingrese un número de minitérminos mayor o igual a "+noDeCombi+".");
	     	}
	     	else{
	     		var combinaciones=[];	
	     		var n = Math.pow(2,noDeCombi);
	     		var i = 0,j=0;
	     		var aux=0;
	     		var aux2=0;
	     		while(i<n){
	     			aux=dec2bin(i);
	     			aux2=noDeCombi-aux.toString().length;
	     			if(aux2!=0)
	     				combinaciones.push(addPadding(aux,aux2));
	     			else
	     				combinaciones.push(aux.toString());
	     			i++;
	     		}

	     		var cLen=combinaciones.length;
	     		var aux3='';
	     		var res="";
	     		var rand=0;
	     		var pre = [];
	     		var val = true;

	     		aux=aux.toString();
	     		aux2=combinaciones[0].length;
				i=0;

				while(i<noDeCombi){
					pre.push(null);

					do{
	     				rand = Math.floor((Math.random() * p) + 0);
	     				val = compruebaRepetidos(pre,rand);

	     				if(!val)
	     					pre[i]=$("#p"+rand.toString()).attr("name");

	     				console.log("do: pre: "+pre[i]+" val: "+val+" rand: "+rand);
	     				// pre == null , val == true
	     			}while(pre[i]==null );
	     			pre[i]=rand;

					i++;
				}	     		

				i=0;
				var queries=[];
				var query='';
	     		while(i<cLen){
	     			query='';
	     			res+="<tr id='m"+i+"' name='m"+i+"' query=''><td><input type='checkbox' id='checa"+i+"' class='checadores filled-in' checked='checked' /><label for='checa"+i+"' id='labelCheca"+i+"'>SI</label></td><td>m <sub>"+i+"</sub> : </td><td>"
	     			j=0;
	     			aux=combinaciones[i];
	     			while(j<aux2){
	     				aux3=aux.charAt(j);
	     				if(aux3=='0'){
	     					if(j==0){
	     						res+="p <sub>"+pre[j]+"</sub>";
	     						query+="p"+pre[j];
	     					}
	     					else{
	     						res+=" ^ p <sub>"+pre[j]+"</sub>";
	     						query+=" ^ p"+pre[j];
	     					}
	     				}
	     				else{
	     					if(j==0){
	     						res+="~(p <sub>"+pre[j]+"</sub>)";
	     						query+="~(p"+pre[j]+")";
	     					}
	     					else{
	     						res+=" ^ ~(p <sub>"+pre[j]+"</sub>)";
	     						query+=" ^ ~(p"+pre[j]+")";
	     					}
	     				}
	     				
	     				j++;
	     			}
	     			queries.push(query);
	     			res+="</td></tr>"
	     			i++;
	     		}
	     		if($("#mini").attr("val") == "false"){
	     			$('#mini').append(res);
	     			$("#mini").attr("val","true");
	     			$("#mini").attr("frag",i);
	     			i=0;
	     			while(i<cLen){
	     				$("#m"+i).attr("query",queries[i]);
	     				i++;
	     			}
	     		}
	     		else{
	     			alert("Ya hay fragmentos minitérminos. Coloque primero los fragmentos en los sitios y después pruebe de nuevo.");
	     		}

	     	}

     	}
	    else{alert('No hay ningun predicado, por favor agregue enunciados.');}	
     });

//		DEL PASO 4)
// 		Esta funcion obtiene los fragmentos minitérminos de la tabla, obtiene el query de la función getQuery() en este mismo archivo en la línea 1
// 		y manda el conjunto de queries a un php (comprobarM.php)
	 $('#ComprobarM').on("click",function(){
	 	var n=$("#mini").attr("frag");
	 	var built_queries = [];
		var pre = parseInt($("#agregarPredic").attr("n"));
		var numeroP = parseInt($("#numeroP").val());

		if(pre >= numeroP){
			built_queries = getQueries(n);
		 	var q = built_queries.join('$;');
	
		 	$.ajax({
			    method:"post",
			      url:"comprobarM.php",
			      cache:false,
			      data:{queries:q},
			      success: function(respAX){
			      	console.log(respAX);
			      	var res = respAX.split(","); 
					var i = 0;
					var rLen = res.length;
					var auxM = 0;
					while(i<rLen){
						auxM=parseInt(res[i]);
						if(i==(rLen-1)){
							if(auxM==1){
								alert("Sus minitérminos son completos. Están listos para colocar en los sitios");
							}
							else{
								alert("Sus minitérminos no son completos. Pruebe agregando más.");
							}
						}
						else{
							alert("El minitermino #"+auxM+" no es mínimo. Por lo tanto se eliminará");
							$("#m"+auxM).replaceWith("");
						}
						i++;
					}
						
			    }
			});

		}
		else{
			alert("Agregue más predicados antes de comprobar los miniterminos");
		}
	 });

//	Continuando del paso 4: coloca en el sitio especificado por el usuario (Hazel,Juel o Bejar)
//	Obtiene los minitérminos que cumplieron la regla de completitud y minimalidad
// Realizamos casi el mismo proceso realizado en la función ComprobarM (linea 625), sólo que ahora no vamos a comprobar 
// si es mínimo ni completo, pero se manda los datos a colocarFrag.php
	 $("#colocar").on("click",function(){
	 	var val=parseInt($("#mini").attr("frag"));
	 	if( val == 0 ){
	 		alert("Agregue predicados antes de enviar al sitio");
	 	}
	 	else{
	 		var sitio=$("#sitio").val();
	 		var servidor="";
	 		var usuario="";
	 		var pass="";
	 		var bd="feedback";

	 		if(sitio == "Bejar"){
	 			servidor="10.100.76.76"; //IP
	 			usuario="equis"			//Usuario de Mysql 
	 			pass="pass"
	 		}
	 		else if(sitio=="Juel"){
	 			servidor="10.100.76.71"; //IP
	 			usuario="aber"			// Usuario de Mysql 
	 			pass="pass"
	 		}
	 		else{
	 			servidor="localhost";
	 			usuario="root"
	 			pass="n0m3l0"
	 		}
      
      console.log("s: "+servidor+" u: "+usuario+" pass: "+pass);
	 		var n=$("#mini").attr("frag");
	 		var built_queries = [];
			var pre = parseInt($("#agregarPredic").attr("n"));
			var numeroP = parseInt($("#numeroP").val());

				built_queries = getQueries(n);
			 	var q = built_queries.join('$;');
			 	$.ajax({
				    method:"post",
				      url:"colocarFrag.php",
				      cache:false,
				      data:{sitio:sitio,servidor:servidor,usuario:usuario,pass:pass,bd:bd,tipoFrag:"H",queries:q},
				      success: function(respAX){
				      	console.log(respAX);
							
				    }
				});


		}
	 });

});