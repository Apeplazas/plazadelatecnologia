<?php
setcookie('id', $_GET['id']);
setcookie('url', $_GET['url']);
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Acceso de internet - Plaza de la Tecnologia</title>
    <link type="text/css" rel="stylesheet" href="http://www.plazadelatecnologia.com/assets/css/style.css">
	<link href='http://www.plazadelatecnologia.com/assets/graphics/pt.ico' rel='icon' type='image/gif'/>
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-11500342-2']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
</head>
<body >
<div id="headerDefault">
    <div id="header" >
    <a class="logo" title="Plaza de la Tecnologia, Computacion, telefonia, electronica, entretenimiento y mas" href="http://www.plazadelatecnologia.com/"><img src="http://www.plazadelatecnologia.com/assets/graphics/plazadelatecnologia-logo2012.png" alt="Plaza de la Computacion"></a>
	<ul class="menu tabs">
  <li class="menudiv">
    <a class="menuInactive" href="http://www.plazadelatecnologia.com/" title="Plaza de la Tecnologia">Inicio</a>
  </li><li class="menudiv">
    <a class="menuInactive" href="http://www.plazadelatecnologia.com/noticias" title="Noticias">noticias</a>
  </li><li class="menudiv">
    <a class="menuInactive" href="http://www.plazadelatecnologia.com/nosotros" rel="nofollow" title="Nosotros">Nosotros</a>
  </li><li class="menudiv">
    <a class="menuInactive" href="http://www.plazadelatecnologia.com/ofertas" title="Ofertas">ofertas</a>
  </li><li class="menudiv">
    <a class="menuInactive" href="http://www.plazadelatecnologia.com/galerias/videogalerias" rel="nofollow" title="Videogaleria">Videogaleria</a>
  </li><li class="menudiv">
    <a class="menuInactive" href="http://www.plazadelatecnologia.com/contacto" rel="nofollow" title="Contactanos">Contacto</a>
  </li>
  <li><a class="menuInactive bckBlue" href="#">Ciudades</a>
    <ul class="subMenu">
		<li class="even-list"><a title="Tecnologia en Aguascalientes" href="http://www.plazadelatecnologia.com/aguascalientes">Aguascalientes</a></li>
        <li class="odd-list"><a title="Tecnologia en Chihuahua" href="http://www.plazadelatecnologia.com/chihuahua">Chihuahua</a></li>
        <li class="even-list"><a title="Tecnologia en Cuernavaca" href="http://www.plazadelatecnologia.com/cuernavaca">Cuernavaca</a></li>
        <li class="odd-list"><a title="Tecnologia en Pericentro - Estado de Mexico" href="http://www.plazadelatecnologia.com/edo_de_mexico">Estado de Mexico (Pericentro)</a></li>
        <li class="even-list"><a title="Tecnologia en Guadalajara" href="http://www.plazadelatecnologia.com/guadalajara">Guadalajara</a></li>
        <li class="odd-list"><a title="Tecnologia en Leon" href="http://www.plazadelatecnologia.com/leon">Leon</a></li>
        <li class="even-list"><a title="Tecnologia en Merida" href="http://www.plazadelatecnologia.com/merida">Merida</a></li>
        <li class="odd-list"><a title="Tecnologia en México" href="http://www.plazadelatecnologia.com/mexico">Mexico (Distrito Federal)</a></li>
        <li class="even-list"><a title="Tecnologia en Monterrey" href="http://www.plazadelatecnologia.com/monterrey">Monterrey</a></li>
        <li class="odd-list"><a title="Tecnologia en Morelia" href="http://www.plazadelatecnologia.com/morelia">Morelia</a></li>
        <li class="even-list"><a title="Tecnologia en Puebla" href="http://www.plazadelatecnologia.com/puebla">Puebla</a></li>
        <li class="even-list odd-list"><a title="Tecnologia en Puebla" href="http://www.plazadelatecnologia.com/queretaro">Queretaro</a></li>
        <li class="odd-list even-list"><a title="Tecnologia en San Luis Potosi" href="http://www.plazadelatecnologia.com/san_luis_potosi">San Luis Potosi</a></li>
        <li class="even-list odd-list"><a title="Tecnologia en Toluca" href="http://www.plazadelatecnologia.com/toluca">Toluca</a></li>
        <li class="odd-list even-list"><a title="Tecnologia en Torreon" href="http://www.plazadelatecnologia.com/torreon">Torreon</a></li>
        <li class="even-list odd-list"><a title="Tecnologia en Villahermosa" href="http://www.plazadelatecnologia.com/villahermosa">Villahermosa</a></li>
		</ul>
    </li>
    <li class="menudiv">
      <a class="menuInactive" href="http://www.plazadelatecnologia.com/renta_de_locales">Renta de Locales</a>
    </li>
