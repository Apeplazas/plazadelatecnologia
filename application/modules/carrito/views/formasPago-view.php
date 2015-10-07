<div id="pasarelaLoading" style="display: none">
	<span><img src="<?=base_url()?>assets/graphics/loadBancos.gif" alt="Cargando" /></span>
</div>
<div id="contentCarTwo" class="bck-load">
<h1 class="mb20">Realiza tus pagos de forma segura</h1>
<div id="izqDatos">
<h3 class="tituloPago">Datos de compra y entrega</h3>
<ul id="datosPago">
	<li><strong>Folio de compra:</strong><em><?=$folio?></em></li>
	<li><strong>Monto total a pagar:</strong><em style="color: #D93600;" id="" >$ <?=$compra[0]->total;?></em></li>
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
	<h3 class="tituloPago">Elige tu forma de pago.</h3>
	<!--Botón para formulario MP-->
	<li><a href="#" id="mp"><img src="<?=base_url()?>assets/graphics/debitoCarrito.png" /></a></li>
	
	<!--<li><a href="#" id="visa"><img src="<?=base_url()?>assets/graphics/debitoCarrito.png" /></a></li>-->
	<!--li><a href="#" id="meses"><img src="<?=base_url()?>assets/graphics/creditoCarrito.png" /></a></li-->
	<? if($compra[0]->total < 15000):?>
	<li><a href="#conveniencia" id="oxxo" class="fancy"><img src="<?=base_url()?>assets/graphics/convenienciaCarrito.png" /></a></li>
	<? endif;?>

</ul>

<div id="conveniencia" style="display:none;">
	<ul>
		<? foreach($tiendasConveniencia as $tienda):?>
			<? if($compra[0]->total < $tienda->limitePago):?>
				<li>
					<form action="<?= base_url();?>carrito/procesarComproPago" method="post" id="<?= $folio;?>">
						<input type="hidden" name="formaPago" value="<?= $tienda->api;?>" />
						<input type="hidden" name="folio" value="<?= $folio;?>" />
						<a href="javascript:{}" onclick="document.getElementById('<?= $folio;?>').submit();"><img src="<?= base_url();?>assets/graphics/tiendas/<?= $tienda->img;?>" /></a>
					</form>
				</li>
			<? endif;?>
		<? endforeach;?>
	</ul>
</div>

