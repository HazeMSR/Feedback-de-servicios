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


});