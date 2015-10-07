<? 
	$total = 0;
	$totalConfirmado = 0;
?>
<script type="text/javascript" charset="utf-8">
$(document).ready( function () {
  $('#inboxLocal').dataTable({
    "bSort": false,
    "iDisplayLength": 25,
    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
  });
  $( document ).tooltip();
});
</script>
<aside id="asideMil">
	<ul class="pFix">
		<? $this->load->view('includes/menus/menuLocal');?>
	</ul>
</aside>
<section id="milocalPanel">
	<h3>Historial de ventas</h3>
	<div id="inboxMilocal">
		<div id="inbWrap">
		<?= $this->session->flashdata('msg'); ?>
		<? if ($producto == FALSE):?>
		<p class="msgInb">No has vendido ningún producto en este momento</p>
		<? else:?>
		<table cellpadding="5" cellspacing="0" id="inboxLocal" >
	  	<thead>
			<tr>
			  <th>Folio</th>
	          <th>Producto</th>
	          <th>Cantidad</th>
	          <th>Venta</th>
	          <th>Status</th>
	          
	        </tr>
		</thead>
	    <tbody id="det">
	    	<? foreach($producto as $rowP):?>
		    <tr>
		      <td><?if ($rowP->statusProducto == 'pagada'):?><a href="<?=base_url()?>mi_local/infoVendido/<?= $rowP->ofertaID;?>/<?= $rowP->localID;?>/<?= $rowP->folio;?>"><?= $rowP->folio;?></a><? else:?><?= $rowP->folio;?><? endif?></td>
		      <td><?if ($rowP->statusProducto == 'pagada'):?><a href="<?=base_url()?>mi_local/infoVendido/<?= $rowP->ofertaID;?>/<?= $rowP->localID;?>/<?= $rowP->folio;?>"><?= $rowP->ofertaTitulo;?></a><? else:?><?= $rowP->ofertaTitulo;?><? endif?></td>
		      <td><?if ($rowP->statusProducto == 'pagada'):?><a href="<?=base_url()?>mi_local/infoVendido/<?= $rowP->ofertaID;?>/<?= $rowP->localID;?>/<?= $rowP->folio;?>"><?= $rowP->cantidad;?></a><? else:?><?= $rowP->cantidad;?><? endif?></td>
		      <td><?if ($rowP->statusProducto == 'pagada'):?><a href="<?=base_url()?>mi_local/infoVendido/<?= $rowP->ofertaID;?>/<?= $rowP->localID;?>/<?= $rowP->folio;?>"><?=  number_format($rowP->totalSinComision);?></a><? else:?><?=  number_format($rowP->totalSinComision);?><? endif?></td>
		      
		      <td>
		      <? if($rowP->statusProducto == 'usuarioRecibio'):?>
		      <a href="<?=base_url()?>mi_local/infoVendido/<?= $rowP->ofertaID;?>/<?= $rowP->localID;?>/<?= $rowP->folio;?>">Entregada</a>
		      <? elseif($rowP->statusProducto == 'vista'):?>
		      <a href="#" title="Confirma envio"><img src="<?=base_url()?>assets/graphics/confirmaEnvio.png" alt="En proceso" /></a>
		      <? elseif($rowP->statusProducto == 'enProcesoEnvio'):?>
		      <img src="<?=base_url()?>assets/graphics/enproceso.png" alt="En proceso" /> En proceso
		      <? elseif($rowP->statusProducto == 'pagada'):?>
		      <a href="<?=base_url()?>mi_local/infoVendido/<?= $rowP->ofertaID;?>/<?= $rowP->localID;?>/<?= $rowP->folio;?>">pagada</a>
		      <? elseif($rowP->statusProducto == 'inconclusa'):?>
		      <a href="<?=base_url()?>mi_local/infoVendido/<?= $rowP->ofertaID;?>/<?= $rowP->localID;?>/<?= $rowP->folio;?>">En espera de pago</a>
		      <? elseif($rowP->statusProducto == 'solicitudTraspaso'):?>
	    	  <a href="<?=base_url()?>mi_local/infoVendido/<?= $rowP->ofertaID;?>/<?= $rowP->localID;?>/<?= $rowP->folio;?>">Traspaso en proceso</a>
		      <? elseif($rowP->statusProducto == 'traspasoExitoso'):?>
		      <a href="<?=base_url()?>mi_local/infoVendido/<?= $rowP->ofertaID;?>/<?= $rowP->localID;?>/<?= $rowP->folio;?>">Dinero traspasado a su cuenta</a>
		      <? endif;?>
		      </td>
		      
	        </tr>
	         <? if($rowP->statusProducto != 'inconclusa'){ $total += $rowP->subtotalLocal;}?>
	         
	        <? endforeach; ?>  
	    </tbody>
		</table>
		<? foreach($confirmado as $rowC):?>
		<? $totalConfirmado += str_replace(",","",$rowC->totalSinComision);?>
		<? endforeach; ?>
		<div id="subTotal"><span><em>Ventas</em><i>$ <?= number_format($total);?></i></span></div>
		<? if($totalConfirmado != 0):?>
		<a class="traspaso narBotonBlaRig ml10 mt10" href="<?=base_url()?>mi_local/solicitudTraspaso">Solicitar $ <?= number_format($totalConfirmado);?>.00 a Transferencia* </a>
		<p><em class="msgImp tright">*El proceso de transferencia toma 5 dias habiles</em></p>
		<? endif?>
		<br class="clear">
		<? endif;?>
		<br class="clear">
		</div>
	</div>
</section>