<? $ramas = $this->data_model->cargarRamas();?>
<form id="addProRam" class="share-popup" method="post" action="<?=base_url() ?>mi_local/agrRamPro"a>
<span><img src="<?=base_url()?>assets/graphics/profile.png" alt="Agrega tu foto" /></span>
	<fieldset>
		<label>Escoge el tipo de producto que quieres subir</label>
		<select name="ramaID">
			<? foreach($ramas as $rowRam):?>
			<option value="<?= $rowRam->ramaID;?>"><?= $rowRam->ramaNombre;?></option>
			<? endforeach; ?>
		</select>
	</fieldset>
    <input class="narBotonBlaRig pt10" type="submit" value="Continuar"/>
</form>
