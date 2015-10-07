<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promociones extends MX_Controller {
	
	function promociones()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
		$this->load->model('landings/landing_model');
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
		
		if(empty($campaniaID[0]->campaniaID)){
			redirect();
		}
		else{
			$op['productos']  = $this->data_model->cargarProPromociones($campaniaID[0]->campaniaID);
			$op['hidden'] = '';
			
			$this->layouts->index('generals/template-promociones',$op);
		}
	}
	
	
}