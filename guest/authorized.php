<?php
$id = $_COOKIE['id']; 
$redirect = $_COOKIE['url'];
shell_exec("sh guest_authorize.sh \"$id\" 30");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" href="images/style.css" type="text/css" />
	<title>Free Wireless Internet</title>
</head>
<body>
	<div id="page" align="center">
		<div id="header">
			<div id="companyname" align="left">Welcome!</div>
		</div>
		<br />
		<div id="content">
			<div id="contenttext">
				<span class="title_blue">Connecting ...</span><br /><br />
				 <span class="subtitle_black">Please wait while we activate your wireless connection.</span><br /><br />
			</div>
			<div class="footer"/>
		</div>
	</div>
<script type="text/javascript">
setTimeout(function() { location.href = '<?php echo $redirect?>'; }, 5000);
</script>
</body>
</html>
