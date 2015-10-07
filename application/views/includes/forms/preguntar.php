<form id="preguntar" class="share-popup" method="post" action="<?=base_url()?>inicio/comentario/<?= $this->uri->segment(4);?>">
<h1>Preguntas y comentarios</h1>
	<fieldset>
		<textarea id="pregComm" name="comentario" placeholder=" Pregunta y cotiza en nuestra comunidad aqui..."></textarea>
		<input type="hidden"  value="oferta" name="tipo"/>
		<input type="hidden" value="<?= $this->uri->uri_string();?>" name="url" />
	</fieldset>
	<input class="nBotonBigRig ml10 mt10" type="submit" value="Enviar" />
</form>
       
		