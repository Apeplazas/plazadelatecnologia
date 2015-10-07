<header>
<h1>Generar ficha para pago en Oxxo o 7-Eleven.</span></h1>
</header>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<div id="panel">
		<form style="padding: 20px;" action="https://www.dineromail.com/mx/Shop/Shop_Ingreso.asp" method="post">
		<input type="hidden" name="NombreItem" value="Pago en Oxxo ">
		<input type="hidden" name="TipoMoneda" value="1">
		<input type="text" class="regIn" name="PrecioItem" placeholder="Monto a pagar">
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
</section>

