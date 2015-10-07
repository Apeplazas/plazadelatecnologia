<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acceso extends MX_Controller {
	
	function acceso()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
		$this->load->model('acceso_model');
		$this->load->library('session');
	}

	function index()
	{	 	
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		$this->layouts->add_include('assets/js/jquery-ui.js');
		
		$op['info'] = array();
		//Vista//
		$this->layouts->simpleLayout('login-view' ,$op);
	}
	
	function validate_credentials()
	{
		$email 			= $this->input->post('email');
		$contrasenia 	= $this->input->post('contrasenia');
		
		$u = $this->acceso_model->validate($email, $contrasenia);
		
		if ($u) {
			
			$id 	= $u[0]->administradorID;
			$name 	= $u[0]->nombre;
			$email 	= $u[0]->email;
			
			$data['admin'] = array(
	                'id' 			=> $id,
	                'name'			=> $name,
	                'email' 		=> $email,
	            );
			
			//guardamos los datos en la sesion
	        $this->session->set_userdata($data);
	        
	        redirect('hobbits');
			
		} else {
			$this->session->set_flashdata('msg','<div class="msg">El email ó la contraseña han sido incorrectos, intenta de nuevo.</div>');
			redirect('acceso');
		}
	}
		
	function salir()
	{
		$this->session->sess_destroy();
		redirect('');
	}
}