<div id="loadingBancos">
	
	<!--Formulario para MP-->
	<form style="display: none;" action="<?= base_url();?>carrito/mercadoPago" method="post" id="formmp" name="formmp" >
		<div id="opInfoTC">
		    <fieldset>
		    	<input class="regIn required idleField" type="text" id="cardNumber" data-checkout="cardNumber" autocomplete="off" placeholder="num. de tarjeta (4509 9535 6623 3704)" />
		        <label id="errortarjeta" style="display: none;"></label>
		    </fieldset>
		    <fieldset>
    			<select class="selReg select required valid" id="issuer" name="issuer"></select>
		    </fieldset>
		    <fieldset>
    			<select class="selReg select required valid" id="installments" name="installments"></select>
		    </fieldset>
		    <fieldset>        
		    	<input class="regIn required idleField" type="text" id="securityCode" data-checkout="securityCode" autocomplete="off" placeholder="codigo seguridad (123)" />
		        <label id="errorcodigo" style="display: none;"></label>
		    </fieldset>
		    <fieldset>
				<input class="regIn required idleField" type="text" id="cardExpirationMonth" data-checkout="cardExpirationMonth" autocomplete="off" placeholder="mes expira (12)" />
		        <label id="errorexpirames" style="display: none;"></label>
		    </fieldset>
			<fieldset>
		    	<input class="regIn required idleField" type="text" id="cardExpirationYear" data-checkout="cardExpirationYear" autocomplete="off" placeholder="año expira (2015)" />
		        <label id="errorexpiraaño" style="display: none;"></label>
		    </fieldset>
		    <fieldset>        
				<input class="regIn required idleField" type="text" id="cardholderName" data-checkout="cardholderName" autocomplete="off" placeholder="Nombre del Titular" />
		        <label id="errornombre" style="display: none;"></label>
		    </fieldset>
		            <!--"Solicita el tipo y número de documento de tu cliente, Sólo México no requiere esta información."-->
		            <!--<li>
		                <label for="docType">Tipo de Documento:</label>
		                <select class="regIn required idleField" id="docType" data-checkout="docType"></select>
		                <label id="errordoctype" style="display: none;"></label>
		            </li>
		            <li>
		                <!--<label for="docNumber">Número de Documento:</label>--
		                <input class="regIn required idleField" type="text" id="docNumber" data-checkout="docNumber" placeholder="12345678" />
		                <label id="errordocnumero" style="display: none;"></label>
		            </li>-->
		    <fieldset>
		    	<input type="hidden" id="amount" name="amount" value="<?=$compra[0]->total;?>" />
		    	<input id="email" name="email" type="hidden" value="<?=$user['email'];?>"/>
		        <input type="hidden" name="folio" value="<?=$folio; ?>" />
		        <input class="nBotonBig fwlight" type="submit" value="Realizar Pago!" />
		    </fieldset>
	    </div>
	</form>
	
	<form style="display: none;" method="post" id="formPayu">
		<h2 id="tituloTarjetas"></h2>
		<span class="card-errors"></span> 
		<input type="hidden" name="folio" value="<?=$folio?>" /> 
		<input type="hidden" name="pais" id="pais" value="MX" />
		<input style="display: none;" name="opPagoPayu" type="hidden" value="" /> 
		<!--Formulario si selecciono TC-->
		<div id="opInfoTC">		
			   <input type="hidden" name="tipotc2" id="tipotc2" value="" />
			<fieldset>
				<select name="nombreBanco" id="nombreBanco" class="selReg select required valid">
				</select>
				<label id="errorBanco" style="display: none;"></label>
			</fieldset>	   
			<fieldset>
			   <select name="cboPagaraEn" id="cboPagaraEn" class="selReg select required valid" data-conekta="monthly_installments">
			   		<option value="1">Formas de pago</option>	   	 
				 	<option value="1">Un Solo Pago</option>
			   </select>
			   <label id="errorcboPagaraEn" style="display: none;"></label>
			</fieldset>
			<fieldset>
			  <input autocomplete="off" class="regIn required" type="text" name="nombreth" id="nombreth" placeholder="Nombre del titular *" data-conekta="card[name]" />
			  <label id="errorTitular" style="display: none;"></label>
			</fieldset>
			<fieldset>
			  <input autocomplete="off" class="regIn required idleField" type="text" placeholder="Número de la tarjeta *" name="numtc" id="numtc" value="" data-conekta="card[number]">
			  <label id="errorNumT" style="display: none;"></label>
			</fieldset>	
			<fieldset>
			   <select name="mestc" id="mestc" class="regDate required valid" data-conekta="card[exp_month]">
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
			   <select name="aniotc" id="aniotc" class="regAnio required valid" data-conekta="card[exp_year]">
			   	<option value="0">Año</option>
			   	<? for ($i=date('Y'); $i <= 2025; $i++):?>
			    <option value="<?=$i?>"><?=substr($i,2,2)?></option>
			    <? endfor;?>	
			    </select>
			    <label id="errorVigencia" style="display: none;"></label>
			</fieldset>	
			<fieldset>
			  <input autocomplete="off" class="regIn required idleField" type="text" placeholder="Código de seguridad *" name="cvvtc" id="cvvtc" value="" data-conekta="card[cvc]" />
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
				<input type="hidden" size="20" data-conekta="description" value="<?=$folio?>"/>
				<input type="hidden" size="13" id="conektaAmount" data-conekta="amount" value="<?=$compra[0]->total * 100;?>"/>
				<input type="hidden" size="3" data-conekta="currency" value="MXN"/>
				<input type="hidden" id="pasarelaTipo" value=""/>
				<input class="nBotonBig fwlight" type="submit" value="Finalizar Compra">
			</fieldset>
			<input type="hidden" name="deviceId" id="deviceId" value="<?=$deviceSessionId?>" />
			<input type="hidden" name="a_vigente" id="a_vigente" value="<?=date("Y")?>" />
			<input type="hidden" name="m_vigente" id="m_vigente" value="<?=date("m")?>" />
			<input type="hidden" id="conektaDiferido3" value="" />
			<input type="hidden" id="conektaDiferido6" value="" />
			<input type="hidden" id="conektaDiferido12" value="" />
			<input type="hidden" id="tardetaTipo" value="" />
			
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
	<br class="clear">
