<header>
<h1>Estrategia de campañas emails<span>Agregar, Editar y Borrado de Emails</span></h1>
</header>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Activación de Emails para campañas</h3>
	<div id="panel">
		<? if ($mails == FALSE):?>
		<p class="msgInb">No tienes campañas activas</p>
		<? else:?>
		<a class="agregaCam" href="<?=base_url()?>hobbits/agregaMails"><img src="<?=base_url()?>assets/graphics/agregarCat.png" alt="Agregar campaña"> <span>Agregar Mail</span></a>
		<table cellpadding="5" cellspacing="0" id="inboxLocal" >
	  	<thead>
			<tr>
			  <th class="name">Nombre</th>
			  <th>Fecha</th>
			  <th>Estatus</th>
			  <th>Imagen</th>
			  <th>Url</th>
			  <th>Url Activo</th>
			  <th>Ver</th>
			</tr>
		</thead>
	    <tbody id="det">
	    	<? foreach($mails as $rowM):?>
			<tr class="<?= $rowM->Status;?>">
		      <td id="name<?= $rowM->mailID;?>" class="name"><?= $rowM->nombreMail;?></td>
		      <td id="fecha<?= $rowM->mailID;?>" class="dateCam"><?= $rowM->Fecha;?></td>
		      <td id="status<?= $rowM->mailID;?>" class="statusCam"><?= $rowM->Status;?></td>
		      <td><a class="log fotoCam" href="#fotoBan<?= $rowM->mailID;?>"><? if($rowM->Imagen == ''):?>Agregar Promo Slider (+)<?else:?><?=$rowM->Imagen?><? endif;?></a></td>
		      <td id="url<?= $rowM->mailID;?>"><?= $rowM->Url;?></td>
		      <td id="urlActivo<?= $rowM->mailID;?>"><?= $rowM->UrlActivo;?></td>
		      <td id="ref<?= $rowM->mailID;?>" class="dateCam"><a href="<?=base_url();?>boletin/mailing/<?= $rowM->mailID;?>" target="_blank">Ver mail</a></td>
		  	</tr>
	        <? endforeach; ?>
	    </tbody>
		</table>
		<? endif;?>
	</div>
</section>

<script type="text/javascript">
jQuery(function($){
<? foreach($mails as $rowP):?>	
	// Actualiza status
	$("#status<?= $rowP->mailID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editStatusMail/<?= $rowP->mailID;?>',
		default_text: 'Cambia el status.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "Activado, Desactivado"
	});
	
	//actualiza Nombre
	$("#name<?= $rowP->mailID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editNameEma/<?= $rowP->mailID;?>',
		default_text: 'Agrega o edita el nombre de tu campaña.',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "2",
		show_buttons: false,
	});
	
	//actualiza Url
	$("#url<?= $rowP->mailID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editUrlMail/<?= $rowP->mailID;?>',
		default_text: 'Agrega o edita el Url.',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "2",
		show_buttons: false,
	});
	
	//actualiza Fecha en que inicia
	$("#fecha<?= $rowP->mailID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editFechaMail/<?= $rowP->mailID;?>',
		default_text: 'Agrega o edita fecha Inicio.',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "2",
		show_buttons: false,
	});
	
	// Actualiza status
	$("#urlActivo<?= $rowP->mailID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editUrlActivo/<?= $rowP->mailID;?>',
		default_text: 'Cambia el status.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "si, no"
	});
<? endforeach; ?>
})
</script>

<? foreach($mails as $rowB):?>
<form id="fotoBan<?= $rowB->mailID;?>" class="share-popup dnone" method="post" action="<?=base_url() ?>hobbits/mailImagen/<?= $rowB->mailID;?>" enctype="multipart/form-data">
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