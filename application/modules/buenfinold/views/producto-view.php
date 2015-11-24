<meta charset="ISO-8859-1">
<? foreach($producto as $productoInfo):?>
<!--<? $masComision 		= $productoInfo->ofertaPrecio + ($productoInfo->ofertaPrecio * $productoInfo->comision)/100?>-->
<!--<? $masComisionMes 	= $masComision + ($masComision * $productoInfo->meses)/100?>-->
<!--<? $meses				= $masComisionMes/12;?>-->

<DIV ID='BF06'>
   
  <DIV ID='BF06W'>
    <div id='BF06LI'>
       
      <div id='BF06LI1'>
        <div id='BF06LI1_txt'> <?=$productoInfo->ofertaTitulo;?></div>
       <div id='BF06LI1_empresa'><?=$productoInfo->nombreCte;?></div>
       <div id='BF06LI1_resumen'><?=$productoInfo->ofertaDescripcion;?></div>
       <div id='BF06LI1_resumen'>Local(es): <?=$productoInfo->localcte;?></div>
       <div id="BF06LI1_resumen">Plaza: <?=$productoInfo->plaza;?></div>
       <div id='BF06LT1_redes'>
       <!--<img src="<?base_url()?>/assets/graphics/BF2015/redess.jpg" width="" height="20" /> -->
       </div>
       
       
       <div class='precio BF03_precio'>
        <?= $productoInfo->precio > 0 ? '$ ' . number_format($productoInfo->precio) : '-' . $productoInfo->campLib1;?>
       </div> 
      </div>
       
        <div id='BF06LI2'><center><img id="imagendet" src="<?base_url()?>/assets/graphics/BF2015/<?=$productoInfo->id;?>.jpg" height="204" /></center></div>
        
      <div id='BF06LI_descripcion'>Recuerda que el cupón es para hacer válido el precio de la oferta presentada en este sitio. 
      	<br />
      	<a style="color: #FE2E2E;" href="http://www.plazadelatecnologia.com/buenfin/plazas/<?=$productoInfo->plaza;?>">Más Ofertas >></a>
      	</div>
      
    </div>
       
    <div id='BF06LD'>
    	<div id='BF06LD_tit'>
       OBTENER<br />
       CUPON </div>
       
       <form id="formulario" action="<?=base_url()?>buenfin/send_email" method="post">
			<input type="hidden" name="art" value="<?=$productoInfo->id?>"/>
			<input id="nombre" class="campocupon" type="text" name="nombre" placeholder="ESCRIBE TU NOMBRE" required="required" />
			<input id="email" class="campocupon" type="email" name="email" placeholder="ESCRIBE TU EMAIL" required="required" />
			<input id='BF06LD_boton' type="submit" value="">
	   </form>
      </div>
       </div>
    <div id='break'> </div>
  </DIV>
</DIV>	
<?endforeach;?>




<script type="text/javascript">
jQuery(function($){
	$('#mz').addimagezoom({
		descArea: '#description', 
		speed: 1500, 
		descpos: true, 
		imagevertcenter: true, 
		magvertcenter: true, 
		zoomrange: [2, 10],
		magnifierpos: 'right',
		cursorshadecolor: '#fdffd5',
		cursorshade: true,
		magnifiersize: [400, 400]
	});

})
</script>
<script>
//Tabulador mapas
$(document).ready(function(){
	$(".bTab").hide();
	$("ul.tabsExtras li:first").addClass("activeMap").show();
	$(".bTab:first").show();
	$("ul.tabsExtras li").click(function()
       {
		$("ul.tabsExtras li").removeClass("activeMap");
		$(this).addClass("activeMap");
		$(".bTab").hide();

		var activeTab = $(this).find("a").attr("href");
		$(activeTab).fadeIn();
		return false;
	});
	$("ul.tabsExtras li:even").addClass("even-list");
	
	    //4 Carrouseles de inicio 
    $(".carousel-image-text-horizontal").touchCarousel({
    	autoplay: true,
    	autoplayDelay: 2000,
    	itemsPerMove: 4,
		pagingNav: true,
		scrollbar: false,				
		scrollToLast: true,
		loopItems: true	
	});
	
});
</script>

<!-- Facebook Pixel Code Buen fin 2015-->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '533793683440327');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=533793683440327&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->