<header>
<h1>Seguimiento en renta de locales </h1>
</header>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Activación de productos para la campaña  </h3>
	<div id="panel">
		<? if ($infoLocales == FALSE):?>
		<p class="msgInb">No tienes campañas activas</p>
		<? else:?>
		<table id="rentLoc" class="rentadeloc tablesorter" cellpadding="5" cellspacing="0" id="inboxLocal" >
	  	<thead>
			<tr>
			  <th>Fecha y Hora</th>
			  <th class="name">Nombre</th>
			  <th>Email</th>
			  <th>Telefono o Celular</th>
			  <th>Estado</th>
			  <th>Comentario</th>
			  <th>Asignada a</th>
			  <th>Status</th>
			  <th>Borrar</th>
	        </tr>
		</thead>
	    <tbody id="det">
	    	<? foreach($infoLocales as $rowC):?>
			<tr class="<?= $rowC->status;?>">
			  <td id="fin<?= $rowC->contactoID;?>" class="dateRen"><?= $rowC->fecha;?></td>
		      <td id="name<?= $rowC->contactoID;?>" class="name"><?= $rowC->nombre;?></td>
		      <td id="des<?= $rowC->contactoID;?>"><?= $rowC->email;?></td>
		      <td id="url<?= $rowC->contactoID;?>"><?= $rowC->telefono;?> / <?= $rowC->celular;?></td>
		      <td id="inicio<?= $rowC->contactoID;?>" class="dateCam"><?= $rowC->estado;?> </td>
		      <td id="color<?= $rowC->contactoID;?>"><?= $rowC->comentario;?></td>
		      <td id="status<?= $rowC->contactoID;?>" class="statusRen"><?= $rowC->asignado;?></td>
		      <td id="stat<?= $rowC->contactoID;?>" class="stat"><?= $rowC->status;?></td>
		      <td class="borrarRent"><a href="<?=base_url()?>hobbits/borrarRentaLocal/<?= $rowC->contactoID;?>" title="Borrar Pregunta">Borrar</a></td>
		    </tr>
	        <? endforeach; ?>
	    </tbody>
		</table>
		<? endif;?>
	</div>
</section>
<script type="text/javascript">
jQuery(function($){
<? foreach($infoLocales as $rowP):?>	
	// Actualiza vendedor
	$("#status<?= $rowP->contactoID;?>").editInPlace({
		url: '<?=base_url()?>ajax/addVendedor/<?= $rowP->contactoID;?>',
		default_text: 'Asignar.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "Mario Castro, Luis de Jesus, Pedro de Jesus, Jupiter Alvarez, Patricia Espinoza, Juan Carlos Chavez, Alejandra Rodriguez, Claudia Miranda, Marlene Nikole, Jesus Salazar, Luis Enrique, Alejandro Reyes, Fabiola Ledesma, Oswaldo Miranda, Luis Ayil, Jaime Zamora, Cesar Mercado, Fermin Perez, Carlos Zavala, Adriana Garcia, Jorge Muñoz, Mauricio Mia, Miguel Angel Garcia, Fernando Valentin, Alvaro Grande, Elias Francisco, German Hernandez, Armando Hernandez, Aldo Fabian, Lesley Nava, Juan Torres, Carlos Sandoval, Juan Quiroga, Oscar Baltazar, Laura Yuriria Ramirez"
	});
	//actualiza Si rento o no 
	$("#stat<?= $rowP->contactoID;?>").editInPlace({
		url: '<?=base_url()?>ajax/updateStat/<?= $rowP->contactoID;?>',
		default_text: 'En espera.',
		bg_over: "#FFF1E2",
		field_type: "select",
		select_options: "Rentó, No rentó, En espera"
	});
<? endforeach; ?>
})
</script>
<script>
$(document).ready(function() {
    $('#rentLoc').dataTable( {
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

<? foreach($infoLocales as $rowB):?>
<form id="fotoBan<?= $rowB->contactoID;?>" class="share-popup dnone" method="post" action="<?=base_url() ?>hobbits/bannerCampania/<?= $rowB->contactoID;?>" enctype="multipart/form-data">
<span><img src="<?=base_url()?>assets/graphics/profile.png" alt="Agrega tu foto" /></span>
	<fieldset>
		<a class="iconoFoto" >
		<input id="userfile" class="subirFoto required" value="" type="file" size="35" name="userfile" />
		<em>Agrega tu foto, peso máximo 2 Megabytes. </em>
		</a>
	</fieldset>
    <input class="nBotonBigRig ml10 mt10" type="submit" value="Finalizar" />
</form>
<? endforeach; ?>