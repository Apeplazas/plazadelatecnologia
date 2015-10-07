<div id="contentReg">
<section>
	<h1>Recupera tu contraseña</h1>
	<form   method="post" action="<?=base_url()?>registrate/recuperar_hash">
    <strong>Proporciona el email dado de alta en tu cuenta.</strong>
    <?= $this->session->flashdata('msg'); ?>
    <fieldset>
      <input class="regIn required  email" minlength="2" type="text" placeholder="Escribe tu email" name="email">
    </fieldset>
    <fieldset>
      <input class="nBotonBig fwlight" type="submit"  value="Solicitar contraseña">
    </fieldset>
    </form>
</section>
</div>