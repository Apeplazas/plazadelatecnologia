<script language="javascript" src="http://www.plazadelatecnologia.com/brayant/assets/js/jquery-1.9.1.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#inboxLocal').dataTable();
	"bSort": false,
    "iDisplayLength": 25,
    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
});
</script>
<? if ($inbox == FALSE):?>
	<p class="msgInb">No tienes correos pendientes en este momento</p>
	<? else:?>
	<table cellpadding="5" cellspacing="0" id="inboxLocal" >
		<thead>
		  <tr>
		    <th>&nbsp;</th>
		    <th>Tienda</th>
		    <th>Pregunta</th>
		    <th>Dia</th>
		    <th>Hora</th>
		    <th>&nbsp;</th>
		  </tr>
		</thead>
	<tbody id="det">
	<? foreach($inbox as $rowIn):?>	
	<tr class="<?= $rowIn->estatus;?>">
		<td><a class="red leido" href="<?=base_url()?>usuario/lectura/<?= $rowIn->parentID;?>"><span><img src="<?=base_url()?>assets/graphics/<?= $rowIn->contactoTipo;?>Icon.png" alt="Pregunta de oferta" /></span></a></td>
		<td><a class="red leido" href="<?=base_url()?>usuario/lectura/<?= $rowIn->parentID;?>"><? if($rowIn->userAlias == ''):?><?= $rowIn->userName;?> <? else:?><?= $rowIn->userAlias;?><? endif;?></a></td>
		<td><a class="red leido" href="<?=base_url()?>usuario/lectura/<?= $rowIn->parentID;?>"><?= character_limiter(($rowIn->contactoComentario),50);?></a></td>
		<td><a class="red leido" href="<?=base_url()?>usuario/lectura/<?= $rowIn->parentID;?>"><?= convierteFechaBDLetra($rowIn->contactoFecha,2)?></a></td>
		<td><a class="red leido" href="<?=base_url()?>usuario/lectura/<?= $rowIn->parentID;?>">11:09:56</a></td>
		<td><a class="red leido" href="<?=base_url()?>usuario/borrado/<?= $rowIn->parentID;?>"><img src="<?=base_url()?>assets/graphics/borrarProducto.png" alt="Borrar Producto" /></a></td>
	</tr>
	<? endforeach; ?>        
    </tbody>
	</table>
	<br class="clear">
	<? endif;?>
	<br class="clear">
