<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto extends MX_Controller {
	
	function contacto()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
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
		
		//Vista//
		$this->layouts->mobileSencillo('contacto-view' ,$op);
	}
	
	function formulario()
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
		
		$op['ciudades']    		= $this->data_model->cargarCiudades();
		
		//Vista//
		$this->layouts->mobileSencillo('formulario-view' ,$op);
	}
	
	function quejasysugerencias()
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
		
		//Vista//
		$this->layouts->mobileSencillo('quejasysugerencias-view' ,$op);
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
			
			//Valida la informacion del contacto
			$cadena = $nombreContacto." ".$email." ".$telefonoContacto." ".$estadoContacto." ".$comentario." ".$contactoTipo;
				
			preg_match("/href|declare|select|somebody|http|www/",$cadena,$registros);
			if(count($registros) == 0){
			
		//Genera Array y Inserta en la BD 
		$op = array(
			'comentario'	=> $_POST['comentarioContacto'], 
			'contactoTipo'			=> $_POST['motivoContacto'], 
			'usuarioTipo'			=> $_POST['usuarioTipo'],
			'nombre'				=> $_POST['nombreContacto'],
			'email'					=> $_POST['emailContacto'],
			'estado'				=> $_POST['estadoContacto'],
			'telefono'				=> $_POST['telefonoContacto'],
			'contactoFecha'			=> date("Y-m-d"),  /* Inserta Fecha */
			'contactoHora'			=> 	date("H:m:s"),	/* Inserta Hora */
			);
			
		$this->db->insert('contactosExternos', $op);
		
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('contacto@plazadelatecnologia.com', 'Contacto Plaza de la Tecnologia');
		$this->email->to($email);
		$this->email->cc('mdiaz@apeplazas.com');
		$this->email->subject('Contácto en Linea - Plaza de la Tecnologia');		
		$this->email->message('
<html>
<head>
<title>Contácto en Linea - Plaza de la Tecnologia</title>
</head>
<body>
<p>Hola '.$nombreContacto	.'!!!</p>
<p>Tu comentario a sido enviado a nuestra departamento de Atención a Clientes, en breve uno de nuestros representantes te contáctara para darle seguimiento a tu duda o comentario.</p>
<p>Gracias por contáctarnos, Saludos</p>
</body>
</html>
');
	if($this->email->send())
			{
				redirect('gracias/contacto');
			}

			else{
				show_error($this->email->print_debugger()); /* Muestra error de envio de email */
			}
		
		}else{
			echo 'faltan datos';
		}
	}
}
	
	function suscribete()
	{
		//Genera variables para posteo en email
		$nombre		= 	$this->input->post('nombreSus');
		$email		= 	$this->input->post('emailSus');
		
		//Valida la informacion del contacto
		$cadena = $nombre." ".$email;
			
		preg_match("/href|declare|select|somebody|http|www/",$cadena,$registros);
		if(count($registros) == 0){
				
		//if (!empty($nombre) && !empty($email)){
			//Genera Array y Inserta en la BD 
			$op = array(
						'nombre'	=> $_POST['nombreSus'], 
						'email'		=> $_POST['emailSus'], 
						'Fecha'		=> date("Y-m-d"),  /* Inserta Fecha */
			);
			$this->db->insert('suscripcionesBoletin', $op);
			
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from('contacto@plazadelatecnologia.com', 'Suscripcion Plaza de la Tecnologia');
			$this->email->to($email);
			$this->email->cc('mdiaz@apeplazas.com');
			$this->email->subject('Via plazadelatecnologia.com | Gracias por suscribirte');		
			$this->email->message('
<html>
<head>
<title>Gracias por suscribirte en - plazadelatecnologia.com</title>
</head>
<body>
<p>Hola '.$nombre	.'!!!</p>
<p>Tu suscripcion a nuestro sistema de boletin por email ha sido exitoso.</p>
<p>Saludos</p>
</body>
</html>
');
			if($this->email->send()){
				redirect('gracias/suscripcion');
			}else{
				show_error($this->email->print_debugger()); /* Muestra error de envio de email */
			}
		
		}else{
			echo 'faltan datos';
		}
	}
	
	function guardarContactoRenta()
	{

		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('telefono', 'Telefono', 'required');
		$this->form_validation->set_rules('estado', 'Estado', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			//Optimizacion y conexion de tags para SEO//
			$opt = $this->uri->segment(1);
			$op['opt'] = $this->data_model->cargarOptimizacion($opt);
			
			redirect('contacto/formulario');
		}
		
		else{
			//Genera variables para posteo en email
			$nombre				= 	$this->input->post('nombre');
			$email				= 	$this->input->post('email');
			$telefono			= 	$this->input->post('telefono');
			$celular			= 	$this->input->post('celular');
			$estado				= 	$this->input->post('estado');
			$comentario			= 	$this->input->post('comentario');
			
			//Valida la informacion del contacto
			$cadena = $nombre." ".$email." ".$telefono." ".$celular." ".$estado." ".$comentario;
				
			preg_match("/href|declare|select|somebody|http|www/",$cadena,$registros);
			if(count($registros) == 0){
			
		//Genera Array y Inserta en la BD 
		$op = array( 
			'nombre'				=> $_POST['nombre'],
			'email'					=> $_POST['email'],
			'estado'				=> $_POST['estado'],
			'telefono'				=> $_POST['telefono'],
			'celular'				=> $_POST['celular'],
			'comentario'			=> $_POST['comentario'],
			'fecha'					=> date("Y-m-d"),  /* Inserta Fecha */
			'hora'					=> 	date("H:m:s"),	/* Inserta Hora */
			);
			
		$this->db->insert('contactoRentadelocales', $op);
		
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('contacto@plazadelatecnologia.com', 'Contacto Plaza de la Tecnologia');
		$this->email->to($email);
		$this->email->cc('jdavila@apeplazas.com','brodriguez@apeplazas.com','jrodriguezs@apeplazas.com');
		$this->email->bcc('mdiaz@apeplazas.com');
		$this->email->subject('Contácto en Linea - Via Plaza de la Tecnologia');		
		$this->email->message('
<html>
<head>
<title>Renta de locales - Plaza de la Tecnologia</title>
</head>
<body>
<p>Hola '.$nombre.'!!!</p>
<p>Tu Telefono es '.$telefono.'!!!</p>
<p>Tu Celular es '.$celular.'!!!</p>
<p>Del estado '.$estado.'!!!</p>
<p>Pronto se pondra en contacto uno de nuestros representantes de ventas.</p>
<p>Gracias por contáctarnos, Saludos</p>
</body>
</html>
');
	if($this->email->send())
			{
				redirect('gracias/contacto');
			}

			else
			{
				show_error($this->email->print_debugger()); /* Muestra error de envio de email */
			}}else{
			echo 'faltan datos';
		}
	}
}

}