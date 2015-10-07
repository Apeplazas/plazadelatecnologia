<div id="content">
<aside id="quejasysugerencias">
	
	<img class="fleft" style="width: 300px;" src="<?=base_url()?>articulosUpload/<?= $noticia[0]->articuloImagenes;?>.jpg" alt="<?= $noticia[0]->articuloTitulo;?>" />
</aside>
<section id="contentCont">
<h1><?=$noticia[0]->articuloTitulo?></h1>
<p>Registrate para asistir al evento.</p>
<?= $this->session->flashdata('msg'); ?>
<form method="post" action="<?=base_url()?>eventos/guardaSuscripcion">
<fieldset>
  <?= form_error('nombreAdministrador'); ?>
  <input class="regIn required inMem" placeholder="Nombre completo" type="text" name="nombreCompleto">
</fieldset>
<fieldset>
  <?= form_error('email'); ?>
  <input class="regIn required inMem" type="text" name="email" placeholder="Escribe tu email">
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
	<p class="aviso"><input name="privacidad" checked="" type="checkbox" value="Leido">
	He leido el <a href="http://www.plazadelatecnologia.com/avisoPrivacidad" target="new">aviso de privacidad</a></p>
	</fieldset>
<fieldset>
<input type="hidden" name="eventoID" value="<?=$noticia[0]->articuloID?>" />
<input type="hidden" name="back" value="<?=$this->uri->uri_string()?>" />
<input type="hidden" name="eventoUrl" value="<?=$this->uri->segment(3)?>" />
<input type="hidden" name="ciudad" value="Querétaro" />
<input id="regAho" class="nBotonBig" type="submit" value="Enviar">
</fieldset>
<br class="clear">
</form>
</section>
</div>