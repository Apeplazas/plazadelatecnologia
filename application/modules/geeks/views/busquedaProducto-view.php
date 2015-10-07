<!--aside id="RamCatSub">
	<ul id="filtro">
		<? if ($this->uri->segment(2) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/0/<?= $this->uri->segment(3);?>" title="Quitar Filtro"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(2)));?></a></li>
		<? endif;?>
		<? if ($this->uri->segment(3) != '0'):?>
		<li><a href="<?=base_url()?><?= $this->uri->segment(1);?>/" title="Quitar Filtro"><img src="<?=base_url()?>assets/graphics/close.png" alt="Quitar Filtro" /><?= ucfirst( str_replace('_',' ', $this->uri->segment(3)));?></a></li>
		<? endif;?>
	</ul>
	<h3>Filtrar</h3>
	<dl>
	  <dt>Marca</dt>
	    <? foreach($marcas as $marcaRow):?>
	    <dd><a href="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$marcaRow->marcaUrl?>/<? if($this->uri->segment(3) == ''): echo '0'; else: echo $this->uri->segment(3); endif;?>" title="<?=$marcaRow->marca?>"><?=$marcaRow->marca?> (<?=$marcaRow->total?>)</a></dd>
	    <? endforeach;?>
	</dl>
	<dl>
	  <dt>Categoria</dt>
	    <? foreach($ramas as $ramaRow):?>
	    <dd><a href="<?=base_url()?><?=$this->uri->segment(1)?>/<? if($this->uri->segment(2) == ''): echo '0'; else: echo $this->uri->segment(2); endif;?>/<?=$ramaRow->ramaUrl?>" title="<?=$ramaRow->ramaNombre?>"><?=$ramaRow->ramaNombre?> (<?=$ramaRow->total?>)</a></dd>
	    <? endforeach;?>
	</dl>
</aside-->
<section id="busTotal" class="contenedorGamGeek" >
<? $this->load->view('includes/banners/bannersLeadCategorias');?>
<h1 class="mb20"><?if($this->uri->segment(1) == 'venta_outlet'){ echo "Venta Outlet";}else{echo 'Ofertas y Promociones';}?></h1>
<div id="busqExtra">
<form id="orderBy"  method="post" action="<?=base_url()?><?=$this->uri->segment(1)?>/<?=$this->uri->segment(2)?>/<?=$this->uri->segment(3)?>">
	<label>Ordernar</label>
	<select name="order" onchange="this.form.submit()">
		<?  $opciones[1] 	= 'marca';
			$opciones[2] 	= 'precio';
			$opciones[3] 	= 'titulo';
		?>
		<? for($i = 1; $i <= count($opciones); $i++):?>
		<option value="<?=$opciones[$i]?>" <?if($opciones[$i] == $order):?> selected <?endif;?>>por <?=$opciones[$i]?></option>
		<? endfor;?>
	</select>
</form>
<!--<span id="listType">
	<em>Tipo de Lista: </em>
	<button id="box" class="actBox">Cubo</button>
	<button id="wide" class="inactWide">Lista</button>
</span>-->
</div>
<span id="cantBus"><?=count($productos)?> RESULTADOS ENCONTRADOS</span>
<ul id="listChange" class="box" title="">
  <? foreach($productos as $listaPro):?>
  <? $masComision 		= $listaPro->ofertaPrecio + ($listaPro->ofertaPrecio * $listaPro->comision)/100?>
  <? $masComisionMes 	= $masComision + ($masComision * $listaPro->meses)/100?>
  <? $meses				= $masComisionMes/12;?>
  <li class="box noPag">
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
	  <? if ($listaPro->promoBuenFin > '0'):?><b class="tagBuenFin"></b><? endif?>
  </li>
  <? endforeach;?>
</ul>
</section>