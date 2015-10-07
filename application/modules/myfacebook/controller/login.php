<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller {
	
	function login()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('user_model');
		$this->load->library('session');
			
	}

	function index()
	{
		//da estilo a efecto en logo en home//
		$op['body']= 'loginUsers';
		
		//Carga los extras al Template Layout//
		$this->layouts->add_include('assets/js/functionsAdmin.js');	
		
		$this->load->view('login-view' ,$op);
			
	}
	
	function validate_credentials()
    {		
        // carga validacion de contraseña y usuario para login
        $query = $this->user_model->validate();
         
        if($query) // si las contraseña y usuario es valida enseña..
        {
            $usuarioID = $query[0]->usuarioID;
            $data = array(
                'usuarioID' => $usuarioID,
                'usuarioEmail' => $this->input->post('usuarioEmail'),
                'is_logged_in' => true
            );
            
            //guardamos los datos en la sesion
            $this->session->set_userdata($data);
			if($query){
            redirect('intranet');
			};
        }
		
	else //si la contraseña esta incorrecta vuelve al index
		{
			$this->session->set_flashdata('msg','<div id="msgLoginAdmin">Su contraseña y Usuario fueron incorrectos,<br> por favor intente nuevamente</div>');
			//envia email
			redirect('login');
		}
    }
	
	
}