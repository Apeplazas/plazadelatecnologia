$(document).ready(function(){
	
	$("#locDes").editInPlace({
		url: '../ajax/editarDescripcion',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		default_text: 'Agrega una descripción de tu empresa.',
		show_buttons: false,
	});
	
	$(".locNom").editInPlace({
		url: '../ajax/editarNombre',
		default_text: 'Ajusta o Edita el nombre de tu marca aquí.',
		bg_over: "#FFF1E2",
		field_type: "text",
		show_buttons: true,
		
	});
	
	$("#locUrl").editInPlace({
		url: '../ajax/editarUrl',
		default_text: 'http://www.plazadelatecnologia.com/example',
		bg_over: "#FFF1E2",
		field_type: "text",
		show_buttons: true,
	});	
	
	$("#locTel").editInPlace({
		url: '../ajax/editarTel',
		default_text: 'Número telefónico',
		bg_over: "#FFF1E2",
		field_type: "text",
		show_buttons: true,
	});	
	
	$("#locNum").editInPlace({
		url: '../ajax/editarNum',
		default_text: 'Número de Local',
		bg_over: "#FFF1E2",
		field_type: "text",
		show_buttons: true,
	});
	
	$("#locEmail").editInPlace({
		url: '../ajax/editarEmail',
		default_text: 'Email de Local',
		bg_over: "#FFF1E2",
		field_type: "text",
		show_buttons: true,
	});
});