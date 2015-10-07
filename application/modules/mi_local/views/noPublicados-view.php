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

	<? if ($nopublicados):?>
	<h1 class="ml10">Productos pendientes por publicar</h1>
	<ul>
	  <? foreach($nopublicados as $rowPub):?>
	  <li>
	  <strong><? if ($rowPub->ofertaStatus == 'Pendiente' || $rowPub->ofertaStatus == 'No Publicado'):?>Falta información, verificala <br>da click en editar<? else:?><?= character_limiter(($rowPub->ofertaTitulo),40);?><? endif;?></strong>
	    <a class="ofeImaTi" href="<?=base_url()?>mi_local/editarProducto/<?= $rowPub->ofertaID;?>/<?=$rowPub->ramaID?>"><img src="<?=base_url()?>ofertasLocatarios/<?= $rowPub->ofertaImagen;?>" alt="<?= character_limiter(($rowPub->ofertaTitulo),50);?>" /> <? if($rowPub->ofertaStatus == 'Pendiente'):?><? endif;?></a>
	    
	   <? if ($rowPub->ofertaPrecio != ''):?><b>$ <?= $rowPub->ofertaPrecio;?></b><?else:?><p class="sinPrecio">Sin precio</p><? endif;?>
		  <a class="borOfeTi" title="Editar Producto" href="<?=base_url()?>mi_local/editarProducto/<?= $rowPub->ofertaID;?>/<?=$rowPub->ramaID?>"><span><img src="<?=base_url()?>assets/graphics/editarProducto.png" alt="Editar Oferta" /></span><em>Editar</em></a>
		  <a class="borOfeTi" href="<?=base_url()?>mi_local/borrarProducto/<?= $rowPub->ofertaID;?>/<?=$this->uri->segment(2);?>"><span><img src="<?=base_url()?>assets/graphics/borrarOferta.png" alt="Borrar Oferta" /></span><em>Borrar</em></a>
	  </li>
	  <? endforeach; ?>
	</ul>
	<? else:?>
	<h1>Todos tus productos y ofertas se estan publicando.</h1>
	<? endif;?>
</div>
</section>
</div>
<? endforeach; ?>