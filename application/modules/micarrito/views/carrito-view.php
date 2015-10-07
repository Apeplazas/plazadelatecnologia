<div id="contentCar">
<h1>Productos agregados a tu carrito.</h1>
<div id="myCar">
	<div id="shopAjaxHi">
	<ul id="desMenCar" class="fleft100">
		<li class="desCarM">Descripción</li>
		<li class="desCan">Cantidad</li>
		<li class="desPre">Precio</li>
		<li class="desIva">Iva</li>
		<li class="desTot">Total</li>
	</ul>
<ul id="proCar">
<li class="evTab">
	<div class="naDesCar">
		<a href="<?=base_url()?>"><img src="http://localhost:8888/ptv8/assets/graphics/samsunggalaxy.png" alt="Samsung Galaxy"></a>
		<strong>Samsung Galaxy S4 LTE GT-I337M Telcel - Negro</strong>
		<p>dsfasdfas sadf asd fasdf asdf asdfsdf adsf sdf asfdfasdf asdf asdf asdf asd f</p>
	</div>
	<form class="ajaxQty" accept-charset="utf-8" method="post" action="http://www.supernaturista.com/carrito/addQtyCar">
		<input class="fleft ajaxAct min" type="submit" name="subtract92270" onclick="javascript: subtractQty92270();" value="-">
	    <input disabled="disabled" class="number ajaxOn" type="text" name="cantidad" id="qty92270" value="1">
	    <input class="fleft ajaxAct plus" type="submit" name="cantidad92270" onclick="javascript: document.getElementById(&quot;qty92270&quot;).value++;" value="+">
	    <input type="hidden" name="id" value="a265a8ff5ff76c7594010c9b8d0d8b0e">
	    <script type="text/javascript">
		function subtractQty92270(){
			if(document.getElementById("qty92270").value - 1 < 0)
				return;
			else
				 document.getElementById("qty92270").value--;
		}
		</script>	 
	</form>
	<p class="totPreCar">$ 86</p>
	<p class="ivaCar">$ 14</p>
	<p class="totNumCar">$ 100</p>
</li>

<li class="evTab">
	<p class="naDesCar"><span><img src="<?=base_url()?>assets/graphics/samsunggalaxy.png" alt="Samsung Galaxy"></span><em>Samsung Galaxy S4 LTE Telcel</em></p>
	<form class="ajaxQty" accept-charset="utf-8" method="post" action="http://www.supernaturista.com/carrito/addQtyCar">
	<input class="fleft ajaxAct min" type="submit" name="subtract11584" onclick="javascript: subtractQty11584();" value="-">
	<input disabled="disabled" class="number ajaxOn" type="text" name="cantidad" id="qty11584" value="1">
	<input class="fleft ajaxAct plus" type="submit" name="cantidad11584" onclick="javascript: document.getElementById(&quot;qty11584&quot;).value++;" value="+">
	<input type="hidden" name="id" value="67a3c1520c0b54c1f3be3fcfb4f1dca0">
	
	<script type="text/javascript">
	function subtractQty11584(){
		if(document.getElementById("qty11584").value - 1 < 0)
			return;
		else
			document.getElementById("qty11584").value--;
		}
	</script>
	</form>
	<p class="totPreCar">$ 17</p>
	<p class="ivaCar">$ 0</p>
	<p class="totNumCar">$ 17</p>
</li>
</ul>

<div id="accion">
<a class="fleft segBot" href="<?=base_url()?>recomendados" title="Seguir Comprando">Seguir comprando</a>

<a class="fleft segBot" href="<?=base_url()?>deseos/guardarCarrito" title="Guardar Carrito">Guardar Carrito</a>

<a id="finCompra" href="<?=base_url()?>carrito/autenticacion"><span><img src="<?=base_url()?>assets/graphics/carritodecompras.png" alt="Carrito de Compras" /></span><em>Finalizar Compra</em></a>
</div>


<script>
$(document).ready(function(){
$ ('.evTab:even').addClass('even');
$('.ajaxQty').on('submit', function(){ 
	var that = $(this),
		url = that.attr('action'),
		type = that.attr('method'),
		data = {};
	that.find('[name]').each(function(index, value){
		var that = $(this),
			name = that.attr('name'),
			value = that.val();
		
		data[name] = value;
	});
	
	$.ajax({
		url: url,
		type: type,
		data: data,
		success: function(html){
				if(html){
					$('#finCom, #shopAjaxHi, #shopAjax, #botonCm').remove();
					$('#myCar').append(html);
					}
				
				}
			});
		return false;
	});

});
</script>
</div></div>
<br class="clear">
</div>