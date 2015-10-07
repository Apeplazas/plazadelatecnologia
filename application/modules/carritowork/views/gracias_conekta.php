<div id="contentCar" >
<h1>Pago Bancario</h1>
	<div class="msgpaypal">
	<? if(!empty($mensajeError)):
		print_r($mensajeError);
	else:?>
	<span><img src="<?=base_url()?>assets/graphics/palomita.png" alt="Ok" /></span>
	<h3>TU PAGO FUE EXITOSO</h3>
	<div class="sep">
		<p>El detalle de tu compra fue mandada por correo electronico.</p>
		<p>Recuerda que toda la información que proporciones es absolutamente confidencial.</p>
	</div>
	<? endif; ?>
	</div>
</div>	
<img src="//cdsusa.veinteractive.com/DataReceiverService.asmx/Pixel?journeycode=ADBE8577-0CFE-4C2D-A096-AD1E7624180C" width="1" height="1"/>