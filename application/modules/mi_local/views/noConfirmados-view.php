<? foreach($info as $rowInf):?>
<div id="wrapEdiTi">
<aside id="tienda">
<ul class="pFix">
<? $this->load->view('includes/menus/menuLocal');?>
</ul>
</aside>
<section id="infoVenta">
<h1 class="ml10">Productos pendientes por confirmar</h1>
<ul>
	<? foreach($sinConfirmar as $rowVen):?>
	<? if ($sinConfirmar != ''):?>
	<li>
		<span class="imgOfeIma"><img src="<?=base_url()?>ofertasLocatarios/<?= $rowVen->ofertaImagen;?>" alt="<?= $rowVen->ofertaTitulo;?>" /></span>
		<div class="infoOferta">
		  <strong><em>Producto Vendido:</em><i><?= $rowVen->ofertaTitulo;?></i></strong>
		  <p>Fecha de Compra: <?= convierteFechaBDLetra($rowVen->fecha,2)?></p>
		  <span class="fleft mt20">Descripcion de tu oferta:</span>
		  <p class="venDes"><?= character_limiter(nl2br($rowVen->ofertaDescripcion),100);?></p>
		  <p>Comprado por: <?= ucfirst($rowVen->userAlias);?> -> ( <?= ucfirst($rowVen->userName);?> <?= ucfirst($rowVen->lastName);?> )</p>
		  <a class="nBotonMed mt20" href="<?=base_url()?>mi_local/infoVendido/<?= $rowVen->ofertaID;?>/<?= $rowVen->localID;?>">Ver mas...</a>
		</div>
	</li>
	<? else:?>
	<div id="sinContent"><h4>Por el momento no tiene productos pendientes por confirmar envio.</h4></div>
	<? endif?>
	<? endforeach; ?>
</ul>
</section>
</div>
<? endforeach; ?>