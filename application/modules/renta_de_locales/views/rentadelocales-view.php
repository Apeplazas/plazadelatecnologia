<div id="contentRent">
<span id="spanRent"><img src="<?=base_url()?>assets/graphics/rentadelocales-en-plazadelatecnologia.png" alt="Renta de oficinas en Plaza de la Tecnologia" /></span>
<section id="renta">
<h1>Renta tu local en Plaza de la Tecnología</h1>
<p>¡No esperes más y crece con nosotros! Tenemos presencia en: México, Guadalajara, Monterrey, Estado de México, Aguascalientes, Chihuahua, Aguascalientes, León, San Luis Potosí, Mérida, Morelia, Toluca, Torreón, Puebla, Villahermosa… ¡y ahora una nueva Plaza en Querétaro! en Plaza de la Tecnología: siempre encuentras, ahorras y mejoras.</p>
<aside>
	<ul id="serv">
		<li>
			<span><img src="<?=base_url()?>assets/graphics/ubicacion_estrategica.png" alt="Ubicación Estrategica" /></span>
			<strong>Ubicacion Estrategica</strong>
			<p>Nos encontramos en las colonias Centro de las principales ciudades del país, por lo que la Plaza está en un punto de fácil acceso para todo público y es un negocio referente.</p>
		</li>
		<li>
			<span><img src="<?=base_url()?>assets/graphics/afluencia.png" alt="Gran Afluencia peatonal y vehicular" /></span>
			<strong>Gran afluencia peatonal y vehicular</strong>
			<p>Contamos más de 1 millón 700 mil visitantes mensuales y más de 100 locales comerciales en cada plaza. Con frecuencia realizamos eventos que acercan a tus compradores a la plaza.</p>
		</li>
		<li>
			<span><img src="<?=base_url()?>assets/graphics/seguridad.png" alt="Seguridad Constante" /></span>
			<strong>Seguridad constante</strong>
			<p>La Plaza está vigilada con personal capacitado durante las 24 horas los 365 días del año, realizamos un monitoreo constante por circuito cerrado de televisión con grabación.</p>
		</li>
		<li>
			<span><img src="<?=base_url()?>assets/graphics/publicidad.png" alt="Publicidad Permanente" /></span>
			<strong>Publicidad permanente en la Plaza</strong>
			<p>Invertimos en apoyo de Medios Masivos (Radio, Prensa, TV abierta y por cable) para difundir ofertas, promociones y al lugar mismo.</p>
		</li>
		<li>
			<span><img src="<?=base_url()?>assets/graphics/localenlinea.png" alt="Local en Linea" /></span>
			<strong>Local en linea</strong>
			<p>¡Ofrece tus servicios ahora por Internet! Te ofrecemos un espacio virtual donde puedes recibir cotizaciones publicar y contactar a más clientes por nuestra página web, que cuenta con 71 mil visitas mensuales.</p>
		</li>
	</ul>
</aside>
<form method="post" action="<?=base_url()?>contacto/guardarContactoRenta">
<h2>SOLICITA TU LOCAL CON NOSOTROS.</h2>
	<fieldset>
	  <input class="regIn required idleField" type="text" name="nombre" placeholder="Nombre Completo*" value="">
	</fieldset>
	<fieldset>
	  <input class="regIn required email idleField" type="text" placeholder="Email *" name="email" value="">
	</fieldset>
	<fieldset>
	  <input class="regIn required email idleField" type="text" placeholder="Telefono" name="telefono" value="">
	</fieldset>
	<fieldset>
	  <input class="regIn required email idleField" type="text" placeholder="Celular" name="celular" value="">
	</fieldset>
	<fieldset>
	   <select name="estado" class="selReg select required valid">
	   	 <option value="">Elige una Ciudad</option>
	   	 	<? foreach($ciudades as $row):?>
	   	 	<option value="<?= $row->sucursalCiudad;?>"><?= $row->sucursalCiudad;?></option>
	   	 	<? endforeach; ?>
	   </select>
	</fieldset>
	<fieldset>
		<textarea name="comentario" id="comRen" placeholder="Escribe tu pregunta o comentario..."></textarea>
	</fieldset>
	<fieldset>
	<p class="aviso"><input name="privacidad" checked="" type="checkbox" value="Leido">
	He leido el <a href="http://www.plazadelatecnologia.com/avisoPrivacidad" target="new">aviso de privacidad</a></p>
	</fieldset>
	<fieldset>
	  <input class="nBotonBig fwlight" type="submit" value="Enviar Información">
	</fieldset>
	</form>
</section>
</div>