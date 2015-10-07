<header>
<h1>Solicitud de traspasos<span>Enviar mail a locatarios para confirmación de solicitud de traspaso</span></h1>
</header>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Enviar mail de confirmación de solicitud de trasapaso</h3>
	<div id="panel">
		<table id="intentosTab" cellpadding="5" cellspacing="0" id="inboxLocal" >
	  	<thead>
			<tr>
			  <th>ID</th>
			  <th>Usuario</th>
			  <th>Email</th>
			  <th>Teléfono</th>
			  <th>Estado</th>
			  <th>Fecha y Hora</th>
			  <th>Detalle</th>
			  <th>Estatus</th>
			  <th>Mail de seguimiento</th>
			  <th>Comentarios Administrador</th>
			</tr>
		</thead>
	    <tbody id="det">
	    	<? foreach($historial as $peticionItem):?>
			<tr>
		      <td><?= $peticionItem->peticionID;?></td>
		      <td><?= $peticionItem->nombreUsuario;?></td>
		      <td><?= $peticionItem->emailUsuario;?></td>
		      <td><?= $peticionItem->telUsuario;?></td>
		      <td><?= $peticionItem->estado;?></td>
		      <td><?= $peticionItem->fechaAlta;?> a las <?= $peticionItem->horaAlta;?></td>
		      <td><?= $peticionItem->detalle;?></td>
		      <td><a class="statusPet" href="#peticion" alt="<?= $peticionItem->peticionID;?>" title="<?= $peticionItem->estatus;?>"><?= $peticionItem->estatus;?></a></td>
		      <td><a class="statusPet" href="<?=base_url()?>hobbits/enviarMail/<?= $peticionItem->peticionID;?>">Enviar Email</a></td>
		      <td><?= $peticionItem->comentariosAdmin;?></td>
		  	</tr>
	        <? endforeach; ?>
	    </tbody>
		</table>
	</div>
</section>
<? $this->load->view('includes/forms/estatusPeticion');?>
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
