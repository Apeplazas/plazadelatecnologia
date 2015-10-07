<?
$rama			= ucfirst($this->uri->segment(1));
$marca			= ucfirst($this->uri->segment(2));
$tematicaOpt	= ucfirst($this->uri->segment(3));
$cat			= ucfirst($this->uri->segment(4));
$cat1			= ucfirst($this->uri->segment(5));
$cat2			= ucfirst($this->uri->segment(6));
$cat3			= ucfirst($this->uri->segment(7));
$cat4			= ucfirst($this->uri->segment(8));
?>
<aside id="RamCatSub">
	<ul id="filtro">
		<? if ($this->uri->segment(2) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/0/<?= $this->uri->segment(3);?>" title="Quitar filtro"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(2)));?></a></li>
		<? endif;?>
		<? if ($this->uri->segment(3) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/<?= $this->uri->segment(2);?>/0" title="Quitar filtro"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(3)));?></a></li>
		<? endif;?>
		<? if ($this->uri->segment(4) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/<?= $this->uri->segment(2);?>/<?= $this->uri->segment(3);?>" title="Quitar filtro"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(4)));?></a></li>
		<? endif;?>
	</ul>
	<h3>Filtrar por:</h3>
	<dl>
	  <dt>Marca</dt>
	    <? foreach($marcas as $marcaRow):?>
	    <dd><a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?= $marcaRow->marcaUrl?>/<?=$this->uri->segment(3)?>" title="<?=$marcaRow->marca?>"><?=$marcaRow->marca?> (<?=$marcaRow->total?>)</a></dd>
	    <? endforeach;?>
	</dl>
	<dl>
		<dt>Categoria</dt>
		<? foreach($tematica as $rowTem):?>
		<dd><a href="<?=base_url()?><?= $this->uri->segment(1);?>/<?= $this->uri->segment(2);?>/<?= $rowTem->tematicaUrl;?>" title="<?= $rowTem->tematicaNombre;?>"><?= $rowTem->tematicaNombre;?></a></dd>
		<? endforeach; ?>
	</dl>
	<? foreach($caracteristicas as $caractRow):?>
	<dl>
	  <dt><?=$caractRow->descripcion?></dt>
	  <? $subCat = $this->data_model->cargaSubCat( $this->uri->segment(1), $this->uri->segment(2),$caractRow->tipoID);?>
	  <? foreach($subCat as $rowSub):?>
	  <? if($this->uri->segment(4) != $rowSub->catUrl ):?>
	  <dd><a href="<?=base_url()?><?=$this->uri->segment(1)?>/<? if ($this->uri->segment(2) != '0'):?><?= $this->uri->segment(2)?><? else:?>0<? endif?>/<? if ($this->uri->segment(3) != '0'):?><?= $this->uri->segment(3)?><? else:?>0<? endif?>/<?= $rowSub->catUrl;?>" title="<?= $rowSub->descripcion;?>"><?= $rowSub->descripcion;?></a></dd>
	  <? else:?>
	  <dd><?= $rowSub->descripcion;?></dd>
	  <? endif?>
	  <? endforeach; ?>
	</dl>
	<? endforeach;?>
	<a id="brochureBanSma" title="Descarga nuestro brochure de ofertas" href="<?=base_url()?>folletos"><img class="100Pc" src="<?=base_url()?>assets/graphics/ofertasBrochureSmall.png" alt="Brochure de Ofertas"></a>
</aside>
<section id="busTotal" class="busqGenList">
<h1 class="ml10 ml20"><?if($this->uri->segment(1) == 'ofertas'){foreach($localInfo as $value){echo 'Ofertas de '.$value->name;}}elseif($this->uri->segment(2) == 'busqueda_rapida'){echo 'Resultado de busqueda';}?></h1>
<? $this->load->view('includes/banners/bannersLeadCategorias');?>
<div id="busqExtra">
	<h1><?= $this->uri->segment(1);?> <? if ($marca != '0'):?><?=$marca?><?endif;?> <? if (isset($tematicaOpt)):?><?= str_replace('_',' ', $tematicaOpt)?><?endif;?> <? if (isset($cat)):?><?= str_replace('_',' ', $cat)?><?endif;?> al mejor precio.</h1>	
</div>
<? foreach($opt as $rowOpt):?>
<p class="desOpt">Compra en linea <?= $this->uri->segment(1);?> <?= $rowOpt->metaTitle;?></p>
<? endforeach; ?>
<span id="cantBus"><?=count($productos)?> RESULTADOS ENCONTRADOS</span>
<ul id="listChange" class="box" title="">
  <? foreach($productosPagados as $listaPag):?>
  <? $masComision 		= $listaPag->ofertaPrecio + ($listaPag->ofertaPrecio * $listaPag->comision)/100?>
  <? $masComisionMes 	= $masComision + ($masComision * $listaPag->meses)/100?>
  <? $meses				= $masComisionMes/12;?>
	<li class="box noPag">
	<div class="iconSponsored"><img src="<?=base_url()?>assets/graphics/destacados.png" alt="Articulos Destacados" /></div>
	  <a href="<?=base_url()?><?=strtolower($listaPag->rama)?>/oferta/<?=url_title(trim($listaPag->ofertaTitulo), '_')?>/<?=$listaPag->ofertaID?>" title="<?= $listaPag->ofertaTitulo?>">
  	  <? if ($listaPag->descuentoPorcentaje > '0'):?><b class="tagDisc"><?= $listaPag->descuentoPorcentaje;?>%</b><? endif?>
	  <span>
	    	<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/ofertasLocatarios/'.str_replace('.', '_thumb.', $listaPag->ofertaImagen))):?>
	    	<img src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $listaPag->ofertaImagen)?>" alt="<?= $listaPag->ofertaTitulo?>" />
	    	<? else:?>
	    	<img style="width:85px;" src="<?=base_url()?>assets/graphics/no_image.png" alt="Imagen no disponible" />
	    	<? endif;?>
	  </span>
	  <strong><?= $listaPag->marca?></strong>
	  <p><?= $listaPag->ofertaTitulo?> </p>
	  <? if ($listaPag->descuentoPorcentaje > '0'):?><b class="tachadoPag">$ <?= number_format($listaPag->precioLocal + $listaPag->gananciaPt + $listaPag->costoEnvio);?></b><? endif?>
	  
	  <em>$ <?= number_format($listaPag->ofertaPrecio)?></em>
	  <i class="meses">12 pagos de</i>
	  <em class="mesesCosto">$ <?= number_format($meses, 2)?></em>
	  <button class="vermas">ver mas...</button>
	  </a>
	</li>
  <? endforeach;?>
  
  <? foreach($productos as $listaPro):?>
  <? $masComision 		= $listaPro->ofertaPrecio + ($listaPro->ofertaPrecio * $listaPro->comision)/100?>
  <? $masComisionMes 	= $masComision + ($masComision * $listaPro->meses)/100?>
  <? $meses				= $masComisionMes/12;?>
  <li class="noPag">
  	  <a href="<?=base_url()?><?=strtolower($listaPro->rama)?>/oferta/<?=url_title(trim($listaPro->ofertaTitulo), '_')?>/<?=$listaPro->ofertaID?>" title="<?= $listaPro->ofertaTitulo?>">
  	  <? if ($listaPro->descuentoPorcentaje > '0'):?><b class="tagDisc"><?= $listaPro->descuentoPorcentaje;?>%</b><? endif?>
	  <span>
	    	<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/ofertasLocatarios/'.str_replace('.', '_thumb.', $listaPro->ofertaImagen))):?>
	    	<img src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $listaPro->ofertaImagen)?>" alt="<?= $listaPro->ofertaTitulo?>" />
	    	<? else:?>
	    	<img style="width:85px;" src="<?=base_url()?>assets/graphics/no_image.png" alt="Imagen no disponible" />
	    	<? endif;?>
	  </span>
	  <strong><?= $listaPro->marca?></strong>
	  <p><?= $listaPro->ofertaTitulo?> </p>
	  <? if ($listaPro->descuentoPorcentaje > '0'):?><b class="tachado">$ <?= number_format($listaPro->precioLocal + $listaPro->gananciaPt + $listaPro->costoEnvio);?></b><? endif?>
	  
	  <em>$ <?= number_format($listaPro->ofertaPrecio)?></em>
	  <i class="meses">12 pagos de</i>
	  <em class="mesesCosto">$ <?= number_format($meses, 2)?></em>
	  <button class="vermas">ver mas...</button>
	  </a>
  </li>
  <? endforeach;?>
</ul>
</section>