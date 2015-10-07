<?php
/**
 * Archivo de conexion a la BD
 *
 * @author	
 * @filesourse
 */
 
require_once 'adodb/adodb.inc.php';


//con adodb
$dsn = 'mysql://plazadel_root:web@peplazas411500@localhost/plazadel_ptv8prueba'; 
$conn = ADONewConnection($dsn);


define('ERROR_DB', 'Existe un error inesperado en la consulta, favor de acudir al administrador');
define('ERROR_DB_INSERT', 'Existe un error inesperado al insertar la informaci&oacute;n, favor de acudir al administrador');

?>
