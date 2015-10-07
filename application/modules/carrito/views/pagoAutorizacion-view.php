<?php if($this->uri->segment(2) == 'pagoAutorizacion'):?>
<!-- Google Code for Compra Final Real Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 967808133;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "tWUQCI2zoVkQham-zQM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/967808133/?label=tWUQCI2zoVkQham-zQM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php endif;?>

<?php if($this->uri->segment(2) == 'procesarComproPago'):?>
	<!-- Google Code for VentaComproPago Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 967808133;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "6ObDCN-0oVkQham-zQM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/967808133/?label=6ObDCN-0oVkQham-zQM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<?php endif;?>
<img src="//cdsusa.veinteractive.com/DataReceiverService.asmx/Pixel?journeycode=ADBE8577-0CFE-4C2D-A096-AD1E7624180C" width="1" height="1"/>
<div id="contentCar" >
<h1>Pago</h1>
	<div class="msgpaypal">
	<? if($trans_error != 0):?>
	<span><img src="<?=base_url()?>assets/graphics/tache.png" alt="Error" /></span>
	<? else:?>
	<span><img src="<?=base_url()?>assets/graphics/palomita.png" alt="Ok" /></span>
	<? endif;?>
	<h3>Gracias por tu compra.</h3>
	<div class="sep">
		<?php

			$error = 200;
			$opPagoPayu = 'TC';
			$valores= array();

			if(isset($trans_error)&&isset($trans_referencia)){
				$opPagoPayu = $trans_tipo;
			}else{
				header("Location: /");
				exit();
			}

 
		switch($opPagoPayu){
			case "TC":
		?>
		<p><?=$trans_msg?></p>	
		<br/><br/>			
		<p>Recuerda que toda la información que proporciones es absolutamente confidencial.</p>
			<?php break; ?>

			<?php case "OXXO":
		?>
		<p><?=$trans_msg?></p>	
		<br/><br/>
		<p>Codigo de reservaci&oacute;n: <?=$trans_referencia?></p>
		<br/>
		<p><a href="/carrito/imprimirTicket" target="_blank">Imprime y presenta este comprobante en cualquier tienda OXXO del país para realizar el pago por tu compra, Presione aquí</a></p>
		<br/><br/>
		<p>El detalle de tu compra sera mandada por correo electronico una vez que tu pago sea confirmado.</p>
		<p>Imprime y presenta el comprobante, enviado a tu correo electronico, en cualquier tienda OXXO del país para realizar el pago por tu compra.<br>El pago se acreditará en la cuenta del vendedor a las 24 hs. de haberse realizado.</p>
		<p>Recuerda que toda la información que proporciones es absolutamente confidencial.</p>
			<?php break; ?>

			<?php case "7ELEVEN":
		?>
		<p><?=$trans_msg?></p>	
		<br/><br/>
		<p>Codigo de reservaci&oacute;n: <?=$trans_referencia?></p>
		<br/>
		<p><a href="/carrito/imprimirTicket" target="_blank">Imprime y presenta este comprobante en cualquier tienda 7ELEVEN del país para realizar el pago por tu compra, Presione aquí</a></p>		
		<br/><br/>
		<p>El detalle de tu compra sera mandada por correo electronico una vez que tu pago sea confirmado.</p>
		<p>Imprime y presenta el comprobante, enviado a tu correo electronico, en cualquier tienda 7-Eleven del país para realizar el pago por tu compra.<br>El pago se acreditará en la cuenta del vendedor a las 24 hs. de haberse realizado.</p>
		<p>Recuerda que toda la información que proporciones es absolutamente confidencial.</p>
			<?php break; ?>

			<?php default: ?>
				<?php if(is_array($trans_msg)):
					foreach($trans_msg as $msg):?>	
					<p><?=$msg;?></p>
					<?endforeach;
			endif;?>
				
			<?php break; ?>

		<?php }?>
		<? $this->cart->destroy();?>
	</div>
	</div>
</div>