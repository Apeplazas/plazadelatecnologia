<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landings extends MX_Controller {
	
	function landings()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
		$this->load->model('landings/landing_model');
	}

	function computadoras()
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
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		
		$rama		= $this->uri->segment(2);
		$marca		= $this->uri->segment(3);
		$tematica	= $this->uri->segment(4);
		$cat		= $this->uri->segment(5);
		$cat1		= $this->uri->segment(6);
		$cat2		= $this->uri->segment(7);
		$cat3		= $this->uri->segment(8);
		$cat4		= $this->uri->segment(9);
		
		$op['productos']  = $this->data_model->cargarBusqueda($rama,$marca,$tematica,$cat,$cat1,$cat2,$cat3,$cat4);
		$op['hidden'] = '';
		$op['marcas'] = $this->data_model->cargaMarcas($rama,$tematica);
		$op['tematica'] = $this->data_model->cargaTematicas($rama,$marca);
		$op['caracteristicas'] = $this->data_model->cargaCaracteristicas($rama,$marca);
		
		//landing promo
		$op['mainPromo'] = $this->landing_model->cargaMainPromo();
		$op['ofertasDestacadas'] = $this->landing_model->cargaOfeDestacadas();
		
		$this->layouts->index('generals/template-landing-view',$op);
	}
	
	
}