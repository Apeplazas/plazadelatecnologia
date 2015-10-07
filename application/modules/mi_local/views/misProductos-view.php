<? foreach($info as $rowInf):?>
<div id="wrapEdiTi">
<aside id="tienda">
<ul class="pFix">
<? $this->load->view('includes/menus/menuLocal');?>
</ul>
</aside>
<section id="miTienda">
<?= $this->session->flashdata('msg'); ?>
<div id="proVenTiePen">
	<? foreach($localRama as $rowRama):?>
	<? $busqueda =  $this->milocal_model->cargarOfertaRama($rowRama->ramaID,$rowInf->localID);?>
	<h1 class="ml10"><?= $rowRama->ramaNombre;?></h1>
	<ul id="tusOfertas">
	  <? foreach($busqueda as $rowBus):?>
	  <li>
	    <strong><? if ($rowBus->ofertaStatus == 'Activo'):?>* <?= character_limiter(($rowBus->ofertaTitulo),40);?><?else:?>Ver errores...<? endif;?></strong>
	   <a class="ofeImaTi" 
	   <? if(($rowBus->cantidadInicial - $rowBus->existencia) != '0'):?> 
	   href="<?=base_url()?><?= strtolower($rowRama->ramaNombre);?>/<?= url_title($rowBus->ofertaTitulo, '_');?>/<?= $rowBus->ofertaID;?>
	   <? else:?>href="<?=base_url()?>mi_local/editarProducto/<?= $rowBus->ofertaID;?>/<?=$rowRama->ramaID?>"
	   <?endif;?> 
	   
	   <? $vendidos =  $this->milocal_model->cuentaVentasporOferta($rowBus->ofertaID);?>
	   
	   "><img src="<?=base_url()?>ofertasLocatarios/<?= $rowBus->ofertaImagen;?>" alt="<?= character_limiter(($rowBus->ofertaTitulo),50);?>" /> <? if($rowBus->ofertaStatus == 'Pendiente'):?><span><img src="<?=base_url()?>assets/graphics/nopublicado.png" alt="No publicado" /></span><? endif;?></a>
	   <? if ($rowBus->ofertaPrecio != ''):?><b>$ <?= number_format($rowBus->ofertaPrecio);?></b><?else:?><p class="sinPrecio">Sin precio</p><? endif;?>
	   <p><em><?= $vendidos[0]->Cuenta;?></em><i>Vendidos</i></p>
	   <p><em><?= $rowBus->existencia;?></em><i>Inventario</i></p>
	   <a class="borOfeTi" title="Editar Producto" href="<?=base_url()?>mi_local/editarProducto/<?= $rowBus->ofertaID;?>/<?=$rowRama->ramaID?>"><span><img src="<?=base_url()?>assets/graphics/editarProducto.png" alt="Editar Oferta" /></span><em>Editar</em></a>
	   <a class="borOfeTi" href="<?=base_url()?>mi_local/borrarProducto/<?= $rowBus->ofertaID;?>/<?=$this->uri->segment(2);?>"><span><img src="<?=base_url()?>assets/graphics/borrarOferta.png" alt="Borrar Oferta" /></span><em>Borrar</em></a>
	  </li>
	  <? endforeach; ?>
	</ul>
	<? endforeach; ?>
	
	</div>
</section>
</div>
<? endforeach; ?>