



<div id='contentbrand'>

<div class="wrapCenter">

<a id="temporalidad"title="computadoras armadas al mejor precio" href="<?=base_url()?>computadoras"><img src="<?=base_url()?>assets/graphics/oferta-en-computadoras.png" alt="Tematicas Plaza de la Tecnologia" /></a>

<div id="leadBorderServer"><!-- lead728indx -->



<div id='div-gpt-ad-1412267715425-0' style='width:728px; height:90px;'>



 

 

<script type='text/javascript'>

googletag.cmd.push(function() { googletag.display('div-gpt-ad-1412267715425-0'); });

</script>





</div>

</div>

	

	<div id="sliderTwo">

		<div id="banner-fade">

		  <ul class="bjqs">

			 <? foreach($slider as $rowS):?>

		    <li>

		    	<a class="texInd" href="<?=$rowS->bannerUrl?>/s/<?= $rowS->bannerFecha;?>"  title="<?= $rowS->bannerTitulo;?>">

		    		<img width="720" height="300" src="<?=base_url()?>assets/graphics/bannerPublicidad/<?= $rowS->bannerSlider;?>" alt="<?= $rowS->bannerTitulo;?>">

		    	</a>

		    </li>

		  <? endforeach; ?>

	      </ul>

		</div>

	</div>

	<form id="mayoreo" method="post" enctype="multipart/form-data" action="<?=base_url()?>inicio/salvarVentasMayoreo">

		<h4>Ventas al Mayoreo o Empresas</h4>

		<fieldset class="inp">

			<label class="txtEma">Email:</label>

			<input class="sm" type="text" name="email" value="" />

		</fieldset>

		<fieldset class="inpTwo">

			<textarea name="mensaje" placeholder="Comentarios:"></textarea>

		</fieldset>

		<fieldset>

			<div class="containerS">

			  <span class="select-wrapper">

			    <input type="file" name="archivo" id="image_src" />

			  </span>

			</div>

		</fieldset>

			<input type="submit" id="subVal" value="Enviar" />

	</form>

	<script type="text/javascript" charset="utf-8">

		$('div.fancy-file input:file').bind('change blur', function() {

	    var $inp = $(this), fn;

	    

	    fn = $inp.val();

	    if (/fakepath/.test(fn))

	        fn = fn.replace(/^.*\\/, '');

	    

	    $inp.closest('.fancy-file').find('.fancy-file-name').text(fn);

	});

	</script>

	<!-- Tu tematicas 

	<ul id="listaTemporada">

	  <li><a title="Computadoras para Gamers" href="<?=base_url()?>gamers"><img src="<?=base_url()?>assets/graphics/gamers.png" alt="Categoria Gamers" /></a></li>

	  <li><a title="Computadoras especiales para Geeks" href="<?=base_url()?>geeks"><img src="<?=base_url()?>assets/graphics/computadoras-para-geeks.png" alt="Computadoras para Geeks" /></a></li>

	  <li><a title="Remate y Ofertas de Tecnologia" href="<?=base_url()?>ofertas"><img src="<?=base_url()?>assets/graphics/remates-ofertas.png" alt="Ofertas y Remates" /></a></li>

	  <li><a title="Ventas a Mayoreo Plaza de la Tecnologia" href="<?=base_url()?>"><img src="<?=base_url()?>assets/graphics/ventas-mayoreo.png" alt="Ventas al Mayore" /></a></li>

	</ul>

	-->

	<br class="clear">

	<section class="auto985">

	<!-- Tu slider marcas

	<ul id="pagMarcas">

		<li><a href="<?=base_url()?>">Sony</a></li>

		<li><a href="<?=base_url()?>">LG</a></li>

		<li><a href="<?=base_url()?>"></a></li>

		<li><a href="<?=base_url()?>">Sony</a></li>

	</ul>

	-->

	<ul id="banPromo">

		<li class="wi300">

			<div id='div-gpt-ad-1409074805814-3' style='width:300px; height:250px;'>

				<script type='text/javascript'>googletag.cmd.push(function() { googletag.display('div-gpt-ad-1409074805814-3'); });</script>

			</div>

		</li>

		<li class="wi300">

			

            <div  style='width:300px; height:250px;'>

            <div id='div-gpt-ad-1409074805814-1' style='width:300px; height:250px;'>

