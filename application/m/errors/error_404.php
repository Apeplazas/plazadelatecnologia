<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<title>Plaza de la Tecnologia</title>
<meta name="description" content="Las mejores ofertas de computo, telefonia, electronico, y reparaciones en México" />
<meta name="keywords" content="Computo, Electronica, Telefonia y Reparciones"/>
<meta name="robots" content="All,index, follow" />
<link type="text/css" href="http://www.plazadelatecnologia.com/assets/css/style.css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Raleway:500,200' rel='stylesheet' type='text/css'>
<script language="javascript" src="http://www.plazadelatecnologia.com/assets/js/jquery-1.9.1.js" type="text/javascript"></script>
<script language="javascript" src="http://www.plazadelatecnologia.com/assets/js/jquery.fancybox.pack.js" type="text/javascript"></script>
<link type="text/css" href="http://www.plazadelatecnologia.com/assets/css/jquery.fancybox.css" rel="stylesheet"/>
<script language="javascript" src="http://www.plazadelatecnologia.com/assets/js/functions.js" type="text/javascript"></script>
<link rel="icon" type="image/png" href="http://www.plazadelatecnologia.com/assets/graphics/pt.ico" />
<!--[if lt IE 9]>
<script src="http://www.plazadelatecnologia.com/assets/js/html5shiv.js"></script>
<![endif]-->
</head>
<body class="bckWhite">
<header class="pfixed miloc">
<a id="logo" href="http://www.plazadelatecnologia.com/" title="Plaza de la tecnologia Ofertas en Computadoras, tablets y muchos mas..."><img src="http://www.plazadelatecnologia.com/assets/graphics/logo-plazadelatecnologia-color.png" alt="Plaza de la Tecnologia" /></a>	
</header>
<div id="contentLocal404">
<a id="oops" href="http://www.plazadelatecnologia.com"><img src="http://www.plazadelatecnologia.com/assets/graphics/oops.png" alt="Opps esta pagina se ha mudado" /></a>
</div>

<!-- Ventana de registro o acceso-->
<div style="display:none">
	<div id="login_form" >
    <p class="msgLog"><a href="<?=base_url()?>" title="plaza de la tecnologia"><img src="<?=base_url()?>assets/graphics/plazadelatecnologia-color.jpg" alt="Plaza de la tecnologia" /></a> <em>¿Necesitas ayuda? <a class=" red" title="contacto" href="<?=base_url()?>contacto">Contáctanos aquí</a></em></p>
    <span id="hspan"><img src="<?=base_url()?>assets/graphics/accesousuarios.jpg" alt="Acceso a usuarios" /></span>
	<form id="commentForm"  method="post" action="<?=base_url()?>registrate/validate_credentials">
    <h3>Bienvenido de Regreso.</h3>
    <fieldset>
      <label>Correo</label>
      <input class="inputReg required  email" minlength="2" type="text" value="ESCRIBE TU EMAIL" name="email">
    </fieldset>
    <fieldset>
      <label>Contraseña</label>
      <input type="password" class="inputReg required" name="contrasenia">
      <a class="pass red" href="<?=base_url()?>registrate/recuperar_contrasenia">¿Olvidaste tu Contraseña?</a>
    </fieldset>
    <fieldset>
      <input type="hidden" value="<?=$this->uri->uri_string()?>" name="url">
      <input id="botonEntrar" type="image" src="<?=base_url()?>assets/graphics/entrar.png" value="enviar">
    </fieldset>
    </form>
    	<div id="regRight">
	    <a title="conectate con facebook" href="<?=base_url()?>myfacebook"><img src="<?=base_url()?>assets/graphics/conectate-con-facebook.png" alt="conectate con facebook" /></a>
	    <b>Ó</b>
	    <p>Si lo prefieres, <a class="red" title="registrate" href="<?=base_url()?>registrate/solicitud_informacion">regístrate aqui</a>  con todos tus datos.</p>
	    	<div id="lideres">
	          <strong>Líderes de opinión en tecnología y muchos más...</strong>
	          <span><img src="<?=base_url()?>assets/graphics/compucity-registro.jpg" alt="Compucity" /></span>
	          <span><img src="<?=base_url()?>assets/graphics/sumitel-registro.jpg" alt="Sumitel" /></span>
	          <span><img src="<?=base_url()?>assets/graphics/teclaser-registro.jpg" alt="Teclaser" /></span>
	          <p>más de 5000 líderes en venta y opinión en tecnología</p>
	        </div>
	    </div>
	</div>
</div>
<script type="text/javascript">
//Form Focus
$(document).ready(function() {
			$('textarea').addClass("idleField");
			$('textarea').focus(function() {
				$(this).removeClass("idleField").addClass("focusField");
    		    if (this.value == this.defaultValue){ 
    		    	this.value = '';
				}
				if(this.value != this.defaultValue){
	    			this.select();
	    		}
    		});
			$('input[type="text"]').addClass("idleField");
       		$('input[type="text"]').focus(function() {
       			$(this).removeClass("idleField").addClass("focusField");
    		    if (this.value == this.defaultValue){ 
    		    	this.value = '';
				}
				if(this.value != this.defaultValue){
	    			this.select();
	    		}
    		});
    		$('input[type="text"]').blur(function() {
    			$(this).removeClass("focusField").addClass("idleField");
    		    if ($.trim(this.value) == ''){
			    	this.value = (this.defaultValue ? this.defaultValue : '');
				}
    		});
			$('textarea').blur(function() {
    			$(this).removeClass("focusField").addClass("idleField");
    		    if ($.trim(this.value) == ''){
			    	this.value = (this.defaultValue ? this.defaultValue : '');
				}
    		});
		});	
</script>
</body>
</html>

