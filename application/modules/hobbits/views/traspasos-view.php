<header>
<h1>Solicitud de traspasos<span>Enviar mail a locatarios para confirmación de solicitud de traspaso</span></h1>
</header>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Enviar mail de confirmación de solicitud de trasapaso</h3>
	<div id="panel">
		<? if (count($traspasoSolicitud) == 0):?>
		<p class="msgInb">No hay solicitudes de traspaso</p>
		<? else:?>
		<table id="intentosTab" cellpadding="5" cellspacing="0" id="inboxLocal" >
	  	<thead>
			<tr>
			  <th>Folio</th>
			  <th>Fecha de Solicitud</th>
			  <th>Monto</th>
			  <th>Nombre de Solicitante</th>
			  <th>Mail</th>
			  <th>Confirmar</th>
			</tr>
		</thead>
	    <tbody id="det">
	    	<? foreach($traspasoSolicitud as $rowTraspaso):?>
			<tr class="<?= $rowTraspaso->status;?>">
		      <td id="name<?= $rowTraspaso->folio;?>" class="Usuario"><?= $rowTraspaso->folio;?></td>
		      <td id="fecha<?= $rowTraspaso->folio;?>" class="dateInt"><?= $rowTraspaso->fecha;?></td>
		      <td id="nombre<?= $rowTraspaso->folio;?>" class="nombreInt">$ <?= $rowTraspaso->monto;?></td>
		      <td id="oferta<?= $rowTraspaso->folio;?>"><?= $rowTraspaso->nombre;?></td>
		      <td id="status<?= $rowTraspaso->folio;?>"><?= $rowTraspaso->email;?></td>
		      <td id="enviar<?= $rowTraspaso->folio;?>" class="confirmar"><a href="<?=base_url();?>hobbits/confirmarTraspaso/<?= $rowTraspaso->folio;?>">Confirmar traspaso</a></td>
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