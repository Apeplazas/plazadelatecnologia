<form id="fotoMain" class="share-popup" method="post" action="<?=base_url() ?>mi_local/fotoMain/<?= $this->uri->segment(3);?>/<?= $this->uri->segment(4);?>" enctype="multipart/form-data">
<span><img src="<?=base_url()?>assets/graphics/profile.png" alt="Agrega tu foto" /></span>
	<fieldset>
		<a class="iconoFoto" >
		<input id="userfile" class="subirFoto required" value="" type="file" size="35" name="userfile" />
		<em>Agrega tu foto, peso máximo 2 Megabytes. </em>
		</a>
	</fieldset>
    <input class="nBotonBigRig ml10 mt10" type="submit" value="Finalizar" />
</form>