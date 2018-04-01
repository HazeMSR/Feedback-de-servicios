$(document).ready(function(e) {
	var promedio =$("#promedio").val();
	var tt2 =$("#tt2").val();

	if(promedio < 8.5){
		$("#banner1").css({"display":"none"});
		$("#excelencia").css({"display":"none"});
	}
	if(tt2 == 0){
		$("#banner2").css({"display":"none"});
		$("#graduacion").css({"display":"none"});
	}

	console.log(promedio);
	console.log(tt2);
});