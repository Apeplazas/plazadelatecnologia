<?php
/*

-= ERROR! =-

If you can read this you do not have PHP installed or configured properly on your server.
PHP is one of the minimum requirements of all Interspire products.

Please have your host install or configure PHP for you before contacting Interspire.

*/


/**
 * This file contains a cut-down version of check.php which will only check IEM-specific requirements.
 *
 * For upgrading user, you can upload the script to admin/temp directory,
 * and it will check the minimum database version.
 */
session_start();

if (!isset($_GET['a'])) {
    $_SESSION['CHECK_SESSION_CHECK'] = TRUE;
    $_SESSION['time'] = time();
	header('Location: '.$_SERVER['PHP_SELF'].'?a=sessionCheck');
}

if(isset($_SESSION['CHECK_SESSION_CHECK'])){
    define('CHECK_SESSION_OK', TRUE);
    define('CHECK_SESSION_TIME', $_SESSION['time']);
} else {
    if(empty($_SESSION)){
        define('CHECK_SESSION_OK', FALSE);
    }
}

error_reporting(0);
@ini_set(display_errors, 0);

define('CHECK_SAFE_MODE', !(bool)ini_get('safe_mode'));
define('CHECK_CURL_AVAILABLE', function_exists('curl_init'));
define('CHECK_URL_FOPEN', ini_get('allow_url_fopen'));
define('CHECK_ZENDENGINE1_COMPATIBILITY', (bool)ini_get('zend.ze1_compatibility_mode'));

define('CHECK_FTP_AVAILABLE', function_exists('ftp_login'));
define('CHECK_FILE_UPLOADS', (bool)ini_get('file_uploads'));
define('CHECK_MYSQL_AVAILABLE', function_exists('mysql_connect'));
define('CHECK_PGSQL_AVAILABLE', function_exists('pg_connect'));
define('CHECK_IMAP_AVAILABLE', function_exists('imap_open'));
define('CHECK_GD_AVAILABLE', function_exists('imagegd'));
define('CHECK_ZLIB_AVAILABLE', function_exists('gzwrite'));
define('CHECK_PSPELL_AVAILABLE', function_exists('pspell_suggest'));
define('CHECK_FSOCKOPEN_AVAILABLE', function_exists('fsockopen'));
define('CHECK_SIMPLEXML_AVAILABLE', function_exists('simplexml_load_string') && class_exists('SimpleXMLElement'));
define('CHECK_SOAP_AVAILABLE', class_exists('SoapServer'));
define('CHECK_MCRYPT_AVAILABLE', function_exists("mcrypt_encrypt"));

define('CHECK_SESSION_AUTOSTART', (bool) ini_get('session.auto_start'));
define('CHECK_SESSION_DIR_EXISTS', (bool) is_dir(ini_get('session.save_path')));
define('CHECK_SESSION_REFERER_CHECK_CORRECT', ini_get('session.referer_check') == '' || strpos($_SERVER['HTTP_HOST'], ini_get('session.referer_check')));

if(class_exists("DOMDocument", false)){define('CHECK_DOM_AVAILABLE', true);} else {define('CHECK_DOM_AVAILABLE', false);}
if(extension_loaded("mbstring") && function_exists("mb_strtolower")){define('CHECK_MBSTRING_AVAILABLE', true);}else{define('CHECK_MBSTRING_AVAILABLE', false);}

define('CHECK_PHP_SAPI', php_sapi_name());

define('CHECK_PASS', '<div class="CheckResult Pass">OK!</div>');
define('CHECK_FAIL', '<div class="CheckResult Fail">Not OK</div>');
define('CHECK_UNKNOWN', '<div class="CheckResult Unknown">Unknown</div>');

define('CHECK_BASEDIR_OK', is_null(ini_get('open_basedir')) || ini_get('open_basedir') === false || ini_get('open_basedir') == '');

