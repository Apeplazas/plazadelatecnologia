<?php
setcookie('id', $_GET['id']);
setcookie('url', 'http://plazadelatecnologia.com/guest/ok.php');
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
<body>
<div id="headerDefault">
    <div id="header">
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
	</ul>
    </div>
</div>
<div id="content" style="text-align:left;">
	<div id="loginContainer">
      <div id="wrapLog">
        <h1>Servicio de internet gratuito</h1>
		<div class="form-controls">
		<form method="post" action="http://plazadelatecnologia.com/acceso_usuarios/validateInternet">
        <span class="titLog">Introduce tu usuario y contraseña</span>
		<fieldset>
        <label>Email</label>
		<input class="widthInputLog" type="text"  name="usuarioEmail">
        </fieldset>
        <fieldset>
		<label>Contraseña</label>
		<input class="widthInputLog" type="password" value="" name="usuarioContrasenia">
        </fieldset>
        <fieldset>
          <input class="input_text" name="connect" type="submit" value="Connect" id="connect" onClick="checkLogin()" />
        </fieldset>
		</form>
         <div id="regLog">
	      <a href="http://www.plazadelatecnologia.com/guest/registro.php">
	        <img src="http://www.plazadelatecnologia.com/assets/graphics/registrateahora.jpg" alt="registrate ahora">
	      </a>
	      </div>
        <h2>Terminos y Condiciones</h2>
        <p class="termcond">Al usar este servicio, cualquier persona acepta, de forma obligatoria y vinculante, los siguientes términos y condiciones: Plaza de la Tecnología se reserva el derecho de restringir o denegar de manera unilateral el servicio de internet inalámbrico, según su conveniencia. Sin excepción, el servicio se presta por un máximo de 2 horas efectivas por equipo al día. El uso del servicio se permite exclusivamente al llenar el registro. Una vez completado, el usuario quedará suscrito para recibir correos electrónicos con promociones y ofertas de Plaza de la Tecnología; también acepta de forma voluntaria que su información sea usada por quien ofrece este servicio de la forma que más convenga.</p>
      </div>
      <a class="mtb" href="http://www.plazadelatecnologia.com/renta_de_locales" title="Renta tu local en Plaza de la Tecnología"><img alt="Renta tu local en Plaza de la Tecnología" src="http://www.plazadelatecnologia.com/assets/graphics/bannersPromocionales/renta-tu-local-de-computo.jpg"></a>
      </div>
	</div>
</div>
<br class="clear">
<!--Empieza Pie de Pagina -->
<div id="footer">
	<div id="footerWrap">
      <ul class="footerMedium">
        <li><strong>Categorias de Artículos</strong></li>
        <li><a title="Articulos y Noticias de Computo" href="http://www.plazadelatecnologia.com/computo">Computo</a></li>
        <li><a title="Articulos y Noticias de Electronica" href="http://www.plazadelatecnologia.com/electronica">Electronica</a></li>
        <li><a title="Articulos y Noticias de Telefonia" href="http://www.plazadelatecnologia.com/telefonia">Telefonia</a></li>
        <li><a title="Articulos y Noticias de Entretenimiento" href="http://www.plazadelatecnologia.com/entretenimiento">Entretenimiento</a></li>
      </ul>
      <ul class="footerSmall">
        <li><strong>Servicios</strong></li>
        <li><a title="bolsa de trabajo" href="http://www.apeplazas.com/_contenido/_corporativo/02.php">Bolsa de Trabajo</a></li>
        <li><a title="ofertas en mexico de computo" href="http://www.plazadelatecnologia.com/ofertas">Ofertas</a></li>
        <li><a title="renta tu local en plaza de la tecnologia" href="http://www.plazadelatecnologia.com/renta_de_locales">Renta de Locales</a></li>
        <li><a title="Acceso Locatarios" href="http://www.plazadelatecnologia.com/acceso_usuarios">Acceso a Locatarios</a></li>
      </ul>
      <ul class="footerSmall">
        <li><strong>Sitios de Interes</strong></li>
        <li><a href="http://www.bazargames.com">Bazar Games</a></li>
        <li><a href="http://www.cnbbosques.com">Renta de Oficinas</a></li>
      </ul>
      <ul class="footerSocial">
        <li><strong>Redes Sociales</strong></li>
		  <li>
    <a type="application/rss+xml" href="http://www.plazadelatecnologia.com/inicio/feed" title="Siguenos en Nuestro Boletin"><img src="http://www.plazadelatecnologia.com/assets/graphics/rss-icon.png" alt="RSS Plaza de la Tecnologia" width="25px"></a>
  </li>
  <li>
    <a href="http://www.youtube.com/plazadelatecnologia" target="_blank" title="Canal You Tube de Plaza de la Tecnologia"><img src="http://www.plazadelatecnologia.com/assets/graphics/youtube-link.png" alt="Siguenos en YouTube" width="25px"></a>
  </li>
  <li>
    <a href="http://www.twitter.com/plazatecnologia" target="_blank" title="Siguenos en Twitter"><img src="http://www.plazadelatecnologia.com/assets/graphics/tweets.png" alt="Siguenos en Twitter" width="25px"></a>
  </li>
  <li>
    <a href="http://www.facebook.com/plazadelatecnologia" target="_blank" title="Siguenos en Facebook"><img src="http://www.plazadelatecnologia.com/assets/graphics/facebook-comments.png" alt="Siguenos en Facebook" width="25px"></a>
  </li>      </ul>
      <ul class="nuevaImagen">
        <li><img src="http://www.plazadelatecnologia.com/assets/graphics/nueva-imagen.png" alt="Nuevo Diseño Plaza de la Tecnologia"></li>
      </ul>
      <em class="copy">Copyright © 2011. Todos los Derechos Reservados por Plaza de la Tecnología.</em>
	</div>
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
