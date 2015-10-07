<script src="<?=base_url()?>assets/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
// Busca municipios por estado
$(document).ready(function(){
	//Para cargar los municipios
	$("#estadoDir").change(function(){
		var estadoFiltro = $(this).val();
		$("#municipioDir").removeAttr("disabled");
		$.post("https://www.plazadelatecnologia.com/ajax/cargarMunicipios",{estadoFiltro:estadoFiltro},function(data){
			sucess:				
				$("#municipioDir").empty().append(data);
				$("#municipioDir").removeAttr("disabled");
		});
	});
	//Para cargar las colonias
	$("#municipioDir").change(function(){
		var estadoFiltro = $("#estadoDir").val();
		var municipioFiltro = $(this).val();
		$("#coloniaDir").removeAttr("disabled");
		$.post("https://www.plazadelatecnologia.com/ajax/cargarColonias",{municipioFiltro:municipioFiltro,estadoFiltro:estadoFiltro},function(data){
			sucess:				
				$("#coloniaDir").empty().append(data);
				$("#coloniaDir").removeAttr("disabled");
		});
	});
	//Para cargar C.P.
	$("#coloniaDir").change(function(){
		var estadoFiltro 	= $("#estadoDir").val();
		var municipioFiltro = $("#municipioDir").val();
		var coloniaFiltro 	= $(this).val();
		$("#cpDir").removeAttr("disabled");
		$.post("https://www.plazadelatecnologia.com/ajax/cargarCP",{municipioFiltro:municipioFiltro,estadoFiltro:estadoFiltro,coloniaFiltro:coloniaFiltro},function(data){
			sucess:				
				$("#cpDir").val(data);
				$("#cpDir").removeAttr("disabled");
		});
	});
});
</script>
<div id="contentCar">
<h1>Indica la dirección a donde deberan ser enviados tus articulos.</h1>
<div id="sitioEntrega">
<? if (count($direcciones) > 0):?>
<p>Elige una dirección de tu lista.</p>
<ul id="listDir">
	<? foreach ($direcciones as $dir):?>
	<li>
		<?=$dir->direccion?> <a href="#" onClick="document.getElementById('sitio-<?=$dir->idSitio?>').submit();" >enviar aquí</a>
		<form action="<?=base_url()?>carrito/enviar_aqui" method="post" style="display:none;" id="sitio-<?=$dir->idSitio?>" >
			<input type="hidden" value="<?=$folio?>" name="folio" />
			<input type="hidden" value="<?=$dir->idSitio?>" name="idSitio" />
			<input type="submit" value="Enviar" />
		</form>
	</li>
	<? endforeach;?>
</ul>
<p>Nueva dirección.</p>
<? endif;?>
<form id="sitioEntregaFrom" action="<?=base_url()?>carrito/formas_pago" method="post">
<fieldset>
	<select  id="estadoDir" required="required" name="estado" class="selReg required valid" required="required">
		<option value="">Elige tu Estado</option>
	<? foreach($estados as $estadosRow):?>
		<option value="<?= $estadosRow->idEstado?>"><?= $estadosRow->nombreEstado?></option>
	<? endforeach;?>
	</select>
</fieldset>
<fieldset>
	<select id="municipioDir" name="delSitio" required="required" class="selReg">
		<option value="0">Elige tu Municipio</option>
	</select>
</fieldset>
<fieldset>
	<select id="coloniaDir" name="colSitio" required="required" class="selReg">
		<option value="0">Elige tu Colonia</option>
	</select>
</fieldset>
<fieldset>
	<input class="regIn" type="text" id="cpDir" name="codSitio" required="required" placeholder="C.P."/>
</fieldset>
<fieldset class="hundred">
	<input class="regIn" type="text" name="dirSitio" value="" placeholder="Calle y numero exterior *"/>
	</textarea>
</fieldset>
<fieldset>
	<input class="regIn required" type="text" name="telSitio" required="required" placeholder="Telefono"/>
</fieldset>
<fieldset>
	<input class="regIn" type="text" name="nombResp" value="" placeholder="Persona que recibira la entrega *"/>
</fieldset>
<fieldset class="hundred mb20">
	<input type="hidden" name="folio" value="<?=$folio?>" />
	<input id="entCar" type="submit" value="Continuar" class="nBotonBig ">
</fieldset>
</form>
</div>
<? $this->load->view('carrito_totales-view');?>
</div>