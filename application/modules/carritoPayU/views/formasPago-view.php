<div id="contentCar">
<h1>Realiza tus pagos de forma segura</h1>
<div id="izqDatos">
<ul id="datosPago">
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
<? $this->load->view('carrito_totales-view');?>
</div>
<ul id="opcionesPago">
	<li><a href="#" id="visa"><img src="<?=base_url()?>assets/graphics/pago-visa.png" /></a></li>
	<li><a href="#" id="oxxo"><img src="<?=base_url()?>assets/graphics/pago-oxxo.png" /></a></li>
	<li><a href="#" id="eleven"><img src="<?=base_url()?>assets/graphics/pago-oxxo.png" /></a></li>
	<li><a href="#" id="meses"><img src="<?=base_url()?>assets/graphics/pago-visa.png" /></a></li>
	<li><a href="#" id="paypal"><img src="<?=base_url()?>assets/graphics/paypal.png" /></a></li>
</ul>
<form style="display: none;" id="formPago" method="post" action="<?=base_url()?>carritonew/procesarPago">	
<input style="display: none;"type="hidden" name="folio" value="<?=$folio?>" /> 
<input style="display: none;" name="opPagoPayu" type="hidden" value="" /> 
<fieldset>&nbsp;</fieldset>
<!--Formulario si selecciono TC-->
<div id="opInfoTC">		
	<fieldset>
	   <select name="tipotc" class="selReg select required valid">
	   	 <option value="">Tipo de tarjeta</option>	   	 
		 <option value="TC">Tarjeta de Crédito</option>
		 <option value="TD">Débito</option>		 
	   </select>
	</fieldset>
	<fieldset>
	   <select name="tipotc2" class="selReg select required valid">
	   	 <option value="">Tipo de tarjeta</option>	   	 
		 <option value="VISA">Visa</option>
		 <option value="MASTERCARD">MasterCard</option>
		 <option value="AMEX">AMEX</option>
	   </select>
	</fieldset>		
	<fieldset>
	  <input class="regIn required" type="text" name="nombreth" placeholder="Tarjetahabiente *" value="">
	</fieldset>
	<fieldset>
	  <input class="regIn required idleField" type="text" placeholder="Número de la tarjeta *" name="numtc" value="">
	</fieldset>	
	<fieldset>
	   <select name="mestc" class="regDate required valid">
	   		<option value="0">Fecha de Vencimiento</option>
	   		<option value="01">01</option>
			<option value="02">02</option>
			<option value="03">03</option>
			<option value="04">04</option>
			<option value="05">05</option>
			<option value="06">06</option>
			<option value="07">07</option>
			<option value="08">08</option>
			<option value="09">09</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
	   </select>
	   <select name="aniotc" class="regAnio required valid">
	   	<option value="0">Año</option>
	   	<? for ($i=2014; $i <= 2025; $i++):?>
	    <option value="<?=$i?>"><?=substr($i,2,2)?></option>
	    <? endfor;?>	
	    </select>
	</fieldset>	
	<fieldset>
	  <input class="regIn required idleField" type="text" placeholder="Código de seguridad *" name="cvvtc" value="">
	</fieldset>	
	<fieldset>
	  <input class="nBotonBig fwlight" type="submit" value="Finalizar Compra">
	</fieldset>
	
</div>

</form>
<!--Fin TC-->
<form id="formPaypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
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
</form>
<form id="formMeses" action="https://www.dineromail.com/mx/Shop/Shop_Ingreso.asp" method="post">
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
	</form>
</div>
<script>
$('#visa').click(function(){
	$('input[name="opPagoPayu"]').val("TC");
	$('#formPago').toggle();
});
$('#oxxo').click(function(){
	$('input[name="opPagoPayu"]').val("OXXO");
	$('#formPago').submit();
});
$('#eleven').click(function(){
	$('input[name="opPagoPayu"]').val("7ELEVEN");
	$('#formPago').submit();
});
$('#paypal').click(function(){
	$('#formPaypal').submit();
});
$('#meses').click(function(){
	$('#formMeses').submit();
});
</script>