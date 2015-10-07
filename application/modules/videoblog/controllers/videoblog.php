<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videoblog extends MX_Controller {
	
	function videoblog()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
		$this->load->model('videoblog_model');
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
		
		$op['eventos']            = $this->blog_model->cargarUltimosEventos();
		$op['sorteos']            = $this->blog_model->cargarUltimosSorteos();
		$op['destacados']         = $this->blog_model->cargarUltimosDestacados();
		$op['videosDestacados']   = $this->videoblog_model->cargarVideosDestacados();
		$op['videoMain']          = $this->videoblog_model->cargarVideoMain();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('videoblog-view' ,$op);
	}
	
	function promocion($var)
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
		
		$op['eventos']            = $this->blog_model->cargarUltimosEventos();
		$op['sorteos']            = $this->blog_model->cargarUltimosSorteos();
		$op['destacados']         = $this->blog_model->cargarUltimosDestacados();
		$op['videosDestacados']   = $this->videoblog_model->cargarVideosDestacados();
		$op['videoMain']          = $this->videoblog_model->cargarVideoMain();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('videoblog-view' ,$op);
	}
	
	function computo()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt 		= $this->uri->segment(1);
		$op['opt'] 	= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$tematica	= $this->uri->segment(2);
		$op['noticias']   = $this->blog_model->cargarNoticiasTematica($tematica);
		$op['eventos']    = $this->blog_model->cargarUltimosEventos();
		$op['sorteos']    = $this->blog_model->cargarUltimosSorteos();
		$op['destacados'] = $this->blog_model->cargarUltimosDestacados();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('noticias-tematica-view' ,$op);
	}
	
	function electronica()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt 		= $this->uri->segment(1);
		$op['opt'] 	= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$tematica	= $this->uri->segment(2);
		$op['noticias']   = $this->blog_model->cargarNoticiasTematica($tematica);
		$op['eventos']    = $this->blog_model->cargarUltimosEventos();
		$op['sorteos']    = $this->blog_model->cargarUltimosSorteos();
		$op['destacados'] = $this->blog_model->cargarUltimosDestacados();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('noticias-tematica-view' ,$op);
	}
	
	function telefonia()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt 		= $this->uri->segment(1);
		$op['opt'] 	= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$tematica	= $this->uri->segment(2);
		$op['noticias']   = $this->blog_model->cargarNoticiasTematica($tematica);
		$op['eventos']    = $this->blog_model->cargarUltimosEventos();
		$op['sorteos']    = $this->blog_model->cargarUltimosSorteos();
		$op['destacados'] = $this->blog_model->cargarUltimosDestacados();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('noticias-tematica-view' ,$op);
	}
	
	function reparaciones()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt 		= $this->uri->segment(1);
		$op['opt'] 	= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$tematica	= $this->uri->segment(2);
		$op['noticias']   = $this->blog_model->cargarNoticiasTematica($tematica);
		$op['eventos']    = $this->blog_model->cargarUltimosEventos();
		$op['sorteos']    = $this->blog_model->cargarUltimosSorteos();
		$op['destacados'] = $this->blog_model->cargarUltimosDestacados();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('noticias-tematica-view' ,$op);
	}
	
	function sorteos_rifas_concursos()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt 		= $this->uri->segment(1);
		$op['opt'] 	= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$tematica	= $this->uri->segment(2);
		$op['noticias']   = $this->blog_model->cargarNoticiasTematica($tematica);
		$op['eventos']    = $this->blog_model->cargarUltimosEventos();
		$op['sorteos']    = $this->blog_model->cargarUltimosSorteos();
		$op['destacados'] = $this->blog_model->cargarUltimosDestacados();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('noticias-tematica-view' ,$op);
	}
	
	function eventosyactividades()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt 		= $this->uri->segment(1);
		$op['opt'] 	= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$tematica	= $this->uri->segment(2);
		$op['noticias']   = $this->blog_model->cargarNoticiasTematica($tematica);
		$op['eventos']    = $this->blog_model->cargarUltimosEventos();
		$op['sorteos']    = $this->blog_model->cargarUltimosSorteos();
		$op['destacados'] = $this->blog_model->cargarUltimosDestacados();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('noticias-tematica-view' ,$op);
	}
	
	function post($articuloUrl)
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
		
		$articulo = $this->uri->segment(3);
		$op['noticia'] = $this->blog_model->cargarArticulo($articuloUrl);
		$op['comments'] = $this->blog_model->cargarComentarios($articuloUrl);
		$op['eventos']    = $this->blog_model->cargarUltimosEventos();
		$op['sorteos']    = $this->blog_model->cargarUltimosSorteos();
		$op['destacados'] = $this->blog_model->cargarUltimosDestacados();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('articulo-view' ,$op);
	}
	
	function insertarComentario()
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Genera variables para posteo en email
		$nombre 		= 	$this->input->post('nombre');
		$email			= 	$this->input->post('email');
		$comentario		= 	$this->input->post('comentario');
		$url			= 	$this->input->post('url');
			
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nombre', 'nombre', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('comentario', 'comentario', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			//Optimizacion y conexion de tags para SEO//
			$opt = $this->uri->segment(1);
			$op['opt'] = $this->data_model->cargarOptimizacion($opt);
			
			$articulo = $this->uri->segment(3);
			$op['noticia'] = $this->blog_model->cargarArticulo($articulo);
			$op['comments'] = $this->blog_model->cargarComentarios($articulo);
			
			redirect($url);
		}
		
		else{
				
			//Genera Array y Inserta en la BD 
			$comentario = array(
				'nombre'			 => $_POST['nombre'], 
				'email'  	      	 => $_POST['email'], 
				'comentario'       	 => $_POST['comentario'],
				'articuloID'       	 => $_POST['articuloID'],
				'parentID'       	 => '0',
				'comentarioFecha'	 => date("Y-m-d"),  /* Inserta Fecha */
				'comentarioHora'	 => date("H:m:s"),	/* Inserta Hora */
				);
				
			$this->db->insert('comentarios', $comentario);
			
			redirect($url);
			
		
		}
	}
	
	function cargarMasTematicas($tematica, $articuloID)
	{
		//Manda informacion a paginador scroll down/////////
		$tematica	= $this->uri->segment(3);
		$articuloID	= $this->uri->segment(4);
		
		if ($articuloID >= '10'){
			$op['noticias']	=	$this->blog_model->cargarArticuloPaginaTem($tematica,$articuloID);
			$this->load->view('pagination-articulos-view',$op);
		}		
	}
	
	function cargarMasNoticias($articuloID)
	{
		//Manda informacion a paginador scroll down/////////
		$articuloID	= $this->uri->segment(3);
		
		if ($articuloID >= '10'){
			$op['noticias']	=	$this->blog_model->cargarArticuloPagina($articuloID);
			$this->load->view('pagination-articulos-view',$op);
		}		
	}
}