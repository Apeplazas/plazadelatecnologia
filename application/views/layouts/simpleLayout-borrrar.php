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
<link type="text/css" href="<?=base_url()?>assets/css/style-blog.css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Raleway:500,200' rel='stylesheet' type='text/css'>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.9.1.js" type="text/javascript"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.fancybox.pack.js" type="text/javascript"></script>
<link type="text/css" href="<?=base_url()?>assets/css/jquery.fancybox.css" rel="stylesheet"/>
<script language="javascript" src="<?=base_url()?>assets/js/functions.js" type="text/javascript"></script>
<?= $this->layouts->print_includes(); ?>
<link rel="icon" type="image/png" href="<?=base_url()?>assets/graphics/pt.ico" />
<!--[if lt IE 9]>
<script src="<?=base_url()?>assets/js/html5shiv.js"></script>
<![endif]-->
<script src="//configusa.veinteractive.com/tags/ADBE8577/0CFE/4C2D/A096/AD1E7624180C/tag.js" type="text/javascript" async></script>
</head>
<body>
<header class="defHead">
<a id="logo" href="<?=base_url()?>" title="Plaza de la tecnologia Ofertas en Computadoras, tablets y muchos mas..."><img src="<?=base_url()?>assets/graphics/logo-plazadelatecnologia.png" alt="Plaza de la Tecnologia" /></a>
<a id="perfil" title="Registrate y encuentra las mejores promociones" href="<?=base_url()?>inicio/milocal"><img src="<?=base_url()?>assets/graphics/milocalblog-sinfoto.png" alt="" /></a>					
<a id="registrate" title="Registrate y encuentra las mejores promociones" href="<?=base_url()?>registrate">Registrate</a>
<a id="log-white" href="#login_form">Entrar</a>
<span id="set"><em>Tu perfil</em>
<a id="inbox" href="<?=base_url()?>muro/mensajes" title="Inbox"><img src="<?=base_url()?>assets/graphics/inbox-white-active.png" alt="Tu Inbox" /></a>
<a id="ajustes" href="<?=base_url()?>muro/mensajes" title="Inbox"><img src="<?=base_url()?>assets/graphics/ajustes-white.png" alt="Tu Inbox" /></a>
<a href="<?=base_url()?>contacto" title="Atención a Clientes"><img src="<?=base_url()?>assets/graphics/asistencia-white.png" alt="Ayuda en linea" /></a>
</span>
</header>

<div id="content">
<?= $content; ?>
</div>
<footer id="foot">
<? $this->load->view('includes/menus/footer');?>
</footer>
<? $this->load->view('includes/login');?>
<? $this->load->view('includes/barraFooterSocial');?>

<!-- Google Code para etiquetas de remarketing -->
<!--------------------------------------------------
Es posible que las etiquetas de remarketing todavía no estén asociadas a la información de identificación personal o que estén en páginas relacionadas con las categorías delicadas. Para obtener más información e instrucciones sobre cómo configurar la etiqueta, consulte http://google.com/ads/remarketingsetup.
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 967808133;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/967808133/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

</body>
</html>


