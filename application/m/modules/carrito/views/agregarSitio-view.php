<script src="<?=base_url()?>assets/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
// Busca municipios por estado
$(document).ready(function(){
	//Para cargar los municipios
	$("#estadoDir").change(function(){
		var estadoFiltro = $(this).val();
		$("#municipioDir").removeAttr("disabled");
		$.post("http://m.plazadelatecnologia.com/ajax/cargarMunicipios",{estadoFiltro:estadoFiltro},function(data){
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
		$.post("http://m.plazadelatecnologia.com/ajax/cargarColonias",{municipioFiltro:municipioFiltro,estadoFiltro:estadoFiltro},function(data){
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
		$.post("http://m.plazadelatecnologia.com/ajax/cargarCP",{municipioFiltro:municipioFiltro,estadoFiltro:estadoFiltro,coloniaFiltro:coloniaFiltro},function(data){
			sucess:				
				$("#cpDir").val(data);
				$("#cpDir").removeAttr("disabled");
		});
	});
});
</script>
<h1>Indica la dirección a donde deberan ser enviados tus articulos.</h1>
<div id="contentCar">
<form id="sitioEntrega" action="http://m.plazadelatecnologia.com/carrito/formas_pago" method="post">
<? if (count($direcciones) > 0):?>
<p style="font-weight: bold;">Elige una dirección de tu lista.</p>
<ul id="listDir">
	<? foreach ($direcciones as $dir):?>
	<li ><?=$dir->direccion?> <a href="http://m.plazadelatecnologia.com/carrito/enviar_aqui/<?=$folio?>/<?=$dir->idSitio?>">enviar aquí</a></li>
	<? endforeach;?>
</ul>
<p style="font-weight: bold;">Nueva dirección.</p>
<? endif;?>
<fieldset>
	<select  id="estadoDir" name="estado" class="selReg required valid" required="required">
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
	<input class="regIn" type="text" id="cpDir" name="codSitio" readonly="readonly" placeholder="C.P."/>
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