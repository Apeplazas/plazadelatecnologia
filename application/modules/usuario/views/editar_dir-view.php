<script type="text/javascript">
// Busca municipios por estado
$(document).ready(function(){
	//Para cargar los municipios
	$("#estadoDir").change(function(){
		var estadoFiltro = $(this).val();
		$("#municipioDir").removeAttr("disabled");
		$.post("http://www.plazadelatecnologia.com/ajax/cargarMunicipios",{estadoFiltro:estadoFiltro},function(data){
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
		$.post("http://www.plazadelatecnologia.com/ajax/cargarColonias",{municipioFiltro:municipioFiltro,estadoFiltro:estadoFiltro},function(data){
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
		$.post("http://www.plazadelatecnologia.com/ajax/cargarCP",{municipioFiltro:municipioFiltro,estadoFiltro:estadoFiltro,coloniaFiltro:coloniaFiltro},function(data){
			sucess:				
				$("#cpDir").val(data);
				$("#cpDir").removeAttr("disabled");
		});
	});
});
</script>
<? $user  = $this->session->userdata('user');?>
<script type="text/javascript" charset="utf-8">
$(document).ready( function () {
  $('#inboxLocal').dataTable({
    "bSort": false,
    "iDisplayLength": 25,
    "aLengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
  });
  $( document ).tooltip();
});
</script>
<aside id="asideInb">
	<ul class="pFix">
		<? $this->load->view('includes/menus/menuUser');?>
	</ul>
</aside>
<section id="milocalPanel">
<?= $this->session->flashdata('msg'); ?>
	<h3>Editar Dirección</h3>
	<div id="inbWrap">
		<?= $this->session->flashdata('msg'); ?>
		<form id="editDir" action="<?=base_url()?>usuario/updateDir" method="post">
			<? foreach($direccion as $dirItem):?>
			<fieldset>
				<input class="regIn" type="text" name="titulo" placeholder="Título: <?=$dirItem->titulo?>" value=""/>
			</fieldset>
			<fieldset>
				<input class="regIn" type="text" name="calle" placeholder="Calle y número: <?=$dirItem->direccion?>" value="" />
			</fieldset>
			<fieldset>
				<select  id="estadoDir" required="required" name="estado" class="selReg required valid" required="required">
					<option value="">Elige tu Estado</option>
				<? foreach($estados as $estadosRow):?>
					<option value="<?= $estadosRow->idEstado?>" <? if( $estadosRow->idEstado == $dirItem->claveEstado){ echo 'selected';}?>><?= $estadosRow->nombreEstado?></option>
				<? endforeach;?>
				</select>
			</fieldset>
			<fieldset>
				<select id="municipioDir" name="municipio" required="required" class="selReg">
					<option value="0">Elige tu Municipio</option>
					<?$municipios = $this->carrito_model->municipios($dirItem->claveEstado);?>
					<? foreach($municipios as $munRow):?>
					<option value="<?= $munRow->idMunicipio?>" <? if( $munRow->idMunicipio == $dirItem->claveMunicipio){ echo 'selected';}?>><?= $munRow->nombreMunicipio?></option>
					<? endforeach;?>
				</select>
			</fieldset>
			<fieldset>
				<select id="coloniaDir" name="colonia" required="required" class="selReg">
					<option value="0">Elige tu Colonia</option>
					<? $colonias = $this->carrito_model->colonias($dirItem->claveEstado,$dirItem->claveMunicipio);?>
					<? foreach($colonias as $colRow):?>
					<option value="<?= $colRow->idColonia?>" <? if( $colRow->idColonia == $dirItem->claveColonia){ echo 'selected';}?>><?= $colRow->nombreColonia?></option>
					<? endforeach;?>
				</select>
			</fieldset>
			<fieldset>
				<input class="regIn" type="text" id="cpDir" name="cp"  placeholder="Codigo Postal: <?=$dirItem->CodigoPostal?>" readonly/>
			</fieldset>
			<fieldset>
				<input class="regIn" type="text" id="cpDir" name="tel"  placeholder="Teléfono: <?=$dirItem->telefono?>"/>
			</fieldset>
			<fieldset>
				<input class="regIn" type="text" id="cpDir" name="recibe"  placeholder="Persona que recibe: <?=$dirItem->recibe?>"/>
			</fieldset>
			<? endforeach;?>
		</ul>
		<input type="hidden" name="sitio" value="<?=$dirItem->idSitio?>"/>
		<input class="nBotonBig" type="submit" value="Actualizar" />
		</form>
	</div>
</section>
<? $this->load->view('includes/forms/uploadAvatar');
