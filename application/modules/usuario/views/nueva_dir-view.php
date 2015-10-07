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
		<form id="editDir" action="<?=base_url()?>usuario/guardar_dir" method="post">
			<fieldset>
				<input class="regIn" type="text" name="titulo" placeholder="Título" value=""/>
			</fieldset>
			<fieldset>
				<input class="regIn" type="text" name="calle"  placeholder="Calle y número" />
			</fieldset>
			<fieldset>
				<select  id="estadoDir" required="required" name="estado" class="selReg required valid" required="required">
					<option value="">Estado</option>
				<? foreach($estados as $estadosRow):?>
					<option value="<?= $estadosRow->idEstado?>"><?= $estadosRow->nombreEstado?></option>
				<? endforeach;?>
				</select>
			</fieldset>
			<fieldset>
				<select id="municipioDir" name="municipio" required="required" class="selReg">
					<option value="0">Municipio</option>
				</select>
			</fieldset>
			<fieldset>
				<select id="coloniaDir" name="colonia" required="required" class="selReg">
					<option value="0">Colonia</option>
				</select>
			</fieldset>
			<fieldset>
				<input class="regIn" type="text" id="cpDir" name="cp" placeholder="Codigo Postal"/>
			</fieldset>
			<fieldset>
				<input class="regIn" type="text" id="cpDir" name="tel" placeholder="Teléfono"/>
			</fieldset>
			<fieldset>
				<input class="regIn" type="text" id="cpDir" name="recibe" placeholder="Persona que puede recibir pedido"/>
			</fieldset>
		</ul>
		<input class="nBotonBig" type="submit" value="Guardar" />
		</form>
	</div>
</section>
<? $this->load->view('includes/forms/uploadAvatar');
