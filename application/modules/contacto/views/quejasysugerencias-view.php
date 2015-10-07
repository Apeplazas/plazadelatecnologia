<aside id="quejasysugerencias">
	<img src="<?=base_url()?>assets/graphics/quejasysugerencias.png" alt="Quejas y Sugerencias | Plaza de la tecnologia te escucha." />
</aside>
<section id="contentCont">
<h1>Plaza de la tecnologia te escucha.</h1>
<p>En Plaza de la Tecnología nos esforzamos cada día para darte el mejor servicio, si tienes alguna sugerencia o queja por favor mándanos este formulario para darle seguimiento. Para mejor servicio, procura proporcionarnos la mayor información posible.</p>
<form method="post" action="<?=base_url()?>contacto/guardarContacto" name="contactoForm">
<fieldset>
  <input class="regIn required inMem" placeholder="Nombre" type="text" name="nombreContacto" value="">
</fieldset>
<fieldset>
  <input class="regIn required inMem" type="text" name="emailContacto" placeholder="Correo electronico Ejemplo: email@gmail.com" value="">
</fieldset>
<fieldset>
  <input class="regIn required inMem" type="text" name="telContacto" placeholder="Pueden llamarme al teléfono" value="">
</fieldset>
<fieldset>
   <select id="estado" name="estadoContacto" class="selReg required valid">
   	 <option value="">¿En que ciudad te encuentras?</option>
     <option value="Baja California">Baja California</option>
     <option value="Baja California Sur">Baja California Sur</option>
     <option value="Campeche">Campeche</option>
     <option value="Coahuila">Coahuila</option>
     <option value="Colima">Colima</option>
     <option value="Chiapas">Chiapas</option>
     <option value="Chihuahua">Chihuahua</option>
     <option value="Distrito Federal">Distrito Federal</option>
     <option value="Durango">Durango</option>
     <option value="Guanajuato">Guanajuato</option>
     <option value="Guerrero">Guerrero</option>
     <option value="Hidalgo">Hidalgo</option>
     <option value="Jalisco">Jalisco</option>
     <option value="México">México</option>
     <option value="Michoacan">Michoacan</option>
     <option value="Morelos">Morelos</option>
     <option value="Nayarit">Nayarit</option>
     <option value="Nuevo León">Nuevo León</option>
     <option value="Oaxaca">Oaxaca</option>
     <option value="Puebla">Puebla</option>
     <option value="Quéretaro">Quéretaro</option>
     <option value="Quintana Roo">Quintana Roo</option>
     <option value="San Luis Potosí">San Luis Potosí</option>
     <option value="Sinaloa">Sinaloa</option>
     <option value="Sonora">Sonora</option>
     <option value="Tabasco">Tabasco</option>
     <option value="Tamaulipas">Tamaulipas</option>
     <option value="Tlaxcala">Tlaxcala</option>
     <option value="Veracruz">Veracruz</option>
     <option value="Yucatán">Yucatán</option>
     <option value="Zacatecas">Zacatecas</option>
     <option value="Zacatecas">Otra</option>
   </select>
</fieldset>
<fieldset>
	<select id="moCo" name="motivoContacto" class="selReg required valid inMem">
		<option value="">Tipo de Queja</option>
		<option value="Compra en linea">Compra en linea</option>
		<option value="Atención a Clientes">Atención a Clientes</option>
		<option value="Atención de la Administración">Atención de la Administración</option>
		<option value="Comportamiento de algún locatario">Comportamiento de algún locatario</option>
		<option value="No respetaron mi garantía">No respetaron mi garantía</option>
		<option value="Problemas en la pagina WEB">Problemas en la pagina WEB</option>
		<option value="Envío de productos">Envío de productos</option>
		<option value="Renta de locales">Renta de locales</option>
		<option value="Solicitud de local en linea">Solicitud de local en linea</option>
		<option value="Quejas o Sugerencias">Otro tema</option>
		<option value="Otros">Otros</option>
	</select>
</fieldset>
<fieldset>
  <textarea id="dirMem" name="comentarioContacto" placeholder="Describe lo sucedido" class="espInput required" value=""></textarea>
</fieldset>
<fieldset>
	<p class="aviso"><input name="privacidad" checked="" type="checkbox" value="Leido">
	He leido el <a href="http://www.plazadelatecnologia.com/avisoPrivacidad" target="new">aviso de privacidad</a></p>
	</fieldset>
<fieldset>
<input id="regAho" class="nBotonBig" type="submit" value="Enviar comentario">
</fieldset>
<br class="clear">
</form>
</section>