</ul>    </div>
</div>
    <div id="content">
	    <div id="regCont">
		<h1>Registrate para obtener acceso a internet</h1>
		<div class="form-register">
		<form method="post" action="http://www.plazadelatecnologia.com/acceso_usuarios/register_access">
		<fieldset>
        <label>Nombre Completo</label>
		<input class="widthInput" type="text"  name="usuarioNombre">
        </fieldset>
        <fieldset>
		<label>Email</label>
		<input class="widthInput" type="text" value="" name="usuarioEmail">
        </fieldset>
        <fieldset>
		<label>Estado</label>
        <select class="widthInput" name="usuarioCiudad">
        	<option class="required ancho" value="select" >Seleccione tu ciudad</option>
			<option value="Aguascalientes">Aguascalientes</option>
			<option value="México">México</option>
		    <option value="Chihuahua">Chihuahua</option>
		    <option value="Cuernavaca">Cuernavaca</option>
		    <option value="Estado de México - Pericentro">Estado de México - Pericentro</option>
		    <option value="Guadalajara">Guadalajara</option>
		    <option value="Leon">Leon</option>
		    <option value="Monterrey">Monterrey</option>
		    <option value="Morelia">Morelia</option>
		    <option value="Nuevo Leon">Nuevo Leon</option>
		    <option value="Puebla">Puebla</option>
		    <option value="San Luis Potosi">San Luis Potosi</option>
		    <option value="Toluca">Toluca</option>
		    <option value="Torreon">Torreon</option>
		    <option value="Villahermosa">Villahermosa</option>
		    <option value="Merida">Merida</option>
		</select>
        </fieldset>
        <fieldset>
		<label>Contraseña que deseas tener</label>
		<input class="widthInput" type="password" name="usuarioContrasenia">
        </fieldset>
        <fieldset>
		<input id="accept-tou" type="checkbox" checked="checked" name="accept-tou" value="yes" /> I accept the <a href="javascript:void(0)" id="show-tou">Term of Use</a></label>
        </fieldset>
        <fieldset>
          <input class="input_text" name="connect" type="submit" value="Connect" id="connectReg" onClick="checkLogin()" />
        </fieldset>
        <h2>Terminos y condiciones</h2>
		<p>A usar este servicio, cualquier persona acepta, de forma obligatoria y vinculante, los siguientes términos y condiciones: Plaza de la Tecnología se reserva el derecho de restringir o denegar de manera unilateral el servicio de internet inalámbrico, según su conveniencia. Sin excepción, el servicio se presta por un máximo de 2 horas efectivas por equipo al día. El uso del servicio se permite exclusivamente al llenar el registro. Una vez completado, el usuario quedará suscrito para recibir correos electrónicos con promociones y ofertas de Plaza de la Tecnología; también acepta de forma voluntaria que su información sea usada por quien ofrece este servicio de la forma que más convenga.</p>
		
		</form>
        <br class="clear">
		</div>
        <br class="clear">
    </div>
</div>
<br />			
</div>
<script type="text/javascript">
var checkbox_tou = document.getElementById('accept-tou');

function addevent(el, event, fn) {
	if (el.addEventListener)
		el.addEventListener(event, fn, false);
	else
		el.attachEvent('on'+event, fn);
}

function reflectAcceptTou() {
	console.log(checkbox_tou.checked);
	var button_connect = document.getElementById('connect');
	if (checkbox_tou.checked) {
		button_connect.removeAttribute('disabled');
		button_connect.removeAttribute('class');
	}
	else {
		button_connect.setAttribute('disabled', 'disabled');
		button_connect.setAttribute('class', 'disabled');
	}
}

addevent(checkbox_tou, 'change', reflectAcceptTou);

function checkLogin(){
	location.href = 'authorized.php';
}
</script>   
</body>
</html>