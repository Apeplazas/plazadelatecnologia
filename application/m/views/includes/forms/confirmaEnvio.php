<form action="<?=base_url()?>mi_local/confirmaFecha/<?= $this->uri->segment(3);?>" class="share-popup" method="post" id="confEnvi">
<span><img src="<?=base_url()?>assets/graphics/profile.png" alt="Agrega tu foto" /></span>
	<fieldset>
	<label>Fecha de entrega</label>
	<select name="fechaEntrega">
	  <option value="1 a 3 Dias" selected="selected">1 a 3 Dias</option>
	  <option value="3 a 5 Dias">3 a 5 Dias</option>
	  <option value="7 a 15 Dias">7 a 15 Dias</option>
	</select>
	</fieldset>
	<input type="submit" class="ml220 narBotonBla" value="Confirmar Envio" />
</form>