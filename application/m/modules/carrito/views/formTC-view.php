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
<form method="post" action="http://www.plazadelatecnologia.com/carrito/procesarPago" id="formPayu">
<input type="hidden" name="folio" value="<?=$folio?>" /> 
<input type="hidden" name="pais" id="pais" value="MX" />
<input style="display: none;" name="opPagoPayu" type="hidden" value="TC" /> 
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
	  <input autocomplete="off" class="regIn required idleField" type="number" placeholder="Número de la tarjeta *" name="numtc" id="numtc" value="">
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
</div>
<script>

//$(document).ready(function() {
jQuery(function($) {
	
	$("#tipotc2").change(function(){
		$('#errorTipoT').hide();
	});
	
	
	$("#nombreth").change(function() {
		$('#errorTitular').hide();
	});
	
	$("#numtc").change(function() {
		$('#errorNumT').hide();
	});
	
	$("#cvvtc").change(function() {
		$('#errorCCV').hide();
	});
	
	$("#mestc").change(function() {
		$('#errorVigencia').hide();
	});
	
	$("#aniotc").change(function() {
		$('#errorVigencia').hide();
	});
	
	$("#ciudad").change(function() {
		$('#errorCiudad').hide();
	});
	
	$("#direccion").change(function() {
		$('#errorDir').hide();
	});
	
	$("#cp").change(function() {
		$('#errorCP').hide();
	});
	
	$("#formPayu").submit(function() {

		var letras		="abcdefghyjklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
		var numeros		="0123456789";
		var tipo 	= $("#tipotc2").val();
		var mes 	= $("#mestc").val();
		var anio 	= $("#aniotc").val();
		var cvvtc 	= $("#cvvtc").val();
		var numtc 	= $("#numtc").val();
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
			
			if (titular == ''){
			$('#errorTitular').empty().append('Introduce el nombre del titular').show();
			return false;
		}
			
			for(i=0; i<titular.length; i++){
		      if (numeros.indexOf(titular.charAt(i),0) != -1){
		         $('#errorTitular').empty().append('Ingresar solo letras').show();
		         return false;
		      }
		    }
		    
		   for(i=0; i<numtc.length; i++){
		      if (letras.indexOf(numtc.charAt(i),0)!=-1){
		        $('#errorNumT').empty().append('Ingresar solo numeros').show();
		        return false;
		      }
		   }
		   
		   for(i=0; i<cvvtc.length; i++){
		      if (letras.indexOf(cvvtc.charAt(i),0)!=-1){
		        $('#errorCCV').empty().append('Ingresar solo numeros').show();
		        return false;
		      }
		   }

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
	$('#meses').click(function(){
		$('#formMeses').submit();
	});
}); 
</script>