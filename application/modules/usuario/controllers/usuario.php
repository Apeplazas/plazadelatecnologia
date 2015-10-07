<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends MX_Controller {
	
	function usuario()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('carrito/carrito_model');
		$this->load->model('usuario_model');
		$this->is_logged_in();
	}
	
	//verifica que la sesion esta inciada para poder dar acceso a modulo
	function is_logged_in()
    {
        $userprofile = $this->session->userdata('user');
        if(!isset($userprofile) || $userprofile != true)
        {
                    redirect('registrate/iniciar_sesion');
        }else{
            
                    if($userprofile['tipoUsuario'] != 'usuario'){
                   
                    redirect('mi_local');
                    }
             }
    }
    
	function index()
	{
	 	//Validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
        
        if ($user['uid'] != '') {
        
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->usuario_model->cargarMenuUsuario();
		//Carga inbox locales//
		$op['inbox'] = $this->usuario_model->cargarInbox($user['uid']);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js');
		
		//Vista//
		$this->layouts->usuario('usuario-view' ,$op);
	}
	
	function lectura($mensajeID)
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
         if ($user['uid'] != '') {
        
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
        
        //Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		//Carga menu locales//
		$op['menuLocal'] = $this->usuario_model->cargarMenuUsuario();
		//Carga inbox locales//
		$op['inbox'] = $this->usuario_model->cargarInbox($user['uid']);
		
		$mensajeID = $this->uri->segment(3);
		$op['mensaje'] = $mensaje = $this->usuario_model->cargarMensajeID($mensajeID);
		
		foreach($mensaje as $rowMensaje):
		
			//Actualiza el comentario como Leido en la Bd de contactos//
			if($rowMensaje->estatus != 'contestado' ){
				$leido = array('estatusUsuario' => 'leido',);
				$this->db->where('contactoID', $mensajeID);
				$this->db->update('contactos', $leido); 
			}
			//Vista//
			$this->layouts->milocal('mensaje-view' ,$op);
		
		
		endforeach;
	}
	
	function responder()
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
         if ($user['uid'] != '') {
        
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$infoCon = $this->usuario_model->cargarUsuarioInfo($user['uid']);
		//Carga menu locales//
		$op['menuLocal'] = $this->usuario_model->cargarMenuUsuario();
		
		//SESSION DE REGISTRO//
		foreach($infoCon as $rowIn):
	 	$id					= $rowIn->idRegistro;
        $email				= $rowIn->email;
        $alias				= $rowIn->userAlias;
        $name				= $rowIn->userName;
        endforeach;
        
        //VALIDA QUE EL FORMULARIO NO MANDE EN CERO//
		$this->load->library('form_validation');
		$this->form_validation->set_rules('responder', 'Responder', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			//Optimizacion y conexion de tags para SEO//
			$opt = $this->uri->segment(1);
			$op['opt'] = $this->data_model->cargarOptimizacion($opt);
			
			$this->layouts->milocal('mensaje-view' ,$op);
		}
		
		else{
			//Genera variables para posteo en email
			$parentID				= 		$this->input->post('mensajeID');
			$contactoComentario		=		$this->input->post('responder');
			$ofertaID				=		$this->input->post('ofertaID');
			$contactoTipo			=		$this->input->post('contactoTipo');
			$usuario				=		$this->input->post('xls');
			$emailRecibe			=		$this->input->post('email');
			$ofertaTitulo			=		$this->input->post('ofertaTit');
			$nombre					=		$this->input->post('name');
				
			//Genera Array y Inserta en la BD 
			$op = array(
				'parentID'              => $parentID, 
				'contactoComentario'    => $contactoComentario, 
				'ofertaID'              => $ofertaID, 
				'contactoTipo'          => $contactoTipo, 
				'usuarioIDEnvia'        => $id,
				'usuarioIDRecibe'       => $usuario,
				'usuarioTipo'           => 'usuario', 
				'contactoFecha'         => date("Y-m-d"),  /* Inserta Fecha */
				'contactoHora'          => date("H:m:s"),	/* Inserta Hora */
				);
				
			$contestaciones = $this->usuario_model->limpiarContestaciones($parentID);
			foreach($contestaciones as $row){
				//Actualiza el estado del comentario hijo//
				$contestado = array('estatusUsuario' => 'contestado', 'fechaSeguimiento' => date("Y-m-d"));
				$this->db->where('contactoID', $row->contactoID);
				$this->db->update('contactos', $contestado);
			}
					
			if ($this->db->insert('contactos', $op)){
				//Actualiza el comentario como Leido en la Bd de contactos//
				$contestado = array('estatusLocal' => 'pendiente', 'fechaSeguimiento' => date("Y-m-d"));
				$this->db->where('contactoID', $parentID);
				$this->db->update('contactos', $contestado);
				}
				
			//Manda email con contestacion//
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from('atencionaclientes@plazadelatecnologia.com', 'Comentario via | plazadelatecnologia.com');
			$this->email->to($emailRecibe);
			$this->email->bcc('mdiaz@apeplazas.com');	
			$this->email->subject('Pregunta o comentario en el artículo '.$ofertaTitulo.'');		
			$this->email->message('
<html>
<head>
<title>Pregunta o comentario en el artículo '.$ofertaTitulo.'</title>
</head>
    <body>
    <p>¡Hola! '.$name.'</p>
    <p>'.$nombre.' Ha contestado tu comentario del artículo '.$ofertaTitulo.'</p>
    <p>Para ver y contestar da <a href="http://www.plazadelatecnologia.com/mi_local">click aqui... </a></p>
    <p>Estamos a su entera disposición para cualquier duda o aclaración en atencionaclientes@plazadelatecnologia.com</p>
    </body>
</html>
');
		if($this->email->send())
				{
					redirect('usuario/lectura/'.$parentID);
				}
	
				else
				{
					show_error($this->email->print_debugger()); /* Muestra error de envio de email */
				}
			
		}
		

	}
	
	function borrado($mensajeID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$mensajeID 	= $this->uri->segment(3);
		$borrar = $this->usuario_model->borrado($mensajeID);
			foreach($borrar as $row){
			$borrar		= array('estatusUsuario' =>	'borrado',);
			$this->db->where('parentID', $mensajeID);
			$this->db->update('contactos', $borrar); 
		}
		
		
		$this->db->where('contactoID', $mensajeID);
		$this->db->update('contactos', $borrar); 
		
		if($this->db->affected_rows()){
			redirect('usuario');
		}
		else{
			redirect('mi_local/looser');
		}
	}
	
	function config_cuenta(){
		
		//Validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
        
        if ($user['uid'] != '') {
        
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->usuario_model->cargarMenuUsuario();
		//Carga inbox locales//
		$op['ajustes'] = $this->usuario_model->ajustesCuenta($user['uid']);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js');
		
		//Vista//
		$this->layouts->usuario('config_cuenta-view' ,$op);
	}
	
	function uploadAvatar()
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
	   $config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' 	=> 'usuariosFotos',
			'max_size' 		=> 5000,
			'encrypt_name' 	=> TRUE,
			'maintain_ration' => TRUE,
	   );
		
 	   $this->load->library('upload', $config);
	   $this->upload->do_upload();
	   $image_data = $this->upload->data();
	   
	   $config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => 'usuariosFotos/thumbs',
				'create_thumb' 	=>	TRUE,
				'thumb_marker'  => '' ,
				'width' => 200,
				'height' => 200,
				'maintain_ration' => TRUE,
				'encrypt_name' 	=> TRUE,
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		
		$localLogo= array('imagenPersonalizada' => $image_data['raw_name'].$image_data['file_ext']);
		
		$this->db->where('idRegistro', $user['uid']); 
		$this->db->update('usuarios', $localLogo); 
		
		redirect('usuario/config_cuenta');   
	}

	function updateInfo()
	{
		if ($this->input->post('nickname') !=  '') {
			$update['userAlias'] = $this->input->post('nickname');
		}
		
		if ($this->input->post('name') !=  '') {
			$update['userName'] = $this->input->post('name');
		}
		
		if ($this->input->post('lastName') !=  '') {
			$update['lastName'] = $this->input->post('lastName');
		}
		
		if ($this->input->post('lastName') !=  '') {
			$update['lastName'] = $this->input->post('lastName');
		}

		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}

		$this->db->where('idRegistro', $user['uid']);
		$this->db->update('usuarios', $update);
		
		$this->session->set_flashdata('msg','<div class="msg">Actualización realizada con éxito.</div>');
		redirect('usuario/config_cuenta');
	}
	
	function updatePass(){
		
		$passNow = $this->input->post('passwordNow');
		$passNew = $this->input->post('passwordNew');
		
		$user = $this->session->userdata('user');
		
		if ($passNow != '') {
			
			$pass = $this->usuario_model->passIgual($user['uid']);
			if ($pass[0]->contrasenia == md5($passNow)) {
					
				$pass = array('contrasenia' => md5($passNew));
				$this->db->where('idRegistro', $user['uid']);
				$this->db->update('usuarios', $pass);
				
				$this->session->set_flashdata('msg','<div class="msg">Actualización realizada con éxito.</div>');
			}else{
				$this->session->set_flashdata('msg','<div class="msg">Contraseña incorrecta.</div>');
			}
		}

		redirect('usuario/config_cuenta');
	}

	function pedidos()
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
        
        if ($user['uid'] != '') {
        
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->usuario_model->cargarMenuUsuario();
		//Carga inbox locales//
		$op['pedidos'] = $this->usuario_model->pedidosLista($user['uid']);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js');
		
		//Vista//
		$this->layouts->usuario('pedidos-view' ,$op);
	}
	
	function detalleCompra()
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
        
        if ($user['uid'] != '') {
        
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->usuario_model->cargarMenuUsuario();
		//Carga inbox locales//
		$op['compra'] = $this->usuario_model->detalleCompra($this->uri->segment(3));
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js');
		
		//Vista//
		$this->layouts->usuario('detalleCompra-view' ,$op);
	}
	
	function direcciones()
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
        
        if ($user['uid'] != '') {
        
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->usuario_model->cargarMenuUsuario();
		//Carga inbox locales//
		$op['direcciones'] = $this->usuario_model->direccionesCuenta($user['uid']);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js');
		
		//Vista//
		$this->layouts->usuario('lista_direcciones-view' ,$op);
	}
	
	function editar_dir()
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
        
        if ($user['uid'] != '') {
        
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->usuario_model->cargarMenuUsuario();
		//Carga inbox locales//
		$op['direccion']     = $this->usuario_model->cargarDireccion($this->uri->segment(3));
		$op['estados']	     = $this->carrito_model->estados();
		
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js');
		
		//Vista//
		$this->layouts->usuario('editar_dir-view' ,$op);
	}
	
	function updateDir()
	{
		if ($this->input->post('titulo') !=  '') {
			$update['titulo'] = $this->input->post('titulo');
		}
		
		if ($this->input->post('calle') !=  '') {
			$update['direccion'] = $this->input->post('calle');
		}
		
		if ($this->input->post('cp') !=  '') {
			$update['CodigoPostal'] = $this->input->post('cp');
		}
		
		if ($this->input->post('tel') !=  '') {
			$update['telefono'] = $this->input->post('tel');
		}
		
		if ($this->input->post('recibe') !=  '') {
			$update['recibe'] = $this->input->post('recibe');
		}
		
		$update['estado'] 				= $this->input->post('estado');
		$update['municipioDelegacion'] 	= $this->input->post('municipio');
		$update['colonia'] 				= $this->input->post('colonia');

		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}

		$this->db->where('idSitio', $this->input->post('sitio'));
		$this->db->update('sitiosEntrega', $update);
		
		$this->session->set_flashdata('msg','<div class="msg">Actualización realizada con éxito.</div>');
		redirect('usuario/editar_dir/'.$this->input->post('sitio'));
	}

	function nueva_dir()
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
        
        if ($user['uid'] != '') {
        
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->usuario_model->cargarMenuUsuario();
		$op['estados']	     = $this->carrito_model->estados();
		
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js');
		
		//Vista//
		$this->layouts->usuario('nueva_dir-view' ,$op);
	}
	
	function guardar_dir()
	{
		$titulo 		= $this->input->post('titulo');
		$direccion 		= $this->input->post('calle');
		$codigopostal 	= $this->input->post('cp');
		$telefono 		= $this->input->post('tel');
		$recibe 		= $this->input->post('recibe');
		$estado			= $this->input->post('estado');
		$municipio		= $this->input->post('municipio');
		$colonia 		= $this->input->post('colonia');

		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$sitio = array('usuarioID'		=> $user['uid'],
					   'titulo' 		=> $titulo, 
					   'direccion' 		=> $direccion,
					   'CodigoPostal' 	=> $codigopostal,
					   'telefono'		=> $telefono,
					   'recibe'			=> $recibe,
					   'estado'			=> $estado,
					   'municipioDelegacion' => $municipio,
					   'colonia'		=> $colonia,
		);
		$this->db->insert('sitiosEntrega', $sitio);
		
		$this->session->set_flashdata('msg','<div class="msg">La dirección se guardo con éxito.</div>');
		redirect('usuario/direcciones');
	}

	function eliminar_dir()
	{
		$eliminaDir = array('estatus' => 'borrado');
		$this->db->where('idSitio', $this->uri->segment(3));
		$this->db->update('sitiosEntrega', $eliminaDir);
	
		$this->session->set_flashdata('msg','<div class="msg">Se ha eliminado una direccion de la lista.</div>');
		redirect('usuario/direcciones');	
	}
	
	function salir()
	{
		$this->session->sess_destroy();
		redirect();	
	}
	
}