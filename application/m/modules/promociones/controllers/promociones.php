<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promociones extends MX_Controller {
	
	function promociones()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('inicio/ofertas_model');
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
		
		//Busca nombre campania//
		$nombreCampania = $this->uri->segment(2);
		$campaniaID 	= $this->data_model->buscaCampaniaID($nombreCampania);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$ofertaTipo = 'Oferta';
		$marca = $this->uri->segment(2);
		$rama = $this->uri->segment(3);
		
		if(empty($campaniaID[0]->campaniaID)){
			redirect();
		}
		else{
			$op['productos']  = $this->data_model->cargarProPromociones($campaniaID[0]->campaniaID);
			$op['hidden'] = '';
			$op['marcas'] = $this->ofertas_model->marcasDinamica($ofertaTipo, $rama);
			$op['tematica'] = $this->data_model->cargaTematicas($rama,$marca);
			$op['caracteristicas'] = $this->data_model->cargaCaracteristicas($rama,$marca);
			
			$this->layouts->mobile('generals/template-subCat-view-mobile',$op);
		}
	}
	
	
}