<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>-BazarGames Encuesta</title>
<link href='<?=base_url()?>assets/graphics/pt.ico' rel='icon' type='image/gif'/>
<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
<link href="<?=base_url()?>assets/css/styleEncuestasBazar.css" rel="stylesheet" type="text/css" />
<script src="<?=base_url()?>assets/js/jquery-1.5.2.min.js"></script>
<?php echo $this->layouts->print_includes(); ?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-11500342-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<script src="//configusa.veinteractive.com/tags/ADBE8577/0CFE/4C2D/A096/AD1E7624180C/tag.js" type="text/javascript" async></script>
</head>
<body>
<div id="encuestasPlazas">
	<?php echo $content; ?>
</div>

<br class="clear">
<!--Empieza Pie de Pagina -->
<div id="footer">
	<div id="footerWrap">
      <em class="copy">Copyright &copy; 2011. Todos los Derechos Reservados por BazarGames.</em>
	</div>
</div>

</body>
</html>