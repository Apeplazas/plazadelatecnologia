<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrador Plaza de la tecnologia</title>
<meta name="robots" content="noindex">
<link href="<?=base_url()?>assets/css/styleAdmin.css" rel="stylesheet" type="text/css" />
<link href='<?=base_url()?>favicon.ico' rel='icon' type='image/gif'/>
<script language="javascript" src="<?=base_url()?>assets/js/jquery-1.5.2.min.js" type="text/javascript"></script>
<!--[if lte IE 6]>
<script type="text/javascript" src="<?=base_url()?>assets/js/pngFix/jquery.pngFix.js"></script>
// Png Fix
$(function() {
		   $(document).pngFix();
});
<![endif]-->
<?php echo $this->layouts->print_includes(); ?>
</head>
<body class="<?=$body?>">
<div id="loginAdmin">
    <form method="post" action="<?=base_url()?>login/validate_credentials">
    <span><img src="<?=base_url()?>assets/graphics/plazadelatecnologia-logo.png" alt="logo plaza de la tecnologia" /></span>
    <?php echo $this->session->flashdata('msg'); ?>
    <p>
      <label>Email</label>
      <input class="widthInput logAdm" type="text"  name="usuarioEmail">
    </p>
    <p>
      <label>Contraseña</label>
      <input class="widthInput logAdm" type="password" value="" name="contrasenia">
    </p>
      <input class="adminSubmit fright" type="image" src="<?=base_url()?>assets/graphics/entrarLogin.png" value="Entrar" name="submit">
    </form>
</div><!-- end login_form-->
<script type="text/javascript">// Borra mensaje
	$("#msgLoginAdmin").fadeOut(8000);
 </script>

<br class="clear">
</body>
</html>