<? foreach($producto as $productoInfo):?>
<? $masComision 		= $productoInfo->ofertaPrecio + ($productoInfo->ofertaPrecio * $productoInfo->comision)/100?>
<? $masComisionMes 	= $masComision + ($masComision * $productoInfo->meses)/100?>
<? $meses				= $masComisionMes/12;?>
<aside class="ml20">
	<div itemscope itemtype="http://schema.org/Product">
	<h1><?=preg_replace("[^A-Za-z0-9]", "", $productoInfo->ofertaTitulo);?></h1>
</div>
<? if($this->uri->segment(6) == '2014-04-07'):?>
<script type="text/javascript">mixpanel.track("<? if($this->uri->segment(5) == 's'):?>Slider<? elseif ($this->uri->segment(5) == 'b2'):?>Skybanner<? elseif ($this->uri->segment(5) == 'b3'):?>Lead Banner Categorias<? elseif ($this->uri->segment(5) == 'b1'):?>Box Banner<? endif;?> <?=$productoInfo->ofertaTitulo;?> Funnel <?= $this->uri->segment(6);?>");</script>
<? endif?>
<div id="fotoPro">
	<div class="targetarea" itemscope itemtype="http://schema.org/ImageObject">
		<img itemprop="image" id="mz" alt="zoomable" src="<?=base_url()?>ofertasLocatarios/<?= $productoInfo->ofertaImagen?>"/>
	</div>
	<div class="mz thumbs">
		<a itemprop="thumbnail" href="<?=base_url()?>ofertasLocatarios/<?= $productoInfo->ofertaImagen;?>" data-large="<?=base_url()?>ofertasLocatarios/<?= $productoInfo->ofertaImagen;?>"><img itemprop="thumbnail" src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $productoInfo->ofertaImagen)?>" alt="Samsung" /></a>
		<? $imagenes = $this->ofertas_model->cargarFotosExtras($productoInfo->ofertaID);?>
		<? foreach($imagenes as $rowImag):?>
		<a itemprop="thumbnail" href="<?=base_url()?>ofertasLocatarios/<?= $rowImag->imagen;?>" data-large="<?=base_url()?>ofertasLocatarios/<?= $rowImag->imagen;?>"><img itemprop="thumbnail" src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $rowImag->imagen)?>" /></a>
		<? endforeach; ?>
	</div>
</div>
<div id="infoPro" itemscope itemtype="http://schema.org/Product">
	<h2>* Caracteristicas Principales</h2>
	<a class="loc" title="Tienda de <?=$productoInfo->localNombre?>" href="<?=base_url()?><?=$productoInfo->localUrl?>">Articulo ofrecido por <?=$productoInfo->localNombre?></h3> 
	<a class="linkSma" title="Mas ofertas de <?=$productoInfo->localNombre?>" href="<?=base_url()?><?=$productoInfo->localUrl?>/ofertas">| Ver mas ofertas</a>
	<!--i class="tel">Telefono: <?=$productoInfo->localTelefono?></i-->
	<? if ($productoInfo->garantia != ''):?><div class="MarcaEdit"><b>Garantia:</b><em id="garPro"><?= $productoInfo->garantia;?></em></i></div><?endif?>
	<? if ($productoInfo->statusProducto != ''):?><div class="MarcaEdit"><b>Estado Producto:</b><em id="statusPro"><?= $productoInfo->statusProducto;?></em></i></div><?endif?>
	<? if ($productoInfo->marca != ''):?><div class="MarcaEdit"><b>Marca :</b><em id="marcaOp" itemprop="brand"><?= $productoInfo->marca;?></em></i></div><?endif?>
	<? if ($productoInfo->tematicaNombre != ''):?><div class="MarcaEdit"><b>Categoria :</b><em id="tematicaOp<?=$this->uri->segment(4)?>" itemprop="category"><?= $productoInfo->tematicaNombre;?></em></i></div><?endif?>
	<? if ($productoInfo->color != ''):?><div class="MarcaEdit"><b>Color :</b><em id="colorPro" itemprop="color"><?= $productoInfo->color;?></em></i></div><?endif?>
	<? $catTipo = $this->ofertas_model->cargarCatTipoRama($productoInfo->ramaID);?>
	<? foreach($catTipo as $rowCt):?>
		<? $descripcion = $this->ofertas_model->cargarBusquedaCat($productoInfo->ofertaID, $rowCt->tipoID);?>
		<div class="MarcaEdit"><b><?= $rowCt->descripcion;?></b><em id="catOp<?= $rowCt->tipoID;?>"><? if ($descripcion) : foreach($descripcion as $rowDes):?><?= $rowDes->descripcion;?><? endforeach; ?><?else:?>Otros<?endif;?></em></div>
	<? endforeach; ?>
	<? if ($caracteristicas):?>
	<h3>* Extras</h3>
	<ul>
		<? foreach($caracteristicas as $caract):?>
		<li><?=$caract->caracteristica?></li>
		<? endforeach;?>
	</ul>
	<? endif?>
	<? $user = $this->session->userdata('user');?>
	<? if($user['uid'] == ''):?>
	<a  class="nBotonBig ml10 mt10 log" href="#login_form" title="Solicita mas información del producto">Solicita mas Información</a>
	<? else:?>
	<a  class="nBotonBig ml10 mt10 log" href="#muroInteraccion" title="Solicita mas información del producto">Solicita mas Información</a>
