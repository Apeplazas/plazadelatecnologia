<div id="contentCar">
<? $cart = $this->cart->contents();?>
<? if(count($cart)):?>
<h1>Productos agregados a tu carrito.</h1>
<div id="myCar">
	<div id="shopAjaxHi">
	<ul id="desMenCar" class="fleft100">
		<li class="desCarM">Descripción</li>
		<li class="desCan">Cantidad</li>
		<li class="desPre">Precio</li>
		<!--<li class="desEnvio">Envio</li>-->
		<li class="desTot">Subtotal</li>
	</ul>
<form action="https://www.plazadelatecnologia.com/carrito/confirmaCarrito" method="post">
<ul id="proCar">
<? foreach ($cart as $itemCart):?>
<? $item = $this->carritowork_model->itemInfo($itemCart['id']);?>
<li class="evTab">
	<div class="naDesCar">
		<a href="<?=base_url()?><?=strtolower($item[0]->ramaNombre)?>/oferta/<?=url_title(trim($item[0]->ofertaTitulo), '_')?>/<?=$item[0]->ofertaID?>">
	    <? if(file_exists($_SERVER['DOCUMENT_ROOT'].'/ofertasLocatarios/'.str_replace('.', '_thumb.', $item[0]->ofertaImagen))):?>
    	<img style="max-width: 120px" src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $item[0]->ofertaImagen)?>" title="<?= $item[0]->ofertaTitulo?>" />
    	<? else:?>
    	<img style="width: 60px;" src="<?=base_url()?>assets/graphics/no_image.png" title="Imagen no disponible" />
    	<? endif;?>
		</a>
		<p><b><?= $item[0]->ofertaTitulo;?></b>
		<?= character_limiter($item[0]->ofertaDescripcion, 100);?></p>
	</div>
	<p class="desCan">
	<select class="cantidad" title="<?=$itemCart['rowid']?>" name="cantidad<?=$item[0]->ofertaID?>">
		<? if($item[0]->existencia < 2):?>
			<option value="1" selected disabled>1</option>
		<? else:?>
		<? for ($i=1; $i <= $item[0]->existencia; $i++):?>
		<option value="<?=$i?>" <? if($i == $itemCart['qty']):?> selected <?endif;?>><?=$i?></option>
		<? endfor;?>
		
		<? endif;?>
	</select>
	</p>
	<p class="totPreCar">$ <?= number_format($itemCart['price']);?></p>
	<!--<p class="totEnvio">
		<? if($item[0]->envio != 'Si'):?>
		<!--<select class="envio" required="required" name="envio-<?=$itemCart['rowid']?>" title="<?= $itemCart['subtotal']?>" id="<?=$itemCart['rowid']?>">
			<option value="">Elige una forma de envio</option>
			<option value="<?=$item[0]->costoEnvio?>">Absorver el costo de envio. $<?=$item[0]->costoEnvio?></option>
			<option value="0">Recoger articulo en Plaza de la Tecnología Aguascalientes</option>
		</select>
		
		
		<em class="msgEnvio">$<?=$item[0]->costoEnvio?></em>
		<? else:?>
		<em class="msgEnvio">Envio a domicilio gratis.</em>
		
	<? endif;?>
	<input type="hidden" id="<?=$itemCart['rowid']?>" name="envio-<?=$itemCart['rowid']?>" value="<?=$item[0]->costoEnvio?>"/>
	</p>-->
	<p class="totNumCar" id="sub-<?=$itemCart['rowid']?>">$ <?= number_format($itemCart['subtotal']);?></p>
	<a class="deleteItem" href="<?=base_url()?>carrito/eliminar/<?=$itemCart['rowid']?>"><img src="<?=base_url()?>assets/graphics/list-remove.png" title="Quitar del carrito"/></a>
	<input type="hidden"  name="precioLocal-<?=$itemCart['rowid']?>" value="<?=$item[0]->precioLocal?>"/>
</li>
<? endforeach;?>
</ul>
<div id="accion">
<!--<a class="fleft segBot" href="<?=base_url()?>recomendados" title="Seguir Comprando">Seguir comprando</a>
<a class="fleft segBot" href="<?=base_url()?>deseos/guardarCarrito" title="Guardar Carrito">Guardar Carrito</a>-->
<? $user = $this->session->userdata('user');?>
<? if($user['uid'] == ''):?>
<!-- Tu comentario<a id="finCompra" class="log" href="#login_form"><span><img src="<?=base_url()?>assets/graphics/carritodecompras.png" alt="Carrito de Compras" /></span><em>Iniciar sesión para continuar</em></a>-->
<a id="finCompra" class="log" href="<?=base_url()?>carrito/registrate"><span><img src="<?=base_url()?>assets/graphics/carritodecompras.png" alt="Carrito de Compras" /></span><em>Continuar</em></a> 
<? else:?>
<input type="submit" class="narBotonBlaRig pt10" value="Finalizar Compra" />
<? endif;?>
</form>
</div>

<? else:?>
<h1>No hay productos en tu carrito.</h1>
<? endif;?>
</div>
</div>
<br class="clear">
</div>
<script>
$('.cantidad').change(function() {
    var rowid = $(this).attr('title');
    var qty = $(this).val();
    var envio = $('#'+rowid).val();
   	$.ajax({
		url: 'http://www.plazadelatecnologia.com/carrito/addQty',
		type: 'post',
		data: {qty : qty, rowid : rowid, envio : envio},
		success: function(html){
				if(html){
					$('#sub-'+rowid).empty();
					$('#sub-'+rowid).append(html);
					$('#'+rowid).attr( 'title', html.replace("$","") );
					}
				}
			});
});
</script>
<script>
$('.envio').change(function() {
	var rowid = $(this).attr('id');
    var envio = $(this).val() * 1;
    var text = $('#'+rowid+' option:selected').text();
    var total = $(this).attr('title') * 1;
    var option= $('#'+rowid+' option').eq(1).val() * 1;
    
    if(envio != 0){
    	var echo  = total + envio;
    }else{
    	if(total > option){
    		var echo = total - option;
    	}else if(total < option){
    		var echo = total;
    	}
    }
	
	$('#sub-'+rowid).empty();
	$('#sub-'+rowid).append('$ '+echo);
	$('#'+rowid).attr( 'title', echo);		
	$('#hide-'+rowid).attr( 'value', text);	
});
</script>
