<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<meta name="robots" content="noindex">
<link type="text/css" href="<?=base_url()?>assets/css/style-admin.css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Raleway:500,200' rel='stylesheet' type='text/css'>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.9.1.js" type="text/javascript"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.fancybox.pack.js" type="text/javascript"></script>
<link type="text/css" href="<?=base_url()?>assets/css/jquery.fancybox.css" rel="stylesheet"/>
<script src="<?=base_url()?>assets/js/modernizr.custom.js"></script>
<script language="javascript" src="<?=base_url()?>assets/js/functions-admin.js" type="text/javascript"></script>
<?= $this->layouts->print_includes(); ?>
<link rel="icon" type="image/png" href="<?=base_url()?>assets/graphics/pt.ico" />
<!--[if lt IE 9]>
<script src="<?=base_url()?>assets/js/html5shiv.js"></script>
<![endif]-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-11500342-2', 'plazadelatecnologia.com');
  ga('send', 'pageview');
</script>
<script src="//configusa.veinteractive.com/tags/ADBE8577/0CFE/4C2D/A096/AD1E7624180C/tag.js" type="text/javascript" async></script>
</head>
<body class="bckWhite">
<div class="container">
<ul id="gn-menu" class="gn-menu-main">
	<li class="gn-trigger">
	  <a class="gn-icon gn-icon-menu"><span>Menu</span></a>
	  <nav class="gn-menu-wrapper">
	  <div class="gn-scroller">
	    <ul class="gn-menu">
	      <li><a href="<?=base_url()?>hobbits/campanias" class="gn-icon gn-icon-download">Campañas</a>
	        <ul class="gn-submenu">
	        <? foreach($campanias as $c):?>
	          <li><a href="<?=base_url()?>hobbits/verOfertasCampania/<?= $c->campaniaID;?>" class="gn-icon gn-icon-illustrator"><?= $c->campaniaNombre;?></a></li>
	         <? endforeach; ?>
	        </ul>
	      </li>
	      <li><a href="<?=base_url()?>hobbits/segmento/Oferta" class="gn-icon gn-icon-cog">Ofertas</a></li>
	        <ul class="gn-submenu">
	          <li><a href="<?=base_url()?>hobbits/seleccionOfertas/Regular" class="gn-icon gn-icon-illustrator">Seleccion de Ofertas</a></li>
	        </ul>
	      <li><a href="<?=base_url()?>hobbits/segmento/Liquidacion" class="gn-icon gn-icon-help">Outlet</a></li>
	       <ul class="gn-submenu">
	          <li><a href="<?=base_url()?>hobbits/seleccionLiquidacion/Regular" class="gn-icon gn-icon-illustrator">Seleccion de Ofertas</a></li>
	        </ul>
	      <li><a href="<?=base_url()?>hobbits/bannersPromocionales" class="gn-icon gn-icon-archive">Promociones banners</a>
	        <ul class="gn-submenu">
	          <li><a class="gn-icon gn-icon-article">Articles</a></li>
	          <li><a class="gn-icon gn-icon-pictures">Images</a></li>
	          <li><a class="gn-icon gn-icon-videos">Videos</a></li>
	          <li><a class="gn-icon gn-icon-videos" href="<?=base_url()?>hobbits/busquedas">Historial de Busquedas</a></li>
	        </ul>
	      </li>
	      <li><a href="<?=base_url()?>hobbits/traspasos_exito" class="gn-icon gn-icon-archive">Solicitud de Traspasos</a></li>
	      <li><a href="<?=base_url()?>hobbits/confirmar_pago_cliente" class="gn-icon gn-icon-archive">Confirmar pago de cliente</a></li>
	      <li><a href="<?=base_url()?>hobbits/peticiones_online" class="gn-icon gn-icon-archive">Peticiones chat/teléfono</a>
	      	<ul class="gn-submenu">
	      	  <li><a href="<?=base_url()?>hobbits/historial_peticiones" class="gn-icon gn-icon-archive">Historial de peticiones</a></li>
	          <li><a href="<?=base_url()?>hobbits/ficha_oxxo" class="gn-icon gn-icon-archive">Generar fichas para OXXO</a></li>
	        </ul>
	      </li>
	      <li class="gn-icon gn-icon-archive">Campañas Emails
	      	<ul class="gn-submenu">
	      	  <li><a href="<?=base_url()?>hobbits/intentosCompras" class="gn-icon gn-icon-archive">Intentos de Compra</a></li>
	          <li><a href="<?=base_url()?>hobbits/mails" class="gn-icon gn-icon-archive">Email Ofertas</a></li>
	          <li><a href="<?=base_url()?>hobbits/diary_mail" class="gn-icon gn-icon-archive">Email Diario</a></li>
	          <li><a href="<?=base_url()?>hobbits/comunicados" class="gn-icon gn-icon-archive">Email Comunicado</a></li>
	        </ul>
	      </li>
	    </ul>
	  </div>
	  </nav>
	</li>
	<li><a href="<?=base_url()?>hobbits" class="logo"><img src="<?=base_url()?>assets/graphics/logo-plazadelatecnologia-color.png" alt="Logo Plaza de la Tecnologia" /></a></li>
	<li><a class="codrops-icon codrops-icon-drop" href="<?=base_url()?>"><span>Ir pagina principal</span></a></li>
</ul>
<?= $content; ?>
</div>
<script src="<?=base_url()?>assets/js/classie.js"></script>
<script src="<?=base_url()?>assets/js/gnmenu.js"></script>
<script> new gnMenu( document.getElementById( 'gn-menu' ) ); </script>
</body>