if (in_array(CHECK_PHP_SAPI, array('apache', 'apache2handler'))) {
	define('CHECK_MOD_REWRITE_AVAILABLE',  in_array("mod_rewrite",parseApacheModules()));
	define('CHECK_MOD_SECURITY_ENABLED', in_array("mod_security",parseApacheModules()));
} else {
	define('CHECK_MOD_REWRITE_AVAILABLE',  NULL);
	define('CHECK_MOD_SECURITY_ENABLED', NULL);
}
if (is_numeric(strpos(CHECK_PHP_SAPI, 'cgi'))) {
	define('CHECK_CGI_MODE', true);

} else {
	define('CHECK_CGI_MODE', false);
}
// ----- Makre sure MySQL version 4.1.1 or above is availabe
ob_start();
phpinfo();
$phpinfo = ob_get_contents();
ob_end_clean();
$start = explode("<h2><a name=\"module_mysql\">mysql</a></h2>",$phpinfo,1000);
if(count($start) < 2){
	define('CHECK_MYSQL_AVAILABLE', FALSE);
}else{
	$again = explode("<tr><td class=\"e\">Client API version </td><td class=\"v\">",$start[1],1000);
	$last_time = explode(" </td></tr>",$again[1],1000);
	define('MYSQL_VERSION_CHECK', $last_time[0]);
	define('CHECK_MYSQL_AVAILABLE', TRUE);
}
// -----
// ----- Make sure that the system is able to access outside URL
$ok = false;

if (CHECK_CURL_AVAILABLE) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, 'http://www.interspire.com/');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FAILONERROR, true);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);

	$temp = curl_exec($ch);
	curl_close($ch);

	if (!empty($temp)) {
		$ok = true;
	} else {
		define('CHECK_CURL_AVAILABLE', FALSE);
	}
}

if (CHECK_URL_FOPEN) {
	$temp = file_get_contents('http://www.interspire.com/');
	if (!empty($temp)) {
		$ok = true;
	} else {
		define('CHECK_URL_FOPEN', FALSE);
	}
}

