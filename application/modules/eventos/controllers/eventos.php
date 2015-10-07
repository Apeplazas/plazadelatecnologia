<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventos extends MX_Controller {
	
	function eventos()
	{
		parent::__construct();	
		
		$this->load->model('inicio/data_model');	
		$this->load->model('noticias/blog_model');
		$this->load->model('ofertas/ofertas_model');	
		$this->load->model('eventos_model');	
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
		
		$op['noticias']   = $this->blog_model->cargarNoticias($opt);
		$op['eventos']    = $this->blog_model->cargarUltimosEventos();
		$op['sorteos']    = $this->blog_model->cargarUltimosSorteos();
		$op['destacados'] = $this->blog_model->cargarUltimosDestacados();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('eventos-view' ,$op);
	}
	
	function post()
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
		
		$articuloUrl = $this->uri->segment(3);
		$op['noticia'] = $this->blog_model->cargarArticulo($articuloUrl);
		$op['comments'] = $this->blog_model->cargarComentarios($articuloUrl);
		$op['eventos']    = $this->blog_model->cargarUltimosEventos();
		$op['sorteos']    = $this->blog_model->cargarUltimosSorteos();
		$op['destacados'] = $this->blog_model->cargarUltimosDestacados();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('noticias/articulo-view' ,$op);
	}
	
	function suscripcion($articuloUrl)
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
		
		$articuloUrl = $this->uri->segment(3);
		$op['noticia'] = $this->blog_model->cargarArticulo($articuloUrl);
		$op['eventos']    = $this->blog_model->cargarUltimosEventos();
		$op['sorteos']    = $this->blog_model->cargarUltimosSorteos();
		$op['destacados'] = $this->blog_model->cargarUltimosDestacados();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('subscripEvento-view' ,$op);
	}
	
	function guardaSuscripcion()
	{
		$nombre = $this->input->post('nombreCompleto');
		$tel 	= $this->input->post('telefono');
		$cel 	= $this->input->post('celular');
		$email 	= $this->input->post('email');
		$back 	= $this->input->post('back');
		$eventoID = $this->input->post('eventoID');
		$eventoUrl = $this->input->post('eventoUrl');
		$ciudad = $this->input->post('ciudad');
		
		$suscr = array('nombre' 		=> $nombre, 
					   'telefonoLocal' 	=> $tel,
					   'celular' 		=> $cel,
					   'email'			=> $email,
				   	   'fecha' 			=> date('Y-m-d'),
				   	   'eventoID'		=> $eventoID,
				   	   'ciudad'			=> $ciudad
		);
		
		$this->db->insert('suscripcionesEventos', $suscr);
		$noticia = $this->blog_model->cargarArticulo($eventoUrl);
		
		//Manda email con contestacion//
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from('contacto@plazadelatecnologia.com', 'Registro | plazadelatecnologia.com');
			$this->email->to($email);
			$this->email->bcc('mdiaz@apeplazas.com');	
			$this->email->subject('Registro a eventos de Plaza de la Tecnología');		
			$this->email->message('
<html>
<head>
<title>Te has registrado con éxito</title>
</head>
    <body>
    <p>¡Hola! '.$nombre.'</p>
    <p>Te has registrado con éxito para asistir a nuestro evento: '.$noticia[0]->articuloTitulo.'</p>
    <p>La fecha del evento es el '.$noticia[0]->fechaEvento.' en '.$noticia[0]->lugarEvento.' a partir de las '.$noticia[0]->articuloHora.'</p>
    <img src="http://www.plazadelatecnologia.com/articulosUpload/'.$noticia[0]->articuloImagenes.'"
    <p>Para ver la información del evendo da <a href="http://www.plazadelatecnologia.com/eventos/post/'.$eventoUrl.'">click aqui... </a></p>
    <p>Estamos a su entera disposición para cualquier duda o aclaración en atencionaclientes@plazadelatecnologia.com</p>
    </body>
</html>
');
		$this->email->send();
		
		$this->session->set_flashdata('msg','<div class="msg">Te has registrado con éxito.</div>');
		
		redirect('eventos/post/'.$eventoUrl);
	}
}
