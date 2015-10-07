<header>
<h1>Solicitud de productos en linea.<span>Guardar peticiones de productos que se reciben en el chat o vía telefonica</span></h1>
</header>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Peticiones de productos.</h3>
	<div id="panel">
		<form id="peticiones" action="<?=base_url()?>hobbits/guardar_peticion" method="post">
			<fieldset>
				<input class="regIn" type="text" name="usuario" placeholder="Nombre del solicitante"/>
			</fieldset>
			<fieldset>
				<input class="regIn" type="text" name="email" placeholder="Email del solicitante"/>
			</fieldset>
			<fieldset>
				<input class="regIn" type="text" name="telefono" placeholder="Teléfono del solicitante"/>
			</fieldset>
			<fieldset>
				<select  id="plaza" required="required" name="plaza" class="selReg required valid" required="required">
					<option value="">Plaza Nombre</option>
					<option value="PT">PT</option>
					<option value="PM">PM</option>
					<option value="PT">Bazar</option>
					<option value="CJ">Centro Joyero</option>
					<option value="ZJ">Zona de Juegos</option>
				</select>
			</fieldset>
			<fieldset>
				<select  id="motivo" required="required" name="motivo" class="selReg required valid" required="required">
					<option value="">Motivo de Llamada</option>
					<option value="Renta de locales">Renta de locales</option>
					<option value="Renta de locales">Cotizaciones</option>
					<option value="Direcciones, tels y horarios plazas">Direcciones, tels y horarios plazas</option>
					<option value="Registro Local">Registro Local</option>
					<option value="Registro usuario">Registro usuario</option>
					<option value="Estatus compra">Estatus compra</option>
					<option value="Promociones">Promociones</option>
					<option value="Información de página">Información de página</option>
					<option value="Quejas">Quejas</option>
				</select>
			</fieldset>
			<fieldset>
				<select  id="estadoDir" required="required" name="estado" class="selReg required valid" required="required">
					<option value="">Estado</option>
				<? foreach($estados as $estadosRow):?>
					<option value="<?= $estadosRow->nombreEstado?>"><?= $estadosRow->nombreEstado?></option>
				<? endforeach;?>
				</select>
			</fieldset>
			<fieldset>
				<textarea class="textPet" name="detallePeticion" placeholder="Detalles de la Petición"></textarea>
			</fieldset>
			<input class="nBotonBig" type="submit" value="Guardar" />
		</form>
	</div>
</section>
<script> 
$(document).ready(function() {
    $('#intentosTab').dataTable( {
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "aaSorting": [ [0,'desc'] ],
        "bSort": true,
        "bInfo": false,
        "bAutoWidth": false
    } );
} ); 
</script>