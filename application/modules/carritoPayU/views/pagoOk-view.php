<div id="contentCar" >
<h1>Pago en PAYU</h1>
	<div class="msgpaypal">
	<span><img src="<?=base_url()?>assets/graphics/palomita.png" alt="Ok" /></span>
	<h3>Gracias por tu compra.</h3>
	<div class="sep">
		<?php

			$error = 200;
			$opPagoPayu = 'TC';
			$valores= array();

			if(isset($trans_error)&&intval($trans_error)==0&&isset($trans_referencia)){
				$valores = explode('#',$s_trans_respuesta);
			}else{
				header("Location: /");
				exit();
			}

 
		switch($opPagoPayu){
			case "TC":
		?>
		<p><?=$trans_msg?></p>	
		<br/><br/>
		<p>Información de su pago:</p>		
		<p>Tarjetahabiente: <?=$valores[3]?></p>		
		<p>Número de la tarjeta:************<?=$valores[4]?></p>		
		<p>Referencia: <?=$valores[1]?></p>		
		<p>Autorizacion: <?=$valores[2]?></p>		
		<p>Monto: <?=$valores[0]?> MXN</p>		
		<br/><br/>
		<p>El detalle de tu compra sera mandada por correo electronico.</p>		
		<p>Recuerda que toda la información que proporciones es absolutamente confidencial.</p>
			<?php break; ?>

			<?php case "OXXO":
		?>
		<p>El detalle de tu compra sera mandada por correo electronico una vez que tu pago sea confirmado.</p>
		<p>Imprime y presenta el comprobante, enviado a tu correo electronico, en cualquier tienda OXXO del país para realizar el pago por tu compra.<br>El pago se acreditará en la cuenta del vendedor a las 24 hs. de haberse realizado.</p>
		<p>Recuerda que toda la información que proporciones es absolutamente confidencial.</p>
			<?php break; ?>

			<?php case "7ELEVEN":
		?>
		<p>El detalle de tu compra sera mandada por correo electronico una vez que tu pago sea confirmado.</p>
		<p>Imprime y presenta el comprobante, enviado a tu correo electronico, en cualquier tienda 7-Eleven del país para realizar el pago por tu compra.<br>El pago se acreditará en la cuenta del vendedor a las 24 hs. de haberse realizado.</p>
		<p>Recuerda que toda la información que proporciones es absolutamente confidencial.</p>
			<?php break; ?>



		<?php }?>
	</div>
	</div>
</div>	