<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Encuestas Plaza de la tecnologia</title>
<meta name="robots" content="noindex">
<link href="<?=base_url()?>assets/css/styleEncuestas.css" rel="stylesheet" type="text/css" />
<link href='<?=base_url()?>assets/graphics/pt.ico' rel='icon' type='image/gif'/>
<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.5.2.min.js" type="text/javascript"></script>
<script language="javascript">
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
<!--[if lte IE 6]>
<script type="text/javascript" src="<?=base_url()?>assets/js/pngFix/jquery.pngFix.js"></script>
// Png Fix
$(function() {
		   $(document).pngFix();
});
<![endif]-->
<?php echo $this->layouts->print_includes(); ?>
</head>
<body id="apeencuesta">
<div id="loginAdminF">
    <form id="formularioUsuarios" method="post" action="<?=base_url()?>encuestas/validate_credentialsAPE">
    <?php echo $this->session->flashdata('msg'); ?>
    <!-- <p>
      <label>Nombre</label>
      <input type="text"  name="usuarioNombre" required="required">
    </p>
     <p>
      <label>Apellido</label>
      <input type="text"  name="usuarioApellido" required="required">
    </p>-->
    <p>
      <label>Email</label>
      <input type="text"  name="usuarioEmail" required="required" value="ejemplo@apeplazas.com">
      
    </p>
   
      <input id="entrarEncF" type="image" src="<?=base_url()?>assets/graphics/entrar-encuesta.jpg" />
    </form>
</div><!-- end login_form-->

<br class="clear">
</body>
</html>