<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modernizate extends MX_Controller {

	function modernizate()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('noticias/blog_model');
		$this->load->model('ofertas/ofertas_model');		
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
			$op['inf∂o']	= $this->data_model->$tipo($user['uid']);
		}
		
		$op['noticias']   = $this->blog_model->cargarNoticias($opt);
		$op['eventos']    = $this->blog_model->cargarUltimosEventos();
		$op['sorteos']    = $this->blog_model->cargarUltimosSorteos();
		$op['destacados'] = $this->blog_model->cargarUltimosDestacados();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('modernizate-view' ,$op);

	}

	

}

