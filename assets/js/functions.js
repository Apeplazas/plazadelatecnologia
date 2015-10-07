jQuery(function($) {
/********************************************************************************************************************
Enseña y esconde el submenu
********************************************************************************************************************/
	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
				
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
	});
	
/********************************************************************************************************************
Hace funcionar los placeholder en Explorer 8 9 10
********************************************************************************************************************/
$(function(){
	$(":input[placeholder]").placeholder();
});	
/********************************************************************************************************************
Cambia la clase en la busqueda para pasar de box a horizontal
********************************************************************************************************************/
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
Abre formulario para subir banner lead tienda
********************************************************************************************************************/
	$(".upBan").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#login_error").hide();
		}
	});
/********************************************************************************************************************
Abre formulario para subir box banner tienda
********************************************************************************************************************/
	$(".upCon").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#login_error").hide();
		}
	});
/********************************************************************************************************************
Abre formulario para subir logo
********************************************************************************************************************/
	$(".upLogo").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#login_error").hide();
		}
	});
/********************************************************************************************************************
Abre formulario para cambiar fotos de articulos
********************************************************************************************************************/
	$(".fotoP").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#login_error").hide();
		}
	});
/********************************************************************************************************************
Abre formulario para cambiar fotos de articulos
********************************************************************************************************************/
	$(".guia").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#login_error").hide();
		}
	});
/********************************************************************************************************************
Abre formulario para subir Avatar
********************************************************************************************************************/
	$(".upAvatar").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#login_error").hide();
		}
	});
/********************************************************************************************************************
Abre formulario para cambiar foto principal
********************************************************************************************************************/
	$(".fotoMain").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#login_error").hide();
		}
	});
/********************************************************************************************************************
Agrega categorias en el articulo
********************************************************************************************************************/
	$(".agregaCat").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#login_error").hide();
		}
	});
/********************************************************************************************************************
Agrega articulos por tematica
********************************************************************************************************************/
	$(".addProRam").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#login_error").hide();
		}
	});
/********************************************************************************************************************
Abre formulario para traspasos
********************************************************************************************************************/
	$(".traspaso").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#login_error").hide();
		}
	});
/********************************************************************************************************************
Abre formulario para traspasos
********************************************************************************************************************/
	$(".preguntar").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false,
		'onClosed'		: function() {
		    $("#login_error").hide();
		}
	});
/********************************************************************************************************************
Busca y hace cuenta de total de producto
********************************************************************************************************************/
	$("#subTot, #cosEnv, #des").keyup(function(){
		var filtro    = $("#subTot").val();
		var filtro2   = $("#cosEnv").val();
		var filtro3   = $("#des").val();
		$("#totAjax").removeAttr("disabled");
		$.post("http://www.plazadelatecnologia.com/ajax/cargarBancos",{filtro:filtro,filtro2:filtro2,filtro3:filtro3},function(data){
			sucess:				
				$("#totAjax").empty().append(data);
				$("#totAjax").removeAttr("disabled");
		});
		
	})
	$(function(){
	setTimeout(function(){ $("#panel").fadeOut(); }, 20000);
	
		// Expande Panel de Registro
		$("#open").click(function(){
			$("div#panel").slideDown("fast");
		
		});	
		
		// Cierra el panel de registro
		$("#close").click(function(){
			$("div#panel").slideUp("fast");	
		});		
		
		// cambia el link de cerrar a abrir
		$("#toggle_panel a").click(function () {
			$("#toggle_panel a").toggle();
		});	
	})
});

