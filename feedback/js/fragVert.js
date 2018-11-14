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

     $('#generarE').on("click",function(){
        var a =$('#atributoselV').val();
        var aLen = a.length;
        var i = 0;
        var aux = "";
        var atr="";
        var pat1= new RegExp(/[\`]+\w+[\`]+/g);
        var pat2= new RegExp(/\w+/g); 
        while(i<aLen){
          aux = pat1.exec(a[i]);
          aux = pat2.exec(aux); 
          if(atr.length<1)
            atr=aux;
          else
            atr+=", "+aux;       
        }
        var rel = $("#relacionV").val();
        var n = $("#comprobarExpresiones").attr("expresiones");
        $("#mostrarExpresionesV").append("<tr id='e"+n+"' name='e"+n+"' numero='"+n+"' relacion='"+rel+"' atributos='"+atr+"><td><b>e <sub>"+n+" :</sub></b></td><td><b>"+rel+"</b></td><td> π <sub>"+atr+"</sub> ("+rel+")</td></tr>")
        $("#comprobarExpresiones").attr("expresiones",(parseInt(n)+1));
     });


});