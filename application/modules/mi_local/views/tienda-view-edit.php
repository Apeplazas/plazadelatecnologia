<? foreach($info as $rowInf):?>
<? $leaderBoard = $this->milocal_model->cargarBannerTienda($rowInf->localID, 'leaderBoard');?>
<? $boxBanner 	= $this->milocal_model->cargarBannerTienda($rowInf->localID, 'box');?>
<h1 id="editPer">Hola Completa tu perfil.</h1>
<div id="wrapEdiTi">
<aside id="tienda">
<a class="upLogo" href="#banLogo"><img src="<?=base_url()?>localesLogos/<?= $rowInf->localLogo;?>" alt="<?= $rowInf->localNombre;?>" ></a>
<ul>
<? $this->load->view('includes/menus/menuLocal');?>
</ul>
<div id="promoTienda">
	<a href="<?=base_url()?>">
	<?php if($boxBanner) : foreach($boxBanner as $rowB) :?>
	<a class="upBan" href="#banFoto"><img src="<?=base_url()?>assets/graphics/bannersPromocionales/thumbs/<?= $rowB->bannerImagen;?>" alt="Promocion <?= $rowInf->localNombre;?>" /></a>
	<? endforeach; ?>
	<? else:?>
	<a class="upBan" href="#banFoto"><img src="<?=base_url()?>assets/graphics/bannersPromocionales/sinbannerBox.png" alt="Promocion <?= $rowInf->localNombre;?>" /></a>
	<? endif;?>
	</a>
</div>
</aside>
<section id="miTienda">
<? if($leaderBoard) : foreach($leaderBoard as $rowL):?>
<div id="banMitienda"><a id="promoPrin" class="upBan" href="#banLeadFoto"><img src="<?=base_url()?>assets/graphics/bannersPromocionales/thumbs/<?= $rowL->bannerImagen;?>" alt="Banner LeaderBoard <?= $rowInf->localNombre;?>" /></a></div>
<? endforeach; ?>
<? else:?>
<a  class="upBan" href="#banLeadFoto" ><img src="<?=base_url()?>assets/graphics/bannersPromocionales/sinbannerLead.png" alt="Promocion" /></a>
<? endif;?>
<?= $this->session->flashdata('msg'); ?>
<div id="editTit"><em>Tienda</em> <i class="locNom"><?= $rowInf->localNombre;?></i></div>
<ul id="infoLocal">
<li><i>Url en PT</i><p id="<? if($rowInf->localUrl == ''): echo 'locUrl'; endif;?>">http://www.plazadelatecnologia.com/<b><? if($rowInf->localUrl != ''): echo $rowInf->localUrl; else: echo 'editar'; endif;?></b></p></li>
<li><i>Agregar telefóno(s):</i><p id="locTel"><?= $rowInf->localTel;?></p></li>
<li><i>Editar email:</i><p id="locEmail"><?= $rowInf->email;?></p></li>
<li><i>Editar número de local:</i><p id="locNum"><?= $rowInf->localNum;?></p></li>
<li><i>Editar descripción de Local:</i><p id="locDes"><?= nl2br($rowInf->localDescripcion);?></p></li>
</ul>
<div id="proVenTie">
	<? foreach($localRama as $rowRama):?>
	<? $busqueda =  $this->milocal_model->cargarOfertaRama($rowRama->ramaID,$rowInf->localID);?>
	<h1 class="ml10"><?= $rowRama->ramaNombre;?></h1>
	<ul id="tusOfertas">
	  <? foreach($busqueda as $rowBus):?>
	  <li>
	    <strong><? if (!$rowBus->ofertaTitulo || $rowBus->ofertaStatus != 'Pendiente' || $rowBus->ofertaStatus != 'No Publicado'):?>* <?= character_limiter(($rowBus->ofertaTitulo),40);?><?else:?>Ver errores...<? endif;?></strong>
	   <a class="ofeImaTi" href="<?=base_url()?>mi_local/editarProducto/<?= $rowBus->ofertaID;?>/<?=$rowRama->ramaID?>"><img src="<?=base_url()?>ofertasLocatarios/<?= $rowBus->ofertaImagen;?>" alt="<?= character_limiter(($rowBus->ofertaTitulo),50);?>" /> 
	   <? if($rowBus->ofertaStatus == 'Pendiente' || $rowBus->ofertaStatus == 'No Publicado' ):?><span><img src="<?=base_url()?>assets/graphics/nopublicado.png" alt="No publicado" /></span><? endif;?></a>
	   <? if ($rowBus->ofertaPrecio != ''):?><b>$ <?= number_format($rowBus->ofertaPrecio);?></b><?else:?><p class="sinPrecio">Sin precio</p><? endif;?>
	    <a class="borOfeTi" title="Editar Producto" href="<?=base_url()?>mi_local/editarProducto/<?= $rowBus->ofertaID;?>/<?=$rowRama->ramaID?>"><span><img src="<?=base_url()?>assets/graphics/editarProducto.png" alt="Editar Oferta" /></span><em>Editar</em></a>
	   <a class="borOfeTi" href="<?=base_url()?>mi_local/borrarProducto/<?= $rowBus->ofertaID;?>"><span><img src="<?=base_url()?>assets/graphics/borrarOferta.png" alt="Borrar Oferta" /></span><em>Borrar</em></a>
	  </li>
	  <? endforeach; ?>
	  
	</ul>
	<? endforeach; ?>
	
	</div>
</section>
<? $this->load->view('includes/forms/uploadBoxBanners');?>
<? $this->load->view('includes/forms/uploadleaderboardBanners');?>
<? $this->load->view('includes/forms/uploadLogo');?>
</div>
<? endforeach; ?>