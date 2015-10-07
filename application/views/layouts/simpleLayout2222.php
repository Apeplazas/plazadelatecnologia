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
<link type="text/css" href="https://www.plazadelatecnologia.com/assets/css/style.css" rel="stylesheet"/>
<link href='https://fonts.googleapis.com/css?family=Raleway:500,200' rel='stylesheet' type='text/css'>
<script language="javascript" src="https://www.plazadelatecnologia.com/assets/js/jquery-1.9.1.js" type="text/javascript"></script>
<script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
<script language="javascript" src="https://www.plazadelatecnologia.com/assets/js/jquery.fancybox.pack.js" type="text/javascript"></script>
<link type="text/css" href="https://www.plazadelatecnologia.com/assets/css/jquery.fancybox.css" rel="stylesheet"/>
<script language="javascript" src="https://www.plazadelatecnologia.com/assets/js/functions.js" type="text/javascript"></script>
<script language="javascript" src="https://www.plazadelatecnologia.com/assets/js/jquery.placeholder.js" type="text/javascript"></script>
<link type="text/css" href="https://www.plazadelatecnologia.com/assets/css/jquery.placeholder.min.css" rel="stylesheet">
<script language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js" type="text/javascript"></script>
<?= $this->layouts->print_includes(); ?>
<link rel="icon" type="image/png" href="<?=base_url()?>assets/graphics/pt.ico" />
<!--<script>
  $(function() {
    $( document ).tooltip();
  });
  </script>-->
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
<!-- start Mixpanel --><script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.track_charge people.clear_charges people.delete_user".split(" ");
for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src=("https:"===e.location.protocol?"https:":"http:")+'//cdn.mxpnl.com/libs/mixpanel-2.2.min.js';f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f)}})(document,window.mixpanel||[]);
mixpanel.init("6abe3d2dbfa74d665d21fc1c83421959");</script><!-- end Mixpanel -->
<script src="//configusa.veinteractive.com/tags/ADBE8577/0CFE/4C2D/A096/AD1E7624180C/tag.js" type="text/javascript" async></script>
</head>
<body>

<header class="defHeadSimple">
<a id="logo" href="http://www.plazadelatecnologia.com" title="Plaza de la Tecnología Ofertas en Computadoras, tablets y muchos mas..."><img src="<?=base_url()?>assets/graphics/logo-plazadelatecnologia-color.png" alt="Plaza de la Tecnologia" /></a>
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
<a id="registrate" title="Registrate y encuentra las mejores promociones" href="<?=base_url()?>registrate">Regístrate</a>
<a id="log" class="log logDeact" href="#login_form">Entrar</a>
<span id="set"><a href="<?=base_url()?>contacto" title="Atención a Clientes"><em>Atención a Clientes</em><img src="<?=base_url()?>assets/graphics/asistencia.png" alt="Ayuda en linea" /></a>
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
</header>
<div id="content">
<?= $content; ?>
</div>
<footer id="foot">
<? $this->load->view('includes/menus/footer');?>
</footer>
<? $this->load->view('includes/login');?>
<script type="text/javascript">
adroll_adv_id = "HE6LB4APCFESRFSCNJCGXE";
adroll_pix_id = "5OFNJAKMD5CQJPMEDJM5VZ";
(function () {
var oldonload = window.onload;
window.onload = function(){
   __adroll_loaded=true;
   var scr = document.createElement("script");
   var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
   scr.setAttribute('async', 'true');
   scr.type = "text/javascript";
   scr.src = host + "/j/roundtrip.js";
   ((document.getElementsByTagName('head') || [null])[0] ||
    document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
   if(oldonload){oldonload()}};
}());
</script>
<!-- Email Retargeting -->
<script src="//configusa.veinteractive.com/tags/ADBE8577/0CFE/4C2D/A096/AD1E7624180C/tag.js" type="text/javascript" async></script>
<!-- Fin Email Retargeting -->

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

