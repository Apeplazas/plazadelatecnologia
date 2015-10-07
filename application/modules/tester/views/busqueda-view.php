<aside id="RamCatSub">
	<dl>
	  	<? foreach($ramas as $ramaRow):?>
	    <dt><?=$ramaRow->ramaNombre?></dt>
	    	<? $marcas = $this->data_model->cargaMarcas($ramaRow->ramaUrl,$tematica = '');?>
		    <? foreach($marcas as $marcaRow):?>
		    <dd><a href="<?=base_url()?><?=$ramaRow->ramaUrl?>/<?=$marcaRow->marcaUrl?>/<? if($this->uri->segment(4) == ''): echo '0'; else: echo $this->uri->segment(4); endif;?>"><?=$marcaRow->marca?> (<?=$marcaRow->total?>)</a></dd>
		    <? endforeach;?>
	    <? endforeach;?>
	</dl>
</aside>
<section id="busTotal" class="busqGenList">
<h1 class="ml10 mb20"><?if($this->uri->segment(1) == 'ofertas'){foreach($localInfo as $value){echo 'Ofertas de '.$value->name;}}elseif($this->uri->segment(2) == 'busqueda_rapida'){echo 'Resultado de la busqueda';}?></h1>
<div id="busqExtra">
<form id="orderBy" onchange="order()">
	<label>Ordernar</label>
	<select name="" id="seleccion">
		<? $opciones[1] = 'marca';
			$opciones[2] = 'precio';
			$opciones[3] = 'titulo';?>
		<? for($i = 1; $i <= count($opciones); $i++):?>
		<option value="<?=base_url()?>inicio/busquedaResultados/<?=$opciones[$i]?>" <?if($opciones[$i] == $this->uri->segment(3)):?> selected <?endif;?>>por <?=$opciones[$i]?></option>
		<? endfor;?>
	</select>
</form>
<span id="listType">
	<em>Tipo de Lista: </em>
	<button id="box" class="actBox">Cubo</button>
	<button id="wide" class="inactWide">Lista</button>
</span>
</div>
<span id="cantBus"><?=count($productos)?> RESULTADOS ENCONTRADOS</span>
<ul id="listChange" class=" box" title="">
  <? foreach($productos as $listaPro):?>
  <? $masComision 		= $listaPro->ofertaPrecio + ($listaPro->ofertaPrecio * $listaPro->comision)/100?>
  <? $masComisionMes 	= $masComision + ($masComision * $listaPro->meses)/100?>
  <? $meses				= $masComisionMes/12;?>
  <li class="noPag">
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
<script type="text/javascript">
	function order() {
		var f = document.getElementById('orderBy');
		var s = document.getElementById('seleccion');
			if( s.selectedIndex == 1 ) { 
				f.setAttribute("action",s.options[1].value) ;  
				f.submit();
			}
			if( s.selectedIndex == 2 ) { 
			location.href = s.options[2].value;
			}
		}
</script>

