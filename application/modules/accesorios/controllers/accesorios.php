<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accesorios extends MX_Controller {
	
	function accesorios()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
	}
	
	function index()
	{
		$this->redirect();
	}
	
	function redirect()
	{
		$order = '';
	  	if($_POST){
			switch ($this->input->post('order')) {
				case 'precio':
					$order = 'lo.ofertaPrecio ASC';
					break;
				
				case'titulo':
					$order = 'lo.ofertaTitulo ASC';
					break;
				case'marca':
					$order = 'lo.marcaID DESC';
					break;
			}
			
		}else{
			$order = 'lo.marcaID DESC';
	 	}
	 	//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] 	= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		$op['dc']			='<!--
Start of DoubleClick Floodlight Tag: Please do not remove
Activity name of this tag: PT accesorios
URL of the webpage where the tag is expected to be placed: http://www.apeplazas.com
This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
Creation Date: 04/23/2015
-->
<script type="text/javascript">
var axel = Math.random() + "";
var a = axel * 10000000000000;
document.write(\'<iframe src="http://4808733.fls.doubleclick.net/activityi;src=4808733;type=invmedia;cat=brq2suvy;ord=\' + a + \'?" width="1" height="1" frameborder="0" style="display:none"></iframe>\');
</script>
<noscript>
<iframe src="http://4808733.fls.doubleclick.net/activityi;src=4808733;type=invmedia;cat=brq2suvy;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
</noscript>
<!-- End of DoubleClick Floodlight Tag: Please do not remove -->' ;
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$url = $this->uri->uri_string(); // Genera Variable del Url
		$op['bannerSky']    = $this->data_model->cargarSkyHome($url);
		$op['slider']    = $this->data_model->cargarSlider($url);
		$op['bannerLead']   = $this->data_model->cargarLead($url);
		$op['bannerBox']    = $this->data_model->cargarBoxBanner($url);
		$op['bannerLeadFoot']    = $this->data_model->cargarLeadFoot($url);
		
		$rama		= $this->uri->segment(1);
		$marca		= $this->uri->segment(2);
		$tematica	= $this->uri->segment(3);
		$cat		= $this->uri->segment(4);
		$cat1		= $this->uri->segment(5);
		$cat2		= $this->uri->segment(6);
		$cat3		= $this->uri->segment(7);
		$cat4		= $this->uri->segment(8);
		
		$op['face']  = $this->data_model->cargarOptFace($rama,$marca,$tematica,$cat,$cat1,$cat2,$cat3,$cat4);
		$op['productos']  = $this->data_model->cargarBusqueda($rama,$marca,$tematica,$cat,$cat1,$cat2,$cat3,$cat4);
		$op['productosPagados']  = $this->data_model->cargarBusquedaPagada($rama,$marca,$tematica,$cat,$cat1,$cat2,$cat3,$cat4);
		$op['hidden'] = '';
		$op['marcas'] = $this->data_model->cargaMarcas($rama,$tematica);
		$op['tematica'] = $this->data_model->cargaTematicas($rama,$marca);
		$op['caracteristicas'] = $this->data_model->cargaCaracteristicas($rama,$marca);
		
		$this->layouts->categorias('generals/template-subCat-view',$op);
	}
	
}