<div id="contentReg">
<section>
<h1>Plaza de la tecnología</h1>
<p>Por cuestiones de seguridad, tendrás que cambiar tu contraseña por una nueva, Escribe tu nueva contraseña y confirmarla después oprime el botón enviar.</p>
<form method="post" action="<?=base_url()?>registrate/pwd">
<strong>Cambia tu Contraseña.</strong>
<?= $this->session->flashdata('msg'); ?>
<fieldset>
  <input class="regIn required  email" minlength="2" type="password" placeholder="Escribe tu nueva contraseña" name="new_pwd">
</fieldset>
<fieldset>
  <input class="regIn required  email" minlength="2" type="password" placeholder="Confirma tu contraseña" name="new_pwd_again">
</fieldset>
<fieldset>
  <? foreach($query as $row):?>
  <input type="hidden" value="<?= $row->usuarioTipo;?>" name="tipo" />
  <? endforeach; ?>
  <input type="hidden" value="<?= $this->uri->segment(4);?>" name="hash" />
  <input class="nBotonBig fwlight" type="submit"  value="Cambiar contraseña">
</fieldset>
</form>
</section>
</div>