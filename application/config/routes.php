<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "inicio";
$route['404_override'] = '';

//redirect para vista de productos
$route['ofertas/adroll']    			= "ofertas/adroll";
$route['computadoras/oferta/(:any)']    = "ofertas/busqueda";
$route['laptops/oferta/(:any)']         = "ofertas/busqueda";
$route['tablets/oferta/(:any)']         = "ofertas/busqueda";
$route['impresoras/oferta/(:any)']      = "ofertas/busqueda";
$route['accesorios/oferta/(:any)']      = "ofertas/busqueda";
$route['telefonia/oferta/(:any)']       = "ofertas/busqueda";
$route['electronicos/oferta/(:any)']    = "ofertas/busqueda";
$route['software/oferta/(:any)']        = "ofertas/busqueda";
$route['reparaciones/oferta/(:any)']    = "ofertas/busqueda";
//redirect de segmentos viejos
$route['mexico']                        = "sucursales";
$route['mexico/folletos']              	= "folletos";
$route['mexico/(:any)']                 = "sucursales";
$route['lazaro_cardenas_y_uruguay']         = "sucursales";
$route['lazaro_cardenas_y_uruguay/folletos']= "folletos";
$route['lazaro_cardenas_y_uruguay/(:any)']	= "sucursales";
$route['calle_uruguay']			        = "sucursales";
$route['calle_uruguay/folletos']		= "folletos";
$route['calle_uruguay/(:any)']		    = "sucursales";
$route['aguascalientes']                = "sucursales";
$route['aguascalientes/folletos']       = "folletos";
$route['aguascalientes/(:any)']         = "sucursales";
$route['chihuahua']                     = "sucursales";
$route['chihuahua/folletos']      		= "folletos";
$route['chihuahua/(:any)']              = "sucursales";
$route['cuernavaca']                    = "sucursales";
$route['cuernavaca/folletos']           = "folletos";
$route['cuernavaca/(:any)']             = "sucursales";
$route['edo_de_mexico']                 = "sucursales";
$route['edo_de_mexico/folletos']        = "folletos";
$route['edo_de_mexico/(:any)']          = "sucursales";
$route['guadalajara']                   = "sucursales";
$route['guadalajara/folletos']          = "folletos";
$route['guadalajara/(:any)']            = "sucursales";
$route['leon']                          = "sucursales";
$route['leon/folletos']                 = "folletos";
$route['leon/(:any)']                   = "sucursales";
$route['merida']                        = "sucursales";
$route['merida/folletos']               = "folletos";
$route['merida/(:any)']                 = "sucursales";
$route['monterrey']                     = "sucursales";
$route['monterrey/foolletos']           = "folletos";
$route['monterrey/(:any)']              = "sucursales";
$route['morelia']                       = "sucursales";
$route['morelia/folletos']              = "folletos";
$route['morelia/(:any)']                = "sucursales";
$route['puebla']                        = "sucursales";
$route['puebla/folletos']               = "folletos";
$route['puebla/(:any)']                 = "sucursales";
$route['queretaro']                     = "sucursales";
$route['queretaro/folletos']            = "folletos";
$route['queretaro/(:any)']              = "sucursales";
$route['san_luis_potosi']               = "sucursales";
$route['san_luis_potosi/folletos']      = "folletos";
$route['san_luis_potosi/(:any)']        = "sucursales";
$route['toluca']                        = "sucursales";
$route['toluca/folletos']               = "folletos";
$route['toluca/(:any)']                 = "sucursales";
$route['torreon']                       = "sucursales";
$route['torreon/folletos']              = "folletos";
$route['torreon/(:any)']                = "sucursales";
$route['villahermosa']                  = "sucursales";
$route['villahermosa/folletos']         = "folletos";
$route['villahermosa/(:any)']           = "sucursales";
$route['coacalco']                      = "sucursales";
$route['coacalco/folletos']             = "folletos";
$route['coacalco/(:any)']               = "sucursales";
$route['tijuana']                       = "sucursales";
$route['tijuana/folletos']              = "folletos";
$route['tijuana/(:any)']                = "sucursales";
$route['tampico']                       = "sucursales";
$route['tampico/folletos']              = "folletos";
$route['tampico/(:any)']                = "sucursales";

$handle = opendir(APPPATH."/modules");
while (false !== ($file = readdir($handle))) {
  if(is_dir(APPPATH."/modules/".$file)){
    $route[$file] = $file;
    $route[$file."/(:any)"] = $file."/$1";
  }
}

$route['([a-z-_/]+)'] = "tienda";
 //redirect antiguos links


//redirect de ramas para url optimizadas
$route['computadoras/(:any)'] 		= "computadoras/redirect";
$route['laptops/(:any)'] 			= "laptops/redirect";
$route['tablets/(:any)'] 			= "tablets/redirect";
$route['impresoras/(:any)'] 		= "impresoras/redirect";
$route['accesorios/(:any)'] 		= "accesorios/redirect";
$route['telefonia/(:any)'] 			= "telefonia/redirect";
$route['electronicos/(:any)'] 		= "electronicos/redirect";
$route['software/(:any)'] 			= "software/redirect";
$route['reparaciones/(:any)'] 		= "reparaciones/redirect";

//redirect mobile de ramas para url optimizadas
$route['computadoras_mobile/(:any)'] 		= "computadoras_mobile/redirect";
$route['laptops_mobile/(:any)'] 			= "laptops_mobile/redirect";
$route['tablets_mobile/(:any)'] 			= "tablets_mobile/redirect";
$route['impresoras_mobile/(:any)'] 			= "impresoras_mobile/redirect";
$route['accesorios_mobile/(:any)'] 			= "accesorios_mobile/redirect";
$route['telefonia_mobile/(:any)'] 			= "telefonia_mobile/redirect";
$route['electronicos_mobile/(:any)'] 		= "electronicos_mobile/redirect";
$route['software_mobile/(:any)'] 			= "software_mobile/redirect";
$route['reparaciones_mobile/(:any)'] 		= "reparaciones_mobile/redirect";

//otros routes
$route['ofertas/(:any)']    		= "ofertas/index";
$route['venta_outlet/(:any)']    	= "venta_outlet/index";
$route['busqueda_rapida']    		= "inicio/busqueda_rapida";
$route['busqueda_rapida/(:any)']    = "inicio/busqueda_rapida";

//redirecciona campanias
$route['promociones/(:any)'] 		= "promociones/redirect";

/* End of file routes.php */
/* Location: ./application/config/routes.php */