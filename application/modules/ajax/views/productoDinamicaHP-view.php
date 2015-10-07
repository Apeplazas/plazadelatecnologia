	<div class="line">
		<span class="removeThis"><img src="<?=base_url()?>assets/graphics/removeHP.png" alt="Borrar" /></span>
			<fieldset class="pt10">
				<select class="selectOneTwo" name="producto[]">
					<option value="Impresoras">Impresoras</option>
					<option value="Cartuchos">Cartuchos</option>
					<option value="Toners">Toners</option>
				</select>
			</fieldset>
			<fieldset class="pt10">
				<input class="xsmaInp" type="text" name="modelo[]" />
			</fieldset>
			<fieldset class="pt10">
				<select class="selectOneSma" name="tipo[]" id="">
					<option value="XL">XL</option>
					<option value="Standard">Standard</option>
				</select>
			</fieldset>
			<fieldset class="pt10">
				<input class="xsmaInp" type="text"  name="cantidad[]"/>
			</fieldset>
			<fieldset>
				<span class="addButtonTwo"><img src="<?=base_url()?>assets/graphics/agregarProductoHP.png" alt="Agregar Producto HP" /></span>
			</fieldset>
		</div>
<script type="text/javascript">
jQuery(function($) {
	$(".addButtonTwo").click(function(){
		$.post("http://www.plazadelatecnologia.com/ajax/dinamicaHP",
		
		function(data){
			sucess:		
				$("#wrapAjax").append(data);
		});
		$(this).remove();
	})
	
	$( ".removeThis" ).click(function() {
	  $(this).closest('div').remove();
	});
})
</script>