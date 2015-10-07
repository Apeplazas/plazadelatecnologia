<div id="resumenCompra">
	<table>
		<tr>
			<th class="artTh">Articulo</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Subtotal</th>
		</tr>
	<? foreach($detalleCompra as $itemRow):?>
	<tr>
		<td class="artTd"><?= $itemRow->ofertaTitulo?></td>
		<td><?= $itemRow->ofertaPrecio?></td>
		<td><?= $itemRow->cantidadProducto?></td>
		<td><?= number_format($itemRow->subtotalPago,2)?></td>
	</tr>
	
	<? endforeach;?>
	<? foreach($compra as $compraRow):?>
	<tr>
		<td class="noneTd">&nbsp;</td>
		<td class="noneTd">&nbsp;</td>
		<td class="totalTd">Total</td>
		<td class="totalTd"><?= number_format($compraRow->total, 2)?></td>
	</tr>
	<? break; 
	endforeach;?>
	</table>

</div>