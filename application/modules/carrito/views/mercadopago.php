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