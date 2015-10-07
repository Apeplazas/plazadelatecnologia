<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registrate extends MX_Controller {
	
	function registrate()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('inicio/ofertas_model');
		$this->load->model('registrate_model');
		$this->load->library('session');
	}

	function index()
	{
		$this->load->helper('breadcrumb');
	 	
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		$id					= $this->session->userdata('uid');
		$op['info']			= array();
		
		if ($id != '') {
			$tipo = 'info_'.$this->session->userdata('tipoUsuario');
			$op['info']	= $this->data_model->$tipo($id);
		}
		
		$op['estados']		= $this->data_model->cargarEstadosMex();
		
		$this->layouts->add_include('assets/js/jquery-ui.js');
		
		//Vista//
		$this->layouts->index('registrate-view' ,$op);
	}
	
	function guardarRegistro()
	{
		$nickname 	= $this->input->post('nickname');
		$nombre 	= $this->input->post('nombre');
		$apellido 	= $this->input->post('apellido');
		$email 		= $this->input->post('email');
		$password 	= $this->input->post('password');
		$state 		= $this->input->post('state');
		$gender 	= $this->input->post('gender');
		$fechaNac 	= $this->input->post('anio').'-'.$this->input->post('mes').'-'.$this->input->post('dia');
		
		$mail = $this->registrate_model->veificaRegistros($email);
		
		if (!$mail) {
			
			$registro = array('userAlias' 	=> $nickname, 
							  'userName' 	=> $nombre,
							  'lastName'	=> $apellido,
							  'email'		=> $email,
							  'gender'		=> $gender,
							  'contrasenia'	=> md5($password),
							  'hash'		=> md5($email),
							  'state'		=> $state,
							  'status'		=> 'Desactivado',
							  'registrationDate'	=> date('Y-m-d'),
							  'ip'			=> $_SERVER['SERVER_ADDR'],
							  'terminosCondiciones'	=> 'acepto');
							  
			$this->db->insert('usuarios', $registro);
			
			$u = $this->registrate_model->validate($email, $password);
		
			if ($u) {
				
				$id 	= $u[0]->idRegistro;
				$name 	= $u[0]->userAlias;
				$email 	= $u[0]->email;
				
				$data['user'] = array(
	                'uid' 			=> $id,
	                'name'			=> $name,
	                'email' 		=> $email,
	                'tipoUsuario'	=> 'usuario',
	                'is_logged_in' 	=> true
	            );
	            
	            //guardamos los datos en la sesion
	            $this->session->set_userdata($data);
	            
				redirect('usuario');
			}else{
				echo "string";
			}
			
		}else {
			$this->session->set_flashdata('msg','<div class="msg">Lo sentimos, esta cuenta de email ya esta registrada.</div>');
			redirect('registrate');
		}
	}

	function iniciar_sesion()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		$id					= $this->session->userdata('uid');
		$op['info']			= array();
		
		if ($id != '') {
			$tipo = 'info_'.$this->session->userdata('tipoUsuario');
			$op['info']	= $this->data_model->$tipo($id);
		}
        
        //Muestra las campañas que se corren durante el mes y ofertas de esas campañas//
        $op['campanias']    = $this->data_model->cargarCampanias();
        //Carga Ramas para busqueda de productos y limita a 1 para busqueda//
        $op['ramas']		= $this->data_model->cargarRamasLimitadas();
        
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/bjqs-1.3.min.js')
					  ->add_include('assets/js/jquery.touchcarousel-1.2.min.js')
					  ->add_include('assets/js/ytmenu.js')
					  ->add_include('assets/css/three-d-skin.css')
					  ->add_include('assets/css/touchcarousel.css')
					  ->add_include('assets/js/jquery.cookie.js');
		
		//Vista//
		$this->layouts->index('login-view' ,$op);
	}
	
	function validate_credentials()
	{
		
		$email 			= $this->input->post('email');
		$contrasenia 	= $this->input->post('contrasenia');
		
		$u = $this->registrate_model->validate($email, $contrasenia);
		
		if ($u) {
			
			$id 	= $u[0]->idRegistro;
			$name 	= $u[0]->userAlias;
			$email 	= $u[0]->email;
			
			$data['user'] = array(
                'uid' 			=> $id,
                'name'			=> $name,
                'email' 		=> $email,
                'tipoUsuario'	=> 'usuario',
                'is_logged_in' 	=> true
            );
            
            //guardamos los datos en la sesion
            $this->session->set_userdata($data);
            
			redirect('usuario');
			
		} else {
			
			$l = $this->registrate_model->validateLocal($email, $contrasenia);
			
			if ($l) {
				
				$id 	= $l[0]->localID;
				$name 	= $l[0]->localNombre;
				$email 	= $l[0]->localEmail;
				
				$data['user'] = array('uid' 			=> $id,
							  'name'			=> $name,
							  'email' 			=> $email,
							  'tipoUsuario'		=> 'mi_local',
							  'is_logged_in' 	=> true
	            );
	            
	            //guardamos los datos en la sesion
	            $this->session->set_userdata($data);
				redirect('mi_local');
				
			} else {
				$this->session->set_flashdata('msg','<div class="msg">El email ó la contraseña han sido incorrectos, intenta de nuevo.</div>');
				redirect('registrate/iniciar_sesion');
			}
		}
	}

	function accesoDinamico()
	{
		$email 			= $this->input->post('email');
		$contrasenia 	= $this->input->post('contrasenia');
		$urlBack 		= $this->input->post('url');
		
		$u = $this->registrate_model->validate($email, $contrasenia);
		
		if ($u) {
			
			$id 	= $u[0]->idRegistro;
			$name 	= $u[0]->userAlias;
			$email 	= $u[0]->email;
			
			$data['user'] = array(
	                'uid' 			=> $id,
	                'name'			=> $name,
	                'email' 		=> $email,
	                'tipoUsuario'	=> 'usuario',
	                'is_logged_in' 	=> true
            );
            
            //guardamos los datos en la sesion
            $this->session->set_userdata($data);
            
			header('Location: http://m.plazadelatecnologia.com/'.$urlBack);
			
		} else {
			
			$l = $this->registrate_model->validateLocal($email, $contrasenia);
			
			if ($l) {
				
				$id 	= $l[0]->localID;
				$name 	= $l[0]->localNombre;
				$email 	= $l[0]->localEmail;
				$url 	= $l[0]->localUrl;
				
				$data['user'] = array('uid' 			=> $id,
							  'name'			=> $name,
							  'email' 			=> $email,
							  'tipoUsuario'		=> 'mi_local',
							  'is_logged_in' 	=> true
	            );
	            
	            //guardamos los datos en la sesion
	            $this->session->set_userdata($data);
				header('Location: http://m.plazadelatecnologia.com/mi_local');
				
			} else {
				$this->session->set_flashdata('msg','<div class="msg">El email ó la contraseña han sido incorrectos, intenta de nuevo.</div>');
				header('Location: http://m.plazadelatecnologia.com/carrito/registrate');
			}
		}
	}

	function recuperar_contrasenia()
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
		$this->layouts->index('recuperarContrasenia-view' ,$op);
	}
	
	function solicitud_local()
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
		
		$op['sucursal']	= $this->data_model->cargarSucursales();
		
		//Vista//
		$this->layouts->index('solicitudlocal-view' ,$op);
	}
	
	function solicitud_local_visita()
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
		
		$op['sucursal']	= $this->data_model->cargarSucursales();
		
		//Vista//
		$this->layouts->index('solicitudlocalVisita-view' ,$op);
	}
	
	function procesaSolicitud()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nombreAdministrador', 'Nombre del Administrador', 'required');
		$this->form_validation->set_rules('nombreLocal', 'Nombre de la Marca', 'required');
		$this->form_validation->set_rules('razonSocial', 'Tu Razon Social', 'required');
		$this->form_validation->set_rules('numeroLocal', 'El numero de tu local o locales', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('telefono', 'Telefono', 'required');
		$this->form_validation->set_rules('celular', 'Celular', 'required');
		$this->form_validation->set_rules('contrasenia', 'Contraseña', 'required');
		$this->form_validation->set_rules('plaza', 'Plaza en la que te encuentras', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			//Optimizacion y conexion de tags para SEO//
			$opt = $this->uri->segment(1);
			$op['opt'] = $this->data_model->cargarOptimizacion($opt);
			
			$this->layouts->index('solicitudlocal-view' ,$op);
		}
		
		else{
			//Genera variables para posteo en email
		$nombreAdministrador 	= 	$this->input->post('administrador');
		$nombreLocal			= 	$this->input->post('marca');
		$razonSocial			= 	$this->input->post('razonSocial');
		$numeroLocal			= 	$this->input->post('numeroLocal');
		$email					= 	$this->input->post('email');
		$telefono				= 	$this->input->post('telefono');
		$celular				= 	$this->input->post('celular');
		$contrasenia			= 	$this->input->post('contrasenia');
		$plaza					= 	$this->input->post('plaza');
			
		//Genera Array y Inserta en la BD 
		$op = array(
			'administrador'		 => $_POST['nombreAdministrador'], 
			'marca'  	      	 => $_POST['nombreLocal'], 
			'razonSocial'        => $_POST['razonSocial'], 
			'numeroLocal'        => 'numeroLocal', 
			'email'              => $_POST['email'], 
			'telefono'           => $_POST['telefono'],
			'celular'            => $_POST['celular'],
			'contrasenia'        => $_POST['contrasenia'],
			'plaza'              => $_POST['plaza'],
			'fecha'              => date("Y-m-d"),  /* Inserta Fecha */
			'ip'                 => $_SERVER['REMOTE_ADDR'], /*Inserta ip*/
			);
			
		$this->db->insert('solicitudLocalenlinea', $op);
		
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('contacto@plazadelatecnologia.com', 'Solicitud de local en linea');
		$this->email->to($email);
		$this->email->cc('mdiaz@apeplazas.com');
		$this->email->bcc('jhernandezn@apeplazas.com');
		$this->email->subject('Solicitud de local en linea');		
		$this->email->message('
<html>
<head>
<title>Solicitud de local en linea</title>
</head>
<body>
<p>Hola '.$nombreAdministrador.'!!!</p>
<p>Has enviado una solicitud de local en linea de Plaza de la Tecnología. Tus datos serán verificados y en cuanto sean aceptados se te notificara al email proporcionado.</p>
<p>Nombre de Marca '.$nombreLocal.'</p>
<p>Razon Social: '.$razonSocial.' </p>
<p>Plaza: '.$plaza.' </p>
<p>Numero o numeros de local (es): '.$numeroLocal.' </p>
<p>Telefono: '.$telefono.' </p>
<p>Celular: '.$celular.' </p>
<p>Gracias por registrarnos con nosotros, Saludos</p>
</body>
</html>
');
	if($this->email->send())
			{
				redirect('gracias/solicitudLocal');
			}

			else
			{
				show_error($this->email->print_debugger()); /* Muestra error de envio de email */
			}
		
		}
	}
	
	function procesaSolicitudVisita()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nombreAdministrador', 'Nombre del Administrador', 'required');
		$this->form_validation->set_rules('nombreLocal', 'Nombre de la Marca', 'required');
		$this->form_validation->set_rules('razonSocial', 'Tu Razon Social', 'required');
		$this->form_validation->set_rules('numeroLocal', 'El numero de tu local o locales', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('telefono', 'Telefono', 'required');
		$this->form_validation->set_rules('celular', 'Celular', 'required');
		$this->form_validation->set_rules('contrasenia', 'Contraseña', 'required');
		$this->form_validation->set_rules('plaza', 'Plaza en la que te encuentras', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			//Optimizacion y conexion de tags para SEO//
			$opt = $this->uri->segment(1);
			$op['opt'] = $this->data_model->cargarOptimizacion($opt);
			
			$this->layouts->index('solicitudlocal-view' ,$op);
		}
		
		else{
			//Genera variables para posteo en email
		$nombreAdministrador 	= 	$this->input->post('administrador');
		$nombreLocal			= 	$this->input->post('marca');
		$localUrl				= 	$this->input->post('localUrl');
		$paginaInternet			= 	$this->input->post('paginaInternet');
		$razonSocial			= 	$this->input->post('razonSocial');
		$numeroLocal			= 	$this->input->post('numeroLocal');
		$email					= 	$this->input->post('email');
		$emailAdministrador		= 	$this->input->post('emailAdministrador');
		$telefono				= 	$this->input->post('telefono');
		$celular				= 	$this->input->post('celular');
		$contrasenia			= 	$this->input->post('contrasenia');
		$plaza					= 	$this->input->post('plaza');
		$clave					=	md5($email);
		$url					=   strtolower($localUrl);
			
		//Genera Array y Inserta en la BD 
		$op = array(
			'localID'                => '1234'.$clave, 
			'localAdministrador'     => $_POST['nombreAdministrador'], 
			'localNombre'            => $_POST['nombreLocal'],
			'localUrl'               => strtolower($_POST['localUrl']),
			'localStatus'            => 'Pendiente', 
			'paginaInternet'         => $_POST['paginaInternet'], 
			'razonSocial'            => $_POST['razonSocial'], 
			'localNumero'            => $numeroLocal, 
			'localEmail'             => $_POST['email'],
			'emailAdministrador'     => $_POST['emailAdministrador'], 
			'localTelefono'          => $_POST['telefono'],
			'telefonoAdministrador'  => $_POST['celular'],
			'contrasenia'            => md5($contrasenia),
			'sucursal'               => $_POST['plaza'],
			'creacionFecha'          => date("Y-m-d"),  /* Inserta Fecha */
			);
			
		$this->db->insert('locatarios', $op);
		
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('contacto@plazadelatecnologia.com', 'Regístro exitoso');
		$this->email->to($emailAdministrador);
		$this->email->cc('mdiaz@apeplazas.com');
		$this->email->bcc('jhernandezn@apeplazas.com');
		$this->email->subject('Alta de Local en línea exitosa');		
		$this->email->message('
<html>
<head>
<title>Solicitud de local en línea</title>
</head>
<body>
<p>Hola '.$nombreAdministrador.'!!!</p>
<p>Tu alta en nuestro sistema ha sido exitosa, y ya puedes empezar a utilizar nuestro sistema. <a href="www.plazadelatecnologia.com">click aquí..</a>.</p>
<p>Gracias por registrarte con nosotros, <br>Saludos</p>
</body>
</html>
');
	if($this->email->send())
			{
				redirect();
			}

			else
			{
				show_error($this->email->print_debugger()); /* Muestra error de envio de email */
			}
		
		}
	}
	
	function recuperar_hash()
	{
		$correo_usuario = trim($_POST["email"]);
		
		if( empty($correo_usuario) || !isset($correo_usuario) )
		{
			echo"Imposible continuar, se necesita correo";
			exit;
		}
		
		$u = $this->db->query("SELECT * FROM usuarios WHERE email='$correo_usuario'")->result();
	
		if ($u) {
			$id 	= $u[0]->idRegistro;
			$name 	= $u[0]->userAlias;
			$email 	= $u[0]->email;
			$tipo 	= 'usuario';
			
		} else {
			
				$l = $this->db->query("SELECT * FROM locatarios WHERE localEmail='$correo_usuario'")->result();
				
				if ($l) {
					$id 	= $l[0]->localID;
					$name 	= $l[0]->localNombre;
					$email 	= $l[0]->localEmail;
					$tipo 	= 'local';
				} 
				
				else {
					$this->session->set_flashdata('msg','<div class="msg">El email ó la contraseña han sido incorrectos, intenta de nuevo.</div>');
					redirect('registrate/iniciar_sesion');
				}
			}
			
			$fecha_actual = date("y-m-d");
			$key_word = $correo_usuario.$fecha_actual;
	        $hash = sha1($key_word);
	        
	        $var = array('usuarioID'=>$id,'hash_pwd'=>$hash,'usuarioTipo'=>$tipo);
	        $this->db->insert('recuperar_pwd', $var);
	        $link = "http://www.plazadelatecnologia.com/registrate/recuperar_contrasenia.php";
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from('noresponder@plazadelatecnologia.com', 'Recupera tu Contraseña');
			$this->email->to($correo_usuario);
			$this->email->subject('Recuperacion de contraseña, plazadelatecnologia.com');
			$link_text="Hola $name !!! Da click aquí para generar su nueva contraseña <a href=\"http://www.plazadelatecnologia.com/brayant/registrate/ok/hash/$hash\">Recuperar Contraseña</a>";
			$this->email->message($link_text);
			$this->email->send();
			
			redirect('gracias/recuperarContrasenia');
		
	}
	function ok()
	{
		$hash = $this->uri->segment(4);
		$hash = trim($hash);
		
		$query = $this->db->query("SELECT * from recuperar_pwd WHERE hash_pwd='$hash'");
		
		if( $query->num_rows()>0 )
		{
			foreach ($query->result() as $row)
			{
				$usuarioID 		= $row->usuarioID;
				$usuarioTipo 	= $row->usuarioTipo;
			}
		}
		else
		{
			//podemos redireccionar o escribimos algo
			echo"no corresponde el hash al enviado";
		}
		
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$op['query'] = $query->result();
		$this->layouts->index('psw-view', $op);
	}
	
	function pwd()
	{
		$pwd  = trim($_POST["new_pwd"]);
		$pwd1 = trim($_POST["new_pwd_again"]);
		$tipo = $_POST["tipo"];
		$hash = $_POST["hash"];
		
		if( strcmp($pwd,$pwd1) == 0 )
		{
			$c = $this->db->query("SELECT * FROM recuperar_pwd WHERE hash_pwd='$hash'");
			
			foreach($c->result() as $row){
				$usuarioID = $row->usuarioID;
			}
			
			$sha1_pwd = md5($pwd);
			$data = array('contrasenia',$sha1_pwd);
			if($tipo == 'usuario'){
				$this->db->query("UPDATE usuarios SET contrasenia='$sha1_pwd' WHERE idRegistro='$usuarioID'");
			}
			else{
				$this->db->query("UPDATE locatarios SET contrasenia='$sha1_pwd' WHERE localID='$usuarioID'");
			}
			
			$this->session->set_flashdata('msg','<em class="msg">Te contraseña ha sido cambiada exitosamente. Inicia Sesión.</em>');
			redirect('registrate/iniciar_sesion');
		}
		else
		{
			$this->session->set_flashdata('msg','<em class="msg">Las contraseñas proporcionadas no coinciden, Inténtalo nuevamente.</em>');
			redirect('registrate/ok/hash/'.$hash.'');
		}
	}
	
	function salir()
	{
		$this->session->sess_destroy();
		redirect('');
	}
}