$(document).ready(function(e) {
	$("#formAcc").validetta({
		bubblePosition: 'bottom', bubbleGapTop: 10, bubbleGapLeft: -5,
		onValid:function(e){
			e.preventDefault();
			
			/*En el AJAX se toman los parametros del formulario,
			se realiza la consulta mandandolos a index_AX.php
			si no se encuentra el usuario manda error, si si
			redirige a crud.php*/
			$.ajax({
				method:"post",
				url:"php/index_AX.php",
				cache:false,
				data:$("#formAcc").serialize(),
				success: function(respAX){				
					if(respAX==-1){
						
						alert("ERROR. El password o el usuario no coinciden.");
					}else{
						console.log(respAX);
						if(respAX == 1){
							alert(respAX);
							$(location).attr("href","php/crud.php");
						}else{
							
							if(respAX == 0){
								alert(respAX);
								$(location).attr("href","php/inicioUsuario.php");
							}
						}
					}
				}
			});
		}
	});	
});