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
<!--[if lte IE 6]>
<script type="text/javascript" src="<?=base_url()?>assets/js/pngFix/jquery.pngFix.js"></script>
// Png Fix
$(function() {
		   $(document).pngFix();
});
<![endif]-->
<?php echo $this->layouts->print_includes(); ?>
</head>
<body>
<div id="loginAdmin">
    <form method="post" action="<?=base_url()?>encuestas/validate_credentials_bazar">
    <?php echo $this->session->flashdata('msg'); ?>
    <p>
      <label>Email</label>
      <input type="text"  name="usuarioEmail">
    </p>
      <input id="entrarEnc" type="image" src="<?=base_url()?>assets/graphics/entrar-encuesta.jpg" />
    </form>
</div><!-- end login_form-->

<br class="clear">
</body>
</html>