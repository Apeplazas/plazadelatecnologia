<header>
<h1>Usuarios con intentos de compra<span>Enviar mail a usuarios con intento de compra</span></h1>
</header>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Enviar mail a usuarios con intento de compra</h3>
	<div id="panel">
		<? if ($intentosCompra == FALSE):?>
		<p class="msgInb">No tienes campañas activas</p>
		<? else:?>
		<table id="intentosTab" cellpadding="5" cellspacing="0" id="inboxLocal" >
	  	<thead>
			<tr>
			  <th class="Usuario">Usuario</th>
			  <th>Fecha de Compra</th>
			  <th>Producto</th>
			  <th>Nombre</th>
			  <th>Oferta</th>
			  <th>Status</th>
			  <th>Enviar Mail</th>
			</tr>
		</thead>
	    <tbody id="det">
	    	<? foreach($intentosCompra as $rowIntento):?>
			<tr class="<?= $rowIntento->status;?>">
		      <td id="name<?= $rowIntento->usuario;?>" class="Usuario"><?= $rowIntento->usuario;?></td>
		      <td id="fecha<?= $rowIntento->usuario;?>" class="dateInt"><?= $rowIntento->fechadeCompra;?></td>
		      <td id="producto<?= $rowIntento->usuario;?>" class="productoInt"><?= $rowIntento->producto;?></td>
		      <td id="nombre<?= $rowIntento->usuario;?>" class="nombreInt"><?= $rowIntento->usuarioNombre;?></td>
		      <td id="oferta<?= $rowIntento->usuario;?>"><?= $rowIntento->ofertaNombre;?></td>
		      <td id="status<?= $rowIntento->usuario;?>"><?= $rowIntento->status;?></td>
		      <td id="enviar<?= $rowIntento->usuario;?>" class="enviarMail"><a href="<?=base_url();?>hobbits/intentosComprasMail/<?= $rowIntento->producto;?>">Enviar mail</a></td>
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