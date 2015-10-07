<aside id="RamCatSub">
	<ul id="filtro">
		<? if ($this->uri->segment(2) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/0/<?= $this->uri->segment(3);?>"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(2)));?></a></li>
		<? endif;?>
		<? if ($this->uri->segment(3) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/<?= $this->uri->segment(2);?>/0"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(3)));?></a></li>
		<? endif;?>
		<? if ($this->uri->segment(4) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/<?= $this->uri->segment(2);?>/<?= $this->uri->segment(3);?>"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(4)));?></a></li>
		<? endif;?>
	</ul>
	<h3>Filtrar por:</h3>
	<dl>
	  <dt>Marca</dt>
	    <? foreach($marcas as $marcaRow):?>
	    <dd><a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?= $marcaRow->marcaUrl?>/<?=$this->uri->segment(3)?>"><?=$marcaRow->marca?> (<?=$marcaRow->total?>)</a></dd>
	    <? endforeach;?>
	</dl>
	<dl>
		<dt>Categoria</dt>
		<? foreach($tematica as $rowTem):?>
		<dd><a href="<?=base_url()?><?= $this->uri->segment(1);?>/<?= $this->uri->segment(2);?>/<?= $rowTem->tematicaUrl;?>"><?= $rowTem->tematicaNombre;?></a></dd>
		<? endforeach; ?>
	</dl>
	<? foreach($caracteristicas as $caractRow):?>
	<dl>
	  <dt><?=$caractRow->descripcion?></dt>
	  <? $subCat = $this->data_model->cargaSubCat( $this->uri->segment(1), $this->uri->segment(2),$caractRow->tipoID);?>
	  <? foreach($subCat as $rowSub):?>
	  <? if($this->uri->segment(4) != $rowSub->catUrl ):?>
	  <dd><a href="<?=base_url()?><?=$this->uri->segment(1)?>/<? if ($this->uri->segment(2) != '0'):?><?= $this->uri->segment(2)?><? else:?>0<? endif?>/<? if ($this->uri->segment(3) != '0'):?><?= $this->uri->segment(3)?><? else:?>0<? endif?>/<?= $rowSub->catUrl;?>"><?= $rowSub->descripcion;?></a></dd>
	  <? else:?>
	  <dd><?= $rowSub->descripcion;?></dd>
	  <? endif?>
	  <? endforeach; ?>
	</dl>
	<? endforeach;?>
	<ul>
	  <li><a href="url">Liquidaciones</a></li>
	  <li><a href="url">Ofertas</a></li>
	</ul>
</aside>
<section id="landing">
<div id="mainPromo">
<? foreach($mainPromo as $rowP):?>
	<a href="<?=base_url()?><?= $rowP->ramaUrl?>/oferta/<?= url_title($rowP->ofertaTitulo, '_');?>">
	<? if ($rowP->marca != ''):?><h2><?= $rowP->ramaNombre;?> <?= $rowP->marca;?></h2><? endif;?>
	<span><img src="<?=base_url()?>ofertasLocatarios/<?= $rowP->ofertaImagen;?>" alt="Las mejores promociones en <?= $this->uri->segment(2);?>" /></span>
	<div id="promoInfo">
	<h3><?= $rowP->ofertaTitulo;?></h3>
		<div class="price"><i><b class="desde">desde</b><em class="simbol">$</em> <?= number_format($rowP->ofertaPrecio);?></i>
		<? if ($rowP->envio == 'Si'):?><strong class="envioGratis"><img src="<?=base_url()?>assets/graphics/enviogratis.png" alt="Envio Gratis" /></strong><? endif;?>
		</div>
		</a>
	</div>
	<? endforeach; ?>
</div>
<ul id="landDes">
<? foreach($ofertasDestacadas as $rowD):?>
	<li>
	<a href="<?= $rowD->ramaUrl?>/oferta/<?= url_title($rowD->ofertaTitulo, '_');?>">
	<span><img src="<?=base_url()?>ofertasLocatarios/<?= $rowD->ofertaImagen;?>" alt="<?= $rowD->ofertaTitulo;?>" /></span>
	<strong><?= character_limiter($rowD->ofertaTitulo, '50');?></strong>
	<em>$ <?= number_format($rowD->ofertaPrecio);?></em>
	</a>
	</li>
<? endforeach; ?>
</ul>
</section>
<section id="busTotal" class="busqGenList">
<h1 class="ml10 ml20"><?if($this->uri->segment(1) == 'ofertas'){foreach($localInfo as $value){echo 'Ofertas de '.$value->name;}}elseif($this->uri->segment(2) == 'busqueda_rapida'){echo 'Resultado de busqueda';}?></h1>
<div id="busqExtra">
	<h1>Busqueda de <?= $this->uri->segment(1);?> </h1>
</div>
<span id="cantBus"><?=count($productos)?> RESULTADOS ENCONTRADOS</span>
<ul id="listChange" class=" box" title="">
  <? foreach($productos as $listaPro):?>
  <? $masComision 		= $listaPro->ofertaPrecio + ($listaPro->ofertaPrecio * $listaPro->comision)/100?>
  <? $masComisionMes 	= $masComision + ($masComision * $listaPro->meses)/100?>
  <? $meses				= $masComisionMes/12;?>
  <li>
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
	  <? if ($listaPro->descuentoPorcentaje > '0'):?><b class="tachado">$ <?= number_format($listaPro->precioLocal + $listaPro->gananciaPt + $listaPro->envio);?></b><? endif?>
	  <? if ($listaPro->envio == 'Si'):?><b class="envioIncluido"><img src="<?=base_url()?>assets/graphics/enviogratis.png" alt="Envio Incluido" /></b><? endif?>
	  <em>$ <?= number_format($listaPro->ofertaPrecio)?></em>
	  <i class="meses">12 pagos de</i>
	  <em class="mesesCosto">$ <?= number_format($meses, 2)?></em>
	  <button class="vermas">ver mas...</button>
	  </a>
  </li>
  <? endforeach;?>
</ul>
</section>