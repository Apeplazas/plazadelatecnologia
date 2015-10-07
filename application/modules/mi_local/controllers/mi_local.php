<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mi_local extends MX_Controller {
	
	function mi_local()
	{
		parent::__construct();
		$this->load->model('mi_local/milocal_model');
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
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
            
                    if($userprofile['tipoUsuario'] != 'mi_local'){
                   
                    redirect('usuario');
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
		
		$url = $this->uri->uri_string(); // Genera Variable del Url
		$op['bannerSky']      = $this->data_model->cargarSkyHome($url);
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->milocal_model->cargarMenuLocal();
		$op['noConf'] 		= $this->milocal_model->porConf($user['uid']);
		
		//Carga inbox locales//
		$op['inbox'] = $this->milocal_model->cargarInbox($user['uid']);
		
		//Carga menu de no publicados//
		$op['nopublicados'] = $this->ofertas_model->cargarPendientesLocal($user['uid']);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js');
					 
		
		//Vista//
		$this->layouts->milocal('inbox-view' ,$op);
	}
	
	function inbox()
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
		$op['menuLocal'] = $this->milocal_model->cargarMenuLocal();
		$op['noConf'] 		= $this->milocal_model->porConf($user['uid']);
		
		//Carga inbox locales//
		$op['inbox'] = $this->milocal_model->cargarInbox($user['uid']);
		//Carga menu de no publicados//
		$op['nopublicados'] = $this->ofertas_model->cargarPendientesLocal($user['uid']);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js');
		
		//Vista//
		$this->layouts->milocal('inbox-view' ,$op);
	}
	
	function productosVendidos()
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
		$op['menuLocal'] 	= $this->milocal_model->cargarMenuLocal();
		$op['noConf'] 		= $this->milocal_model->porConf($user['uid']);
		//Carga inbox locales//
		$op['inbox'] = $this->milocal_model->cargarInbox($user['uid']);
		//Carga menu de no publicados//
		$op['nopublicados'] = $this->ofertas_model->cargarPendientesLocal($user['uid']);
		
		//Carga productos vendidos/
		$op['producto'] 	= $this->milocal_model->cargaProductosVen($user['uid']);
		$op['confirmado'] 	= $this->milocal_model->cargaProductosConfirmados($user['uid']);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js');
		
		//Vista//
		$this->layouts->milocal('productosVendidos-view' ,$op);
	}
	
	function solicitudTraspaso()
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
		//Carga inbox locales//
		$op['inbox'] = $this->milocal_model->cargarInbox($user['uid']);
		//Carga menu de no publicados//
		$op['nopublicados'] = $this->ofertas_model->cargarPendientesLocal($user['uid']);
		$op['producto'] 	= $this->milocal_model->cargaProductosConfirmados($user['uid']);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js');
					  
		//Vista//
		$this->layouts->simpleLayout('traspaso-form' ,$op);
	}
	
	function traspaso()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nombre', 'Nombre que solicita el traspaso', 'required');
		$this->form_validation->set_rules('nombreCuenta', 'nombre cuenta requiere el nombre del cuentahabiente', 'required');
		$this->form_validation->set_rules('banco', 'Banco', 'required');
		$this->form_validation->set_rules('numeroCuenta', 'Numero de cuenta', 'required');
		$this->form_validation->set_rules('clabe', 'Clabe', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('privacidad', 'Terminos y Condiciones', 'required');
		
		if ($this->form_validation->run() == FALSE)
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
			//Carga inbox locales//
			$op['inbox'] = $this->milocal_model->cargarInbox($user['uid']);
			//Carga menu de no publicados//
			$op['nopublicados'] = $this->ofertas_model->cargarPendientesLocal($user['uid']);
			
			$this->layouts->index('traspaso-form' ,$op);
		}
		
		else
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
			
			//Productos confirmados a pagar//
			$confirmado	= $this->milocal_model->cargaProductosConfirmados($user['uid']);
			
			//Genera variables para posteo en email
			$nombreCuenta     = $this->input->post('nombreCuenta');
			$banco            = $this->input->post('banco');
			$numeroCuenta     = $this->input->post('numeroCuenta');
			$clabe            = $this->input->post('clabe');
			$localID          = $user['uid'];	
			$nombre           = $this->input->post('nombre');
			$emailSolicitante = $this->input->post('email');
			$total            = '';
			$gananciaPt       = '';
						
			//busca el ultimo folio en la BD
			$query = $this->milocal_model->foliosTraspasos();
			if($query){
				//Genera el folio consecutivo de los traspasos.
				foreach ($query as $row) {
					$id_c = $row->folioTraspaso;
					$arr_folio = explode("-", $id_c);
					$fol = $arr_folio[1];
					$foll = $fol + 1;
					$folio = "TRF-00".$foll;
				}
			}else{
				$fol = 0;
				$fol = $fol + 1;
				$folio = "TRF-00" .$fol;
			}
			
			foreach($confirmado as $rowC){
				if ($rowC->totalSinComision != ''){
				$total += str_replace(",","",$rowC->totalSinComision);
				$gananciaPt += str_replace(",","",$rowC->gananciaPt);
				
				$actualiza = array('statusProducto' => 'solicitudTraspaso', 'folioTraspaso' => $folio, );
						$this->db->where('ofertaID', $rowC->ofertaID);
						$this->db->where('folioCompra', $rowC->folioCompra);
						$this->db->update('productosComprados', $actualiza);
					}
			}
			
			//Genera array para insertar los datos del usuario con cargo de envio
			if($total != ''){
				$traspaso = array(
					'folioTraspaso' 	=> $folio,
					'montoTraspaso'		=> $total,
					'fechaSolicitud'	=> date("Y-m-d"),  /* Inserta Fecha */
					'comisionPT'		=> $gananciaPt,
					'nombreSolicitante'	=> $nombre,
					'emailSolicitante'	=> $emailSolicitante,
					'localID'			=> $localID,
				);
					
				$this-> db->insert('solicitudTraspasos', $traspaso);
					$bancoDatos = array(
					'nombreCuenta' 		=> $nombreCuenta,
					'banco'				=> $banco,
					'numeroCuenta'		=> $numeroCuenta,
					'clabe'				=> $clabe,
					'localID'			=> $localID,
				);
				$this-> db->insert('cuentasBancos', $bancoDatos);
								
				//Manda email con contestacion//
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->from('administracion@plazadelatecnologia.com', 'Comentario via | plazadelatecnologia.com');
				$this->email->to('jhernandezn@apeplazas.com');
				$this->email->bcc('mdiaz@apeplazas.com');	
				$this->email->subject('Solicitud de Traspaso');		
				$this->email->message('
<html>
<head>
<title>'.$user['name'].' ha solicitado un traspaso.</title>
</head>
    <body>
    <p>Nombre de la cuenta:'.$nombreCuenta.'</p>
    <p>Titular:'.$nombre.'</p>
    <p>Email titular:'.$emailSolicitante.'</p>
    <p>Banco:'.$banco.'</p>
    <p>Numero de Cuenta:'.$numeroCuenta.'</p>
    <p>CLABE:'.$clabe.'</p>
    <br>
    Total solicitado:
	<strong>'.$total.'</strong>
	<p>Para confirmar al locatario de que el traspaso ha sido realizado, da <a href="http://www.plazadelatecnologia.com/hobbits/traspasos_exito">click aqui</a>.</p>
    </body>
</html>
');
				$this->email->send();
				//Mensaje de transaccion exitosa//
				$this->session->set_flashdata('msg', '<strong class="msgSuccess">Su transacción fue exitosa y sera reflejada el Viernes.</strong>');
				redirect('mi_local/productosVendidos');
				
				}
			else{
			$this->session->set_flashdata('msg', '<strong class="msgSuccess">Lo sentimos, en este momento no cuentas con dinero disponible para traspaso.</strong>');
				redirect('mi_local/productosVendidos');
				}
		}
				
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
		$op['menuLocal'] = $this->milocal_model->cargarMenuLocal();
		$op['noConf'] 		= $this->milocal_model->porConf($user['uid']);
		//Carga inbox locales//
		$op['inbox'] = $this->milocal_model->cargarInbox($user['uid']);
		//Carga menu de no publicados//
		$op['nopublicados'] = $this->ofertas_model->cargarPendientesLocal($user['uid']);
		
		$mensajeID = $this->uri->segment(3);
		$op['mensaje'] = $mensaje = $this->milocal_model->cargarMensajeID($mensajeID);
		
		foreach($mensaje as $rowMensaje):	
		//Actualiza el comentario como Leido en la Bd de contactos//
		if($rowMensaje->estatus != 'contestado' ){
			$leido = array('estatusLocal' => 'leido',);
			$this->db->where('contactoID', $mensajeID);
			$this->db->update('contactos', $leido); 
		}
		//Vista//
		$this->layouts->milocal('mensaje-view' ,$op);
			
		endforeach;
	}
	
	function envio($usuarioID,$ofertaID)
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
         if ($user['uid'] != '') {
        
			$tipo        = 'info_'.$user['tipoUsuario'];
			$op['info']  = $this->data_model->$tipo($user['uid']);
		}
		
        //Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		//Carga menu locales//
		$op['menuLocal'] = $this->milocal_model->cargarMenuLocal();
		$op['noConf'] 		= $this->milocal_model->porConf($user['uid']);
		//Carga inbox locales//
		$op['inbox'] = $this->milocal_model->cargarInbox($user['uid']);
		//Carga menu de no publicados//
		$op['nopublicados'] = $this->ofertas_model->cargarPendientesLocal($user['uid']);
		
		$usuarioID = $this->uri->segment(3);
		$op['infoUsuario'] 		= $this->data_model->info_usuario($usuarioID);
		
		$this->layouts->milocal('envio-view' ,$op);
	}
	
	function misProductos()
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
		$op['opt'] 			= $this->data_model->cargarOptimizacion($opt);
		//Carga menu locales//
		$op['menuLocal'] 	= $this->milocal_model->cargarMenuLocal();
		$op['noConf'] 		= $this->milocal_model->porConf($user['uid']);
		//Carga los productos que tiene un local y los agrupa por rama para sacar las ramas que tiene disponibles
		$op['localRama'] 	= $this->milocal_model->productoLocalRama($user['uid']);
		$op['pendientes'] 	= $this->ofertas_model->cargarPendientes($user['uid']);
		//Carga inbox locales//
		$op['inbox'] = $this->milocal_model->cargarInbox($user['uid']);
		//Carga menu de no publicados//
		$op['nopublicados'] = $this->ofertas_model->cargarPendientesLocal($user['uid']);
		
		$url = $this->uri->uri_string(); // Genera Variable del Url
		$op['bannerSky']      = $this->data_model->cargarSkyHome($url);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js');
		
		//Vista//
		$this->layouts->milocal('misProductos-view' ,$op);
	}
	
	function noPublicados()
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
		$op['opt'] 			= $this->data_model->cargarOptimizacion($opt);
		//Carga menu locales//
		$op['menuLocal'] 	= $this->milocal_model->cargarMenuLocal();
		$op['noConf'] 		= $this->milocal_model->porConf($user['uid']);
		//Carga los productos que tiene un local y los agrupa por rama para sacar las ramas que tiene disponibles
		$op['localRama'] 	= $this->milocal_model->productoLocalRama($user['uid']);
		$op['pendientes'] 	= $this->ofertas_model->cargarPendientes($user['uid']);
		//Carga inbox locales//
		$op['inbox'] = $this->milocal_model->cargarInbox($user['uid']);
		//Carga menu de no publicados//
		$op['nopublicados'] = $this->ofertas_model->cargarPendientesLocal($user['uid']);

		
		//Vista//
		$this->layouts->milocal('noPublicados-view' ,$op);
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
		
		$infoCon = $this->milocal_model->cargarLocalInfo($user['uid']);
		//Carga menu locales//
		$op['menuLocal'] = $this->milocal_model->cargarMenuLocal();
		$op['noConf'] 		= $this->milocal_model->porConf($user['uid']);
		
		//SESSION DE REGISTRO//
		foreach($infoCon as $rowIn):
	 	$id					= $rowIn->localID;
        $emailIDEnvia 		= $rowIn->localEmail;
        $localNombre		= $rowIn->localNombre;
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
			$contactoTipo			=		$this->input->post('contactoTipo');
			$ofertaID				=		$this->input->post('ofertaID');
			$ofertaTitulo			=		$this->input->post('ofertaTit');
			$usuario				=		$this->input->post('xls');
			$emailRecibe			=		$this->input->post('er');
			$nombre					=		$this->input->post('name');
				
			//Genera Array y Inserta en la BD 
			$op = array(
				'parentID'              => $parentID, 
				'contactoComentario'    => $contactoComentario, 
				'ofertaID'              => $ofertaID, 
				'contactoTipo'          => $contactoTipo, 
				'usuarioIDEnvia'        => $id,
				'usuarioIDRecibe'       => $usuario,
				'usuarioTipo'           => 'local', 
				'contactoFecha'         => date("Y-m-d"),  /* Inserta Fecha */
				'contactoHora'          => date("H:m:s"),	/* Inserta Hora */
				);
			
			$contestaciones = $this->milocal_model->limpiarContestaciones($parentID);
			foreach($contestaciones as $row){
				//Actualiza el estado del comentario hijo//
				$contestado = array('estatusLocal' => 'contestado', 'fechaSeguimiento' => date("Y-m-d"));
				$this->db->where('contactoID', $row->contactoID);
				$this->db->update('contactos', $contestado);
			}
			
			if ($this->db->insert('contactos', $op)){
				//Actualiza el comentario como Leido en la Bd de contactos//
				$contestado = array('estatusUsuario' => 'pendiente', 'fechaSeguimiento' => date("Y-m-d"));
				$this->db->where('contactoID', $parentID);
				$this->db->update('contactos', $contestado);
				}
				
			//Manda email con contestacion//
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from('atencionaclientes@plazadelatecnologia.com', 'Comentario via | plazadelatecnologia.com');
			$this->email->to($emailRecibe);
			$this->email->bcc('mdiaz@apeplazas.com');	
			$this->email->subject('Respondieron tu pregunta por el artículo '.$ofertaTitulo.'');		
			$this->email->message('
<html>
<head>
<title>Respondieron tu pregunta por el artículo '.$ofertaTitulo.'</title>
</head>
    <body>
    <p>¡Hola! '.$nombre.'</p>
    <p>El vendedor del artí­culo '.$ofertaTitulo.' respondió tu pregunta. </p>
    <p>Para ver y contestar da <a href="http://www.plazadelatecnologia.com/usuario">click aqui... </a></p>
    <p>Estamos a tu entera disposición para cualquier duda o aclaración en atencionaclientes@plazadelatecnologia.com</p>
    </body>
</html>
');
		if($this->email->send())
				{
					redirect('mi_local/lectura/'.$parentID);
				}
	
				else
				{
					show_error($this->email->print_debugger()); /* Muestra error de envio de email */
				}
			
		}
		

	}
	
	function editar()
	{
	 	
	 	//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
				
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		//Carga los productos que tiene un local y los agrupa por rama para sacar las ramas que tiene disponibles
		$op['localRama'] = $this->milocal_model->productoLocalRama($user['uid']);
		$op['pendientes'] = $this->ofertas_model->cargarPendientes($user['uid']);
		//Carga inbox locales//
		$op['inbox'] = $this->milocal_model->cargarInbox($user['uid']);
		//Carga menu de no publicados//
		$op['nopublicados'] = $this->ofertas_model->cargarPendientesLocal($user['uid']);
		
		
		//Carga inbox locales//
		$op['inbox'] = $this->milocal_model->cargarInbox($user['uid']);
		//Carga menu locales//
		$op['menuLocal'] = $this->milocal_model->cargarMenuLocal();
		$op['noConf'] 		= $this->milocal_model->porConf($user['uid']);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/editPlace.js');
		//Vista//
		$this->layouts->milocal('tienda-view-edit' ,$op);
	}
	
	function boxBanner()
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
			'upload_path' 	=> 'assets/graphics/bannersPromocionales',
			'max_size' 		=> 5000,
			'encrypt_name' 	=> TRUE,
			'maintain_ration' => TRUE,
	   );
		
 	   $this->load->library('upload', $config);
	   $this->upload->do_upload();
	   $image_data = $this->upload->data();
	   
	   $config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => 'assets/graphics/bannersPromocionales/thumbs',
				'create_thumb' 	=>	TRUE,
				'thumb_marker'  => '' ,
				'width' => 380,
				'height' => 380,
				'maintain_ration' => TRUE,
				'encrypt_name' 	=> TRUE,
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		
		$localInfo = array('imagen'			=>	$image_data['raw_name'].$image_data['file_ext'],
						   'usuarioID'		=>	$user['uid'],
						   'bannerTipo'		=>	'Box',
						   'bannerTitulo'	=>	$user['name'],
						   'bannerStatus'	=>	'Activado',
						   'bannerEsquema'	=>	'locales'
						   );
		
		if($this->db->insert('banners',$localInfo)){
			
			redirect('mi_local/editar');
	    }
	    else{
		    echo $this->upload->display_errors();
	    }
	    
	}
	
	function leaderboardBanner()
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
			'upload_path' 	=> 'assets/graphics/bannersPromocionales',
			'max_size' 		=> 5000,
			'encrypt_name' 	=> TRUE,
			'maintain_ration' => TRUE,
	   );
		
 	   $this->load->library('upload', $config);
	   $this->upload->do_upload();
	   $image_data = $this->upload->data();
	   
	   $config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => 'assets/graphics/bannersPromocionales/thumbs',
				'create_thumb' 	=>	TRUE,
				'thumb_marker'  => '' ,
				'width' => 900,
				'height' => 900,
				'maintain_ration' => TRUE,
				'encrypt_name' 	=> TRUE,
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		
		$localInfo = array('imagen'			=>	$image_data['raw_name'].$image_data['file_ext'],
						   'usuarioID'		=>	$user['uid'],
						   'bannerTipo'		=>	'leaderBoard',
						   'bannerTitulo'	=>	$user['name'],
						   'bannerStatus'	=>	'Activado',
						   'bannerEsquema'	=>	'locales'
						   );
		
		if($this->db->insert('banners',$localInfo)){
			
			redirect('mi_local/editar');
	    }
	    else{
		    echo $this->upload->display_errors();
	    }
	    
	}
	
	function fotoPro($ofertaID,$cat)
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
			'upload_path' 	=> 'ofertasLocatarios',
			'max_size' 		=> 5000,
			'encrypt_name' 	=> TRUE,
			'maintain_ration' => TRUE,
	   );
		
 	   $this->load->library('upload', $config);
	   $this->upload->do_upload();
	   $image_data = $this->upload->data();
	   
	   $this->load->library('image_lib');
	   //[ THUMB IMAGE ]
		$img_config_0['source_image'] = $image_data['full_path'];
		$img_config_0['maintain_ratio'] = TRUE;
		$img_config_0['width'] = 90;
		$img_config_0['height'] = 90;
		$img_config_0['create_thumb'] = TRUE;
		$img_config_0['thumb_marker '] = '_thumb';
		
		//[ MAIN IMAGE ]
		$img_config_1['source_image'] = $image_data['full_path'];
		$img_config_1['maintain_ratio'] = TRUE;
		$img_config_1['width'] = 300;
		$img_config_1['height'] = 300;
		$img_config_1['create_thumb'] = FALSE;
		
		for($i=0;$i<2;$i++){
			eval("\$this->image_lib->initialize(\$img_config_".$i.");");
			$this->image_lib->resize();
		} 
		
		$ofertaID = $this->uri->segment(3);
		$ramaID = $this->uri->segment(4);
		
		$fotoOferta = array('imagen'		=>	$image_data['raw_name'].$image_data['file_ext'],
							'ofertaID'		=>	$ofertaID,);
		
		if($this->db->insert('imagenesProductos',$fotoOferta)){
			
			redirect('mi_local/editarProducto/'.$ofertaID.'/'.$ramaID.'');
	    }
	    else{
		    echo $this->upload->display_errors();
	    }
	    
	}
	
	function agregarCat($ofertaID,$ramaID)
	{
		$carateristica  = $this->input->post('cat');
		$ofertaID     	= $this->uri->segment(3);
		$ramaID     	= $this->uri->segment(4);
		
		//Genera Array y Inserta en la BD 
		$cat = array(
					'caracteristica'    => $carateristica,
					'ofertaID'    		=> $ofertaID, 
				);
				
		if ($this->db->insert('caracteristicasOferta', $cat)){
				redirect('mi_local/editarProducto/'.$ofertaID.'/'.$ramaID.'');
				}
				else{
					redirect('mi_local/loosers');
				}
	}
	
	function uploadLogo()
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
			'upload_path' 	=> 'localesLogos',
			'max_size' 		=> 5000,
			'encrypt_name' 	=> TRUE,
			'maintain_ration' => TRUE,
	   );
		
 	   $this->load->library('upload', $config);
	   $this->upload->do_upload();
	   $image_data = $this->upload->data();
	   
	   $config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => 'localesLogos/thumbs',
				'create_thumb' 	=>	TRUE,
				'thumb_marker'  => '' ,
				'width' => 200,
				'height' => 200,
				'maintain_ration' => TRUE,
				'encrypt_name' 	=> TRUE,
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		
		$localLogo= array('localLogo'		=>	$image_data['raw_name'].$image_data['file_ext'],
						   'localID'		=>	$user['uid'],
						   );
		
		$this->db->where('localID', $user['uid']); 
		$this->db->update('locatarios', $localLogo); 
		
		redirect('mi_local/editar');   
	}
	
	function borrarProducto($ofertaID,$segmento)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$segmento	= $this->uri->segment(4);
		$ofertaID 	= $this->uri->segment(3);
		$borrar		= array('ofertaStatus' =>	'Borrado',);
					   
		$this->db->where('localID', $user['uid']);
		$this->db->where('ofertaID', $ofertaID);
		$this->db->update('locatariosOfertas', $borrar); 
		
		if($this->db->affected_rows()){
				if( $segmento == 'misProductos'){
					redirect('mi_local/misProductos');
				}
				else{
					if($segmento == 'noPublicados'){
					redirect('mi_local/noPublicados');
				}
			}
			
		}
		else{
			redirect('mi_local/looser');
		}
	}
	
	function borrado($mensajeID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] 	!= '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']		= $this->data_model->$tipo($user['uid']);
		}
		
		$mensajeID 	= $this->uri->segment(3);
		$borrar = $this->milocal_model->borrado($mensajeID);
			foreach($borrar as $row){
			$borrar		= array('estatusLocal' =>	'borrado',);
			$this->db->where('parentID', $mensajeID);
			$this->db->update('contactos', $borrar); 
		}
		
		if($this->db->affected_rows()){
			redirect('mi_local');
		}
	}
	
	function enviarMensajeCompra($usuarioID,$ofertaID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$usuarioID 	= $this->uri->segment(3);
		$ofertaID 	= $this->uri->segment(4);
		
		//Genera Array y Inserta en la BD 
		$op = array(
				
				'contactoComentario'	=> $this->input->post('mensaje'),
				'contactoFecha'			=> date("Y-m-d"),  /* Inserta Fecha */
				'contactoHora'          => date("H:m:s"),	/* Inserta Hora */
				'contactoTipo'			=> 'mensajeCompra', 
				'usuarioTipo'			=> 'local', 
				'inboxStatus'			=> 'Activo',
				'ofertaID'				=> $ofertaID,
				'estatusLocal'			=> 'pendiente',
				'usuarioIDEnvia'		=> $user['uid'],
				'usuarioIDRecibe'		=> $usuarioID,
				'contactoEsquema'		=> 'pregunta',
				);
				
			if ($this->db->insert('contactos', $op)){
				 redirect('mi_local');
				}
			else{
				redirect('looser');
			}
	}
	
	function editarProducto($ofertaID,$cat)
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
		
		$ofertaID = $this->uri->segment(3);
		$cat      = $this->uri->segment(4);
		
		//Carga el javascript para jquery//
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/css/multizoom.css')
					  ->add_include('assets/js/multizoom.js')
					  ->add_include('assets/js/autoNumeric-1.7.1.min.js');
			
		$confirmada				= $this->milocal_model->verificaCompra($user['uid'], $ofertaID);
		
		if($confirmada){
			$this->session->set_flashdata('msg', '<strong class="msgSuccess">Lo sentimos, no es posible editar oferta. Ya existen compras de éste producto.</strong>');
			redirect('mi_local/misProductos');
		}
		
		else{
			$producto             = $op['producto'] = $this->ofertas_model->cargarOferta($ofertaID,$extra='');
			$op['marcas']         = $this->ofertas_model->cargarMarcasRama($cat);
			$op['ramas']          = $this->data_model->cargarRamas();
			$op['catTipo']        = $this->ofertas_model->cargarCatTipoRama($cat);
			$op['cargarRamas']    = $this->milocal_model->cargarRamas($cat);
			
			if ($producto[0]->localID  == $user['uid']){
				//Vista//
			$this->layouts->simpleLayout('productoEdit-view' ,$op);
			}
			else{
				redirect('looser');
			}
		}
	}
	
	function agregarProducto($ramaID)
	{
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$cat  = $this->uri->segment(4);
		$date = date("Y-m-d");
		$time = strtotime($date);
		$final = date("Y-m-d", strtotime("+1 month", $time));

		//Genera Array y Inserta en la BD 
		$op = array(
				'localID'				=> $user['uid'],
				'ofertaStatus'			=> 'Pendiente', 
				'ramaID'				=> $opt = $this->uri->segment(3), 
				'ofertaImagen'			=> 'sinEdicion.png', 
				'ofertaFecha'			=> date("Y-m-d"),  /* Inserta Fecha */
				'ofertaVigencia'		=> $final,
				);
				
			if ($this->db->insert('locatariosOfertas', $op)){
				$ID     = $this->ofertas_model->cargarUltimoIdOferta($user['uid']);
				$lastID = $ID[0]->ofertaID;
				 redirect('mi_local/editarProducto/'.$lastID.'/1');
				}
	}
	
	function agrRamPro()
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$ramaID   = $this->input->post('ramaID');
		$date     = date("Y-m-d");
		$time     = strtotime($date);
		$final    = date("Y-m-d", strtotime("+1 month", $time));

		//Genera Array y Inserta en la BD 
		$op = array(
				'localID'				=> $user['uid'],
				'ofertaStatus'			=> 'Pendiente', 
				'ramaID'				=> $ramaID, 
				'ofertaImagen'			=> 'sinEdicion.png', 
				'ofertaFecha'			=> date("Y-m-d"),  /* Inserta Fecha */
				'ofertaVigencia'		=> $final,
				);
				
			if ($this->db->insert('locatariosOfertas', $op)){
				$ID     = $this->ofertas_model->cargarUltimoIdOferta($user['uid']);
				$lastID = $ID[0]->ofertaID;
				redirect('mi_local/editarProducto/'.$lastID.'/'.$ramaID.'');
				}
	}
	
	function fotoMain($ofertaID,$ramaID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user			= $this->session->userdata('user');
		$op['info']		= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
	   $config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' 	=> 'ofertasLocatarios',
			'max_size' 		=> 5000,
			'encrypt_name' 	=> TRUE,
			'maintain_ration' => TRUE,
	   );
		
 	   $this->load->library('upload', $config);
	   $this->upload->do_upload();
	   $image_data = $this->upload->data();
	   
	   $this->load->library('image_lib');

		//[ THUMB IMAGE ]
		$img_config_0['source_image'] = $image_data['full_path'];
		$img_config_0['maintain_ratio'] = TRUE;
		$img_config_0['width'] = 150;
		$img_config_0['height'] = 150;
		$img_config_0['create_thumb'] = TRUE;
		$img_config_0['thumb_marker '] = '_thumb';
		
		//[ MAIN IMAGE ]
		$img_config_1['source_image'] = $image_data['full_path'];
		$img_config_1['maintain_ratio'] = TRUE;
		$img_config_1['width'] = 300;
		$img_config_1['height'] = 300;
		$img_config_1['create_thumb'] = FALSE;
		
		for($i=0;$i<2;$i++){              eval("\$this->image_lib->initialize(\$img_config_".$i.");");
		$this->image_lib->resize();
		} 
		
		$ofertaID 	= $this->uri->segment(3);
		$ramaID 	= $this->uri->segment(4);
		
		$fotoOferta = array('ofertaImagen'	=>	$image_data['raw_name'].$image_data['file_ext']);
		
		$this->db->where('ofertaID', $ofertaID);
		$this->db->where('localID', $user['uid']);
		$this->db->update('locatariosOfertas', $fotoOferta);
		
		redirect('mi_local/editarProducto/'.$ofertaID.'/'.$ramaID.'');
	    
	    
	}
	
	function ofertaBorrar($ofertaID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user			= $this->session->userdata('user');
		$op['info']		= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$ofertaID = $this->uri->segment(3);
		
		$borrar 	= 	array('ofertaStatus'=>	'Borrar');
		
		$this->db->where('ofertaID', $ofertaID);
		$this->db->where('localID', $user['uid']);
		$this->db->update('locatariosOfertas', $borrar);
		
		redirect('mi_local/editar');
	    
	    
	}
	
	function borFoPri($ofertaID,$ramaID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user			= $this->session->userdata('user');
		$op['info']		= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$ofertaID 	= 	$this->uri->segment(3);
		$ramaID   	= 	$this->uri->segment(4);
		
		$borrar 	= 	array('ofertaImagen'=>	'sinEdicion.png');
		$this->db->where('ofertaID', $ofertaID);
		$this->db->where('localID', $user['uid']);
		$this->db->update('locatariosOfertas', $borrar);
		
		$this->db->where('ofertaID', $ofertaID);
		$this->db->delete('imagenesProductos'); 
		
		redirect('mi_local/editarProducto/'.$ofertaID.'/'.$ramaID);
	    
	    
	}
	
	function publicarOferta($ofertaID,$ramaID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user			= $this->session->userdata('user');
		$op['info']		= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$ofertaID		= $this->uri->segment(3);
		$ramaID			= $this->uri->segment(4);
		$envia			= $this->input->post('envia');
		$costoEnvio		= $this->input->post('costoEnvio');
		$cantidad		= $this->input->post('cantPro');
		$precioLocal	= $this->input->post('total');
		$descPorcentaje	= $this->input->post('descuento');
		$diasEntrega	= $this->input->post('diasEntrega');
		$rama			= strtolower($this->input->post('rama'));
		
		
		$sc = $this->db->query("select * from bancos where bancoID = 1");
		foreach($sc->result() as $row){
			
			$comision 		= str_replace(",", "", $row->comisionPt);
			$precioLocal 		= str_replace(",", "", $precioLocal);
			$descuentoPesos	= ($precioLocal * $descPorcentaje) / 100;
			$precioOferta	= $precioLocal - $descuentoPesos;
			$precioOferta   = $precioOferta + $costoEnvio;
			$comisionPT 	= (($precioLocal + $costoEnvio) * $comision)/100;
			$precioOferta   = $precioOferta + $comisionPT;
			$TotalRecibiras = $precioOferta - $comisionPT;
		}
		
		
		$update	= 	array('cantidadInicial'		  => $cantidad,
						  'envio'                 => $envia,
						  'precioLocal'           => $precioLocal,
						  'costoEnvio'            => $costoEnvio,
						  'gananciaPt'            => $comisionPT,
						  'ofertaPrecio'          => $precioOferta,
						  'diasEntrega'           => $diasEntrega,
						  'descuentoPorcentaje'   => $descPorcentaje,
						  'descuentoTotal'        => $descuentoPesos,
						  'existencia'            => $cantidad,
						  'comisionPt'            => $comision.'%',
						  );
						  
			$this->db->where('ofertaID', $ofertaID);
			$this->db->where('localID', $user['uid']);
			$this->db->update('locatariosOfertas', $update);
			
		$info	= $this->ofertas_model->cargarOferta($ofertaID,$extra='');
		$titulo = url_title($info[0]->ofertaTitulo, '_');
		
		//Si encuentra que no tiene valor alguna 
		$a = ''; if(!$info[0]->ofertaTitulo)					{ $a = '<em>No contiene ningun titulo.</em>'.'</br>';}
		$b = ''; if(!$info[0]->ofertaDescripcion)				{ $b = '<em>No has escrito ninguna descripcion.</em>'.'</br>';}
		$c = ''; if(!$info[0]->ofertaPrecio)					{ $c = '<em>No has dado un precio para tu articulo.</em>'.'</br>';}
		$e = ''; if($info[0]->existencia = '0')					{ $e = '<em>Agrega la cantidad de articulos que vendes</em>'.'</br>';}
		$f = ''; if($info[0]->ofertaImagen == 'sinEdicion.png')	{ $f = '<em>No tienen ninguna imagen principal para su promoción.</em>'.'</br>';}
		$g = ''; if($ramaID = '0')								{ $g = '<em>Seleccion la rama a la que pertenece tu oferta.</em>'.'</br>';}
		
		//Imprime lo que le falta para activar
		if($a || $b || $c || $e || $f || $g){
			
			$ramaID			= $this->uri->segment(4);
			
			//abre session para mensaje de flashdata//
			$this->load->library('session');
			$this->session->set_flashdata('msg', $a.$b.$c.$e.$f.$g);
			
			$actualiza 	= 	array('ofertaStatus'=>	'No Publicado');
			$this->db->where('ofertaID', $ofertaID);
			$this->db->where('localID', $user['uid']);
			$this->db->update('locatariosOfertas', $actualiza);
			
			redirect('mi_local/editarProducto/'.$ofertaID.'/'.$ramaID);
		}
		else{
			$actualiza 	= 	array('ofertaStatus'=>	'Activo');
			$this->db->where('ofertaID', $ofertaID);
			$this->db->where('localID', $user['uid']);
			$this->db->update('locatariosOfertas', $actualiza);
			
			
			//abre session para mensaje de flashdata//
			$this->load->library('session');
			$this->session->set_flashdata('msg', '<strong class="msgSuccess">Tu oferta ha sido publicada, si quieres volver editar <a class="backWhite" href="/ptv8/mi_local/editarProducto/'.$ofertaID.'/'.$ramaID.'">click aquí</a> o regresa a tu perfil <a class="backWhite" href="/ptv8/mi_local">aquí</a></strong>');
			redirect(''.$rama.'/oferta/'.$titulo.'/'.$ofertaID.'');
		}
	}
	
	function noConfirmados()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user			= $this->session->userdata('user');
		$op['info']		= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Carga menu locales//
		$op['menuLocal'] = $this->milocal_model->cargarMenuLocal();
		$op['noConf'] 	 = $this->milocal_model->porConf($user['uid']);
				 
		$op['sinConfirmar'] = $this->milocal_model->porConf($user['uid']);
		
		//Vista//
		$this->layouts->milocal('noConfirmados-view' ,$op);
	}
	
	function infoVendido($ofertaID,$localID,$folio)
	{
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user			= $this->session->userdata('user');
		$op['info']		= array();
		
		//Carga menu de no publicados//
		$op['nopublicados'] = $this->ofertas_model->cargarPendientesLocal($user['uid']);
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}

		//Carga menu locales//
		$op['menuLocal'] = $this->milocal_model->cargarMenuLocal();
		$op['noConf'] 	 = $this->milocal_model->porConf($user['uid']);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user			= $this->session->userdata('user');
		$op['info']		= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$ofertaID		= $this->uri->segment(3);
		$op['ventas'] 	= $ventas = $this->data_model->cargarVenta($ofertaID, $user['uid'],$folio);
		
		if($ventas){
			//Vista//
			$producto		= $op['producto'] = $this->ofertas_model->cargarOferta($this->uri->segment(3),$extra='');
			$op['catTipo']	= $this->ofertas_model->cargarCatTipoRama($ventas[0]->ramaID);
				
			$this->layouts->milocal('infoVendidos-view' ,$op);
		}
		
		else{
			$this->session->set_flashdata('msg', '<strong class="msgSuccess">Esta venta ya fue confirmada o no existe en el sistema.</strong>');
			redirect('mi_local/misProductos');
		}
		
	}
	
	function confirmaFecha()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		//Carga menu locales//
		$op['menuLocal'] = $this->milocal_model->cargarMenuLocal();
		
		//validacion para identificar tipo de usuario y desglosar info
		$user			= $this->session->userdata('user');
		$op['info']		= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$ofertaID     	= $this->input->post('ofertaID');
		$numeroGuia   	= $this->input->post('numeroGuia');
		$empresaEnvio 	= $this->input->post('empresaEnvio');
		$ventaFolio		= $this->input->post('ventaFolio');
		
		//Genera Array y Inserta en la BD 
		$actualiza = array(
		'statusProducto'		=> 'enProcesoEnvio',
		'empresaEnvio'			=> $empresaEnvio,
		'numeroGuia'			=> $numeroGuia,
		'fechaConfirmacion'		=> date("Y-m-d"),  /* Inserta Fecha */
		);
		
		$this->db->where('folioCompra', $ventaFolio);
		$this->db->update('productosComprados', $actualiza);
        
        //Manda email con contestacion//
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->from('administracion@plazadelatecnologia.com', 'Confirmación un envío');
				$this->email->to('jhernandezn@apeplazas.com');
				$this->email->bcc('mdiaz@apeplazas.com');	
				$this->email->subject('Confirmación un envío locatario');		
				$this->email->message('
<html>
<head>
<title>Confirmación de envío de venta por locatario.</title>
</head>
    <body>
    <p>Folio de Venta:'.$ventaFolio.'</p>
    <p>Oferta:'.$ofertaID.'</p>
	<p>Este es una aviso de confirmación de envío de producto</p>
    </body>
</html>
');
		if($this->email->send()){
			$this->session->set_flashdata('msg', '<strong class="msgSuccessInbox">Tu venta ha sido confirmada gracias.</strong>');
			redirect('mi_local/productosVendidos');
		}			
        
	}
	
	function contrasenia()
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
         if ($user['uid'] != '') {
        
			$tipo        = 'info_'.$user['tipoUsuario'];
			$op['info']  = $this->data_model->$tipo($user['uid']);
		}
		
        //Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		//Carga menu locales//
		$op['menuLocal'] = $this->milocal_model->cargarMenuLocal();
		$op['noConf'] 		= $this->milocal_model->porConf($user['uid']);
		//Carga inbox locales//
		$op['inbox'] = $this->milocal_model->cargarInbox($user['uid']);
		//Carga menu de no publicados//
		$op['nopublicados'] = $this->ofertas_model->cargarPendientesLocal($user['uid']);
		
		$usuarioID = $this->uri->segment(3);
		$op['infoUsuario'] 		= $this->data_model->info_usuario($usuarioID);
		
		$this->layouts->milocal('contrasenia_view' ,$op);
	}

	function updatePass(){
		
		$passNow = $this->input->post('passwordNow');
		$passNew = $this->input->post('passwordNew');
		
		$user = $this->session->userdata('user');
		
		if ($passNow != '') {
			
			$pass = $this->milocal_model->passIgual($user['uid']);
			if ($pass[0]->contrasenia == md5($passNow)) {
					
				$pass = array('contrasenia' => md5($passNew));
				$this->db->where('localID', $user['uid']);
				$this->db->update('locatarios', $pass);
				
				$this->session->set_flashdata('msg','<div class="msg">Actualización realizada con éxito.</div>');
			}else{
				$this->session->set_flashdata('msg','<div class="msg">Contraseña incorrecta.</div>');
			}
		}

		redirect('mi_local/contrasenia');
	}
	
	function salir()
	{
		$this->session->sess_destroy();
		redirect();	
	}
	
}