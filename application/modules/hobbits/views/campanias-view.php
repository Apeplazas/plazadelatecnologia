<header>
<h1>Estrategia de campañas ecommerce<span>Agregar, Editar y Borrado de Ofertas</span></h1>
</header>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Activación de productos para la campaña  </h3>
	<div id="panel">
		<? if ($campanias == FALSE):?>
		<p class="msgInb">No tienes campañas activas</p>
		<? else:?>
		<table cellpadding="5" cellspacing="0" id="inboxLocal" >
	  	<thead>
			<tr>
			  <th class="name">Nombre</th>
			  <th>Descripcion</th>
			  <th>Campania Url</th>
			  <th>Inicia</th>
			  <th>Finaliza</th>
			  <th>Banner</th>
			  <th>Color</th>
			  <th>Status</th>
			  <th>Ofertas</th>
	        </tr>
		</thead>
	    <tbody id="det">
	    	<? foreach($campanias as $rowC):?>
			<tr class="<?= $rowC->status;?>">
		      <td id="name<?= $rowC->campaniaID;?>" class="name"><?= $rowC->campaniaNombre;?></td>
		      <td id="des<?= $rowC->campaniaID;?>"><?= $rowC->campaniaDescripcion;?></td>
		      <td id="url<?= $rowC->campaniaID;?>"><?= $rowC->campaniaUrl;?></td>
		      <td id="inicio<?= $rowC->campaniaID;?>" class="dateCam"><?= $rowC->fechaInicio;?></td>
		      <td id="fin<?= $rowC->campaniaID;?>" class="dateCam"><?= $rowC->fechaFin;?></td>
		      <td><a class="log fotoCam" href="#fotoBan<?= $rowC->campaniaID;?>"><? if($rowC->bannerImagen == ''):?>Agregar Promo Slider (+)<?else:?><?=$rowC->bannerImagen?><? endif;?></a></td>
		      <td id="color<?= $rowC->campaniaID;?>"><?= $rowC->colorPromocion;?></td>
		      <td id="status<?= $rowC->campaniaID;?>" class="statusCam"><?= $rowC->status;?></td>
		      <td><a class="addProOfe" href="<?=base_url()?>hobbits/agregarOfertasCampania/<?= $rowC->campaniaID;?>">(+) Agregar Productos</a></td>
		    </tr>
	        <? endforeach; ?>
	    </tbody>
		</table>
		<? endif;?>
		<a class="agregaCam" href="<?=base_url()?>hobbits/agregaCampanias"><img src="<?=base_url()?>assets/graphics/agregarCat.png" alt="Agregar campaña"> <span>Agregar Campaña</span></a>
	</div>
</section>
<script type="text/javascript">
jQuery(function($){
<? foreach($campanias as $rowP):?>	
	// Actualiza status
	$("#status<?= $rowP->campaniaID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editStatusCampanias/<?= $rowP->campaniaID;?>',
		default_text: 'Cambia el status.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "activa, desactivada, borrada"
	});
	
	//actualiza Nombre
	$("#name<?= $rowP->campaniaID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editNameCam/<?= $rowP->campaniaID;?>',
		default_text: 'Agrega o edita el nombre de tu campaña.',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "2",
		show_buttons: false,
	});
	
	//actualiza Descripcion
	$("#des<?= $rowP->campaniaID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editDescripcionCam/<?= $rowP->campaniaID;?>',
		default_text: 'Agrega o edita la descripcion..',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "2",
		show_buttons: false,
	});
	
	//actualiza Url
	$("#url<?= $rowP->campaniaID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editUrlCam/<?= $rowP->campaniaID;?>',
		default_text: 'Agrega o edita el Url.',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "2",
		show_buttons: false,
	});
	
	//actualiza Fecha en que inicia
	$("#inicio<?= $rowP->campaniaID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editInicioCam/<?= $rowP->campaniaID;?>',
		default_text: 'Agrega o edita fecha Inicio.',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "2",
		show_buttons: false,
	});
	
	//actualiza Fecha en que inicia
	$("#fin<?= $rowP->campaniaID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editFinCam/<?= $rowP->campaniaID;?>',
		default_text: 'Agrega o edita fecha Inicio.',
		bg_over: "#FFF1E2",
		field_type: "textarea",
		textarea_rows: "2",
		show_buttons: false,
	});
	
	// Actualiza status
	$("#color<?= $rowP->campaniaID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editColorCampanias/<?= $rowP->campaniaID;?>',
		default_text: 'Cambia el status.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "blue, yellow, green"
	});
<? endforeach; ?>
})
</script>

<? foreach($campanias as $rowB):?>
<form id="fotoBan<?= $rowB->campaniaID;?>" class="share-popup dnone" method="post" action="<?=base_url() ?>hobbits/bannerCampania/<?= $rowB->campaniaID;?>" enctype="multipart/form-data">
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