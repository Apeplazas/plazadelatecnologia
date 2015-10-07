<div id="contentCar">
<span class="paymentDiv">
<h1>Realiza tus pagos de forma segura</h1>
<ul>
	<li><strong>Folio de compra:</strong><em><?=$folio?></em></li>
	<li><strong>Monto total a pagar:</strong><em style="color: #D93600;">$ <?=$compra[0]->total;?></em></li>
	<li><strong>Calle:</strong><em><?=$compra[0]->direccion?></em></li>
	<li><strong>Colonia:</strong> <em><?=$compra[0]->colonia?></em></li>
	<li><strong>Del./Municipio:</strong> <em><?=$compra[0]->municipio?></em></li>
	<li><strong>Estado:</strong> <em><?=$compra[0]->estado?></em></li>
	<li><strong>Código Postal:</strong> <em><?=$compra[0]->CP?></em></li>
	<li><strong>Teléfono:</strong> <em><?=$compra[0]->telefono?></em></li>
	<li><strong>Persona que recibe:</strong> <em><?=$compra[0]->personaRecibe?></em></li>
</ul>
</span>
<h2>Selecciona tu forma de pago.</h2>
<form class="pay" action="https://www.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="upload" value="1">
	<input type="hidden" name="business" value="paypal@plazadelatecnologia.com ">
	<input type="hidden" name="currency_code" value="MXN">
	<input type="hidden" name="invoice" value="<?= $folio?>">
	<input type="hidden" name="return" value="<?=base_url()?>carrito/paypal_gracias">
	<input type="hidden" name="notify_url" value="<?=base_url()?>carrito/paypal_gracias">
	<input type="hidden" name="cancel_return" value="<?=base_url()?>carrito">
	<input type="hidden" name="rm" value="2">
	<? $Number = 1;?>
	<?php foreach ($detalleCompra as $item): ?>
	<?$itemNumber =$Number++;?>
	<input type="hidden" name="item_name_<?= $itemNumber?>" value='<?= $item->ofertaTitulo ?>'>
	<input type="hidden" name="amount_<?= $itemNumber?>" value="<?= $item->ofertaPrecio?>">
	<input type="hidden" name="item_number_<?= $itemNumber ?>" value="<?= $item->ofertaID?>">
	<input type="hidden" name="quantity_<?= $itemNumber?>" value="<?= $item->cantidadProducto?>">
	<!--<input type="hidden" name="shipping_<?= $itemNumber?>" value="<?= $item->costoEnvio?>">-->
	<? endforeach?>
	<input class="mt10 ml5 imgPago" type="image" src="<?=base_url()?>assets/graphics/paypal.png" />
</form>

<form class="pay" action="https://www.dineromail.com/mx/Shop/Shop_Ingreso.asp" method="post">
		<input type="hidden" name="NombreItem" value="Pago en Plaza de la Tecnolog&#195;&#173;a">
		<input type="hidden" name="TipoMoneda" value="1">
		<input type="hidden" name="PrecioItem" value="<?=$compra[0]->total;?>">
		<input type="hidden" name="E_Comercio" value="1553040">
		<input type="hidden" name="NroItem" value="">
		<input type="hidden" name="transaction_id" value="<?=$folio?>" />
		<input type="hidden" name="image_url" value="http://www.plazadelatecnologia.com/assets/graphics/plazadelatecnologia-logo2012.jpg">
		<input type="hidden" name="DireccionExito" value="http://www.plazadelatecnologia.com/gracias/visa_mastercard">
		<input type="hidden" name="DireccionFracaso" value="http://www.plazadelatecnologia.com/carrito">
		<input type="hidden" name="DireccionEnvio" value="0">
		<input type="hidden" name="Mensaje" value="0">
		
		<input class="mt10" type="image" src="<?=base_url()?>assets/graphics/pago-visa.png" border="0" name="submit" alt="Pagar con DineroMail">
	</form>
	
	<form class="pay" action="https://www.dineromail.com/mx/Shop/Shop_Ingreso.asp" method="post">
		<input type="hidden" name="NombreItem" value="Pago en Plaza de la Tecnolog&#195;&#173;a">
		<input type="hidden" name="TipoMoneda" value="1">
		<input type="hidden" name="PrecioItem" value="<?=$compra[0]->total;?>">
		<input type="hidden" name="E_Comercio" value="1553040">
		<input type="hidden" name="NroItem" value="">
		<input type="hidden" name="transaction_id" value="<?=$folio?>" />
		<input type="hidden" name="image_url" value="http://www.plazadelatecnologia.com/assets/graphics/plazadelatecnologia-logo2012.jpg">
		<input type="hidden" name="DireccionExito" value="http://www.plazadelatecnologia.com/gracias/americanexpress">
		<input type="hidden" name="DireccionFracaso" value="http://www.plazadelatecnologia.com/carrito">
		<input type="hidden" name="DireccionEnvio" value="0">
		<input type="hidden" name="Mensaje" value="0">
		
		<input class="mt10" type="image" src="<?=base_url()?>assets/graphics/pago-americanexpress.png" border="0" name="submit" alt="Pagar con DineroMail">
	</form>
	
	<form action="https://www.dineromail.com/mx/Shop/Shop_Ingreso.asp" method="post">
		<input type="hidden" name="NombreItem" value="Pago en Oxxo ">
		<input type="hidden" name="TipoMoneda" value="1">
		<input type="hidden" name="PrecioItem" value="<?=$compra[0]->total;?>">
		<input type="hidden" name="E_Comercio" value="1553040">
		<input type="hidden" name="NroItem" value="-">
		<input type="hidden" name="image_url" value="http://www.plazadelatecnologia.com/assets/graphics/plazadelatecnologia-logo2012.jpg">
		<input type="hidden" name="DireccionExito" value="http://www.plazadelatecnologia.com/gracias/oxxo_y_7eleven">
		<input type="hidden" name="DireccionFracaso" value="http://www.plazadelatecnologia.com/carrito">
		<input type="hidden" name="DireccionEnvio" value="0">
		<input type="hidden" name="Mensaje" value="0">
		<input type='hidden' name='MediosPago' value='13,14'>
		<input type="image" src="<?=base_url()?>assets/graphics/pago-oxxo.png" border="0" name="submit" alt="Pagar con DineroMail">
	</form>
</div>