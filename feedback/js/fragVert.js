 $(document).ready(function() {

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
//Del paso 3:
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
            atr+=", "+aux;       
          i++;
        }
        var rel = $("#relacionV").val();
        var n = $("#comprobarExpresiones").attr("expresiones");
        var res ="<tr id='e"+n+"' name='e"+n+"' numero='"+n+"' relacion='"+rel+"' atributos='"+atr+"'><td><input type='checkbox' id='checa"+i+"' class='checadores filled-in' checked='checked' /><label for='checa"+i+"' id='labelCheca"+i+"'>SI</label></td><td><b>e <sub>"+n+" :</sub></b></td><td> <strong>π</strong> <sub>"+atr+"</sub> ("+rel+")</td></tr>";
        console.log(res)
        $("#mV").append(res);
        $("#comprobarExpresiones").attr("expresiones",(parseInt(n)+1));
     });


});