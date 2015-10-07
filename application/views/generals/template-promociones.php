<section id="busTotal" class="busqGenCam">
<h1 class="ml10 ml20"><?if($this->uri->segment(1) == 'ofertas'){foreach($localInfo as $value){echo 'Ofertas de '.$value->name;}}elseif($this->uri->segment(2) == 'busqueda_rapida'){echo 'Resultado de busqueda';}?></h1>
<div id="busqExtra">
	<h1>Promoción en <?= $this->uri->segment(1);?> </h1>
</div>
<span id="cantBus"><?=count($productos)?> RESULTADOS ENCONTRADOS</span>
<ul id="listChange" class="boxCam" title="">
  <? foreach($productos as $listaPro):?>
  <? $masComision 		= $listaPro->ofertaPrecio + ($listaPro->ofertaPrecio * $listaPro->comision)/100?>
  <? $masComisionMes 	= $masComision + ($masComision * $listaPro->meses)/100?>
  <? $meses				= $masComisionMes/12;?>
  <li class="box noPag">
  	  <a href="<?=base_url()?><?=strtolower($listaPro->rama)?>/oferta/<?=url_title(trim($listaPro->ofertaTitulo), '_')?>/<?=$listaPro->ofertaID?>">
  	  <? if ($listaPro->descuentoPorcentaje > '0'):?><b class="tagDisc"><?= $listaPro->descuentoPorcentaje;?>%</b><? endif?>
	  <span>
	    	<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/ofertasLocatarios/'.str_replace('.', '_thumb.', $listaPro->ofertaImagen))):?>
	    	<img src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $listaPro->ofertaImagen)?>" title="<?= $listaPro->ofertaTitulo?>" />
	    	<? else:?>
	    	<img style="width:85px;" src="<?=base_url()?>assets/graphics/no_image.png" title="Imagen no disponible" />
	    	<? endif;?>
	  </span>
	  <strong><?= $listaPro->marca?></strong>
	  <p><?= $listaPro->ofertaTitulo?> </p>
	  <? if ($listaPro->descuentoPorcentaje > '0'):?><b class="tachado">$ <?= number_format($listaPro->precioLocal + $listaPro->gananciaPt);?></b><? endif?>
	  <? if ($listaPro->envio == 'Si'):?><b class="envioIncluido"><img src="<?=base_url()?>assets/graphics/enviogratis.png" alt="Envio Incluido" /></b><? endif?>
	  <em>$ <?= number_format($listaPro->ofertaPrecio)?></em>
	  <i class="meses">12 pagos de</i>
	  <em class="mesesCosto">$ <?= number_format($meses, 2)?></em>
	  </a>
  </li>
  <? endforeach;?>
</ul>
</section>