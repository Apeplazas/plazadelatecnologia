jQuery(function($) {
	// Enseña y Esconde el submenu
	$(function(){
		$('nav ul li').hover(
			function () {
				//Enseña submenu en slidedown
				$('.subMenu', this).fadeIn(15);
			}, 
			function () {
				//Esconde el submenu en slideUp
				$('.subMenu', this).fadeOut(15);			
			}
		);
		//fin
		
		//Genera tab con ui
		$( "#tabs" ).tabs();
		
		//Esconde boton en formulario
		$('#pregComm').focus(function(){
		    $('#submit').show();
		});
		$('#pregComm').blur(function(){
		    $('#submit').hide();
		});
		
		
	});
	//Cambia tipo de busqueda de lista a cuadro
	$('#box').click(function(){
		$('#listChange').removeClass('wide');
		$('#listChange').addClass('box');
		$('#box').addClass('actBox');
		$('#box').removeClass('inactBox');
		$('#wide').removeClass('actWide');
		$('#wide').addClass('inactWide');
	});
	$('#wide').click(function(){
		$('#listChange').addClass('wide');
		$('#listChange').removeClass('box');
		$('#box').removeClass('actBox');
		$('#box').addClass('inactBox');
		$('#wide').removeClass('inactWide');
		$('#wide').addClass('actWide');
	});
		
	 $("#log").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#login_error").hide();
		}
	});
});


