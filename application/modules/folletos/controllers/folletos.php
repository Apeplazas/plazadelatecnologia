<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Folletos extends MX_Controller {
	
	function folletos()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
		$this->load->model('noticias/blog_model');
	}
	
	function index()
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
		
		$op['ciudades'] = $this->data_model->cargarCiudades();
		$op['folletos'] = $this->data_model->cargarFolletos();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('folletos-view' ,$op);
	}
	
}