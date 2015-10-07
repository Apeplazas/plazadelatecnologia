<? foreach($info as $rowInf):?>
<div id="wrapEdiTi">
<aside id="tienda">
<ul class="pFix">
<? $this->load->view('includes/menus/menuLocal');?>
</ul>
</aside>
<section id="infoVenta">
<h1 class="ml10">Información de venta</h1>
	<? foreach($ventas as $rowVen):?>
	<span class="imgOfeIma"><img src="<?=base_url()?>ofertasLocatarios/<?= $rowVen->ofertaImagen;?>" alt="<?= $rowVen->ofertaTitulo;?>" /></span>
	<div class="infoOferta">
		<a id="proVenReg" class="mb20 fleft" href="<?=base_url()?>mi_local/productosVendidos"><img src="<?=base_url()?>assets/graphics/Productos_Vendidos.png" alt="Productos Vendidos">Regresar a productos vendidos</a>
		<p><b class="folInf">Folio: <?= $rowVen->folio;?></b></p>
		<strong><em>Producto Vendido:</em><i><?= $rowVen->ofertaTitulo;?></i></strong>
		<p>Fecha de Compra: <?= $rowVen->fecha?></p>
		<p>Comprado por: <?= ucfirst($rowVen->userAlias);?> -> ( <?= ucfirst($rowVen->userName);?> <?= ucfirst($rowVen->lastName);?> )</p>
		<? $direccion = $this->data_model->cargarDireccion($rowVen->idSitio);?>
		<? foreach($direccion as $rowDir):?>
		<h1 class="ml10">Dirección de entrega</h1>
		<div id="direcWrap">
			<p><span>Entregar en:</span><i><?= $rowDir->titulo;?> Recibira <?= ucfirst($rowDir->recibe);?></i></p>
			<p><span>Direccion:</span><i><?= nl2br($rowDir->direccion);?></i></p>
			<p><span>Detalles de sitio de entrega:</span><i><?= nl2br($rowDir->detallesSitio);?></i></p>
			<? $nombreEstado = $this->data_model->cargarNombreEstado($rowDir->estado);?>
			<? foreach($nombreEstado as $rowE):?>
			<p><span>Estado:</span> <i><?= $rowE->Estado;?></i></p>
			<? endforeach; ?>
			<? $nombreMunicipio= $this->data_model->cargarNombreColonia($rowDir->colonia, $rowDir->estado);?>
			<? foreach($nombreMunicipio as $rowM):?>
			<p><span>Colonia:</span> <i><?= $rowM->Colonia?></i></p>
			<? endforeach; ?>
			<p><span>Codigo Postal:</span> <i><?= $rowDir->CodigoPostal;?></i></p>
			<p><span>Telefono:</span> <i><?= $rowDir->telefono;?></i></p>
		</div>
		<? endforeach; ?>
		
		<? if($rowVen->statusProducto != 'enProceso'):?>
		<p><a class="upCon narBotonBla mtb10" href="#guia">Confirmar envio a <?= ucfirst($rowVen->userAlias);?></a> <a class="nBotonBig mt10 ml20" href="<?=base_url()?>mi_local/envio/<?= $rowDir->usuarioID;?>/<?= $this->uri->segment(3);?>">Contáctar a <?= ucfirst($rowVen->userAlias);?></a></p>
		<? else:?>
		<i class="nBotonMed mtb10">Envio Confirmado</i>
		<? endif;?>
		<h1 class="ml10">Características de tu equipo.</h1>
		<p><b>Categoria</b><em><?= $rowVen->ramaNombre;?></em></p>
		<p><b>Marca</b><em><?= $rowVen->marca;?></em></p>
		<? foreach($catTipo as $rowCt):?>
		<? $descripcion = $this->ofertas_model->cargarBusquedaCat($rowVen->ofertaID, $rowCt->tipoID);?>
		<p><b><?= $rowCt->descripcion;?></b><em id="catOp<?= $rowCt->tipoID;?>"><? if ($descripcion) : foreach($descripcion as $rowDes):?><?= $rowDes->descripcion;?><? endforeach; ?><?else:?>Otros<?endif;?></em></p>
		<? endforeach; ?>
		<h1 class="ml10">Descripción personalizada.</h1>
		<p class="venDes mt10"><?= nl2br($rowVen->ofertaDescripcion);?></p>
		
	</div>
</section>
	<? endforeach; ?>
</div>
<? endforeach; ?>
<? $this->load->view('includes/forms/uploadGuia');?>