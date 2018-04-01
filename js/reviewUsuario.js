$(document).ready(function(e) {
	
	$("#formAddRev").validetta({
		bubblePosition:"bottom", bubbleGapTop:10, bubbleGapLeft:-5,
		onValid:function(e){
			e.preventDefault();
			$("#modalAddRev").modal("close");
			$.ajax({
				method:"post",
				url:"addReview_AX.php",
				data:$("#formAddRev").serialize(),
				cache:false,

				alert(data),
				success: function(respAX){
					if(respAX == 1){
						$.alert({
							title:"Feedback",
							content:"Se agreg&oacute; correctamente la rese&ntilde;a",
							type:"green",
							useBootstrap:false,
							boxWidth:"50%",
							onClose:function(){
								location.reload(true);
							}
						});
					}else{
						if(respAX == -1){
							$.alert({
								title:"Feedback",
								content:"No se pudo agregar la rese&ntilde;ao. Intente de nuevo.",
								type:"red",
								useBootstrap:false,
								boxWidth:"50%"
							});
						}
						else{
							$.alert({
								title:"SEE",
								content:"No se pudo insertar el registro en los usuario. Intente con otro usuario. ",
								type:"red",
								useBootstrap:false,
								boxWidth:"50%"
							});
						}
					}
				}
			})
			console.log(respAX);
		}
	});

		
});
