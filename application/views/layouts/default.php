<?php
function is_mobile(){ 
    $regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|"; 
    $regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|"; 
    $regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|"; 
    $regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|"; 
    $regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220"; 
    $regex_match.=")/i"; return isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
      }      
     if(is_mobile()) { header("Location: http://m.plazadelatecnologia.com");//it's a mobile browser, do something  
     } else { // it's not a mobile browser, do something else header("Location:"); 
   }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9">
<? foreach($opt as $rowOpt):?>
<title><?= $rowOpt->metaTitle;?></title>

<? endforeach; ?>
<? if(isset($producto)): foreach($producto as $productoInfo):?>
<meta property="og:title" content="<?=$productoInfo->ofertaTitulo?>" />
<meta property="og:url" content="<?=base_url()?><?=$this->uri->uri_string?>" />
<meta property="og:description" content="<?=$productoInfo->ofertaDescripcion?>" />
<!--<meta property="og:image" content="<?=base_url()?>ofertasLocatarios/<?= $productoInfo->ofertaImagen?>" />-->
<? endforeach; endif;?>

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


<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<!-- start Mixpanel --><script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.track_charge people.clear_charges people.delete_user".split(" ");
for(g=0;g<i.length;g++)f(c,i[g]);b._i.push([a,e,d])};b.__SV=1.2;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src=("https:"===e.location.protocol?"https:":"http:")+'//cdn.mxpnl.com/libs/mixpanel-2.2.min.js';f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f)}})(document,window.mixpanel||[]);
mixpanel.init("6abe3d2dbfa74d665d21fc1c83421959");</script><!-- end Mixpanel -->
<!-- Tu comentario <script type="text/javascript">
  var heap=heap||[];heap.load=function(a){window._heapid=a;var b=document.createElement("script");b.type="text/javascript",b.async=!0,b.src=("https:"===document.location.protocol?"https:":"http:")+"//cdn.heapanalytics.com/js/heap.js";var c=document.getElementsByTagName("script")[0];c.parentNode.insertBefore(b,c);var d=function(a){return function(){heap.push([a].concat(Array.prototype.slice.call(arguments,0)))}},e=["identify","track"];for(var f=0;f<e.length;f++)heap[e[f]]=d(e[f])};
      heap.load("197888444");
</script>-->
<!-- <link rel="stylesheet" media="screen and (max-width: 1200px)" href="path/to/style.css"> --> 

<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '1536796426593649']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=1536796426593649&amp;ev=PixelInitialized" /></noscript>

<script type='text/javascript'>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
(function() {
var gads = document.createElement('script');
gads.async = true;
gads.type = 'text/javascript';
var useSSL = 'https:' == document.location.protocol;
gads.src = (useSSL ? 'https:' : 'http:') +
'//www.googletagservices.com/tag/js/gpt.js';
var node = document.getElementsByTagName('script')[0];
node.parentNode.insertBefore(gads, node);
})();
</script>

<script type='text/javascript'>
googletag.cmd.push(function() {
googletag.defineSlot('/39972783/pt001', [970, 90], 'div-gpt-ad-1409074805814-0').addService(googletag.pubads());
googletag.defineSlot('/39972783/pt004', [300, 250], 'div-gpt-ad-1409074805814-1').addService(googletag.pubads());
googletag.defineSlot('/39972783/pt005', [300, 250], 'div-gpt-ad-1409074805814-2').addService(googletag.pubads());
googletag.defineSlot('/39972783/pt003', [300, 250], 'div-gpt-ad-1409074805814-3').addService(googletag.pubads());
googletag.defineSlot('/39972783/lead728indx', [728, 90], 'div-gpt-ad-1412267715425-0').addService(googletag.pubads());
googletag.defineSlot('/39972783/pt002', [970, 90], 'div-gpt-ad-1409074805814-4').addService(googletag.pubads());
googletag.pubads().enableSingleRequest();
googletag.enableServices();
});
</script>

<script src="//configusa.veinteractive.com/tags/ADBE8577/0CFE/4C2D/A096/AD1E7624180C/tag.js" type="text/javascript" async></script>
</head>
<body>
		
<? foreach($opt as $rowG):?>
<div id="slidedown">
	<? if ($this->uri->segment(2) == ''):?>
	<div id="panel">
		<div id='div-gpt-ad-1409074805814-0' style='width:970px; margin:0 auto;'>
		<?= $rowG->divGoogleSky;?>
		</div>
	</div>
	<? endif;?>
    </div>
    <span id="toggle_panel">
	<a id="close"  class="close" href="#"><img src="<?=base_url()?>assets/graphics/atencionaclientes-informacion.png" alt="Cerrar Banner" /></a>
	<a id="open"  style="display: none;" class="open" href="#"><img src="<?=base_url()?>assets/graphics/atencionaclientes-informacion.png" alt="Abrir Banner" /></a>
	</span>
</div>
<? endforeach; ?>



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
<? $this->load->view('includes/buscador');?>
<div id="content">
<?= $content; ?>
</div>
<footer id="foot">
<? $this->load->view('includes/menus/footer');?>
</footer>
<? $this->load->view('includes/login');?>
<? $this->load->view('includes/barraFooterSocial');?>
<!-- Google Code for Etiqueta de remarketing -->
<!-- Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. For instructions on adding this tag and more information on the above requirements, read the setup guide: google.com/ads/remarketingsetup -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 996020769;
var google_conversion_label = "Qp2CCOfcswQQoaT42gM";
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/996020769/?value=1.000000&amp;label=Qp2CCOfcswQQoaT42gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- Start of ReTargeter Tag -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/json3/3.2.5/json3.min.js"></script>
    <script type="text/javascript">
        var _rt_cgi = 431;
        var _rt_base_url = "https://lt.retargeter.com/";
        var _rt_js_base_url = "https://s3.amazonaws.com/V3-Assets/prod/client_super_tag/";
        var _rt_init_src = _rt_js_base_url+"init_super_tag.js";
        var _rt_refresh_st = false;
        var _rt_record = function(params){if(typeof document.getElementsByTagName("_rt_data")[0]=="undefined")setTimeout(function(){_rt_record(params)},25)};
        (function() {
            var scr = document.createElement("script");
            scr.src = _rt_init_src;
            document.getElementsByTagName("head")[0].appendChild(scr);
        })();
    </script>
<!-- End of ReTargeter Tag -->
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

<!--
Start of DoubleClick Floodlight Tag: Please do not remove
Activity name of this tag: PT Home
URL of the webpage where the tag is expected to be placed: http://www.apeplazas.com
This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
Creation Date: 04/10/2015
-->
<script type="text/javascript">
var axel = Math.random() + "";
var a = axel * 10000000000000;
document.write('<iframe src="https://4808733.fls.doubleclick.net/activityi;src=4808733;type=invmedia;cat=krq6h0zw;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
</script>
<noscript>
<iframe src="https://4808733.fls.doubleclick.net/activityi;src=4808733;type=invmedia;cat=krq6h0zw;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
</noscript>
<!-- End of DoubleClick Floodlight Tag: Please do not remove -->

</body>
</html>
