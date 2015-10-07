<div id="contentReg">
<section>
	<h1>Iniciar sesión</h1>
	<a id="conFac" title="Registrate con facebook" href="<?=base_url()?>myfacebook"><img src="<?=base_url()?>assets/graphics/conectate.png" alt="Registrate con facebook" /></a>
	<form   method="post" action="<?=base_url()?>registrate/validate_credentials">
    <strong>Bienvenido de Regreso.</strong>
    <?= $this->session->flashdata('msg'); ?>
    <fieldset>
      <input class="regIn required  email" minlength="2" type="text" placeholder="Escribe tu email" name="email">
    </fieldset>
    <fieldset>
      <input type="password" class="regIn required" name="contrasenia" placeholder="Contraseña">
    </fieldset>
    <fieldset>
   		<p class="aviso"><a href="<?=base_url()?>registrate/recuperar_contrasenia">¿Olvidaste tu Contraseña?</a></p>
    </fieldset>
    <fieldset>
      <input type="hidden" value="<?=$this->uri->uri_string()?>" name="url">
      <input class="nBotonBig fwlight" type="submit"  value="Enviar">
    </fieldset>
    </form>
</section>
</div>