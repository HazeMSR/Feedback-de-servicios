 $(document).ready(function() {
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

 //     Del Paso 1)
 //     Esta función es la que obtiene los atributos de la tabla seleccionada

      $("#relacionV").on("change",function(){
        $.ajax({
          method:"post",
          url:"getRel.php",
          cache:false,
          data:{rel:$("#relacionV").val(),val:0},
          success: function(respAX){  
            $('#tablaV').html(respAX);
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
              data:{rel:$v,val:3},
              success: function(respAX2){  
                $('#atributoV').html(respAX2);
                $('select').material_select();

              }
             });

          }
         });
      });
//Del paso 3: Genera las expresiones algebraicas con los atributos y relaciones seleccionados
     $('#generarE').on("click",function(){
        var a =$('#atributoselV').val();
        var aLen = a.length;
        var i = 0;
        var aux = "";
        var atr="";

        while(i<aLen){
          aux = a[i].match(/[\`]+\w+[\`]+/g);

          aux = aux[0].match(/\w+/g); 

          if(atr.length<1)
            atr=aux;
          else
            atr+=","+aux;       
          i++;
        }
        var rel = $("#relacionV").val();
        var n = $("#comprobarExpresiones").attr("expresiones");
        var dos = n;

        var res ="<tr id='e"+n+"' name='e"+n+"' numero='"+n+"' relacion='"+rel+"' atributos='"+atr+"'><td><input type='checkbox' id='checaV"+dos+"' class='filled-in' checked='checked' /><label for='checaV"+dos+"' id='labelChecaV"+dos+"'>SI</label></td><td><b>e <sub>"+n+" :</sub></b></td><td> <strong>π</strong> <sub>"+atr+"</sub> ("+rel+")</td></tr>";

        $("#mV").append(res);
        $("#comprobarExpresiones").attr("expresiones",(parseInt(n)+1));
     });

  //En el paso 4 comprueba que las expresiones cumplan con la condición de completitud, 
  //para eso obtiene los atributos y las relaciones de las expresiones y los manda a comprobarE.php
  $("#comprobarExpresiones").on("click",function(){

      var e = parseInt($('#comprobarExpresiones').attr('expresiones'));
      var i = 0;
      var j = 0;
      var auxLen = 0;
      var arr = [];
      var arrAux = [];
      var auxR = "";
      var auxA = "";

      while(i<e){
          aux='#e'+i;
          var comprueba = $(aux).val();

          if( comprueba != null){
            auxR = $(aux).attr('relacion');
            auxA = $(aux).attr('atributos');
            if(arr.length<1){
              arr=auxA.split(',');
            }
            else{
              arrAux = auxA.split(',');
              auxLen = arrAux.length;
              j=0;
              while(j<auxLen){
                if( !compruebaRepetidos(arr,arrAux[j]) ){
                  if(j>0){
                    arr.push(arrAux[j]);
                  }
                } 
                j++;
              }
        
            }
          } 
        i++;       
      }
      var atrib= arr.join(',');
      console.log("Atributos:"+atrib);
      $.ajax({
            method:"post",
              url:"comprobarE.php",
              cache:false,
              data:{relacion:auxR,atributos:atrib},
              success: function(respAX){
                if(parseInt(respAX) == 1){
                  alert("Sus expresiones son completas, puede proceder a colocarlas.");
                }
              
            }
        });

  });
//  Continuando del paso 5: coloca en el sitio especificado por el usuario (Hazel,Juel o Bejar)
//  Obtiene las expresiones que cumplieron la regla de completitud y las manda a colocarE.php
   $("#colocarV").on("click",function(){
    var e=parseInt($('#comprobarExpresiones').attr('expresiones'));
    if( e == 0 ){
      alert("Agregue expresiones antes de enviar al sitio");
    }
    else{
      var sitio=$("#sitioV").val();
      var servidor="";
      var usuario="";
      var pass="";
      var bd="feedback";

      if(sitio == "Bejar"){
        servidor="10.100.76.76"; //IP
        usuario="equis"     //Usuario de Mysql 
        pass="pass"
      }
      else if(sitio=="Juel"){
        servidor="10.100.79.4"; //IP
        usuario="juel"      // Usuario de Mysql 
        pass="pass"
      }
      else{
        servidor="localhost";
        usuario="root"
        pass="n0m3l0"
      }
      
      console.log("s: "+servidor+" u: "+usuario+" pass: "+pass);
      var i=0;
      var auxLen = 0;
      var arr = [];
      var arrAux = [];
      var auxR = "";
      var auxA = "";
      while(i<e){
          aux='#e'+i;

          var comprueba = $(aux).val();

          if( comprueba != null && $("#checaV"+i).is(':checked')){

            auxR = $(aux).attr('relacion');
            
            auxA = $(aux).attr('atributos');
            if(arr.length<1){
              arr=auxA.split(',');
            }
            else{
              arrAux = auxA.split(',');
              auxLen = arrAux.length;
              j=0;
              while(j<auxLen){
                if( !compruebaRepetidos(arr,arrAux[j]) ){
                  if(j>0){
                    arr.push(arrAux[j]);
                  }
                } 
                j++;
              }
        
            }
          } 
        i++;       
      }
      var atrib= arr.join(',');
      console.log("Atributos:"+atrib);
      $.ajax({
            method:"post",
              url:"colocarE.php",
              cache:false,
              data:{sitio:sitio,servidor:servidor,usuario:usuario,pass:pass,bd:bd,tipoFrag:"V",relacion:auxR,atributos:atrib},
              success: function(respAX){
                console.log(respAX);
              
            }
        });


    }
   });
  

});