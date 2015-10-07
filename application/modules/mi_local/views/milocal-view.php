<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
    $('#inboxLocal').dataTable( {
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "bAutoWidth": false
    });
});
</script>
<ul class="pFix">
<? $this->load->view('includes/menus/menuLocal');?>
</ul>
<section id="milocalPanel">
	<h3>Ultimos Mensajes Pendientes</h3>
	<div id="inboxMilocal">
		<div id="inbWrap">
		<? if ($inbox == FALSE):?>
		<p class="msgInb">No tenemos correos pendientes en este momento</p>
		<? else:?>
		
		<table cellpadding="5" cellspacing="0" id="inboxLocal"  >
	  	<thead>
			<tr>
			  <th>&nbsp;</th>
	          <th>Usuario</th>
	          <th>Pregunta</th>
	          <th>Dia</th>
	          <th>Hora</th>
	          <th>&nbsp;</th>
	          <th>&nbsp;</th>
	        </tr>
		</thead>
	    <tbody id="det">
	    	<? foreach($inbox as $rowIn):?>
		    <tr class="<?= $rowIn->estatus;?>">
		      <td><span><img src="<?=base_url()?>assets/graphics/<?= $rowIn->contactoTipo;?>Icon.png" alt="Pregunta de oferta" /></span></td>
	          <td><? if($rowIn->userAlias == ''):?><?= $rowIn->userName;?> <?= $rowIn->lastName;?><? else:?><?= $rowIn->userAlias;?><? endif;?></td>
	          <td><?= character_limiter(($rowIn->contactoComentario),50);?></td>
	          <td><?= convierteFechaBDLetra($rowIn->contactoFecha,2)?></td>
	          <td><?= $rowIn->contactoHora;?></td>
	          <td><a class="red leido" href="<?=base_url()?>/mi_local/borrado/<?= $rowIn->contactoID;?>">Borrar</a></td>
	          <td><a class="red leido" href="<?=base_url()?>mi_local/lectura/<?= $rowIn->contactoID;?>">Leer aqui...</a></td>
	        </tr>
	        <? endforeach; ?>
	    </tbody>
		</table>
		<a class="fright mt10 segBot" href="<?=base_url()?>mi_local/inbox">Ver Inbox</a>
		<? endif;?>
		<br class="clear">
		</div>
	</div>
	<h3>Tus ultimos productos vendidos</h3>
	<div id="proVend">
	<ul>
	  <li>
	    <strong>* Descuento en Tablets</strong>
	    <p><a href="http://localhost:8888/ptv8/"><img src="http://localhost:8888/ptv8/assets/graphics/compaq-presario.png" alt="Seccion de Tablets">Extensa gama de tablets para este regreso a clases</a></p>
	  </li>
	  <li>
	    <strong>* Descuento en Tablets</strong>
	    <p><a href="http://localhost:8888/ptv8/"><img src="http://localhost:8888/ptv8/assets/graphics/ofertas-tablets.png" alt="Seccion de Tablets">Extensa gama de tablets para este regreso a clases</a></p>
	  </li>
	  <li>
	    <strong>* Descuento en Tablets</strong>
	    <p><a href="http://localhost:8888/ptv8/"><img src="http://localhost:8888/ptv8/assets/graphics/impresoras-escolares.png" alt="Seccion de Tablets">Extensa gama de tablets para este regreso a clases</a></p>
	  </li>
	   <li>
	    <strong>* Descuento en Tablets</strong>
	    <p><a href="http://localhost:8888/ptv8/"><img src="http://localhost:8888/ptv8/assets/graphics/compaq-presario.png" alt="Seccion de Tablets">Extensa gama de tablets para este regreso a clases</a></p>
	  </li>
	  <li>
	    <strong>* Descuento en Tablets</strong>
	    <p><a href="http://localhost:8888/ptv8/"><img src="http://localhost:8888/ptv8/assets/graphics/ofertas-tablets.png" alt="Seccion de Tablets">Extensa gama de tablets para este regreso a clases</a></p>
	  </li>
	  <a class="fright mt10 segBot" href="<?=base_url()?>">Ver tus productos vendidos</a>
	</ul>
	</div>
</section>