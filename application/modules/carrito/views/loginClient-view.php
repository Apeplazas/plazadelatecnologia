<section id="loginReg">
<span id="regis">
<strong>¿Tu primera compra con nosotros?</strong>
<a id="finCompra" class="mt10" href="<?=base_url()?>registrate"><span><img src="<?=base_url()?>/assets/graphics/registrateaqui.png" alt="Registrate aqui"></span><em>Registrate aquí</em></a>
</span>
<form id="reg" method="post" action="<?=base_url()?>registrate/accesoCarrito">
  <h4>Ingresar a Mi cuenta</h4>
  <?= $this->session->flashdata('msg'); ?>
  <p>Si ya estas registrado ingresa tu usuario y Contraseña</p>
  <fieldset>
    <legend>Email</legend>
    <input id="nomForm" class="inputReg required  email" minlength="2" type="text" placeholder="ESCRIBE TU EMAIL" name="email">
  </fieldset>
  <fieldset>
    <legend>Contraseña</legend>
	<input id="emaForm" type="password" class="inputReg required" value="" name="contrasenia">
  </fieldset>
  <fieldset>
	  <a id="olvRe" href="<?=base_url()?>registrate/recuperar_contrasenia">¿Olvidaste tu Contraseña?</a>
  </fieldset>
  <fieldset class="f100">
    <input id="regP" class="registrarse nBotonBig ml10 mt20"  type="submit" value="Ingresar a tu cuenta">
  </fieldset>
</form>
</section>
