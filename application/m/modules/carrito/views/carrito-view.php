
<div id="contentCar">
<? $cart = $this->cart->contents();?>
<? if(count($cart)):?>
<h1>Productos agregados a tu carrito.</h1>
<div id="myCar">
<div id="shopAjaxHi">
<form action="http://m.plazadelatecnologia.com/carrito/confirmaCarrito" method="post">
<ul id="proCar">
<? foreach ($cart as $itemCart):?>
<? $item = $this->carrito_model->itemInfo($itemCart['id']);?>
<li class="evTab">
	<a href="http://m.plazadelatecnologia.com/<?=strtolower($item[0]->ramaNombre)?>/oferta/<?=url_title(trim($item[0]->ofertaTitulo), '_')?>/<?=$item[0]->ofertaID?>">
	<? if(fopen(base_url().'/ofertasLocatarios/'.str_replace('.', '_thumb.', $item[0]->ofertaImagen),'r')):?>
		<img style="max-width: 120px" src="<?=base_url()?>ofertasLocatarios/<?= str_replace('.', '_thumb.', $item[0]->ofertaImagen)?>" title="<?= $item[0]->ofertaTitulo?>" />
	<? else:?>
		<img style="width: 60px;" src="<?=base_url()?>assets/graphics/no_image.png" title="Imagen no disponible" />
	<? endif;?>
	</a>
	<strong><?= character_limiter($item[0]->ofertaTitulo, 50);?></strong>
	<p class="desCan">
		<select class="cantidad" title="<?=$itemCart['rowid']?>" name="cantidad<?=$item[0]->ofertaID?>">
			<? for ($i=1; $i <= $item[0]->existencia; $i++):?>
			<option value="<?=$i?>" <? if($i == $itemCart['qty']):?> selected <?endif;?>><?=$i?></option>
			<? endfor;?>
		</select>
	</p>
	<p class="totPreCar">$ <?= number_format($itemCart['price']);?></p>
	<p class="totNumCar" id="sub-<?=$itemCart['rowid']?>">$ <?= number_format($itemCart['subtotal']);?></p>
	<a class="deleteItem" href="http://m.plazadelatecnologia.com/carrito/eliminar/<?=$itemCart['rowid']?>">Quitar</a>
	<input type="hidden"  name="precioLocal-<?=$itemCart['rowid']?>" value="<?=$item[0]->precioLocal?>"/>
</li>
<? endforeach;?>
</ul>
<div id="accion">
<? $user = $this->session->userdata('user');?>
<? if($user['uid'] == ''):?>
<!-- Tu comentario<a id="finCompra" class="log" href="#login_form"><span><img src="<?=base_url()?>assets/graphics/carritodecompras.png" alt="Carrito de Compras" /></span><em>Iniciar sesión para continuar</em></a>-->
<a id="finCompra" style="width: 75%;" href="http://m.plazadelatecnologia.com/carrito/registrate"><em>Continuar</em></a> 
<? else:?>
<input type="submit" class="narBotonBig mtb10" value="Finalizar Compra" />
<? endif;?>
</form>
</div>

</div>
</div>
<br class="clear">
</div>
<? else:?>
<h1>No hay productos en tu carrito.</h1>
<? endif;?>
<script>
$('.cantidad').change(function() {
    var rowid = $(this).attr('title');
    var qty = $(this).val();
    var envio = $('#'+rowid).val();
   	$.ajax({
		url: 'http://m.plazadelatecnologia.com/carrito/addQty',
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