<? endif;?>
	<div id="tipoCat">
	<p class="catPo">
		<em>Categoria</em>
		<a class="red" href="<?=base_url()?><?=strtolower($productoInfo->ramaNombre)?>" title="Ver mas ofertas de <?=$productoInfo->ramaNombre?>"><?=$productoInfo->ramaNombre?></a>
	</p>
	<p class="catPo">
		<em>Marca</em>
		<a itemprop="brand" class="red" href="<?=base_url()?><?=strtolower($productoInfo->ramaNombre)?>/<?=$productoInfo->marca?>" title="Ver mas <?=$productoInfo->ramaNombre?> <?=$productoInfo->marca?>"><?=$productoInfo->marca?></a>
	</p>
	</div>
</div>
</aside>
<div id="finCom">
<? $this->load->view('includes/menus/socialMediaHeader');?>
<aside id="compra">
<form id="addCartMetric"  action="<?=base_url()?>carrito/agregar" method="post">
	<strong>Agregar a Carrito</strong>
	<fieldset itemprop="offers" itemscope itemtype="http://schema.org/Offer">
	  <p class="bckWh ml5">Precio: <em class="red" itemprop="price">$ <?= number_format($productoInfo->ofertaPrecio)?></em></p>
	</fieldset>
	<fieldset>
	</fieldset>
	<fieldset>
	  <p class="bckWh ml5">12 pagos de: <em class="red2">$ <?= number_format($meses, 2)?></em></p>
	</fieldset>
	<fieldset>
		<input type="hidden" name="ofertaID" value="<?=$productoInfo->ofertaID?>" />
		<input type="hidden" name="ofertaPrecio" value="<?=$productoInfo->ofertaPrecio?>" />
		<input type="hidden" name="ofertaTitulo" value="<?= sanear_string($productoInfo->ofertaTitulo)?>" />
		<input type="hidden" name="ofertaEnvio" value="<?=$productoInfo->costoEnvio?>" />
		<input type="hidden" name="gananciaPt" value="<?=$productoInfo->gananciaPt?>" />
	<input class="narBotonBig mtb10" type="submit" value="Comprar" alt="Comprar" />
	</fieldset>
	<fieldset>
	</fieldset>
</form>
<? $user				= $this->session->userdata('user');?>
<? if ($user['uid'] != ''):?>
<form action="<?=base_url()?>inicio/cupon" method="post">
	<input type="hidden" name="ofertaID" value="<?=$productoInfo->ofertaID?>"/>
	<input type="hidden" name="localID" value="<?=$productoInfo->localID?>"/>
	<input type="hidden" name="usuarioID" value="<?=$user['uid']?>"/>
	<input type="hidden" name="nombre" value="<?=$user['name']?>"/>
	<input type="hidden" name="email" value="<?=$user['email']?>"/>
	<input class="nBotonBig fwlight" type="submit" class="nBotonBig mtb10" value="Imprimir cupón">
