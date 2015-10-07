<? $user  = $this->session->userdata('user');?>
<style>
	#listaDirs li{float: left;width: 200px;padding: 15px 0;font-size: .8em;}
	#listaDirs dl{font-weight: 700;text-transform: uppercase;}
	#listaDirs dt{padding: 10px 0;}
	#inbWrap strong{}
</style>
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
	<h3>Compra <?=$this->uri->segment(3)?></h3>
	<div id="inbWrap">
		<table>
			<thead>
				<tr>
					<th>Oferta</th>
					<th>Cantidad</th>
					<th>Precio</th>
					<th>Subtotal</th>
					<th>Estatus</th>
				</tr>
			</thead>
			<tbody>
				<? $total = 0;?>
				<? foreach($compra as $compraRow):?>
				<? $total += $compraRow->subtotalPago?>
				<tr>
					<td><?=strtoupper($compraRow->ofertaTitulo)?></td>
					<td><?=$compraRow->cantidadProducto?></td>
					<td>$ <?=$compraRow->ofertaPrecio?></td>
					<td>$ <?=$compraRow->subtotalPago?></td>
					<td>
					<? if($compraRow->statusProducto == 'inconclusa'):?>
					En espera de pago
					<?elseif($compraRow->statusProducto == 'pagada'):?>
					Pagada
					<?elseif($compraRow->statusProducto == 'enProcesoEnvio'):?>
					En proceso de entrega
					<?elseif($compraRow->statusProducto == 'usuarioRecibio'):?>
					Entregada
					<?endif;?>
					</td>
				</tr>
				<? endforeach;?>
			</tbody>
		</table>
		<strong>Total del pedido: $ <?=$total?></strong>
		<ul id="listaDirs">
			<li>
				<dt>Dirección de entrega:</dt>
				<dl><?=$compraRow->titulo?></dl>
				<dd>Calle: <?=$compraRow->direccion?></dd>
				<dd>Estado: <?=$compraRow->nombreEstado?></dd>
				<dd>Municipo/Del.: <?=$compraRow->nombreMunicipio?></dd>
				<dd>Colonia: <?=$compraRow->nombreColonia?></dd>
				<dd>C.P.: <?=$compraRow->codigoCP?></dd>
				<dd>Telefono:<?=$compraRow->telefono?></dd>
				<dd>Recibé: <?=$compraRow->recibe?></dd>
			</li>
		</ul>
	</div>
</section>

