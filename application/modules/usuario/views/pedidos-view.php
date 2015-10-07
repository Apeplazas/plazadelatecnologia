<? $user  = $this->session->userdata('user');?>
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
<aside id="asideInb">
	<ul class="pFix">
		<? $this->load->view('includes/menus/menuUser');?>
	</ul>
</aside>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Mis pedidos</h3>
	<div id="inbWrap">
		<table>
			<thead>
				<tr>
					<th>Folio</th>
					<th>Fecha</th>
					<th>Monto</th>
					<th>Estatus</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<? foreach($pedidos as $pedidoRow):?>
				<tr>
					<td><?=$pedidoRow->folio?></td>
					<td><?=$pedidoRow->fechaCompra?></td>
					<td>$ <?=$pedidoRow->total?></td>
					<td>
						<? if($pedidoRow->status == 'pagado'):?>
						Pagado
						<? elseif($pedidoRow->status == 'espera de pago'):?>
						En espera de pago
						<? elseif($pedidoRow->status == 'ptConfirmada'):?>
						Pago confirmado
						<? endif;?>
					</td>
					<td><a href="<?=base_url()?>usuario/detalleCompra/<?=$pedidoRow->folio?>" >Ver detalles</a></td>
				</tr>
				<? endforeach;?>
			</tbody>
		</table>
	</div>
</section>

