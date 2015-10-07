<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Impresoras extends MX_Controller {
	
	function impresoras()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('inicio/ofertas_model');
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
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/idangerous.swiper-2.1.min.js')
					  ->add_include('assets/css/idangerous.swiper.css');
					  
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$segmento = $this->uri->segment(1);
		$keyword = explode("_", $segmento);  
		
		$rama		= $keyword[0];
		$marca		= $this->uri->segment(2);
		$tematica	= $this->uri->segment(3);
		$cat		= $this->uri->segment(4);
		$cat1		= $this->uri->segment(5);
		$cat2		= $this->uri->segment(6);
		$cat3		= $this->uri->segment(7);
		$cat4		= $this->uri->segment(8);
		
		$op['productos']  = $this->data_model->cargarBusqueda($rama,$marca,$tematica,$cat,$cat1,$cat2,$cat3,$cat4);
		$op['hidden'] = '';
		$op['marcas'] = $this->data_model->cargaMarcas($rama,$tematica);
		$op['tematica'] = $this->data_model->cargaTematicas($rama,$marca);
		$op['caracteristicas'] = $this->data_model->cargaCaracteristicas($rama,$marca);
		
		$this->layouts->mobile('generals/template-subCat-view-mobile',$op);
	}
	
	
}