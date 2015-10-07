<div id="contentReg">
<section>
	<h1>Administrador</h1>
	<form   method="post" action="<?=base_url()?>acceso/validate_credentials">
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