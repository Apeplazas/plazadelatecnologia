<header>
<h1>Articulos seleccionados para la sección de ofertas</h1>
</header>
<div id="ofertasCamp">
<?= $this->session->flashdata('msg'); ?>
<aside id="RamCatSub">
	<ul id="filtro">
		<li><strong>Filtrado por:</strong></li>
		<? if ($this->uri->segment(4) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/agregarOfertasCampania/<?= $this->uri->segment(3);?>"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(4)));?></a></li>
		<? endif;?>
		<? if ($this->uri->segment(5) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/agregarOfertasCampania/<?= $this->uri->segment(3);?>/<?= $this->uri->segment(4);?>"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(5)));?></a></li>
		<? endif;?>
		<? if ($this->uri->segment(6) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/<?= $this->uri->segment(2);?>/<?= $this->uri->segment(3);?>"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(4)));?></a></li>
		<? endif;?>
	</ul>
	<h3>Catalogo keyword</h3>
	<dl>
	  <dt>Rama</dt>
	    <? foreach($ramas as $ramaRow):?>
	    <dd><a href="<?=base_url()?><?=$this->uri->segment(1)?>/agregarOfertasCampania/<?=$this->uri->segment(3)?>/<?= $ramaRow->paginaUrl?>/"><?=$ramaRow->ramaNombre?> (<?=$ramaRow->total?>)</a></dd>
	    <? endforeach;?>
	</dl>
	<dl>
	  <dt>Marca</dt>
	    <? foreach($marcas as $marcaRow):?>
	    <dd><a href="<?=base_url()?><?=$this->uri->segment(1)?>/agregarOfertasCampania/<?=$this->uri->segment(3)?>/<?=$this->uri->segment(4)?>/<?= strtolower($marcaRow->marcaUrl);?>"><?=$marcaRow->marca?> (<?=$marcaRow->total?>)</a></dd>
	    <? endforeach;?>
	</dl>
	<dl>
		<dt>Categoria</dt>
		<? foreach($tematica as $rowTem):?>
		<dd><a href="<?=base_url()?><?= $this->uri->segment(1);?>/<?= $this->uri->segment(2);?>/<?= $rowTem->tematicaUrl;?>"><?= $rowTem->tematicaNombre;?> (<?=$rowTem->total?>)</a></dd>
		<? endforeach; ?>
	</dl>
</aside>

<section id="busTotal" class="busqGenList">
<div id="busqExtra">
	<h1>Ofertas seleccionadas</h1>
</div>
<span id="cantBus"><?= count($productos)?> RESULTADOS ENCONTRADOS</span>

<? if ($this->uri->segment(2) == 'verOfertasCampania'):?>
<a class="agregaCamLe" href="<?=base_url()?>hobbits/agregarOfertasCampania/<?= $this->uri->segment(3);?>"><img src="<?=base_url()?>assets/graphics/agregarCat.png" alt="Agregar ofertas"> <span>Agregar Ofertas</span></a>
<? endif;?>
<form action="">
<ul id="listChange" class="box" >
  <? if (count($productos) > 0) : foreach($productos as $listaPro):?>
  <? $masComision 		= $listaPro->ofertaPrecio + ($listaPro->ofertaPrecio * $listaPro->comision)/100?>
  <? $masComisionMes 	= $masComision + ($masComision * $listaPro->meses)/100?>
  <? $meses				= $masComisionMes/12;?>
  <li>
    <em><input type="checkbox" name="<?= $listaPro->ofertaID;?>"/></em>
  	  <? if ($listaPro->descuentoPorcentaje > '0'):?><b class="tagDisc"><?= $listaPro->descuentoPorcentaje;?>%</b><? endif?>
	  <span>
	    	<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/ofertasLocatarios/'.str_replace('.', '_thumb.', $listaPro->ofertaImagen))):?>
	    	<img src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $listaPro->ofertaImagen)?>" title="<?= $listaPro->ofertaTitulo?>" />
	    	<? else:?>
	    	<img style="width:85px;" src="<?=base_url()?>assets/graphics/no_image.png" title="Imagen no disponible" />
	    	<? endif;?>
	  </span>
	  <strong><?= $listaPro->marca?></strong>
	  
	  <? $a =  $this->hobbits_model->marcaAutorizadas($listaPro->ofertaID,$this->uri->segment(3));?>
	  <? foreach($a as $rowA):?>
	  <? if ($rowA->ofertaCampaniaStatus == 'Autorizada'): ?><div id="palomita"><img src="<?=base_url()?>assets/graphics/palomita.png" alt="Autorizada" /></div><? endif;?>
	   <? endforeach; ?>
	  <p><?= $listaPro->ofertaTitulo?> </p>
	  <? if ($listaPro->descuentoPorcentaje > '0'):?><b class="tachado">$ <?= number_format($listaPro->precioLocal + $listaPro->gananciaPt);?></b><? endif?>
	  <? if ($listaPro->envio == 'Si'):?><b class="envioIncluido"><img src="<?=base_url()?>assets/graphics/enviogratis.png" alt="Envio Incluido" /></b><? endif?>
	  <em>$ <?= number_format($listaPro->ofertaPrecio)?></em>
  </li>
  <? endforeach;?>
  <? endif;?>
</ul>
</form>
</section>
</div>