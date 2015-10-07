<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gamers extends MX_Controller {
	
	function gamers()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
	}

	function index()
	{
		$op['order'] = $order = '';
	  	if($_POST){
			switch ($this->input->post('order')) {
				case 'precio':
					$order = 'lo.ofertaPrecio ASC';
					break;
				case'titulo':
					$order = 'lo.ofertaTitulo ASC';
					break;
				case'marca':
					$order = 'lo.marcaID ASC';
					break;
			}
		}else{
			$order = 'RAND()';
	 	}
	 	
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		$ofertaTipo = '';
		$marca = $this->uri->segment(2);
		$rama = $this->uri->segment(3);
		
		$op['marcas'] = $this->ofertas_model->marcasDinamica($ofertaTipo, $rama);
		$op['ramas'] = $this->ofertas_model->ramasDinamica($ofertaTipo, $marca);
		$op['productos'] = $this->ofertas_model->cargarOfertasGamers($marca,$rama, $order);
		
		//Vista//
		$this->layouts->index('busquedaProducto-view' ,$op);
	}

}