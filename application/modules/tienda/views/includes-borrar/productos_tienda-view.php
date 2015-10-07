<? if($destacados):?>
	<h3>Productos destacados</h3>
	<div id="proVenTie">
	<ul>
	<? foreach($destacados as $rowDestaca):?>
	<li>
	    <strong><?= $rowDestaca->ofertaTitulo?></strong>
	    <a href="<?=base_url()?><?=strtolower($rowDestaca->rama)?>/<?=url_title(trim($rowDestaca->ofertaTitulo), '_')?>/<?=$rowDestaca->ofertaID?>">
	    <? if(file_exists($_SERVER['DOCUMENT_ROOT'].'ptv8/ofertasLocatarios/'.$rowDestaca->ofertaImagen)):?>
    	<img style="max-width: 120px" src="<?=base_url()?>ofertasLocatarios/<?= $rowDestaca->ofertaImagen?>" title="<?= $rowDestaca->ofertaTitulo?>" />
    	<? else:?>
    	<img style="width: 90px;" src="<?=base_url()?>assets/graphics/no_image.png" title="Imagen no disponible" />
    	<? endif;?>
	    <p><?= character_limiter($rowDestaca->ofertaDescripcion, 40)?></p>
	    </a>
	  </li>
	 <? endforeach;?>
	</ul>
	</div>
<? endif;?>
<div id="busTotal" class="busqGenListTwo">
<? foreach($localRama as $rowRama):?>
	<? $busqueda =  $this->milocal_model->cargarOfertaRama($rowRama->ramaID,$this->uri->segment(3),$limit = 'LIMIT 5');?>
	<h1 class="ml10"><?=$rowRama->ramaNombre?></h1>
	<div id="busqExtra">
	
	<span id="listType">
		<em>Tipo de Lista: </em>
		<button id="box" class="actBox">Cubo</button>
		<button id="wide" class="inactWide">Lista</button>
	</span>
	</div>
	<ul id="tusOfertas" class=" box">
	  <? foreach($busqueda as $rowBus):?>
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
	  	<a class="mas_rama" title="Ver mas ofertas de <?=$rowRama->ramaNombre?>" href="<?=base_url()?><?=$this->uri->uri_string()?>/<?=$rowRama->ramaNombre?>"><img src="<?=base_url()?>assets/graphics/rama_mas.png"/></a>
	</ul>
	<? endforeach; ?>
</div>