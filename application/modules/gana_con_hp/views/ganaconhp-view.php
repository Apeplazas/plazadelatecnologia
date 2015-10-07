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
		<div id="regHp">
			<h1>Partica por muchos premios en nuestra dinamica HP</h1>
			<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, </p>
			<h2>Regístrate con nosotros y gana muchos premios</h2>
			<form method="post" action="<?=base_url()?>gana_con_hp/registro">
				<fieldset>
					<label>Ciudades Participantes</label>
					<select class="selectOne" name="plazasParticipantes">
						<option value="Merida">Merida</option>
						<option value="Guadalajara">Guadalajara</option>
						<option value="Toluca">Toluca</option>
						<option value="Leon">Leon</option>
					</select>
				</fieldset>
				<fieldset>
					<i><? if($errorNumero):?><img src="<?=base_url()?>/assets/graphics/alert.png"><p><?= $errorNumero?></p><?endif?></i>
					<label>Número de Local</label>
					<input class="smaInp" name="numeroLocal" type="text"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Solo numeros" value="<?= set_value('numeroLocal'); ?>"/>
				</fieldset>
				<fieldset>
					<i><? if($errorNombre):?><img src="<?=base_url()?>/assets/graphics/alert.png"><p><?= $errorNombre?></p><?endif?></i>
					<label>Nombre del local</label>
					<input value="<?= set_value('nombreLocal'); ?>" class="smaInp" type="text" name="nombreLocal" placeholder="Ejemplo: Mas pc" />
				</fieldset>
				<fieldset>
					<i><? if($errorRazon):?><img src="<?=base_url()?>/assets/graphics/alert.png"><p><?= $errorRazon?></p><?endif?></i>
					<label>Razón Social</label>
					<input value="<?= set_value('razonSocial'); ?>" class="smaInp" type="text" name="razonSocial" />
				</fieldset>
				<fieldset>
					<label>Correo Electrónico</label>
					<i id="ema"><? if($email):?><img src="<?=base_url()?>/assets/graphics/alert.png"><p><?= $email?></p><?endif?></i>
					<input id="emaCheck" value="<?= set_value('emaill'); ?>" name="email" class="smaInp" placeholder="ejemplo@gmail.com" />
				</fieldset>
				<fieldset>
					<i><? if($contra):?><img src="<?=base_url()?>/assets/graphics/alert.png"><p><?= $contra?></p><?endif?></i>
					<label>Contraseña</label>
					<input value="<?= set_value('contra'); ?>" class="smaInp" type="text" name="contra" />
				</fieldset>
				<fielset>
					<input id="subHp" type="image" src="<?=base_url()?>assets/graphics/enviarInfo.png" />
				</fielset>
			</form>
		</div>
		<div id="logHp">
		<span><a href="<?=base_url()?>gana_con_hp/premios" title="gana con hp"><img src="<?=base_url()?>assets/graphics/verpremios.png" alt="Ver premios" /></a></span>
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




