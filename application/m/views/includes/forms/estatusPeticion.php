<form id="peticion" class="share-popup answer none" method="post" action="<?=base_url()?>hobbits/estatusPeticion" >
	<h3>Cambiar Estatus</h3>
	<fieldset>
		<select name="estatusP" class="selReg" required>
			<option value="sin seguimiento">Sin seguimiento</option>
			<option value="finalizado">Finalizada</option>
			<option value="venta exitosa">Venta exitosa</option>
		</select>
	</fieldset>
	<fieldset>
		<textarea id="pregComm" name="comentario" placeholder=" Agrega comentarios respecto al cambio de estatus." required></textarea>
	</fieldset>
	<input type="hidden" name="peticionID" value=""/>
	<input class="nBotonBigRig ml10 mt10" type="submit" value="Enviar" />
</form>
       
		