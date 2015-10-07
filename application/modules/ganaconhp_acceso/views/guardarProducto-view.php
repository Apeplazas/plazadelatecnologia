<section id="hp" >
	<div id="headHp">
	<span id="add"><img src="<?=base_url()?>assets/graphics/ganavendiendoproductoshp.png" alt="Gana vendiendo productos HP en Plaza de la tecnologia" /></span>
	</div>
	<? $this->load->view('includes/dinamicas/menuHP_ganaconhp');?>
	
	<div id="wrapHD">
		<?= $this->session->flashdata('msg'); ?>
		<form id="proT" action="<?=base_url()?>ganaconhp_acceso/productosGuardar" method="post">
		<div class="line">
			<fieldset>
				<label>Producto</label>
				<select class="selectOneTwo" name="producto[]">
					<option value="Impresoras">Impresoras</option>
					<option value="Cartuchos">Cartuchos</option>
					<option value="Toners">Toners</option>
				</select>
			</fieldset>
			<fieldset>
				<label>Modelo</label>
				<input class="xsmaInp" type="text" name="modelo[]" />
			</fieldset>
			<fieldset>
				<label>Tipo</label>
				<select class="selectOneSma" name="tipo[]" id="">
					<option value="XL">XL</option>
					<option value="Standard">Standard</option>
				</select>
			</fieldset>
			<fieldset>
				<label>Cantidad</label>
				<input class="xsmaInp" type="text"  name="cantidad[]"/>
			</fieldset>
			<fieldset>
				<span class="addButton"><img src="<?=base_url()?>assets/graphics/agregarProductoHP.png" alt="Agregar Producto HP" /></span>
			</fieldset>
		</div>
		<div id="wrapAjax">
		</div>
		<div id="botonEnv">
			<fieldset>
			  <input id="enviarPro" type="submit" value="Guardar" />
			  <input type="hidden" name="va" value="<?=$this->uri->segment(3);?>"/>
			</fieldset>
		</div>
		</form>
	</div>
</section>
<script type="text/javascript">
jQuery(function($) {
	$(".addButton").click(function(){
		$.post("http://www.plazadelatecnologia.com/ajax/dinamicaHP",
		function(data){
			sucess:				
				$("#wrapAjax").append(data);
		});
		$(".addButtonTwo").remove();
	})
	$( ".removeThis" ).click(function() {
	  $(this).remove();
	});
	
})
</script>