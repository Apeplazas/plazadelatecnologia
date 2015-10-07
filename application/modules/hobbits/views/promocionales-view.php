<header>
<h1>Estrategia de campañas ecommerce<span>Agregar, Editar y Borrado de Ofertas</span></h1>
</header>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Activación de productos para la campaña  </h3>
	<div id="panel">
		<? if ($promocionales == FALSE):?>
		<p class="msgInb">No tienes banners activos en este momento.</p>
		<? else:?>
	  	<ul id="desBan">
	  	<? foreach($promocionales as $rowC):?>
	  	  <li>
	  	  	<span class="bName"><em>Campaña:</em> <i id="name<?= $rowC->publicidadID;?>"><?= $rowC->bannerTitulo;?></i> <a class="abCe" href="#" onclick="$('#bbottomC<?=$rowC->publicidadID?>').toggle(); return false;">Abrir / Cerrar</a></span>
	  	  	<div id="bbottomC<?=$rowC->publicidadID?>" class="bbottomC dnone">
	  	  	<span class="bVigencia"><em>Vigencia:</em><i id="vig<?= $rowC->publicidadID;?>"><?= $rowC->bannerVigencia;?></i></span>
	  	  	<span class="bStatus"><em>Status:</em><i id="statPub<?= $rowC->publicidadID;?>"><?= $rowC->bannerStatus;?></i></span>
	  	  	<span class="bUrlSend"><em>Enlace:</em><i id="enlPub<?= $rowC->publicidadID;?>"><?= $rowC->bannerUrl;?></i></span>
	  	  	<? $u =  $this->hobbits_model->buscaUrlBanners($rowC->publicidadID);?>
	  	  	<? foreach($u as $rowU):?>
	  	  	<span class="bEnlace<?= $rowU->enlaceID;?><?= $rowC->publicidadID;?>">
	  	  	  <em>Url:</em>
	  	  	  <i class="ajax<?= $rowU->enlaceID;?><?= $rowC->publicidadID;?>" id="enl<?= $rowU->enlaceID;?>"> <div class="ajaxDel"><?= $rowU->paginaUrl;?></div></i>
	  	  	  
	  	  	  <a class="delEnl<?= $rowU->enlaceID;?><?= $rowC->publicidadID;?>" title="Borrar Url de Campaña" href="<?=base_url()?>hobbits/borrarUrlBanners/<?= $rowC->publicidadID;?>/<?= $rowU->enlaceID;?>">Borrar</a>
	  	  	  
	  	  	  <!---- Ejecuta y funcion y Borra div por ID ---->
				<script type="text/javascript">
				$(document).ready(function(){
					$(function(){
						$('.delEnl<?= $rowU->enlaceID;?><?= $rowC->publicidadID;?>').click(function(event){
						event.preventDefault();						$(this).parent().after('<span class="bEnlace"></span>');
						$(this).parent().next().html('<div class="fleftComplete center"><img src="<?=base_url(); ?>assets/graphics/loading.png" /></div>').load($(this).attr('href'));
						$('.bEnlace<?= $rowU->enlaceID;?><?= $rowC->publicidadID;?>').remove();
						})	
					})
				});	
				</script>
	  	  	</span>
	  	  	<? endforeach; ?>
	  	  	<span id="<?= $rowC->publicidadID;?>" class="dnone"><i class="bckyellow" id="urlPub<?= $rowC->publicidadID;?>">Escoge una url</i></span>
	  	  	<a class="agregaUrl" onclick="$('#<?= $rowC->publicidadID;?>').toggle(); return false;" href="#"><img src="http://www.plazadelatecnologia.com/assets/graphics/agregarCat.png" alt="Agregar promocion"> <b>Agregar Url</b></a>
		    <? foreach($bannerTipos as $row):?>
		    <? $b =  $this->hobbits_model->cargarBannerInventario($rowC->publicidadID, $row->bannerTipoID);?>
	        <span><i><?= $row->bannerTipo;?></i>
	        <? if($b != 1) : foreach($b as $rowB):?> 
	        <p><?= $rowB->bannerImagen;?></p>
	        <form class="delBa" action="<?=base_url()?>hobbits/borrarBanner" method="post">
		        <input type="hidden" name="bannerID" value="<?= $rowB->bannerID;?>" />
		        <input type="submit" class="deleteBanner"/>
	        </form>
		   <? endforeach; ?>
		   <? else:?>
		   <a href="#" onclick="$('#display<?=$rowC->publicidadID?><?=$row->bannerTipoID?>').toggle(); return false;">Agregar (+)</a>
		   <form class="dnone foBan" id="display<?=$rowC->publicidadID?><?=$row->bannerTipoID?>"  action="<?=base_url()?>hobbits/agregarBanner" method="post" enctype="multipart/form-data">
		   <fieldset>
		   <a class="iconoFotoBanner" >
		     <input id="userfile" class="subirFotoBanner required" value="" type="file" size="35" name="userfile" />
		     <input class="nBotonBigBan" type="submit" value="Finalizar" />
		   </a>
		   </fieldset>
		     <input type="hidden" name="publicidadID" value="<?= $rowC->publicidadID;?>" />
		     <input type="hidden" name="bannerTipoID" value="<?= $row->bannerTipoID;?>" />
		   </form>
		   <? endif;?>
	        </span>
	      <? endforeach; ?>
	      </div>
		  </li>
	      <? endforeach; ?>
		</ul>
		<? endif;?>
		<a class="agregaCam" href="<?=base_url()?>hobbits/agregarPromocion"><img src="<?=base_url()?>assets/graphics/agregarCat.png" alt="Agregar promocion"> <span>Agregar Promoción</span></a>
	</div>
