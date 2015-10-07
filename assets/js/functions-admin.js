jQuery(function($) {
/********************************************************************************************************************
Enseña y esconde el submenu
********************************************************************************************************************/
	$ ('#det tr:even').addClass('evenPa');
/********************************************************************************************************************
Abre formulario para login
********************************************************************************************************************/
	 $(".log").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#login_error").hide();
		}
	});
	
/********************************************************************************************************************
Abre formulario para guardar estatus de peticion telefonica
********************************************************************************************************************/
	$('.statusPet').click(function(event){
			var id = $(this).attr('alt');
			var estatus = $(this).attr('title');;
			$("#peticion [name=peticionID]").val(id);
			$("#peticion [name=estatusP]").val(estatus);
		});	
	
	$(".statusPet").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#peticion").hide();
		    
		}
		
	});
	
/********************************************************************************************************************
Abre formulario para guardar estatus de peticion telefonica
********************************************************************************************************************/
	$('.ingAccion').click(function(event){
			var texto = $(this).attr('alt');
			$("#accion [name=texto]").val(texto);
		});	
	
	$(".ingAccion").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#accion").hide();
		    
		}
		
	});
	
});

