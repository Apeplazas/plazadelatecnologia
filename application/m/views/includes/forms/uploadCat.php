<form id="agregarCat" class="share-popup" method="post" action="<?=base_url() ?>mi_local/agregarCat/<?= $this->uri->segment(3);?>/<?= $this->uri->segment(4);?>">
<span><img src="<?=base_url()?>assets/graphics/profile.png" alt="Agrega tu foto" /></span>
	<fieldset>
		<input type="text" name="cat" placeholder="Agrega una caracteristica o promoción que ayude a la venta de tu producto." />
	</fieldset>
    <input class="narBotonBla fright pt10" type="submit" value="Agregar información" />
</form>