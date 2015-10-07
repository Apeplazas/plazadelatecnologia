<header>
<h1>Confirmación de pago<span>Confirmar pago del cliente</span></h1>
</header>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Confirma el pago que realizo el cliente despues de la compra</h3>
	<div id="panel">
		<? if ($confirmacionPago == FALSE):?>
		<p class="msgInb">No hay solicitudes de traspaso</p>
		<? else:?>
		<table id="intentosTab" cellpadding="5" cellspacing="0" id="inboxLocal" >
	  	<thead>
			<tr>
			  <th>ID de oferta</th>
			  <th>Folio de Compra</th>
			  <th>Monto de compra</th>
			  <th>Fecha de compra de producto</th>
			  <th>Status de pago compra</th>
			  <th>Confirmar</th>
			</tr>
		</thead>
	    <tbody id="det">
	    	<? foreach($confirmacionPago as $rowConfirm):?>
			<tr class="<?= $rowConfirm->productoID;?>">
		      <td id="name<?= $rowConfirm->productoID;?>" class="Usuario"><?= $rowConfirm->ofertaID;?></td>
		      <td id="fecha<?= $rowConfirm->productoID;?>" class="dateInt"><?= $rowConfirm->folioCompra;?></td>
		      <td id="nombre<?= $rowConfirm->productoID;?>" class="nombreInt">$ <?= $rowConfirm->monto;?></td>
		      <td id="oferta<?= $rowConfirm->productoID;?>"><?= $rowConfirm->fechaCompra;?></td>
		      <td id="status<?= $rowConfirm->productoID;?>"><?= $rowConfirm->statusCompra;?></td>
		      <td id="enviar<?= $rowConfirm->productoID;?>" class="confirmar"><a href="<?=base_url();?>hobbits/confirmarCompra/<?= $rowConfirm->folioCompra;?>">Confirmar a locatario</a></td>
		  	</tr>
	        <? endforeach; ?>
	    </tbody>
		</table>
		<? endif;?>
	</div>
</section>
<script>
$(document).ready(function() {
    $('#intentosTab').dataTable( {
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "aaSorting": [ [0,'desc'] ],
        "bSort": true,
        "bInfo": false,
        "bAutoWidth": false
    } );
} ); 
</script>