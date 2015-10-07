<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<? foreach($opt as $rowOpt):?>
<title><?=$rowOpt->metaTitle;?></title>
<meta name="description" content="<?=$rowOpt->metaDescripcion;?>" />
<meta name="keywords" content="<?=$rowOpt->metaKeyword;?>"/>
<? endforeach; ?>
<meta name="robots" content="All,index, follow" />
<link type="text/css" href="<?=base_url()?>assets/css/style.css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Raleway:500,200' rel='stylesheet' type='text/css'>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.9.1.js" type="text/javascript"></script>
<script language="javascript" src="<?=base_url()?>assets/js/modernizr.js" type="text/javascript"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.fancybox.pack.js" type="text/javascript"></script>
<link type="text/css" href="<?=base_url()?>assets/css/jquery.fancybox.css" rel="stylesheet"/>
<script language="javascript" src="<?=base_url()?>assets/js/functions.js" type="text/javascript"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.placeholder.js" type="text/javascript"></script>
<script>
  $(function() {
    $( document ).tooltip();
  });
  </script>
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
<body class="bckBackLocal">
<!-- Banner arreglar estilo <? $this->load->view('includes/banners/bannersSkyLocal');?>-->
<header class="pfixed miloc">
<a id="logo" href="<?=base_url()?>" title="Plaza de la tecnologia Ofertas en Computadoras, tablets y muchos mas..."><img src="<?=base_url()?>assets/graphics/logo-plazadelatecnologia-color.png" alt="Plaza de la Tecnologia" /></a>	
<? if (count($info)):?>
<? foreach($info as $rowInf):?>
<a id="log" class="log logAct" title="<?= $rowInf->name;?>" href="<?=base_url()?>mi_local"><?= $rowInf->name;?></a>
<? $this->load->view('includes/menus/quicklocal');?>
<? endforeach; ?>
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
<? else:?>
<a id="registrate" title="Registrate y encuentra las mejores promociones" href="<?=base_url()?>inicio/registrate">Registrate</a>
<a id="log" class="log logDeact" href="#login_form">Entrar</a>
<span id="set"><em>Tu perfil</em>
<a class="log icoInb" href="#login_form"  title="Inbox"><img src="<?=base_url()?>assets/graphics/inbox-noactive.png" alt="Tu Inbox" /></a>
<a id="ajustes" class="log" href="#login_form" title="Ajustes de Cuenta"><img src="<?=base_url()?>assets/graphics/ajustes.png" alt="Tu Cuenta" /></a>
<a href="<?=base_url()?>contacto" title="Atención a Clientes"><img src="<?=base_url()?>assets/graphics/asistencia.png" alt="Ayuda en linea" /></a>
</span>
<? endif;?>
</header>
<div id="contentLocal">
<?= $content; ?>
</div>
<? $this->load->view('includes/login');?>
<? $this->load->view('includes/forms/addPro');?>
<!-- Email Retargeting -->
<script src="//configusa.veinteractive.com/tags/ADBE8577/0CFE/4C2D/A096/AD1E7624180C/tag.js" type="text/javascript" async></script>
<!-- Fin Email Retargeting -->
</body>
</html>
