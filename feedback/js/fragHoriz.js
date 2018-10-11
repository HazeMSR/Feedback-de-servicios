 $(document).ready(function() {
 	  function compruebaFM(aux,i,p,auxR,auxA,auxO,auxV){
 	  	var val=true;
 	  	$.ajax({
		    method:"post",
		      url:"generarFM.php",
		      cache:false,
		      data:{relacion:auxR,atributo:auxA,operador:auxO,valor:auxV},
		      success: function(res){ 
		      	if(!/[1-9]+/i.test(res)){
		      		alert('Su predicado #'+i.toString()+" esta mal. Por lo tanto, se eliminará.\nPuede agregar más predicados o en todo caso dar click en 'Generar F.M.' de nuevo.");
		      		val == false;
		      		$(aux).replaceWith("");
		      	}
		      	else if(i==(p-1))
		      		alert('Sus predicados están listos para generar minitérminos.');
		      }
		    });
 	  	return val;
 	  }
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
      function validaRepetido(p,r,dec,o,v){
      	var i=0;
      	var auxR="";
      	var auxA="";
      	var auxO="";
      	var auxV="";
      	var aux="";

      	while(i<p){
      		aux = '#p'+i.toString();
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
        		}

          	}
            
          
          
        });

     $('#generarFM').on("click",function(){
     	var p = parseInt($('#agregarPredic').attr('predicados'));
     	var i = 0;
     	var aux="";
     	var auxR="";
     	var auxA="";
     	var auxO="";
     	var auxV="";
     	var val =true;
     	if(p!=0)
	     	while(i<p && val){
	     		aux='#p'+i.toString();
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
	    else{alert('No hay ningun predicado, por favor agregue enunciados.');}
	
	    
     });
	    

});