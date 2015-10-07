<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sucursales extends MX_Controller {
	
	function sucursales()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
		$this->load->model('sucursales_model');
	}
	
	function index()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Carga Ramas para busqueda de productos y limita a 1 para busqueda//
        $op['suc']		= $this->sucursales_model->cargarSucursales();
		
		//Vista//
		$this->layouts->index('sucursales-view' ,$op);
	}
}