</div>
<!--Fin TC-->
<form id="formPaypal" action="<?=base_url()?>carrito/procesarPaypal" method="post">
	<input type="hidden" name="folioId" value="<?=$folio?>">
</form>
<br class="clear">
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!--SDK JS para MP-->
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
<script type="text/javascript">
// Conekta Public Key
Conekta.setPublishableKey('key_REsCpmzLHNkuJa5CACUzwTw');
// MP Public Key
Mercadopago.setPublishableKey("APP_USR-0d0846e7-ad21-45b9-8763-a9adda7bd4e7");/*credenciales modo produccion */
//Mercadopago.setPublishableKey("APP_USR-9f3ab420-f460-4a63-bf0e-0d1bfb23fdf5"); /*Credenciales modo produccion anterior {message: "invalid public_key", error: "not_found", status: 404,…}*/
//Mercadopago.setPublishableKey("TEST-cd74ac62-943b-4cb1-9e07-72a2a493e2d3"); /*Credenciales Modo SandBox*/
 
$(document).ready(function() {

//$(document).ready(function(){
	
$('#mp').click(function(){
  $('#card-form').hide();
  $('#formmp').show();
 })
 
function addEvent(el, eventName, handler){
    if (el.addEventListener) {
           el.addEventListener(eventName, handler);
    } else {
        el.attachEvent('on' + eventName, function(){
          handler.call(el);
        });
    }
};

/*Comprueba Tarjeta y si tiene meses sin intereses*/
function getBin() {
    var cardSelector = document.querySelector("#cardId");
    if (cardSelector && cardSelector[cardSelector.options.selectedIndex].value != "-1") {
        return cardSelector[cardSelector.options.selectedIndex].getAttribute('first_six_digits');
    }
    var ccNumber = document.querySelector('input[data-checkout="cardNumber"]');
    return ccNumber.value.replace(/[ .-]/g, '').slice(0, 6);
}

function clearOptions() {
    var bin = getBin();
    if (bin.length == 0) {
        document.querySelector("#issuer").style.display = 'none';
        document.querySelector("#issuer").innerHTML = "";

        var selectorInstallments = document.querySelector("#installments"),
            fragment = document.createDocumentFragment(),
            option = new Option("Selecciona Banco", '-1');

        selectorInstallments.options.length = 0;
        fragment.appendChild(option);
        selectorInstallments.appendChild(fragment);
        selectorInstallments.setAttribute('disabled', 'disabled');
    }
}

function guessingPaymentMethod(event) {
    var bin = getBin(),
        amount = document.querySelector('#amount').value;
    if (event.type == "keyup") {
        if (bin.length == 6) {
            Mercadopago.getPaymentMethod({
                "bin": bin
            }, setPaymentMethodInfo);
        }
    } else {
        setTimeout(function() {
            if (bin.length >= 6) {
                Mercadopago.getPaymentMethod({
                    "bin": bin
                }, setPaymentMethodInfo);
            }
        }, 100);
    }
};

function setPaymentMethodInfo(status, response) {
    if (status == 200) {
        // do somethings ex: show logo of the payment method
        var form = document.querySelector('#formmp');

        if (document.querySelector("input[name=paymentMethodId]") == null) {
            var paymentMethod = document.createElement('input');
            paymentMethod.setAttribute('name', "paymentMethodId");
            paymentMethod.setAttribute('type', "hidden");
            paymentMethod.setAttribute('value', response[0].id);
            form.appendChild(paymentMethod);
        } else {
            document.querySelector("input[name=paymentMethodId]").value = response[0].id;
        }

        // check if the security code (ex: Tarshop) is required
        var cardConfiguration = response[0].settings,
            bin = getBin(),
            amount = document.querySelector('#amount').value;

        for (var index = 0; index < cardConfiguration.length; index++) {
            if (bin.match(cardConfiguration[index].bin.pattern) != null && cardConfiguration[index].security_code.length == 0) {
                /*
                * In this case you do not need the Security code. You can hide the input.
                */
            } else {
                /*
                * In this case you NEED the Security code. You MUST show the input.
                */
            }
        }

        Mercadopago.getInstallments({
            "bin": bin,
            "amount": amount
        }, setInstallmentInfo);

        // check if the issuer is necessary to pay
        var issuerMandatory = false,
            additionalInfo = response[0].additional_info_needed;

        for (var i = 0; i < additionalInfo.length; i++) {
            if (additionalInfo[i] == "issuer_id") {
                issuerMandatory = true;
            }
        };
        if (issuerMandatory) {
            Mercadopago.getIssuers(response[0].id, showCardIssuers);
            addEvent(document.querySelector('#issuer'), 'change', setInstallmentsByIssuerId);
        } else {
            document.querySelector("#issuer").style.display = 'none';
            document.querySelector("#issuer").options.length = 0;
        }
    }
};

function showCardIssuers(status, issuers) {
    var issuersSelector = document.querySelector("#issuer"),
        fragment = document.createDocumentFragment();

    issuersSelector.options.length = 0;
    var option = new Option("Selecciona Banco", '-1');
    fragment.appendChild(option);

    for (var i = 0; i < issuers.length; i++) {
        if (issuers[i].name != "default") {
            option = new Option(issuers[i].name, issuers[i].id);
        } else {
            option = new Option("Otro", issuers[i].id);
        }
        fragment.appendChild(option);
    }
    issuersSelector.appendChild(fragment);
    issuersSelector.removeAttribute('disabled');
    document.querySelector("#issuer").removeAttribute('style');
};

function setInstallmentsByIssuerId(status, response) {
    var issuerId = document.querySelector('#issuer').value,
        amount = document.querySelector('#amount').value;

    if (issuerId === '-1') {
        return;
    }

    Mercadopago.getInstallments({
        "bin": getBin(),
        "amount": amount,
        "issuer_id": issuerId
    }, setInstallmentInfo);
};

function setInstallmentInfo(status, response) {
    var selectorInstallments = document.querySelector("#installments"),
        fragment = document.createDocumentFragment();

    selectorInstallments.options.length = 0;

    if (response.length > 0) {
        var option = new Option("Selecciona Meses", '-1'),
            payerCosts = response[0].payer_costs;

        fragment.appendChild(option);
        for (var i = 0; i < payerCosts.length; i++) {
            option = new Option(payerCosts[i].recommended_message || payerCosts[i].installments, payerCosts[i].installments);
            fragment.appendChild(option);
        }
        selectorInstallments.appendChild(fragment);
        selectorInstallments.removeAttribute('disabled');
    }
};

function cardsHandler() {
    clearOptions();
    var cardSelector = document.querySelector("#cardId"),
        amount = document.querySelector('#amount').value;

    if (cardSelector && cardSelector[cardSelector.options.selectedIndex].value != "-1") {
        var _bin = cardSelector[cardSelector.options.selectedIndex].getAttribute("first_six_digits");
        Mercadopago.getPaymentMethod({
            "bin": _bin
        }, setPaymentMethodInfo);
    }
}

addEvent(document.querySelector('input[data-checkout="cardNumber"]'), 'keyup', guessingPaymentMethod);
addEvent(document.querySelector('input[data-checkout="cardNumber"]'), 'keyup', clearOptions);
addEvent(document.querySelector('input[data-checkout="cardNumber"]'), 'change', guessingPaymentMethod);
cardsHandler();
/*Termina comprbacion de tarjeta*/

doSubmit = false;
addEvent(document.querySelector('#formmp'),'submit',doPay);
function doPay(event){
    event.preventDefault();
    if(!doSubmit){
        var $form = document.querySelector('#formmp');
        
        Mercadopago.createToken($form, sdkResponseHandler); // The function "sdkResponseHandler" is defined below

        return false;
    }
};

function sdkResponseHandler(status, response) {
    if (status != 200 && status != 201) {
        alert("Favor de verificar sus datos");
    }else{
       
        var form = document.querySelector('#formmp');

        var card = document.createElement('input');
        card.setAttribute('name',"token");
        card.setAttribute('type',"hidden");
        card.setAttribute('value',response.id);
        form.appendChild(card);
        doSubmit=true;
        form.submit();
    }
};
//});
	
	
	
	
	
	
	
	$buildingup = false;
		$(this).delay(400,function(){
		$("#pasarelaLoading").stop().animate({top:'200px'}, {queue:false, duration:1500, easing: 'easeInOutBack'});
		$buildingup = true;	
    });
    
    
	$(".fancy").fancybox({
		'scrolling'		: 'no',
		'titleShow'		: false
	});
	
	$("#numtc").keypress(function(e) {
		$('#errorNumT').hide();
	});
	
	$("#cvvtc").keypress(function(e) {
		$('#errorCCV').hide();
	});
	
	$("#ciudad").keypress(function(e) {
		$('#errorCiudad').hide();
	});
	
	$("#direccion").keypress(function(e) {
		$('#errorDir').hide();
	});
  
	  	var conektaSuccessResponseHandler;
		conektaSuccessResponseHandler = function(token) {
	  		var $form;
	  		$form = $("#formPayu");
	  		/* Inserta el token_id en la forma para que se envíe al servidor */
	  		if(token.object == 'token')
	  			$form.append($("<input type=\"hidden\" name=\"conektaTokenId\" />").val(token.id));
	  		else
	  			$form.append($('<input type="hidden" name="conektaChargeId" />').val(token.id));	

	  		/* and submit */
	  		$form.get(0).submit();
		};
	
		var conektaErrorResponseHandler;
		conektaErrorResponseHandler = function(response) {
			$("#pasarelaLoading").hide();
	  		var $form;
	  		$form = $("#formPayu");
	
	  		/* Muestra los errores en la forma */
	  		$form.find(".card-errors").text(response.message);
	  		$form.find("button").prop("disabled", false);
		};
	
	$("#cp").keypress(function(e) {
		$('#errorCP').hide();
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
		var a_vigente		= $("#a_vigente").val();
		var m_vigente		= $("#m_vigente").val();
		var bancoNombre = $("#nombreBanco").val();  

		if(bancoNombre == ''){
			
			$('#errorBanco').empty().append('Elija el nombre de su banco').show();
			return false;
			
		}
		
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
				$('#errorNumT').empty().append('Número de tarjeta invalido').show();
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
		
		$("#pasarelaLoading").show();
		
		if($("#pasarelaTipo").val() == 'Conekta'){
			
			action = '<?=base_url();?>carrito/procesarConekta';
			$(this).attr('action', action);
			
			var $form;
	    	$form = $(this);
	
	    	/* Previene hacer submit más de una vez */
	    	$form.find("button").prop("disabled", true);
	    	
			if( $('#cboPagaraEn').val() == 1){
				
				$('#conektaAmount').val('<?=$compra[0]->total * 100;?>');	    	
	    		Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
	    		
	    	}else{
	    		
	    		if($('#cboPagaraEn').val() == 3){
	    			
	    			$('#conektaAmount').val($('#conektaDiferido3').val() * 100);
	    			
	    		}else if($('#cboPagaraEn').val() == 6){
	    			
	    			$('#conektaAmount').val($('#conektaDiferido6').val() * 100);
	    			
	    		}else if($('#cboPagaraEn').val() == 12){
	    			
	    			$('#conektaAmount').val($('#conektaDiferido12').val() * 100);
	    			
	    		}
				Conekta.charge.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
				
			}
	    	/* Previene que la información de la forma sea enviada al servidor */
	    	return false;

		}else if($("#pasarelaTipo").val() == 'Banorte'){
	    	
			action = '<?=base_url();?>carrito/procesarPago';
			$(this).attr('action', action);
		}
	});
	
	/*Termina submit */

	$("#numtc").keypress(function(e) {

		if (!(e.which >= 48 && e.which <= 57)) {
			if (e.which != 8 && e.which != 0) {
				$('#errorNumT').empty().append('Ingresar solo numeros').show();
				return false;
			}
		}else{
			$('#errorNumT').hide();
		}
		
		var test = $(this).val();
		
		if(test.charAt(0) == 3)
			$('#tipotc2').val("AMEX");
		else if(test.charAt(0) == 4)
			$('#tipotc2').val("VISA");
		else if(test.charAt(0) == 5)
			$('#tipotc2').val("MASTERCARD");
		else
			$('#tipotc2').val("");
				
		
		
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
		
		$('#tardetaTipo').val('debito');
		$('#tituloTarjetas').html('Tarjetas de débito');
		
		$.ajax({
			data : {"tipoPago":"debito"},
			dataType : 'json',
			url : '<?= base_url(); ?>ajax/cargarPagoBancos',
			type : 'post',
			beforeSend : function() {
				//$(".msgBlack").html("<span class='msg<'>Procesando, espere por favor...</span>");
			},
			success : function(response) {
				
				var opciones = response;
				$("#nombreBanco").empty();
				var optionsHtml = $("#nombreBanco");
				optionsHtml.append($("<option />").val("").text("Nombre del Banco..."));
				
				$.each(opciones,function(key,val){
					optionsHtml.append($("<option />").val(val.tipoID).text(val.banco));	
				});
				
				$('#card-form').hide();
				$('input[name="opPagoPayu"]').val("TC");
				$('#formPayu').show();
								
			}
		});
	});
	
	$('#nombreBanco').change(function(){
		
		$('#errorBanco').hide();
		$.ajax({
			data : {"PagoId":$(this).val()},
			dataType : 'json',
			url : '<?= base_url(); ?>ajax/cargaInfoPagoBanco',
			type : 'post',
			success : function(response) {
				
				$("#cboPagaraEn").empty();
				var optionsHtml = $("#cboPagaraEn");
				optionsHtml.append($("<option />").val(1).text("Formas de pago"));
				optionsHtml.append($("<option />").val(1).text("Un Solo Pago"));
		
				if(response.diferidos == '1' && $("#tardetaTipo").val() == 'credito'){
					
					<?php if($compra[0]->total >= 300):?>
				 	var cargo = <?php echo ($compra[0]->total * .047) + $compra[0]->total;?>;
				 	var meses = <?php echo ($compra[0]->total * .049); ?> + cargo;
				 	var total = meses/3;
				 	
				 	var conekta3meses = meses * 100;

				 	optionsHtml.append($("<option />").val(3).text("3 meses sin intereses ($"+parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()+" mxn mensual)"));
				 	$('#conektaDiferido3').val(meses);
				 	<? endif;?>	
				 
				 
				 	<?php if($compra[0]->total >= 600):?>
				 	var cargo = <?php echo ($compra[0]->total * .047) + $compra[0]->total;?>;
				 	var meses = <?php echo ($compra[0]->total * .079);?> + cargo;
				 	var total = meses/6;
				 
				 	var conekta6meses = meses * 100;
				 	
				 	optionsHtml.append($("<option />").val(6).text("6 meses sin intereses ($"+total+" mxn mensual)"));
				 	$('#conektaDiferido6').val(meses);
				 	<? endif;?>
				 	<?php if($compra[0]->total >= 1200):?>
				 
				 	var cargo = <?php echo ($compra[0]->total * .047) + $compra[0]->total;?>;
				 	var meses = <?php echo ($compra[0]->total * .139);?> + cargo;
				 	var total = meses/12;
				 
				 	var conekta12meses = meses * 100;
				 	
				 	optionsHtml.append($("<option />").val(12).text("12 meses sin intereses ($"+total+" mxn mensual)"));
				 	$('#conektaDiferido12').val(meses);
				 	<?php endif;?>
				}
				
				$('#pasarelaTipo').val(response.tipo);
								
			}
		});
		
	});
	
	$('#paypal').click(function(){
		$('#formPaypal').submit();
	});
	$('#meses').click(function(){
		
		$('#tardetaTipo').val('credito');
		$('#tituloTarjetas').html('Tarjetas de crédito');
		
		$.ajax({
			data : {"tipoPago":"credito"},
			dataType : 'json',
			url : '<?= base_url(); ?>ajax/cargarPagoBancos',
			type : 'post',
			beforeSend : function() {
				//$(".msgBlack").html("<span class='msg<'>Procesando, espere por favor...</span>");
			},
			success : function(response) {
				
				var opciones = response;
				$("#nombreBanco").empty();
				var optionsHtml = $("#nombreBanco");
				optionsHtml.append($("<option />").val("").text("Nombre del Banco..."));
				
				$.each(opciones,function(key,val){
					optionsHtml.append($("<option />").val(val.tipoID).text(val.banco));	
				});
				
				$('#card-form').hide();
				$('input[name="opPagoPayu"]').val("TC");
				$('#formPayu').show();
								
			}
		});
		
	});
	
});/*Termina Domument Ready*/ 
</script>


<!-- Facebook Conversion Code for hasta formas de pago -->
<script>(function() {
var _fbq = window._fbq || (window._fbq = []);
if (!_fbq.loaded) {
var fbds = document.createElement('script');
fbds.async = true;
fbds.src = '//connect.facebook.net/en_US/fbds.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(fbds, s);
_fbq.loaded = true;
}
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', '6026419863620', {'value':'0.01','currency':'USD'}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6026419863620&amp;cd[value]=0.01&amp;cd[currency]=USD&amp;noscript=1" /></noscript>