define('ACCESS_REMOTE_URL', $ok);
// -----

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
	"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xml:lang="en" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Interspire System Compatibility Check Script</title>
	<meta name="ROBOTS" content="NOINDEX, NOFOLLOW" />
	<link rel="SHORTCUT ICON" href="http://www.interspire.com/favicon.ico" />
	<style type="text/css" media="screen">
		html
		{
			color: #32393D;
			font-family: Arial, Tahoma, Helvetica, sans-serif;
		}
		.Header {
			height: 70px;
		}
 		h1 {
			background: white url(http://www.interspire.com/images/logo.gif) center left no-repeat;
			color:#FE4819;
			font-size: 1.7em;
			font-weight: normal;
			height: 60px;
			padding-left: 180px;
			padding-top: 30px;
			margin: 0;
		}
		h2 { color: #196297; }

		.CheckResult
		{
			color: white;
		}
		.Pass {
			background-color: green;
		}
		.Fail {
			background-color: red;
		}
		.Unknown {
			background-color: blue;
		}
		.Clear { clear:both;}

		dt {
			width: 300px;
			float: left;
			border-top: 1px solid #CACACA;
			padding: 3px;
		}

		dd.CheckResult {
			float: left;
			padding: 3px;
			margin-bottom: 1px;
			border-top: 1px solid #CACACA;
			margin-left: 0;
		}

		dd.CheckResultFeature,
		dd.CheckResultFix
		{
			clear: left;
			background: white url(http://www.interspire.com/images/nodejoin.gif) center left no-repeat;
			margin: 0;
			padding-left: 20px;
			font-size: 0.9em;
		}

		fieldset {
			width: 600px;
			border-color: #EEEEEE;
			padding: 1em;
		}

		legend {
			font-weight: bold;
		}

		em { color: #FE4819;}

		a { color:#196297;}
		a:hover { color: #FE4819;}

	</style>


</head>
<body>
	<div class="Header">
		<h1>System Compatibility Check Script</h1>
	</div>
	<br class="Clear" />
	<div class="Content">
		<h2>Basic Information</h2>
		<ul>
		<?php

		echo '<li>PHP is running in ' . CHECK_PHP_SAPI . ' mode</li>';

		if (!CHECK_CGI_MODE && in_array("mod_security",parseApacheModules())) {
			echo "<li>mod_security is running - tinyMCE may break with this on</li>\n";
		}
		?>
		</ul>
		<?php

		$products = array(
			'Required_Functions',
			'Sessions',
			array(
				'label' => 'Email_Marketer',
				'url' => 'http://www.interspire.com/emailmarketer/'
			),
		);

		foreach ($products as $product_details) {

			if (!is_array($product_details)) {
				$product = $product_details;
				$url = '';
			} else {
				$product = $product_details['label'];
				$url = $product_details['url'];
			}

			$check_func = 'Check_'.$product;
            
			if (empty($url)) {
				echo '<h2>'.str_replace('_', ' ', $product).'</h2>';
			} else {
				echo '<h2><a href="'.$url.'">'.str_replace('_', ' ', $product).'</a></h2>';
			}
			echo '<div><ul>';
			if (function_exists($check_func)) {
				call_user_func($check_func);
			}
			echo '</ul></div>';
		}
		?>
	</div>
</body>
</html>

<?php

function parsePHPModules()
{
	ob_start();
	phpinfo(INFO_MODULES);
	$s = ob_get_contents();
	ob_end_clean();

	$s = strip_tags($s,'<h2><th><td>');
	$s = preg_replace('/<th[^>]*>([^<]+)<\/th>/',"<info>\\1</info>",$s);
	$s = preg_replace('/<td[^>]*>([^<]+)<\/td>/',"<info>\\1</info>",$s);
	$vTmp = preg_split('/(<h2[^>]*>[^<]+<\/h2>)/',$s,-1,PREG_SPLIT_DELIM_CAPTURE);
	$vModules = array();
	for ($i=1;$i<count($vTmp);$i++) {
		if (preg_match('/<h2[^>]*>([^<]+)<\/h2>/',$vTmp[$i],$vMat)) {
			$vName = trim($vMat[1]);
			$vTmp2 = explode("\n",$vTmp[$i+1]);
			foreach ($vTmp2 AS $vOne) {
				$vPat = '<info>([^<]+)<\/info>';
				$vPat3 = "/$vPat\s*$vPat\s*$vPat/";
				$vPat2 = "/$vPat\s*$vPat/";
				if (preg_match($vPat3,$vOne,$vMat)) { // 3cols
					$vModules[$vName][trim($vMat[1])] = array(trim($vMat[2]),trim($vMat[3]));
				} elseif (preg_match($vPat2,$vOne,$vMat)) { // 2cols
					$vModules[$vName][trim($vMat[1])] = trim($vMat[2]);
				}
			}
		}
	}
	return $vModules;
}

function parseApacheModules()
{
	$input = parsePHPModules();
	if(isset($input['apache'])){
		$modules = $input['apache']['Loaded Modules'];
		$mod_list = explode(",",$modules);
		foreach($mod_list as $key=>$value){
			$mod_list[$key] = trim($value);
		}
		return $mod_list;
	} elseif(isset($input['apache2handler'])) {
		$modules = $input['apache2handler']['Loaded Modules'];
		$mod_list = explode(" ",$modules);
		foreach($mod_list as $key=>$value){
			$mod_list[$key] = trim($value);
		}
		return $mod_list;
	}
	//apache2handler
	return array();
}

function DisplayResults($checks, $section='')
{
	if (empty($checks)) {
		return;
	}

	echo '<fieldset>'."\n";
	if (!empty($section)) {
	 	echo '<legend>'.$section.'</legend>'."\n";
	}
	echo "<dl>\n";

	foreach ($checks as $label => $check) {
		echo "<dt>".$label.":</dt>\n";

		if (is_array($check)) {
			if ($check['result'] === true) {
				echo '<dd class="CheckResult Pass">Ok</dd>'."\n";
		        if(isset($check['version'])) {
		            echo '<dd class="CheckResultFeature">Version <em>'.$check['version'].'</em></dd>'."\n";
		        }
		        if(isset($check['refresh'])) {
		            echo '<dd class="CheckResultFeature"><em><a href="check_iem.php">Retest</a></em></dd>'."\n";
		            if(CHECK_SESSION_OK != TRUE){
		                echo '<dd class="CheckResultFeature">Current session variables:</dd>'."\n";
		                echo '<dd class="CheckResultFeature"><em>'.print_r($_SESSION, true).'</em></dd>'."\n";
		            }
		        }
			}elseif ($check['result'] === false) {			    
				echo '<dd class="CheckResult Fail">Not Ok</dd>'."\n";
		        if(isset($check['refresh'])) {
		            echo '<dd class="CheckResultFeature"><em><a href="check_iem.php">Retest</a></em></dd>'."\n";
		        } else {
				    echo '<dd class="CheckResultFeature">This feature is required for: <em>'.$check['feature'].'</em></dd>'."\n";
				    echo '<dd class="CheckResultFix">To fix this: <em>'.$check['fix'].'</em></dd>'."\n";
			    }
			} else {
				echo '<dd class="CheckResult Unknown">Unknown</dd>'."\n";
				echo '<dd class="CheckResultFeature">This feature is required for: <em>'.$check['feature'].'</em></dd>'."\n";
				echo '<dd class="CheckResultFix">To fix this: <em>'.$check['fix'].'</em></dd>'."\n";
			}
		} else {
			if ($check === true) {
				echo '<dd class="CheckResult Pass">Ok</dd>'."\n";
			} elseif ($check === false) {
				echo '<dd class="CheckResult Fail">Not Ok</dd>'."\n";
			} else {
				echo '<dd class="CheckResult Unknown">Unknown</dd>'."\n";
			}
		}
	}

	echo '</dl>'."\n";
	echo '</fieldset>'."\n";
	echo '<br class="Clear" />'."\n";
}


function Check_Sessions()
{
	$checks = array (
		'Sessions working ok' => array
		(
		    'result' => CHECK_SESSION_OK,
		    'refresh' => 1
	     ),
		'Session autostart disabled' => !CHECK_SESSION_AUTOSTART,
		'Session referer check correct' => CHECK_SESSION_REFERER_CHECK_CORRECT,
	);
	DisplayResults($checks);
}

function Check_Required_Functions()
{
	$required_functions = array (
		'fopen',
		'fread',
		'fputs',
		'opendir',
		'readdir',
		'closedir',
		'mail',
		'parse_ini_file',
		'ini_set',
	);

	$checks = array();

	foreach ($required_functions as $func) {
		$checks[$func.'()'] = function_exists($func);
	}

	DisplayResults($checks);
}

function Check_Email_Marketer()
{
	$init_file = './../com/init.php';
	if (is_readable($init_file)) {
		define('IEM_NO_CONTROLLER', true);
		require_once $init_file;
	}

	$required = array ();

	// Require PHP 5.1.3 or above
	$required['PHP 5.1.3 or above'] = array(
		'result' => (in_array(version_compare('5.1.3', phpversion()), array(0, -1))),
		'feature' => 'Application',
		'fix' => 'Please ask your host to upgrade your server to PHP version 5.1.3 or above'
	);

	// Compatibility Mode with ZendEngline 1 (ie. PHP 4) needs to be disabled
	$required['Zend Engine 1 Compatibility Disabled'] = array(
		'result' => !CHECK_ZENDENGINE1_COMPATIBILITY,
		'feature' => 'Application',
		'fix' => 'Please ask your web host to disable "ze1_compatibility_mode" in php.ini (or in .htaccess)'
	);

	// "Safe Mode" must be disabled
	$required['Safe Mode Disabled'] = CHECK_SAFE_MODE;

	// "File Uploads" must be enabled
	$required['File Uploads'] = CHECK_FILE_UPLOADS;

	//Check MySQL
	$required['MySQL Available'] = array(
		'result' => CHECK_MYSQL_AVAILABLE,
		'version' => MYSQL_VERSION_CHECK
	);

    $db_checked = false;
    
	if(defined('MYSQL_VERSION_CHECK')) { $db_checked = true; }

	if (defined('SENDSTUDIO_DATABASE_TYPE')) {
		switch (SENDSTUDIO_DATABASE_TYPE) {
			case 'pgsql':
				$required['PostgreSQL'] = array(
					'result' => FALSE,
					'feature' => 'PostgreSQL',
					'fix' => 'PostgreSQL is not supported by Email Marketer'
				);
			break;
		}
	}
	if (!$db_checked) {
		$required['MySQL version 4.1.1 or above Availabe'] = 'unknown';
	}
	//Check MBSTRING
	$required['mbstring Available'] = CHECK_MBSTRING_AVAILABLE;
	// DOM Extension requred for surveys
	$required['DOM Extension Enabled'] = CHECK_DOM_AVAILABLE;
	//cURL
	$required['cURL Available'] = CHECK_CURL_AVAILABLE;
	// Session autostart must be disabled
	$required['Session Autostart Disabled'] = !CHECK_SESSION_AUTOSTART;

	// IMAP module is required
	$required['IMAP Available'] = array(
		'result' => CHECK_IMAP_AVAILABLE,
		'feature' => 'Bounce processing',
		'fix' => 'Please ask your web host to install IMAP PHP extension module'
	);

	// Need to be able to access outside location
	$required['Remote URL Access Available'] = ACCESS_REMOTE_URL;

	// Require GD module
	$required['GD Available'] = array(
		'result' => CHECK_GD_AVAILABLE,
		'feature' => 'CAPTCHA and Printing statistics',
		'fix' => 'Please ask your web host to install IMAP PHP extension module'
	);

	// Mod security must be disabled
	$required['Mod Security Disabled'] = !CHECK_MOD_SECURITY_ENABLED;

	//fsockopen for SMTP
	$optional = array(
		'fsockopen() Available' => array(
			'result' => CHECK_FSOCKOPEN_AVAILABLE,
			'feature' => 'Sending emails via remote SMTP servers',
			'fix' => 'Please ask your web host to allow the use of the fsockopen() function.'
		),
	);

	DisplayResults($required, 'Required');
	DisplayResults($optional, 'Optional');
}
?>
