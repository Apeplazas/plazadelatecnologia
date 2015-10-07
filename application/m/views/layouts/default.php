<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<? foreach($opt as $rowOpt):?>
<title><?= $rowOpt->metaTitle;?></title>
<meta name="description" content="<?=$rowOpt->metaDescripcion;?>" />
<? endforeach; ?>
<? if(isset($producto)): foreach($producto as $productoInfo):?>
<meta property="og:title" content="<?=$productoInfo->ofertaTitulo?>" />
<meta property="og:url" content="<?=base_url()?><?=$this->uri->uri_string?>" />
<meta property="og:description" content="<?=$productoInfo->ofertaDescripcion?>" />
<meta property="og:image" content="<?=base_url()?>ofertasLocatarios/<?= $productoInfo->ofertaImagen?>" />
<? endforeach; endif;?>
<meta name="robots" content="All,index, follow" />
<link type="text/css" href="<?=base_url()?>assets/css/style.css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Raleway:500,200' rel='stylesheet' type='text/css'>
<script language="javascript" src="<?=base_url()?>assets/js/modernizr.js" type="text/javascript"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.fancybox.pack.js" type="text/javascript"></script>
<link type="text/css" href="<?=base_url()?>assets/css/jquery.fancybox.css" rel="stylesheet"/>
<script language="javascript" src="<?=base_url()?>assets/js/functions.js" type="text/javascript"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.placeholder.js" type="text/javascript"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.autocomplete.pack.js" type="text/javascript"></script>
<link type="text/css" href="<?=base_url()?>assets/css/jquery.placeholder.min.css" rel="stylesheet"/>
<?= $this->layouts->print_includes(); ?>
<link rel="icon" type="image/png" href="<?=base_url()?>assets/graphics/pt.ico" />
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
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</head>
<body>
<? $this->load->view('includes/banners/bannersSky');?>
<header class="defHead">
<div id="wraphead">
<a id="logo" href="<?=base_url()?>" title="Plaza de la tecnología Ofertas en Computadoras, tablets y muchos mas..."><img src="<?=base_url()?>assets/graphics/logo-plazadelatecnologia-color.png" alt="Plaza de la Tecnología" /></a>
<? if (count($info)):?>
<? foreach($info as $rowInf):?>
<? $user  = $this->session->userdata('user');?>
<a id="log" class="log logAct" title="Hola <?= $rowInf->name;?>" href="<?=base_url()?><?=$user['tipoUsuario']?>"><?= $rowInf->name;?></a>
<? if($user['tipoUsuario'] == 'mi_local'):?>
<? $this->load->view('includes/menus/quicklocal');?>
<? else:?>
<? $this->load->view('includes/menus/quickUser');?>
<? endif;?>
<? endforeach; ?>
<? else:?>
<a id="registrate" title="Registrate y encuentra las mejores promociones" href="<?=base_url()?>registrate">Regístrate</a>
<a id="log" class="log logDeact" href="#login_form" title="Iniciar Sesión">Entrar</a>
<span id="set"><a href="<?=base_url()?>contacto" title="Atención a Clientes"><em>Atención a Clientes</em><img src="<?=base_url()?>assets/graphics/asistencia.png" alt="Ayuda en línea" /></a>
</span>
<? endif;?>
</div>
<? $this->load->view('includes/menus/nav');?>
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?1k6yWEVFlR7EloTlgcOxIyelWhsJeY0H';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->
</header>
<? if ($this->uri->segment(1) == ''):?>
<? $this->load->view('includes/banners/bannersLead');?>
<? endif?>
<? $this->load->view('includes/buscador');?>

<div id="content">
<?= $content; ?>
</div>
<footer id="foot">
<? $this->load->view('includes/menus/footer');?>
</footer>
<? $this->load->view('includes/login');?>
<? $this->load->view('includes/barraFooterSocial');?>
</body>
</html>
<? if (count($info) > 0):?>
<script type="text/javascript">
	/// Solicita las cuentas de notificaciones iconos header
	$("#inbox").load('<?=base_url()?>ajax/inboxNotificacion');
	var refreshId = setInterval(function() {
    $("#inbox").load('<?=base_url()?>ajax/inboxNotificacion');
	  }, 60000);
	$.ajaxSetup({ cache: false });
	/// Solicita si hay venta
	$("#venConf").load('<?=base_url()?>ajax/ventaNotificacion');
	var refreshId = setInterval(function() {
    $("#venConf").load('<?=base_url()?>ajax/ventaNotificacion');
	  }, 60000);
	$.ajaxSetup({ cache: false });	
</script>
<? endif?>
