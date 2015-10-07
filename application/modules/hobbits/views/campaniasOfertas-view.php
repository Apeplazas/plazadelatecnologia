<? foreach($campania as $row):?>
<header>
<h1>Estrategia de Campaña <?= $row->campaniaNombre;?><span>Agregar, Editar y Borrado de Ofertas</span></h1>
</header>
<section id="ofertasCamp">
<? if ($campania == FALSE):?>
<p class="msgInb">Esta campaña fue borrada o no existe</p>
<? else:?>
<?= $this->session->flashdata('msg'); ?>

<? if ($this->uri->segment(2) == 'agregarOfertasCampania'):?>
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
	<ul>
	  <li><a href="url">Liquidaciones</a></li>
	  <li><a href="url">Ofertas</a></li>
	</ul>
</aside>
<? endif;?>


<section id="busTotal" class="<? if ($this->uri->segment(2) == 'agregarOfertasCampania'):?>busqGenList<? else:?>busqGenAdd<? endif?>">
<div id="busqExtra">
	<h1>Listado de ofertas de la campaña <?= $row->campaniaNombre;?></h1>
</div>
<span id="cantBus"><?= count($productos)?> RESULTADOS ENCONTRADOS</span>

<? if ($this->uri->segment(2) == 'verOfertasCampania'):?>
<a class="agregaCamLe" href="<?=base_url()?>hobbits/agregarOfertasCampania/<?= $this->uri->segment(3);?>"><img src="<?=base_url()?>assets/graphics/agregarCat.png" alt="Agregar ofertas"> <span>Agregar Ofertas</span></a>
<? endif;?>
<ul id="listChange" class="box" >
  <? if (count($productos) > 0) : foreach($productos as $listaPro):?>
  <? $masComision 		= $listaPro->ofertaPrecio + ($listaPro->ofertaPrecio * $listaPro->comision)/100?>
  <? $masComisionMes 	= $masComision + ($masComision * $listaPro->meses)/100?>
  <? $meses				= $masComisionMes/12;?>
  <li>
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
	  <em>$ <?= number_format($listaPro->ofertaPrecio)?></em>
	  <? $s =  $this->hobbits_model->checaOfertaCampania($row->campaniaID,$listaPro->ofertaID);?>
	  <? if($s): foreach($s as $rowS):?>
	  <em id="autorizaCamp<?=$listaPro->ofertaID?>"><?= $rowS->ofertaCampaniaStatus;?></em>
	  <? endforeach;?>
	  <? else:?>
	  <em id="autorizaCamp<?=$listaPro->ofertaID?>">No autorizada</em> 
	  <? endif;?>
  </li>
  <? endforeach;?>
  <? endif;?>
</ul>
</section>
<? endif;?>
</section>
<? endforeach; ?>
<script type="text/javascript">
jQuery(function($){
<? foreach($productos as $listaPro):?>	
	// Actualiza status
	$("#autorizaCamp<?= $listaPro->ofertaID;?>").editInPlace({
		url: '<?=base_url()?>hobbits/addOfertaCampania/<?= $this->uri->segment(3);?>/<?= $listaPro->ofertaID;?>',
		default_text: 'Cambia el status.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "Autorizada, No autorizada"
	});
<?endforeach;?>
})
</script>