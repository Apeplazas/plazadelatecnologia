<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tienda extends MX_Controller {
	
	function tienda()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('tienda_model');
		$this->load->model('ofertas/ofertas_model');
	}

	function index()
	{
	 	//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		$this->layouts->add_include('assets/js/jquery-ui.js');
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}

		$localID = $this->tienda_model->cargarLocalID($opt);

		if (!$localID) {
			redirect('');
		}
		if ($_POST) {
			if ($this->input->post('selectRama') != 'todo') {
				$ramaID = "AND lo.ramaID = '".$this->input->post('selectRama')."'";
			} else {
				$ramaID = '';
			}
		} else {
			$ramaID = '';
		}
		
		$op['tienda'] 		= $this->tienda_model->cargarLocal($localID[0]->id);
		$op['destacados'] 	= $this->tienda_model->cargarDestacados($localID[0]->id);
		$op['productos'] 	= $this->tienda_model->cargarProductos($localID[0]->id, $ramaID);
		$op['ramasLocal'] 	= $this->tienda_model->cargarRamasLocal($localID[0]->id);
		$op['ramaID'] 		= $this->input->post('selectRama');
		
		//Vista//
		$this->layouts->tienda('tienda-view' ,$op);
	}
	
	function tienda_ofertas()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}

		$localID = $this->tienda_model->cargarLocalID($opt);

		if (!$localID) {
			redirect('');
		}
		
		if ($_POST) {
			if ($this->input->post('selectRama') != 'todo') {
				$ramaID = "AND lo.ramaID = '".$this->input->post('selectRama')."'";
			} else {
				$ramaID = '';
			}
		} else {
			$ramaID = '';
		}
		
		$this->layouts->add_include('assets/js/jquery-ui.js');
		$op['tienda'] 	 	= $this->tienda_model->cargarLocal($localID[0]->id);
		$op['productos'] 	= $this->tienda_model->cargarProductos($localID[0]->id, $ramaID);
		$op['destacados'] 	= $this->tienda_model->cargarDestacados($localID[0]->id);
		$op['ramasLocal'] 	= $this->tienda_model->cargarRamasLocal($localID[0]->id);
		$op['ramaID'] 		= $this->input->post('selectRama');
		
		//Vista//
		$this->layouts->tienda('tienda-view' ,$op);
	}
}