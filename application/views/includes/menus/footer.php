<? if($this->uri->segment(1) != 'carrito'):?>
<div id="blackFoot">
<? $header = $this->data_model->cargarRamaDisponibles();?> 
<section id="specialForms">
	<form onchange="noticiasAction()" id="notForm">
		<span><h4>Noticias</h4><em>de interés</em></span>
		<select name="noticias" id="selectNot">
			<option> Elige una categoría</option>
			<option value="http://www.plazadelatecnologia.com/noticias/computo">Cómputo</option>
			<option value="http://www.plazadelatecnologia.com/noticias/telefonia">Telefonía</option>
			<option value="http://www.plazadelatecnologia.com/noticias/electronica">Electrónica</option>
			<option value="http://www.plazadelatecnologia.com/noticias/reparaciones">Reparación</option>
			<option value="http://www.plazadelatecnologia.com/noticias/eventosyactividades">Eventos</option>
			<option value="http://www.plazadelatecnologia.com/noticias/sorteos_rifas_concursos">Sorteos, rifas y concursos</option>
		</select>
	</form>
	<form method="post" action="<?= base_url()?>contacto/suscribete" id="bolForm">
		<span><h4>Suscríbete</h4> <em>a nuestro boletín</em></span>
		<input class="bolInp" type="text" placeholder="Escribe tu nombre" name="nombreSus"/>
		<input class="bolInp" type="text" placeholder="Escribe tu email" name="emailSus"/>
		<input id="envBol" type="submit" value="Enviar" />
	</form>
	<div id="socials">
	<span><h4>Síguenos</h4><b>aquí</b></span>
	<br class="clear">
	<img src="<?=base_url()?>assets/graphics/plazadelatecnologia-marketplace.png" alt="Plaza de la Tecnología Market Place" />
		<div id="details">
		<em>plazadelatecnologia.com</em>
		<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;width=200&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=440098306072057" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:180px; height:21px;" allowTransparency="true"></iframe>
		</div>
		<a id="detailsTwi" href="https://twitter.com/plazatecnologia" class="twitter-follow-button" data-show-count="true" data-lang="es">Follow @plazatecnologia</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
</script>
	</div>
	<div id="amipci">
		<img src="<?=base_url()?>assets/graphics/amipci.png" alt="Socio AMIPCI" />
	</div>
	<div id="terrenos">
		<a href="http://www.plazadelatecnologia.com/arrendador"><img src="<?=base_url()?>assets/graphics/compramosterrenos.png" alt="Socio AMIPCI" /></a>
	</div>
</section>
</div>
<? endif;?>
<div id="grayFoot">
	<span><img src="<?=base_url()?>assets/graphics/plazadelatecnologia-Vertical.png" alt="Plaza de la Tecnología" /></span>
	<dl id="metPago">
	 	<dt>Métodos de pago</dt>
	 	<dd><img src="<?=base_url()?>assets/graphics/visa.png" alt="Visa" /></dd>
	 	<dd><img src="<?=base_url()?>assets/graphics/mastercard.png" alt="Mastercard" /></dd>
	 	<dd><img src="<?=base_url()?>assets/graphics/americanexpress.png" alt="American Express" /></dd>
	 	<dd><img src="<?=base_url()?>assets/graphics/oxxo.png" alt="oxxo" /></dd>
	 	<dd><img src="<?=base_url()?>assets/graphics/paypal-icon.png" alt="Paypal" /></dd>
	 	<dd><img src="<?=base_url()?>assets/graphics/seveneleven.png" alt="Seven Eleven" /></dd>
	 </dl>
	  <dl id="atencion">
	 	<dt>Atención a Clientes</dt>
	 	<dd><a title="Solicita tu local en línea" href="<?=base_url()?>registrate/solicitud_local">Registra tu Local en Línea</a></dd>
	 	<dd><a title="Contacto" href="<?=base_url()?>contacto">Contacto</a></dd>
	 	<dd><a title="Quejas y Sugerencias" href="<?=base_url()?>contacto/quejasysugerencias">Quejas y Sugerencias</a></dd>
	 	<dd><a title="Devoluciones" href="<?=base_url()?>contacto/devoluciones">Devoluciones</a></dd>
	 </dl>
	 <dl id="importante">
	 	<dt>Nosotros</dt>
	 	<dd><a title="Quejas y Sugerencias" href="<?=base_url()?>nosotros">Nosotros</a></dd>
	 	<dd><a title="Sucursales" href="<?=base_url()?>sucursales">Sucursales</a></dd>
	 	<dd><a title="Renta de locales" href="<?=base_url()?>renta_de_locales">Renta de locales</a></dd>
	 	<dd><a title="Politicas de Privacidad" href="<?=base_url()?>avisoPrivacidad">Aviso de Privacidad</a></dd>
	 	<dd><a title="Términos y Condiciones" href="<?=base_url()?>terminosycondiciones">Términos y Condiciones</a></dd>
	 	<dd><a title="Politicas de Privacidad" href="<?=base_url()?>politicas_de_devoluciones">Politicas de Devolución</a></dd>
	 </dl>
	  <dl id="importante">
	 	<dt>Noticias</dt>
	 	<dd><a title="Noticias de Computo" href="<?=base_url()?>noticias/computo">Cómputo</a></dd>
	 	<dd><a title="Noticias de Telefonía" href="<?=base_url()?>noticias/telefonia">Telefonía</a></dd>
	 	<dd><a title="Noticias de Electrónica" href="<?=base_url()?>noticias/electronica">Electrónica</a></dd>
	 	<dd><a title="Noticias de Reparación" href="<?=base_url()?>noticias/reparaciones">Reparación</a></dd>
	 	<dd><a title="Eventos en Plaza de la Tecnología" href="<?=base_url()?>noticias/eventosyactividades">Eventos</a></dd>
	 	<dd><a title="Sorteos, rifas y concursos en Plaza de la Tecnología" href="<?=base_url()?>noticias/sorteos_rifas_concursos">Sorteos, rifas y concursos</a></dd>
	 	<dd><a title="Noticias de Plaza de la Tecnología" href="<?=base_url()?>noticias">Todas las noticias</a></dd>
	 </dl>
	 <dl id="importante">
	 	<dt>Redes Sociales</dt>
	 	<dd><a title="Siguenos en Facebook" href="https://www.facebook.com/plazadelatecnologia" target="_blank">Facebook</a></dd>
	 	<dd><a title="Siguenos en Twitter" href="https://twitter.com/plazatecnologia" target="_blank">Twitter</a></dd>
	 	<dd><a title="Siguenos en Google Plus" href="https://plus.google.com/+plazadelatecnologia" target="_blank">Google plus</a></dd>
	 	<dd><a title="Siguenos en YouTube" href="https://www.youtube.com/user/PlazadelaTecnologia" target="_blank">YouTube</a></dd>
	 </dl>
	 <em> &copy; 2013 | 2014 Plaza de la Tecnología Todos los derechos reservados.</em>
	 <a id="mixpanel" href="https://mixpanel.com/f/partner"><img src="//cdn.mxpnl.com/site_media/images/partner/badge_light.png" alt="Mobile Analytics" /></a>
 </div>
 <script type="text/javascript">
	function noticiasAction() {
		var f = document.getElementById('notForm');
		var s = document.getElementById('selectNot');
			if( s.selectedIndex == 1 ) { 
				f.setAttribute("action",s.options[1].value) ;  
				f.submit();
			}
			if( s.selectedIndex == 2 ) { 
			location.href = s.options[2].value;
			}
		}
</script>