</form>
<? else:?>
<a class="nBotonBig mtb10 log" href="#form_cupon">Imprimir Cupón</a>
<? endif;?>
</aside>
	<ul id="comp">
	<li><strong class="titBlan">Compartir</strong></li>
	<!--<li><a href="<?=base_url()?>"><img src="<?=base_url()?>assets/graphics/compartirEmail.png" alt="Enviar a un amigo" /><span>Enviar a un amigo.</span></a></li>
	<li><img src="<?=base_url()?>assets/graphics/agregarFavoritos.png" alt="Agregar a favoritos" /><span>Agregrar a tus favoritos.</span></a></li>-->
	<li><div class="fb-share-button" data-href="http://www.plazadelatecnologia.com/<?=$this->uri->uri_string()?>" data-type="button_count"></div></li>
	<li style="margin-left: 10px;"><a href="https://twitter.com/share" class="twitter-share-button" data-text="<?=$productoInfo->ofertaTitulo?>" data-lang="es" data-via="plazatecnologia" data-url="http://www.plazadelatecnologia.com/<?=$this->uri->uri_string()?>">Tweet</a></li>
	</ul>
</div>
	<br class="clear" />
	<div class="productosRecomendados">
		<div class="touchcarousel  three-d carousel-image-text-horizontal">
		<ul class="touchcarousel-container">
		<? foreach($productosRecomendados as $rowOfc):?>
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

<aside id="tabs">
  <ul class="tabsExtras">
    <li><a class="desComm" href="#tab1">Preguntas, Comentarios y Descripción</a></li>
   <!-- Queda comentado hasta nuevo aviso <li><a class="pregComm" href="#tab2">Preguntas y Comentarios</a></li>-->
  </ul>
  <div class="bTab" id="tab1">
   <strong class="red">Preguntas al vendedor</strong>
    <?= $this->load->view('includes/forms/preguntasycomentarios');?>
    <? foreach($comentarios as $comentaInfo):?>
	    <div class="pregunta">
	    <p><b><?=$comentaInfo->userAlias?></b> <i class="red"> <?=$comentaInfo->contactoFecha?></i></p>
	    <p><?=$comentaInfo->contactoComentario?></p>
	    <? $respuesta = $this->ofertas_model->cargarContestaciones($comentaInfo->contactoID);?>
	    <? foreach($respuesta as $respInfo):?>
		    <div class="hilo">
			    <p class="titHilo red"><b><?=$respInfo->localNombre?></b> <i class="red"><?=$respInfo->contactoFecha?></i></p>
			    <p><?=$respInfo->contactoComentario?></p>
		    </div>
		<? endforeach;?>
	    </div>
	<? endforeach;?>
   <p><?= nl2br($productoInfo->ofertaDescripcion)?></p>
  </div>
</aside>
<div style="display:none">
	<div id="form_cupon" >
    <form action="<?=base_url()?>inicio/cupon" method="post">
    <h3>Imprime tu cupón</h3>
	<input type="hidden" name="ofertaID" value="<?=$productoInfo->ofertaID?>"/>
	<input type="hidden" name="localID" value="<?=$productoInfo->localID?>"/>
	<input type="hidden" name="usuarioID" value=""/>
	<input class="regIn" type="text" name="nombre" placeholder="Tu nombre"/>
	<input class="regIn" type="text" name="email" placeholder="Tu email"/>
	<input class="nBotonBig fwlight" type="submit" class="nBotonBig mtb10" value="Imprimir cupón">
</form>
	</div>
</div>
<? $this->load->view('includes/forms/preguntar');?>
<div style="display:none">
<?= $this->load->view('includes/forms/preguntasycomentarios');?>
</div>
<? endforeach;?>
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