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
</body>
</html>


