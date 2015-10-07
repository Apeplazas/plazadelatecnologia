<?php
setcookie('id', $_GET['id']);
setcookie('url', $_GET['url']);

?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-2" />
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
        <?$base_url = 'http://plazadelatecnologia.com'?>
      <h1>!!Ya estas conectado, comienza a navegar!!</h1>
		<div id="navegar">
			<a class="navegaIcon" href="http://zonadejuegos.plazadelatecnologia.com/" title="Zona de Juegos y Bazar de Videojuego" target="_blank">
				<img src="<?=$base_url?>/assets/graphics/guest/bz1.png" />
			</a>
			<a class="navegaIcon" href="http://www.google.com.mx/" title="Busca en Google" target="_blank">
				<img src="<?=$base_url?>/assets/graphics/guest/google1.png"  />
			</a>
			<a class="navegaIcon" href="http://www.hotmail.com/" title="Correo Hotmail" target="_blank">
				<img src="<?=$base_url?>/assets/graphics/guest/html1.png" />
			</a>
			<a class="navegaIcon" href="https://twitter.com/plazatecnologia" title="Twitter Plaza de la Tecnología" target="_blank">
				<img src="<?=$base_url?>/assets/graphics/guest/tw1.png" />
			</a>
			<a class="navegaIcon" href="http://www.facebook.com/plazadelatecnologia" title="Facebook Plaza de la Tecnología" target="_blank">
				<img src="<?=$base_url?>/assets/graphics/guest/fb1.png" />
			</a>
		</div>
		<h1 class="ofer">Ofertas en Plaza de la Tecnología</h1>
		<div id="ofertaIndex" >
		<span><a href="http://"></a></span>
        <? $link = mysql_connect("localhost", "plazadel_root","maikdp411500")?>
        <?if (!$link) {
    		die('No pudo conectarse: ' . mysql_error());
		}
		?>
        <? $bd_seleccionada = mysql_select_db("plazadel_bd", $link);?>
        <?if (!$bd_seleccionada) {
    		die ('No se puede usar foo : ' . mysql_error());
		}
		?>
        <? $result = mysql_query("SELECT 
									lo.fileext as 'fileext',
									lo.ofertaID as 'ofertaID',
									LEFT(lo.ofertaTitulo,30) as 'ofertaTitulo',
									lo.ofertaTitulo as 'ofertaTituloURL',
									LEFT(lo.ofertaDescripcion,60) as 'ofertaDescripcion',
									lo.ofertaPrecio as 'ofertaPrecio',
									lo.ofertaImagen as 'ofertaImagen',
									lo.ofertaUrl as 'ofertaUrl',
									lo.ofertaTipo as 'ofertaTipo',
									l.localID as 'localID',
									ca.categoriaUrl as categoriaUrl,
									date_format(lo.ofertaVigencia,'%d/%m/%Y') as 'ofertaVigencia'
									FROM locatariosOfertas lo
									LEFT JOIN locatarios l ON l.localID = lo.localID 
									LEFT JOIN locatariosSucursales ls ON l.localID = ls.localID 
									LEFT JOIN sucursales s ON ls.ciudadID = s.ciudadID
									LEFT JOIN categorias ca on lo.categoriaID = ca.categoriaID
									WHERE  lo.ofertaVigencia > CURDATE() 	
									AND lo.ofertaStatus='Activo'
									group by lo.ofertaID ORDER BY RAND() LIMIT 6", $link);?>
		
         
         <?php while($rowT = mysql_fetch_assoc($result)):?>
				<div class="oferOferta">
					<a class="ofertAOfe" href="<?=$base_url?>/ofertas/<?= $rowT['categoriaUrl']?>/<?=str_replace(" ", "_", strtolower($rowT['ofertaTituloURL']))?>/<?=$rowT['ofertaID'];?>" title="<?=$rowT['ofertaTitulo'];?>">
				    <?php if ($rowT['ofertaImagen']!=""): ?>
				    <img width="76" src="<?=$base_url?>/ofertasLocatarios/thumbs/<?=$rowT['ofertaImagen'];?>_thumb<?=$rowT['fileext'];?>"	 alt="<?=$rowT['ofertaTitulo'];?>" />
				    <?php elseif ($rowT['ofertaImagen']!="1"): ?>
				    <img src="<?=$base_url?>/ofertasLocatarios/sinfoto.jpg" alt="<?=$rowT['ofertaTitulo'];?>" />
				    <?php endif; ?>
					</a>
			        <a class="titleOfe" href="<?=$base_url?>/ofertas/<?= $rowT['categoriaUrl']?>/<?=str_replace(" ", "_", strtolower($rowT['ofertaTituloURL']))?>/<?=$rowT['ofertaID']?>">
			        	<strong><?=$rowT['ofertaTitulo'];?></strong>
			        </a>
				    <p><?=$rowT['ofertaDescripcion'];?><em class="leermasTimMainOfe"><?php if ($rowT['ofertaPrecio']!="Únicamente precio ó porcentaje"): ?>
		            <?=$rowT['ofertaPrecio'];?>
					<?php elseif ($rowT['ofertaImagen']!="1"): ?>
					<?=$rowT['ofertaTipo'];	?>
					<?php endif; ?></em> </p>
					<div class="oferWrapOferta">
						<div class="socialMediaOfe">
							<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?=$base_url?>/ofertas/<?=$rowT['ofertaID'];?> " title="compartir facebook"><img src="<?=$base_url?>/assets/graphics/share-facebook.jpg" alt="comparte este articulo en facebook"></a> 
							<a target="_blank" href="http://twitter.com/home?status=<?=$base_url?>/ofertas/<?=$rowT['ofertaID'];?> " title="compartir en twitter"><img src="<?=$base_url?>/assets/graphics/share-twitter.jpg" alt="comparte este articulo en twitter"></a>
						</div>
			            <a href="<?=$base_url?>/ofertas/<?= $rowT['categoriaUrl']?>/<?=str_replace(" ", "_", strtolower($rowT['ofertaTituloURL']))?>/<?=$rowT['ofertaID'];?>" title="leer mas de <?=$rowT['ofertaTitulo'];?>" class="ofertaPrecioMainOfe"><img src="<?=$base_url?>/assets/graphics/leermas-oferta.jpg" alt="Leer mas" /></a>
					</div>
				</div><!--close wrapper-->
		<?php endwhile;?>
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
