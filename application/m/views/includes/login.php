<div style="display:none">
	<div id="login_form" >
    <p class="msgLog"><a href="<?=base_url()?>" title="plaza de la tecnologia"><img src="<?=base_url()?>assets/graphics/plazadelatecnologia-color.jpg" alt="Plaza de la tecnologia" /></a> <em>¿Necesitas ayuda? <a class=" red" title="contacto" href="<?=base_url()?>contacto">Contáctanos aquí</a></em></p>
    <span id="hspan"><img src="<?=base_url()?>assets/graphics/accesousuarios.jpg" alt="Acceso a usuarios" /></span>
	<form id="commentForm"  method="post" action="<?=base_url()?>registrate/accesoDinamico">
    <h3>Bienvenido de Regreso.</h3>
    <fieldset>
      <label>Correo</label>
      <input class="inputReg required  email" minlength="2" type="text" value="ESCRIBE TU EMAIL" name="email">
    </fieldset>
    <fieldset>
      <label>Contraseña</label>
      <input type="password" class="inputReg required" name="contrasenia">
      <a class="pass red" href="<?=base_url()?>registrate/recuperar_contrasenia">¿Olvidaste tu Contraseña?</a>
    </fieldset>
    <fieldset>
      <input type="hidden" value="<?=$this->uri->uri_string()?>" name="url">
      <input id="botonEntrar" type="image" src="<?=base_url()?>assets/graphics/entrar.png" value="enviar">
    </fieldset>
    </form>
    	<div id="regRight">
      <a style="margin-left:30px;" alt="Conectate con Facebook" href="<?=base_url()?>myfacebook"><img src="<?=base_url()?>assets/graphics/conectate-con-facebook.png" alt="Conectate con Facebook" /></a>
	    <a alt="Registrate aquí" href="<?=base_url()?>registrate"><img src="<?=base_url()?>assets/graphics/registrate.png" alt="Registrate aqui" /></a>
	    </div>
	</div>
</div>
<script type="text/javascript">
//Form Focus
$(document).ready(function() {
			$('textarea').addClass("idleField");
			$('textarea').focus(function() {
				$(this).removeClass("idleField").addClass("focusField");
    		    if (this.value == this.defaultValue){ 
    		    	this.value = '';
				}
				if(this.value != this.defaultValue){
	    			this.select();
	    		}
    		});
			$('input[type="text"]').addClass("idleField");
       		$('input[type="text"]').focus(function() {
       			$(this).removeClass("idleField").addClass("focusField");
    		    if (this.value == this.defaultValue){ 
    		    	this.value = '';
				}
				if(this.value != this.defaultValue){
	    			this.select();
	    		}
    		});
    		$('input[type="text"]').blur(function() {
    			$(this).removeClass("focusField").addClass("idleField");
    		    if ($.trim(this.value) == ''){
			    	this.value = (this.defaultValue ? this.defaultValue : '');
				}
    		});
			$('textarea').blur(function() {
    			$(this).removeClass("focusField").addClass("idleField");
    		    if ($.trim(this.value) == ''){
			    	this.value = (this.defaultValue ? this.defaultValue : '');
				}
    		});
		});	
</script>