<header>
<h1>Estrategia de campañas emails<span>Agregar, Editar y Borrado de Emails</span></h1>
</header>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Activación de Emails para campañas</h3>
	<div id="panel">
		<? if ($comunicados == FALSE):?>
		<p class="msgInb">No tienes campañas activas</p>
		<? else:?>
		<table cellpadding="5" cellspacing="0" id="inboxLocal" >
	  	<thead>
			<tr>
			  <th class="name">Nombre</th>
			  <th>Descripción</th>
			  <th>Fecha</th>
			  <th>Imagen</th>
			  <th>Url</th>
			  <th>Url Activo</th>
			  <th>Ver</th>
			</tr>
		</thead>
	    <tbody id="det">
	    	<? foreach($comunicados as $rowC):?>
			<tr class="Activo">
		      <td id="name<?= $rowC->comunicadoID;?>" class="name"><?= $rowC->Titulo;?></td>
		      <td id="desc<?= $rowC->comunicadoID;?>" class="dateCam"><?=character_limiter(nl2br($rowC->Descripcion),150);?></td>
		      <td id="fecha<?= $rowC->comunicadoID;?>" class="dateCam"><?= $rowC->Fecha;?></td>
		      <td><a class="log fotoCam" href="#fotoBan<?= $rowC->comunicadoID;?>"><? if($rowC->comunicadoImagen == ''):?>Agregar Imagen (+)<?else:?><?=$rowC->comunicadoImagen?><? endif;?></a></td>
		      <td id="url<?= $rowC->comunicadoID;?>"><?= $rowC->Url;?></td>
		      <td id="urlActivo<?= $rowC->comunicadoID;?>"><?= $rowC->urlActivo;?></td>
		      <td id="ref<?= $rowC->comunicadoID;?>" class="dateCam"><a href="<?=base_url();?>boletin/comunicados/<?= $rowC->comunicadoID;?>" target="_blank">Ver mail</a></td>
		  	</tr>
	        <? endforeach; ?>
	    </tbody>
		</table>
		<? endif;?>
		<a class="agregaCam" href="<?=base_url()?>hobbits/agregaComunicado"><img src="<?=base_url()?>assets/graphics/agregarCat.png" alt="Agregar campaña"> <span>Agregar Mail</span></a>
	</div>
</section>

<script type="text/javascript">
jQuery(function($){
<? foreach($comunicados as $rowP):?>	
	// Actualiza status
	$("#status<?= $rowP->comunicadoID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editStatusMail/<?= $rowP->comunicadoID;?>',
		default_text: 'Cambia el status.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "Activado, Desactivado"
	});
	
	//actualiza Nombre
	$("#name<?= $rowP->comunicadoID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editNameCom/<?= $rowP->comunicadoID;?>',
		default_text: 'Agrega o edita el nombre de tu campaña.',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "2",
		show_buttons: false,
	});
	
	//actualiza Descripción
	$("#desc<?= $rowP->comunicadoID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editDescCom/<?= $rowP->comunicadoID;?>',
		default_text: 'Agrega o edita el nombre de tu campaña.',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "2",
		show_buttons: false,
	});
	
	//actualiza Url
	$("#url<?= $rowP->comunicadoID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editUrlCom/<?= $rowP->comunicadoID;?>',
		default_text: 'Agrega o edita el Url.',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "2",
		show_buttons: false,
	});
	
	//actualiza Fecha en que inicia
	$("#fecha<?= $rowP->comunicadoID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editFechaCom/<?= $rowP->comunicadoID;?>',
		default_text: 'Agrega o edita fecha Inicio.',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "2",
		show_buttons: false,
	});
	
	// Actualiza status
	$("#urlActivo<?= $rowP->comunicadoID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editUrlActivoCom/<?= $rowP->comunicadoID;?>',
		default_text: 'Cambia el status.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "si, no"
	});
<? endforeach; ?>
})
</script>

<? foreach($comunicados as $rowB):?>
<form id="fotoBan<?= $rowB->comunicadoID;?>" class="share-popup dnone" method="post" action="<?=base_url() ?>hobbits/comunicadoImagen/<?= $rowB->comunicadoID;?>" enctype="multipart/form-data">
<span><img src="<?=base_url()?>assets/graphics/profile.png" alt="Agrega tu foto" /></span>
	<fieldset>
		<a class="iconoFoto" >
		<input id="userfile" class="subirFoto required" value="" type="file" size="35" name="userfile" />
		<em>Agrega tu foto, medidas de 670 x 380 pixeles. </em>
		</a>
	</fieldset>
    <input class="nBotonBigRig ml10 mt10" type="submit" value="Finalizar" />
</form>
<? endforeach; ?>