</section>
<script type="text/javascript">
$(document).ready(function() {
    $("#desBan").find("li:even").addClass("oddBan");
});
</script>

<script type="text/javascript">
jQuery(function($){
<? foreach($promocionales as $rowP):?>	
	// Actualiza Titulo Publicidad
	$("#name<?= $rowP->publicidadID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editPubliTitulo/<?= $rowP->publicidadID;?>',
		default_text: 'Cambia el status.',
		field_type: "textarea",
		bg_over: "#FFF1E2",
	});
	
	// Actualiza vigencia
	$("#vig<?= $rowP->publicidadID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editPubliVig/<?= $rowP->publicidadID;?>',
		default_text: 'YYYY-MM-DD.',
		field_type: "textarea",
		bg_over: "#FFF1E2",
	});
	
	// Actualiza status
	$("#statPub<?= $rowP->publicidadID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editPubliStat/<?= $rowP->publicidadID;?>',
		default_text: 'Cambia el status.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "Desactivado, Activado, Borrado"
	});
	
	// Actualiza Url Publicidad
	$("#urlPub<?= $rowP->publicidadID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editPubliUrl/<?= $rowP->publicidadID;?>',
		default_text: 'Cambia el Url.',
		field_type: "select",
		bg_over: "#FFF1E2",
		select_options: "<? foreach($enlaces as $rowE):?><?= $rowE->paginaUrl;?>,<? endforeach; ?>"
	});
	
	// Actualiza Url Publicidad
	$("#enlPub<?= $rowP->publicidadID;?>").editInPlace({
		url: '<?=base_url()?>ajax/editEnl/<?= $rowP->publicidadID;?>',
		default_text: 'Cambia el Url.',
		field_type: "textarea",
		bg_over: "#FFF1E2",
	});
	
<? endforeach; ?>
})
</script>

<? foreach($promocionales as $rowB):?>
<form id="fotoBan<?= $rowB->publicidadID;?>" class="share-popup dnone" method="post" action="<?=base_url() ?>hobbits/bannerCampania/<?= $rowB->publicidadID;?>" enctype="multipart/form-data">
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
