<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<? if(isset($opt)) : foreach($opt as $rowOpt):?>
<title><?=$rowOpt->metaTitle;?></title>
<meta name="description" content="<?=$rowOpt->metaDescripcion;?>" />
<? endforeach; ?>
<? else:?>
<meta name="description" content="Noticias y reseñas de lo mejor en Tecnologia en Mexico" />
<? endif;?>
<meta name="robots" content="All,index, follow" />
<link type="text/css" href="<?=base_url()?>assets/css/style-blog.css" rel="stylesheet"/>
<link href='http://fonts.googleapis.com/css?family=Raleway:500,200' rel='stylesheet' type='text/css'>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.9.1.js" type="text/javascript"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.fancybox.pack.js" type="text/javascript"></script>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.fancybox.js" type="text/javascript"></script>
<link type="text/css" href="<?=base_url()?>assets/css/jquery.fancybox.css" rel="stylesheet"/>
<script language="javascript" src="<?=base_url()?>assets/js/jquery.placeholder.js" type="text/javascript"></script>
<link type="text/css" href="<?=base_url()?>assets/css/jquery.placeholder.min.css" rel="stylesheet"/>
<script language="javascript" src="<?=base_url()?>assets/js/functions.js" type="text/javascript"></script>
<?= $this->layouts->print_includes(); ?>
<link rel="icon" type="image/png" href="<?=base_url()?>assets/graphics/pt.ico" />
<!--[if lt IE 9]>
<script src="<?=base_url()?>assets/js/html5shiv.js"></script>
<![endif]-->
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
<header>
<div class="defHead">
<a id="logo" href="<?=base_url()?>" title="Plaza de la tecnología Ofertas en Computadoras, tablets y muchos mas..."><img src="<?=base_url()?>assets/graphics/logo-plazadelatecnologia.png" alt="Plaza de la Tecnología" /></a>
<? if (count($info)):?>
<? foreach($info as $rowInf):?>
<? $user  = $this->session->userdata('user');?>
<a id="perfil" title="Regístrate y encuentra las mejores promociones" href="<?=base_url()?>inicio/milocal"><img src="<?=base_url()?>assets/graphics/milocalblog-sinfoto.png" alt="" /></a>
<span id="set"><em>Perfil</em>
<a id="inbox" href="<?=base_url()?>usuario" title="Inbox"><img src="<?=base_url()?>assets/graphics/inbox-white-active.png" alt="Tu Inbox" /></a>
<a id="ajustes" href="<?=base_url()?>usuario" title="Ajustes"><img src="<?=base_url()?>assets/graphics/ajustes-white.png" alt="Ajustes" /></a>
<a href="<?=base_url()?>contacto" title="Atención a Clientes"><img src="<?=base_url()?>assets/graphics/asistencia-white.png" alt="Ayuda en linea" /></a>
</span>
<? endforeach; ?>
<? else:?>				
<a id="registrate" title="Regístrate y encuentra las mejores promociones" href="<?=base_url()?>registrate">Registrate</a>
<a id="log-white" class="log" href="#login_form" title="Inicia Sesión">Entrar</a>
<span id="set">
<a href="<?=base_url()?>contacto" title="Atención a Clientes"><em>Atención a Clientes</em><img src="<?=base_url()?>assets/graphics/asistencia-white.png" alt="Ayuda en línea" /></a>
</span>
<? endif;?>
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?1k6yWEVFlR7EloTlgcOxIyelWhsJeY0H';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->
<? $this->load->view('includes/menus/navTwo');?>
</div>
</header>
<?= $content; ?>
<footer id="foot">
<? $this->load->view('includes/menus/footer');?>
</footer>
<? $this->load->view('includes/login');?>
</body>
</html>


