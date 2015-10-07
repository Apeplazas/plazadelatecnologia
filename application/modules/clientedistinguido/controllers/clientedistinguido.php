<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientedistinguido extends MX_Controller {
	
	function clientedistinguido()
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
		$this->layouts->simpleLayout('clientedistinguido-view' ,$op);
	}
		
	function guardarContacto()
	{

		$this->form_validation->set_rules('nombreContacto', 'Nombre', 'required');
		$this->form_validation->set_rules('emailContacto', 'Email', 'required');
		$this->form_validation->set_rules('telefonoContacto', 'Telefono', 'required');
		$this->form_validation->set_rules('estadoContacto', 'Estado', 'required');
		$this->form_validation->set_rules('comentarioContacto', 'Comentario', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			//Optimizacion y conexion de tags para SEO//
			$opt = $this->uri->segment(1);
			$op['opt'] = $this->data_model->cargarOptimizacion($opt);
			
			redirect('contacto/formulario');
		}
		
		else{
			//Genera variables para posteo en email
			$nombreContacto		= 	$this->input->post('nombreContacto');
			$email				= 	$this->input->post('emailContacto');
			$telefonoContacto	= 	$this->input->post('telefonoContacto');
			$estadoContacto		= 	$this->input->post('estadoContacto');
			$comentario			= 	$this->input->post('comentarioContacto');
			$contactoTipo		= 	$this->input->post('motivoContacto');
			$empresa			= 	$this->input->post('empresa');
			
			//Valida la informacion del contacto
			$cadena = $nombreContacto." ".$email." ".$telefonoContacto." ".$estadoContacto." ".$comentario." ".$contactoTipo;
				
			preg_match("/href|declare|select|somebody|http|www/",$cadena,$registros);
			if(count($registros) == 0){
			
		//Genera Array y Inserta en la BD 
		$op = array(
			'nombre'         => $_POST['nombreContacto'],
			'email'					=> $_POST['emailContacto'],
			'empresa'        => $_POST['empresa'],
			'telefono'       => $_POST['telefonoContacto'],
			'estado'         => $_POST['estadoContacto'],
			'motivoContacto' => $_POST['motivoContacto'],
			'comentario'     => $_POST['comentarioContacto'], 
			'contactoFecha'			=> date("Y-m-d"),  /* Inserta Fecha */
			'contactoHora'			=> 	date("H:m:s"),	/* Inserta Hora */
			);
			
		$this->db->insert('clienteDistinguido', $op);
		
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('contacto@plazadelatecnologia.com', 'Contacto Plaza de la Tecnologia');
		$this->email->to($email);
		$this->email->cc('mdiaz@apeplazas.com');
		$this->email->subject('Registro de Cliente distinguido - Plaza de la Tecnologia');		
		$this->email->message('
<html>
<head>
<title>Registro de Cliente Distinguido - Plaza de la Tecnologia</title>
</head>
<body>
<p>Hola '.$nombreContacto	.'!!!</p>
<p>Tu registro a nuestro programa fue exitoso, uno de nuestros asesores de servicios se pondrá en contácto contigo antes de 24horas.</p>
<p>Muchas gracias, Saludos</p>
</body>
</html>
');
	if($this->email->send())
			{
				redirect('gracias/clientedistinguido');
				}
	
				else{
					show_error($this->email->print_debugger()); /* Muestra error de envio de email */
				}
		
			}else{
				echo 'faltan datos';
			}
		}
	}
	
}