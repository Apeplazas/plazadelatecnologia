<header>
<h1>Hitorial de Busquedas<span>Vista de lo mas buscado en la pagina web de Plaza de la Tecnología.</span></h1>
</header>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Periodo de 2014-<?=date('m')?>-01 al dia de hoy.</h3>
	<div id="panel">
		<table id="intentosTab" cellpadding="5" cellspacing="0" id="inboxLocal" >
	  	<thead>
			<tr>
			  <th>Texto</th>
			  <th>Veces</th>
			  <th>Resultados</th>
			  <th>Acciones</th>
			  <th>Fecha de acción</th>
			</tr>
		</thead>
	    <tbody id="det">
	    	<? foreach($historial as $palabra):?>
	    	<? $resultados = $this->hobbits_model->resultadosDevuelve($palabra->busquedaTexto);?>
	    	<? $accion = $this->hobbits_model->accionesBusq($palabra->busquedaTexto);?>
			<tr>
		      <td><?= $palabra->busquedaTexto;?></td>
		      <td><?= $palabra->veces;?></td>
		      <td><?= $resultados[0]->numRes;?></td>
		      <td><? if(isset($accion[0])){ echo $accion[0]->accion;}else{echo'<a class="ingAccion" href="#accion" alt="'.$palabra->busquedaTexto.'">Agregar acción</a>';}?></td>
		      <td><? if(isset($accion[0])){ echo $accion[0]->fechaAccion;}?></td>
		    </tr>
	        <? endforeach; ?>
	    </tbody>
		</table>
	</div>
</section>
<? $this->load->view('includes/forms/ingresaAccion');?>
<script>
$(document).ready(function() {
    $('#intentosTab').dataTable( {
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "aaSorting": [ [1,'desc'] ],
        "bSort": true,
        "bInfo": false,
        "bAutoWidth": false
    } );
} ); 
</script>
