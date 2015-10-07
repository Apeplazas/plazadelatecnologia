<aside id="quejasysugerencias">
	<img src="<?=base_url()?>assets/graphics/solicitudlocalenlinea.png" alt="Solicita tu local en linea | Plaza de la tecnologia." />
</aside>
<section id="contentCont">
<h1>Listo para vender en Linea!!! solicita tu local en linea.</h1>
<p>Proporciona la siguiente información para hacer la solicitud de tu local en linea en Plaza de la Tecnología. Tu información debe ser completamente veridica y detallada, ya que esto te beneficiaria en las busquedas de productos y locales en linea.</p>
<form method="post" action="<?=base_url()?>registrate/procesaSolicitud" name="contactoForm">
<fieldset>
  <?= form_error('nombreAdministrador'); ?>
  <input class="regIn required inMem" placeholder="Nombre completo del administrador de la cuenta" type="text" name="nombreAdministrador">
</fieldset>
<fieldset>
  <?= form_error('nombreLocal'); ?>
  <input class="regIn required inMem" placeholder="Nombre de tu marca Ejemplo: Smarttech" type="text" name="nombreLocal">
</fieldset>
<fieldset>
  <?= form_error('razonSocial'); ?>
  <input class="regIn required inMem" placeholder="Razon social registrada en la contratación" type="text" name="razonSocial">
</fieldset>
<fieldset>
  <?= form_error('numeroLocal'); ?>
  <input class="regIn required inMem" type="text" name="numeroLocal" placeholder="Numero de local o locales">
</fieldset>
<fieldset>
  <?= form_error('email'); ?>
  <input class="regIn required inMem" type="text" name="email" placeholder="Escribe un email al que podamos contactarte">
</fieldset>
<fieldset>
  <?= form_error('telefono'); ?>
  <input class="regIn required inMem" type="text" name="telefono" placeholder="Telefono al que podamos contactarte incluyendo clave lada">
</fieldset>
<fieldset>
  <?= form_error('celular'); ?>
  <input class="regIn required inMem" type="text" name="celular" placeholder="Celular al que podamos contactarte">
</fieldset>
<fieldset>
  <?= form_error('contrasenia'); ?>
  <input class="regIn required inMem" type="text" name="contrasenia" placeholder="Contraseña que deseas para el sistema">
</fieldset>
<fieldset>
  <?= form_error('plaza'); ?>
   <select id="estado" name="plaza" class="selReg required valid">
   	 <option>¿En que plaza te encuentras?</option>
     <? foreach($sucursal as $rowC):?>
     <option value="<?= $rowC->sucursalNombre;?>"><?= $rowC->sucursalNombre;?></option>
     <? endforeach; ?>
   </select>
</fieldset>
<fieldset>
	<p class="aviso"><input name="privacidad" checked="" type="checkbox" value="Leido">
	He leido el <a href="http://www.plazadelatecnologia.com/avisoPrivacidad" target="new">aviso de privacidad</a></p>
	</fieldset>
<fieldset>
<input id="regAho" class="nBotonBig" type="submit" value="Enviar solicitud">
</fieldset>
<br class="clear">
</form>
</section>