<!--				  <a href="http://nacionaldebandas.com/inscripciones/?utm_source=WebPlazaTecnologia&amp;utm_medium=banner&amp;utm_campaign=BTS_BannerFijo250_Inscripciones" target="_blank"><img src="<?=base_url()?>/assets/graphics/nb.jpg"/></a> -->

				<script type='text/javascript'>googletag.cmd.push(function() { googletag.display('div-gpt-ad-1409074805814-1'); });</script>

			  </div>

		</li>

		<li class="wi300">

			<div id='div-gpt-ad-1409074805814-2' style='width:300px; height:250px;'>

				<script type='text/javascript'>googletag.cmd.push(function() { googletag.display('div-gpt-ad-1409074805814-2'); });</script>

			</div>

		</li>

	</ul>

	<br class="clear">

	<? foreach($campanias as $rowCam):?>

	<div class="temporada">

	<span class="boxInfo">

	<p><?= $rowCam->campaniaDescripcion;?></p>

	<h1 class="<?= $rowCam->colorPromocion;?>Tit"><?= $rowCam->campaniaNombre;?></h1>

	<em>Tablets, Impresoras, accesorios y mas</em>

	<a class="<?= $rowCam->colorPromocion;?>" href="<?=base_url()?>promociones/<?= $rowCam->campaniaUrl;?>" title="Ver mas">Ver mas</a>

	</span>

		<div class="touchcarousel  three-d carousel-image-text-horizontal">

		<ul class="touchcarousel-container">

		<? $ofertaCampania = $this->data_model->cargarOfertaCampania($rowCam->campaniaID);?>

		<? foreach($ofertaCampania as $rowOfc):?>

		<? if ($rowOfc->ofertaPrecio != ''):?>

		  <li class="touchcarousel-item">

		    <p>

		    	<a id="<?= $rowOfc->ofertaID;?>" href="<?=base_url()?><?=strtolower($rowOfc->rama)?>/oferta/<?=url_title(trim($rowOfc->ofertaTitulo), '_')?>/<?=$rowOfc->ofertaID?>" title="<?=$rowOfc->ofertaTitulo?>">

		    		<span>

		    		<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/ofertasLocatarios/'.str_replace('.', '_thumb.', $rowOfc->ofertaImagen))):?>

	    				<img  src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $rowOfc->ofertaImagen)?>" alt="<?= $rowOfc->ofertaTitulo?>" />

	    			<? else:?>

	    				<img src="<?=base_url()?>assets/graphics/no_image.png" alt="Imagen no disponible" />

	    			<? endif;?>

	    			</span>

	    		</a>

	    	</p>

	    	<strong><?= character_limiter(($rowOfc->ofertaTitulo),20);?></strong>

		    <b>$ <?= number_format($rowOfc->ofertaPrecio);?></b>

		  </li>

		<?endif;?>

		<? endforeach; ?>

		</ul>

		</div>

	</div>

	<? endforeach; ?>

	<!-- pie index -->

<div id='div-gpt-ad-1409074805814-4' style='width:970px; height:90px;'>

<script type='text/javascript'>

googletag.cmd.push(function() { googletag.display('div-gpt-ad-1409074805814-4'); });

</script>

</div>

	</section>

</div>



<script>

	jQuery(function($) {

	//Slider Index View

    $('#banner-fade').bjqs({

        'width' : 720,

        'responsive' : false,

        'showcontrols' : false,

        'centercontrols' : false,

        'centermarkers' : false,

        'usecaptions' : false,

        'animspeed' : 6000,

        'nexttext' : '<img src="http://www.plazadelatecnologia.com/assets/graphics/nextSlider.png" alt="Siguiente" />',

        'prevtext' : '<img src="http://www.plazadelatecnologia.com/assets/graphics/prevSlider.png" alt="Anterior" />',

    });

    

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

<script type="text/javascript">

      mixpanel.track("Landing Page Loaded");

</script>



<!-- Begin Inspectlet Embed Code -->

<script type="text/javascript" id="inspectletjs">

window.__insp = window.__insp || [];

__insp.push(['wid', 1947585724]);

(function() {

function __ldinsp(){var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); }

if (window.attachEvent) window.attachEvent('onload', __ldinsp);

else window.addEventListener('load', __ldinsp, false);

})();

</script>

<!-- Begin twiter -->

<script src="//platform.twitter.com/oct.js" type="text/javascript"></script>

<script type="text/javascript">twttr.conversion.trackPid('l6f1n', { tw_sale_amount: 0, tw_order_quantity: 0 });</script>

<noscript>

<img height="1" width="1" style="display:none;" alt="" src="https://analytics.twitter.com/i/adsct?txn_id=l6f1n&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />

<img height="1" width="1" style="display:none;" alt="" src="//t.co/i/adsct?txn_id=l6f1n&p_id=Twitter&tw_sale_amount=0&tw_order_quantity=0" />

</noscript>

<!-- End Inspectlet Embed Code -->

</div>