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
</div>
<ul id="opcionesPago">
	<li><a href="http://m.plazadelatecnologia.com/carrito/pago_tc/<?=$folio?>" id="visa"><img src="<?=base_url()?>assets/graphics/pago-visa.png" /></a></li>
	<li><a href="#" class="meses"><img src="<?=base_url()?>assets/graphics/pago-debito.png" /></a></li>
	<li><a href="#" class="meses"><img src="<?=base_url()?>assets/graphics/meses-banco.png" /></a></li>
	<li><a href="#" class="meses"><img src="<?=base_url()?>assets/graphics/americanexpress-diferidos.png" /></a></li>
	<? if($compra[0]->total <= 10000):?>
	<li><a href="#" id="oxxo"><img src="<?=base_url()?>assets/graphics/pago-oxxo.png" /></a></li>
	<li><a href="#" id="eleven"><img src="<?=base_url()?>assets/graphics/pago-seveneleven.png" /></a></li>
	<? endif;?>
	<li><a href="#" id="paypal"><img src="<?=base_url()?>assets/graphics/pago-paypal.png" /></a></li>
</ul>
<form style="display: none;" method="post" action="http://www.plazadelatecnologia.com/carrito/procesarPago" id="formPayu">
<input type="hidden" name="folio" value="<?=$folio?>" /> 
<input type="hidden" name="pais" id="pais" value="MX" />
<input style="display: none;" name="opPagoPayu" type="hidden" value="" /> 
<!--Formulario si selecciono TC-->
<div id="opInfoTC">		
	<fieldset>
	   <select name="tipotc2" id="tipotc2" class="selReg select required valid">
	   	 <option value="">Tipo de tarjeta</option>	   	 
		 <option value="VISA">Visa</option>
		 <option value="MASTERCARD">MasterCard</option>
		 <option value="AMEX">AMEX</option>
	   </select>
	   <label id="errorTipoT" style="display: none;"></label>
	</fieldset>		
	<fieldset>
	  <input autocomplete="off" class="regIn required" type="text" name="nombreth" id="nombreth" placeholder="Nombre del titular *">
	  <label id="errorTitular" style="display: none;"></label>
	</fieldset>
	<fieldset>
	  <input autocomplete="off" class="regIn required idleField" type="text" placeholder="Número de la tarjeta *" name="numtc" id="numtc" value="">
	  <label id="errorNumT" style="display: none;"></label>
	</fieldset>	
	<fieldset>
	   <select name="mestc" id="mestc" class="regDate required valid">
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
	   <select name="aniotc" id="aniotc" class="regAnio required valid">
	   	<option value="0">Año</option>
	   	<? for ($i=date('Y'); $i <= 2025; $i++):?>
	    <option value="<?=$i?>"><?=substr($i,2,2)?></option>
	    <? endfor;?>	
	    </select>
	    <label id="errorVigencia" style="display: none;"></label>
	</fieldset>	
	<fieldset>
	  <input autocomplete="off" class="regIn required idleField" type="text" placeholder="Código de seguridad *" name="cvvtc" id="cvvtc" value="">
	  <label id="errorCCV" style="display: none;"></label>
	</fieldset>
	<fieldset>
		<input autocomplete="off" class="regIn required idleField" type="text" name="ciudad" id="ciudad" placeholder="Ciudad" />
		<label id="errorCiudad" style="display: none;"></label>
	</fieldset>
	<fieldset>
		<input autocomplete="off" class="regIn required idleField" type="text" name="direccion" id="direccion" placeholder="Direccion" />
		<label id="errorDir" style="display: none;"></label>
	</fieldset>
	<fieldset>
		<input autocomplete="off" class="regIn required idleField" type="text" name="cp" id="cp" placeholder="Codigo Postal" />
		<label id="errorCP" style="display: none;"></label>
	</fieldset>	
	<fieldset>
	  <input class="nBotonBig fwlight" type="submit" value="Finalizar Compra">
	</fieldset>
	<input type="hidden" name="deviceId" id="deviceId" value="<?=$deviceSessionId?>" />
	<input type="hidden" name="a_vigente" id="a_vigente" value="<?=date("Y")?>" />
	<input type="hidden" name="m_vigente" id="m_vigente" value="<?=date("m")?>" />
	<p style="background:url(https://maf.pagosonline.net/ws/fp?id=<?=$deviceSessionId?>80200)"></p>
	<img src="https://maf.pagosonline.net/ws/fp/clear.png?id=<?=$deviceSessionId?>80200">
	<script src="https://maf.pagosonline.net/ws/fp/check.js?id=<?=$deviceSessionId?>80200"></script>
	<object type="application/x-shockwave-flash"
	data="https://maf.pagosonline.net/ws/fp/fp.swf?id=<?=$deviceSessionId?>80200" width="1" height="1"
	id="thm_fp">
	<param name="movie" value="https://maf.pagosonline.net/ws/fp/fp.swf?id=<?=$deviceSessionId?>80200" />
	</object>
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
$(document).ready(function() {
	
	$("#tipotc2").change(function(){
		$('#errorTipoT').hide();
	});
	
	$("#cvvtc").keypress(function(e) {
		$('#errorCCV').hide();
	});
	
	
	$("#formPayu").submit(function() {

		var tipo 	= $("#tipotc2").val();
		var mes 	= $("#mestc").val();
		var anio 	= $("#aniotc").val();
		var cvvtc 	= $("#cvvtc").val();
		var titular	= $("#nombreth").val();
		var dir		= $("#direccion").val();
		var ciudad	= $("#ciudad").val();
		var pais	= $("#pais").val();
		var cp		= $("#cp").val();
		var bSel = 0;
		var bValue = '';
		var a_vigente		= $("#a_vigente").val();
		var m_vigente		= $("#m_vigente").val();

		$(".opFormaPagos").each(function () {
            if ($(this).is(':checked')){
                bSel = 1;
                bValue = $(this).val();
            }
        });
        
        if($('input[name="opPagoPayu"]').val() == 'TC'){

		if (tipo != ''){

			if (tipo == "AMEX") {
				if ($("#numtc").val().length != 15) {
					$('#errorNumT').empty().append('Comprueba que sean 15 digitos').show();
					return false;
				}
				if (cvvtc.length != 4){
					$('#errorCCV').empty().append('La clave debe ser de 4 digitos').show();
					return false;
				}
			} else {
				if ($("#numtc").val().length != 16) {
					$('#errorNumT').empty().append('Comprueba que sean 16 digitos').show();
					return false;
				} 
				if (cvvtc.length != 3){
					$('#errorCCV').empty().append('La clave debe ser de 3 digitos').show();
					return false;
				}
			}
		} else {
			$('#errorTipoT').empty().append('Elige tu tipo de tarjeta').show();
			return false;
		}
		
		if (mes == 0 || anio == 0){
			$('#errorVigencia').empty().append('Introduce fecha de vencimiento').show();
			return false;
		}

		if (anio == a_vigente && parseInt(mes,10)<parseInt(m_vigente,10)){
			$('#errorVigencia').empty().append('Introduce fecha de vencimiento valido').show();
			return false;
		}
		
		if (cvvtc == ''){
			$('#errorCCV').empty().append('Introduce la clave de tu tarjeta').show();
			return false;
		}
		
		if (titular == ''){
			$('#errorTitular').empty().append('Introduce el nombre del titular').show();
			return false;
		}
		
		if (pais == ''){
			$('#errorPais').empty().append('Introduce el pais').show();
			return false;
		}
		
		if (ciudad == ''){
			$('#errorCiudad').empty().append('Introduce la ciudad').show();
			return false;
		}
		
		
		if (dir == ''){
			$('#errorDir').empty().append('Introduce dirección donde recibes tu estado de cuenta').show();
			return false;
		}
		
		if (cp == ''){
			$('#errorCP').empty().append('Introduce el Codigo Postal').show();
			return false;
		}		
		
		}
	});

	$("#numtc").keypress(function(e) {

		if (!(e.which >= 48 && e.which <= 57)) {
			if (e.which != 8 && e.which != 0) {
				$('#errorNumT').empty().append('Ingresar solo numeros').show();
				return false;
			}
		}else{
			$('#errorNumT').hide();
		}
	});
	$("#cvvtc").keypress(function(e) {

		if (!(e.which >= 48 && e.which <= 57)) {
			if (e.which != 8 && e.which != 0) {
				$('#errorCCV').empty().append('Ingresar solo numeros').show();
				return false;
			}
		}else{
			$('#errorCCV').hide();
		}
	});
	$("#nombreth").keypress(function(e) {
		if (!((e.which >= 65 && e.which <= 90) || (e.which >= 97 && e.which <= 122))) {
			if (e.which != 8 && e.which != 0 && e.which != 32) {
				$('#errorTitular').empty().append('Ingresar solo letras').show();
				return false;
			}
		}else{
			$('#errorTitular').hide();
		}
	});

	$('#visa').click(function(){
		$('input[name="opPagoPayu"]').val("TC");
		$('#formPayu').toggle();
	});
	$('#oxxo').click(function(){
		$('input[name="opPagoPayu"]').val("OXXO");
		$('#formPayu').submit();
	});
	$('#eleven').click(function(){
		$('input[name="opPagoPayu"]').val("7ELEVEN");
		$('#formPayu').submit();
	});
	$('#paypal').click(function(){
		$('#formPaypal').submit();
	});
	$('.meses').click(function(){
		$('#formMeses').submit();
	});
}); 
</script>