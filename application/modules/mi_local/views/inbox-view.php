<? $user  = $this->session->userdata('user');?>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#inboxLocal').dataTable();
	"bSort": false,
    "iDisplayLength": 25,
    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
});
</script>
<aside id="asideInb">
	<ul class="pFix">
		<? $this->load->view('includes/menus/menuLocal');?>
	</ul>
</aside>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Ultimos Mensajes Pendientes</h3>
	<div id="inboxMilocal">
		<div id="inbWrap">
		<? if ($inbox == FALSE):?>
		<p class="msgInb">No tienes correos pendientes en este momento</p>
		<? else:?>
		<table cellpadding="5" cellspacing="0" id="inboxLocal" >
	  	<thead>
			<tr>
			  <th>&nbsp;</th>
	          <th>Usuario</th>
	          <th>Pregunta</th>
	          <th>Dia</th>
	          <th>Hora</th>
	          <th>&nbsp;</th>
	        </tr>
		</thead>
	    <tbody id="det">
	    	<? foreach($inbox as $rowIn):?>
	    	<? $comentario 	= $this->milocal_model->cargarUltimoCom($rowIn->parentID);?>
	    	<? $comenUs 	= $this->milocal_model->cargarUltimoLoc($rowIn->parentID);?>
	    	<? $cuentaMsj	= $this->milocal_model->cargarCuentaMsg($user['uid'], $rowIn->parentID);?>
	    	<? foreach($comenUs as $rowLoc):?>
	    	<? foreach($cuentaMsj as $rowMsg):?>
	    	<? foreach($comentario as $rowCon):?>
		    <tr class="<?= $rowCon->estatus;?>">
		      <td><a class="red leido" href="<?=base_url()?>mi_local/lectura/<?= $rowCon->parentID;?>"><span><img src="<?=base_url()?>assets/graphics/<?= $rowIn->contactoTipo;?>Icon.png" alt="Comentario" /></span><? if($rowMsg->cuentaMsg != '0'):?> <em class="cuentaMsg"><?= $rowMsg->cuentaMsg;?></em><? endif?></a></td>
	          <td><a class="red leido" href="<?=base_url()?>mi_local/lectura/<?= $rowCon->parentID;?>"><? if($rowIn->userAlias == ''):?><?= $rowIn->userName;?> <?= $rowIn->lastName;?><? else:?><?= $rowIn->userAlias;?><? endif;?></a></td>
	          
	          <td><a class="red leido" href="<?=base_url()?>mi_local/lectura/<?= $rowCon->parentID;?>"><?= character_limiter(($rowLoc->contactoComentario),50);?></a></td>
	          
	          <td><a class="red leido" href="<?=base_url()?>mi_local/lectura/<?= $rowCon->parentID;?>"><?= convierteFechaBDLetra($rowIn->contactoFecha,2)?></a></td>
	          <td><a class="red leido" href="<?=base_url()?>mi_local/lectura/<?= $rowCon->parentID;?>">11:09:56</a></td>
	          <td><a class="red leido" href="<?=base_url()?>mi_local/borrado/<?= $rowCon->parentID;?>"><img src="<?=base_url()?>assets/graphics/borrarProducto.png" alt="Borrar Producto" /></a></td>
	        </tr>
	        <? endforeach; ?>
	        <? endforeach; ?>
	        <? endforeach; ?>
	        <? endforeach; ?>
	    </tbody>
		</table>
		<br class="clear">
		<? endif;?>
		<br class="clear">
		</div>
	</div>
</section>