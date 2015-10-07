<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Venta_outlet extends MX_Controller {
	
	function venta_outlet()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
	}
	
	function index()
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
			$order = 'lo.ofertaID DESC';
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
		
		$ofertaTipo = 'Liquidacion';
		$marca = $this->uri->segment(2);
		$rama = $this->uri->segment(3);
		$op['hidden'] 			= '';
		$op['order'] = $this->input->post('order');
		$op['productos']  = $this->ofertas_model->cargarOfertasTodas($ofertaTipo, $marca,$rama, $order);
		$op['marcas']  	  = $this->ofertas_model->marcasDinamica($ofertaTipo, $rama);
		$op['ramas'] 	  = $this->ofertas_model->ramasDinamica($ofertaTipo, $marca);
		
		$this->layouts->index('ofertas/busquedaProducto-view' ,$op);
	}
	
}