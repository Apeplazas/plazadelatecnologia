<? foreach($producto as $productoInfo):?>
<? $masComision 		= $productoInfo->ofertaPrecio + ($productoInfo->ofertaPrecio * $productoInfo->comision)/100?>
<? $masComisionMes 	= $masComision + ($masComision * $productoInfo->meses)/100?>
<? $meses				= $masComisionMes/12;?>
<aside class="ml20">
<div id="fotoPro">
	<div class="targetarea">
		<img id="mz" alt="zoomable" src="<?=base_url()?>ofertasLocatarios/<?= $productoInfo->ofertaImagen?>"/>
	</div>
	<div class="mz thumbs">
		<a href="<?=base_url()?>ofertasLocatarios/<?= $productoInfo->ofertaImagen;?>" data-large="<?=base_url()?>ofertasLocatarios/<?= $productoInfo->ofertaImagen;?>"><img src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $productoInfo->ofertaImagen)?>" alt="Samsung" /></a>
		<? $imagenes = $this->ofertas_model->cargarFotosExtras($productoInfo->ofertaID);?>
		<? foreach($imagenes as $rowImag):?>
		<a href="<?=base_url()?>ofertasLocatarios/<?= $rowImag->imagen;?>" data-large="<?=base_url()?>ofertasLocatarios/<?= $rowImag->imagen;?>"><img src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $rowImag->imagen)?>" /></a>
		<? endforeach; ?>
	</div>
</div>
<div id="infoPro">
	<h1><?=preg_replace("[^A-Za-z0-9]", "", $productoInfo->ofertaTitulo);?></h1>
	<h2>Caracteristicas Principales</h2>
	<? if ($productoInfo->garantia != ''):?><div class="MarcaEdit"><b>Garantia:</b><em id="garPro"><?= $productoInfo->garantia;?></em></i></div><?endif?>
	<? if ($productoInfo->statusProducto != ''):?><div class="MarcaEdit"><b>Estado Producto:</b><em id="statusPro"><?= $productoInfo->statusProducto;?></em></i></div><?endif?>
	<? if ($productoInfo->marca != ''):?><div class="MarcaEdit"><b>Marca :</b><em id="marcaOp"><?= $productoInfo->marca;?></em></i></div><?endif?>
	<? if ($productoInfo->tematicaNombre != ''):?><div class="MarcaEdit"><b>Categoria :</b><em id="tematicaOp<?=$this->uri->segment(4)?>"><?= $productoInfo->tematicaNombre;?></em></i></div><?endif?>
	<? if ($productoInfo->color != ''):?><div class="MarcaEdit"><b>Color :</b><em id="colorPro"><?= $productoInfo->color;?></em></i></div><?endif?>
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
</div>
</aside>
<div id="finCom">
<p class="bckWh ml5">Precio: <em class="red">$ <?= number_format($productoInfo->ofertaPrecio)?></em> o 12 pagos de <em class="red2">$ <?= number_format($meses, 2)?></em></p>
<form  action="http://m.plazadelatecnologia.com/carrito/agregar" method="post">
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
