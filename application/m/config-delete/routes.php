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
$route['mexico/(:any)']                 = "sucursales";
$route['aguascalientes']                = "sucursales";
$route['aguascalientes/(:any)']         = "sucursales";
$route['chihuahua']                     = "sucursales";
$route['chihuahua/(:any)']              = "sucursales";
$route['cuernavaca']                    = "sucursales";
$route['cuernavaca/(:any)']             = "sucursales";
$route['edo_de_mexico']                 = "sucursales";
$route['edo_de_mexico/(:any)']          = "sucursales";
$route['guadalajara']                   = "sucursales";
$route['guadalajara/(:any)']            = "sucursales";
$route['leon']                          = "sucursales";
$route['leon/(:any)']                   = "sucursales";
$route['merida']                        = "sucursales";
$route['merida/(:any)']                 = "sucursales";
$route['monterrey']                     = "sucursales";
$route['monterrey/(:any)']              = "sucursales";
$route['morelia']                       = "sucursales";
$route['morelia/(:any)']                = "sucursales";
$route['puebla']                        = "sucursales";
$route['puebla/(:any)']                 = "sucursales";
$route['queretaro']                     = "sucursales";
$route['queretaro/(:any)']              = "sucursales";
$route['san_luis_potosi']               = "sucursales";
$route['san_luis_potosi/(:any)']        = "sucursales";
$route['toluca']                        = "sucursales";
$route['toluca/(:any)']                 = "sucursales";
$route['torreon']                       = "sucursales";
$route['torreon/(:any)']                = "sucursales";
$route['villahermosa']                  = "sucursales";
$route['villahermosa/(:any)']           = "sucursales";
$route['coacalco']                      = "sucursales";
$route['coacalco/(:any)']               = "sucursales";
$route['tijuana']                       = "sucursales";
$route['tijuana/(:any)']                = "sucursales";

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

//otros routes
$route['ofertas/(:any)']    		= "ofertas/index";
$route['venta_outlet/(:any)']    	= "venta_outlet/index";
$route['busqueda_rapida']    		= "inicio/busqueda_rapida";
$route['busqueda_rapida/(:any)']    = "inicio/busqueda_rapida";


/* End of file routes.php */
/* Location: ./application/config/routes.php */