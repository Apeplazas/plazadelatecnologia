<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/style-mobile.css" type="text/css" />
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.10.1.min.js" type="text/javascript"></script>
<?= $this->layouts->print_includes(); ?>
<link rel="icon" type="image/png" href="<?=base_url()?>assets/graphics/favicon.png">
</head>
<body>
<div id="wrapFixed">
<header id="headMobile">
	<a id="logoMobile" href="http://m.plazadelatecnologia.com"><img src="<?=base_url()?>assets/graphics/logo-plazadelatecnologia-color.png" alt="Plaza de la tecnologia" /></a>
	<a id="carritoMobile" title="Mi Carrito" href="http://m.plazadelatecnologia.com/carrito">Mi Carrito</a>
</header>
<section id="wrapInd">
	<div class="w96">
	<? $this->load->view('includes/buscadorMobile');?>
	</div>
</div>
<?= $content; ?>
</section>

<script>
  var tabsSwiper = new Swiper('.swiper-container',{
    speed:100,
    freeMode : false, 
    onSlideChangeStart: function(){
      $(".tabs .active").removeClass('active')
      $(".tabs a").eq(tabsSwiper.activeIndex).addClass('active')  
    }
  })
  $(".tabs a").on('touchstart mousedown',function(e){
    e.preventDefault()
    $(".tabs .active").removeClass('active')
    $(this).addClass('active')
    tabsSwiper.swipeTo( $(this).index() )
  })
  $(".tabs a").click(function(e){
    e.preventDefault()
  })
</script>
</body>
</html>