<form id="banFoto" class="share-popup" method="post" action="<?=base_url() ?>mi_local/boxBanner" enctype="multipart/form-data">
<span><img src="<?=base_url()?>assets/graphics/profile.png" alt="Agrega tu foto" /></span>
	<fieldset>
		<em>Agrega tu foto, Recuerda cada foto puede pesar máximo 1 Mega. </em>
		<input id="userfile" value="" type="file" size="35" name="userfile" />
	</fieldset>
    <input class="narBotonBla fright pt10" type="submit" value="Subir Box Banner"/>
</form>