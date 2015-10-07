<div id="contentCar" >
<h1>Pago en PAYU</h1>
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



		<?php }?>
	</div>
	</div>
</div>	