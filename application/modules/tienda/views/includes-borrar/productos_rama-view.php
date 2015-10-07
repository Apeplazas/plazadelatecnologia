<div id="busTotal" class="busqGenListTwo">
	<h1 class="ml10"><?=$this->uri->segment(4)?></h1>
	<div id="busqExtra">
	<form id="orderBy" onchange="order()">
		<label>Ordernar</label>
		<select name="" id="seleccion">	
			<option value="http://localhost:8888/ptv8/inicio/busquedaResultados/marca">por marca</option>
			<option value="http://localhost:8888/ptv8/inicio/busquedaResultados/precio">por precio</option>
			<option value="http://localhost:8888/ptv8/inicio/busquedaResultados/titulo">por titulo</option>
		</select>
	</form>
	<span id="listType">
		<em>Tipo de Lista: </em>
		<button id="box" class="actBox">Cubo</button>
		<button id="wide" class="inactWide">Lista</button>
	</span>
	</div>
	<ul id="tusOfertas" class=" box">
	<? foreach($productosRama as $rowBus):?>
	  <li>
	  <strong><?= $rowBus->ofertaTitulo?> </strong>
	    <a href="<?=base_url()?><?=strtolower($rowBus->rama)?>/<?=url_title(trim($rowBus->ofertaTitulo), '_')?>/<?=$rowBus->ofertaID?>">
		<? if(file_exists($_SERVER['DOCUMENT_ROOT'].'ptv8/ofertasLocatarios/'.$rowBus->ofertaImagen)):?>
    	<img style="max-width: 120px;max-height: 130px;" src="<?=base_url()?>ofertasLocatarios/<?= $rowBus->ofertaImagen?>" title="<?= $rowBus->ofertaTitulo?>" />
    	<? else:?>
    	<img style="width: 90px;" src="<?=base_url()?>assets/graphics/no_image.png" title="Imagen no disponible" />
    	<? endif;?>
	    <p><?= $rowBus->ofertaDescripcion?></p>
	    <button class="vermas">ver mas...</button>
	    </a>
	  </li>
	<? endforeach; ?>
	</ul>
</div>