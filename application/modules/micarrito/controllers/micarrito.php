<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Micarrito extends MX_Controller {
	
	function micarrito()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
	}
	
	function index()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->index('carrito-view' ,$op);
	}
}