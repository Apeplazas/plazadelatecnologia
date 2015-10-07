<? $errorNumero = form_error('numeroLocal'); ?>
<? $errorNombre = form_error('nombreLocal'); ?>
<? $errorRazon  = form_error('razonSocial'); ?>
<? $email       = form_error('email'); ?>
<? $contra      = form_error('contra'); ?>

<section id="hp" >
	<div id="headHp">
	<span id="add"><img src="<?=base_url()?>assets/graphics/ganavendiendoproductoshp.png" alt="Gana vendiendo productos HP en Plaza de la tecnologia" /></span>
	</div>
	<? $this->load->view('includes/dinamicas/menuHP_ganaconhp');?>
	
	<div id="contHp">
		<div id="logHp">
		<form  method="post" action="<?=base_url()?>gana_con_hp/validarAcceso">
			<span><img src="<?=base_url()?>assets/graphics/accesoHp.png" alt="Area de Acceso" /></span>
			<fieldset>
				<label>Correo electrónico</label>
				<input class="smaInp" type="text" name="correoElectronico" />
			</fieldset>
			<fieldset>
				<label>Contraseña</label>
				<input class="smaInp" type="password" name="contrasenia" />
			</fieldset>
			<fieldset>
				<input type="submit" id="enviarHp" />
			</fieldset>
		</form>
		</div>
	</div>
</section>

<script type="text/javascript">
$(document).ready(function() {
	// Busca que el email no este registrado
    $("#emaCheck").keyup(function(){
		var filtro    = $("#emaCheck").val();
		$("#ema").removeAttr("disabled");
		$.post("http://www.plazadelatecnologia.com/gana_con_hp/verificaUrl",{filtro:filtro},function(data){
			sucess:				
				$("#ema").empty().append(data);
				$("#ema").removeAttr("disabled");
		});
		
	})
	
    $("#txtboxToFilter").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            (e.keyCode == 65 && e.ctrlKey === true) || 
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
    
});
</script>




