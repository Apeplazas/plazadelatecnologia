<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ticketmaster extends MX_Controller {
	
	function ticketmaster()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
	}
	
	function index()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		$op['ciudades']    		= $this->data_model->cargarCiudades();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Vista//
		$this->layouts->index('ticketmaster-view' ,$op);
	}
		
	
}