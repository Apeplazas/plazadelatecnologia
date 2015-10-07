<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hobbits extends MX_Controller {
	
	function hobbits()
	{
		parent::__construct();
		$this->load->model('hobbits_model');
		$this->load->model('inicio/data_model');
		$this->load->model('carrito/carrito_model');
		$this->load->model('ofertas/ofertas_model');
		$this->is_logged_in();
	}
	
	//verifica que la sesion esta inciada para poder dar acceso a modulo
	function is_logged_in()
    {
        $is_logged_in = $this->session->userdata('admin');
        
        if(!isset($is_logged_in) || $is_logged_in != true)
        {
			redirect('acceso');
        }
    }
    
	function index()
	{
	 	//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga transacciones pagadas
		$op['pagadas'] 	= $this->hobbits_model->cargarPagadas();
		//Carga transacciones pagadas
		$op['pagadas'] 	= $this->hobbits_model->cargarPagadas();
		$op['infoLocales'] 	= $this->hobbits_model->infoLocales();
		$op['localesActivos'] 	= $this->hobbits_model->localesActivos();
		$op['localesenlinea'] 	= $this->hobbits_model->solicitudLocalesenlinea();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js')
					  ->add_include('assets/css/jquery-ui.css');
		
		//Vista//
		$this->layouts->admin('hobbit-view' ,$op);
	}
	
	function campanias()
	{
	 	//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css');
					  
		//Vista//
		$this->layouts->admin('campanias-view' ,$op);
	}
	
	function agregaCampanias()
	{
		//Genera array para insertar los datos del usuario con cargo de envio
		$campania = array(
				'campaniaNombre' 	=> 'Agrega un Nombre',
			);
					
		$this-> db->insert('campanias', $campania);
					  
		redirect('hobbits/campanias');
	}
	
	function agregarPromocion()
	{
		//Genera array para insertar los datos del usuario con cargo de envio
		$publicidad = array(
				'bannerTitulo' 	=> 'Agrega un Titulo a tu Promocion',
				'bannerFecha'	=> date('Y-m-d')
			);
					
		$this-> db->insert('bannersPublicidad', $publicidad);
					  
		redirect('hobbits/bannersPromocionales');
	}

	function agregarOfertasCampania($campaniaID)
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas por ID
		$op['campania'] 	= $this->hobbits_model->cargarCampaniaID($campaniaID);
		
		$rama		= $this->uri->segment(4);
		$marca		= $this->uri->segment(5);
		$tematica	= $this->uri->segment(6);
		
		$op['ramas']      = $this->data_model->cargarRamaDisponibles();
		$op['marcas']     = $this->hobbits_model->cargaMarcas();
		$op['tematica']   = $this->hobbits_model->cargarTematicasDisponible();
		
		$op['productos']  = $this->hobbits_model->cargarBusqueda($rama,$marca,$tematica);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css');
					  
		//Vista//
		$this->layouts->admin('campaniasOfertas-view' ,$op);
	}
	
	function verOfertasCampania($campaniaID)
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas por ID
		$op['campania'] 	= $this->hobbits_model->cargarCampaniaID($campaniaID);
		
		$campaniaID	= $this->uri->segment(3);
		$rama		= $this->uri->segment(4);
		$marca		= $this->uri->segment(5);
		$tematica	= $this->uri->segment(6);
		
		$op['ramas']      = $this->data_model->cargarRamaDisponibles();
		$op['marcas']     = $this->hobbits_model->cargaMarcas();
		$op['tematica']   = $this->hobbits_model->cargarTematicasDisponible();
		
		$op['productos']  = $this->hobbits_model->cargarBusquedaCampania($campaniaID,$rama,$marca,$tematica);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css');
					  
		//Vista//
		$this->layouts->admin('campaniasOfertas-view' ,$op);
	}
	
	function segmento($ofertaTipo)
	{
		$ofertaTipo = $this->uri->segment(3);
		
		//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		
		$ofertaTipo	= $this->uri->segment(3);
		$rama		= $this->uri->segment(4);
		$marca		= $this->uri->segment(5);
		$tematica	= $this->uri->segment(6);
		
		$op['ramas']		= $this->hobbits_model->cargarRamaOfertas($ofertaTipo);
		$op['marcas']		= $this->hobbits_model->cargaMarcasOfertas($ofertaTipo);
		$op['tematica']		= $this->hobbits_model->cargarTematicasOfertas($ofertaTipo);
		$op['productos']	= $this->hobbits_model->cargarOfertas($ofertaTipo,$rama,$marca,$tematica);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css');
					  
		//Vista//
		$this->layouts->admin('ofertasSeleccion-view' ,$op);
	}
	
	function addOfertaCampania($campaniaID,$ofertaID)
	{
		$campaniaID	= $this->uri->segment(3);
		$ofertaID	= $this->uri->segment(4);
		$value 		= $_POST['update_value'];
		
		$existe		= $this->hobbits_model->checaOfertaCampania($campaniaID,$ofertaID);
		
		if ($existe)
		{
			$data 	= array('ofertaCampaniaStatus' => $value,);
				$this->db->where('ofertaID', $ofertaID);
				$this->db->where('campaniaID', $campaniaID);
				$this->db->update('ofertasCampania', $data);
				
		}
		else{
			$data 	= array('ofertaCampaniaStatus' => $value, 'campaniaID' => $campaniaID, 'ofertaID' => $ofertaID);
			$this->db->insert('ofertasCampania', $data);
		}
		
		echo $_POST['update_value'];
	}
	
	function bannerCampania($campaniaID)
	{
	   $config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' 	=> 'assets/graphics',
			'max_size' 		=> 5000,
			'encrypt_name' 	=> FALSE,
			'maintain_ration' => TRUE,
	   );
		
 	   $this->load->library('upload', $config);
	   $this->upload->do_upload();
	   $image_data = $this->upload->data();
	   
	   $this->load->library('image_lib');
		
		//[ MAIN IMAGE ]
		$img_config_1['source_image'] = $image_data['full_path'];
		$img_config_1['maintain_ratio'] = TRUE;
		$img_config_1['width'] = 890;
		$img_config_1['create_thumb'] = FALSE;
		$this->image_lib->resize();
		
		$campaniaID	= $this->uri->segment(3);
		
		$banner = array('bannerSlider'	=>	$image_data['raw_name'].$image_data['file_ext']);
		$this->db->where('campaniaID', $campaniaID);
		$this->db->update('campanias', $banner);
		
		redirect('hobbits/campanias');
	}
	
	function seleccionOfertas()
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		
		$ofertaTipo	= $this->uri->segment(3);
		$rama		= $this->uri->segment(4);
		$marca		= $this->uri->segment(5);
		$tematica	= $this->uri->segment(6);
		
		if ($ofertaTipo == '') {
			$ofertaTipo = 'Costo regular';
		}
		
		$op['ramas']		= $this->hobbits_model->cargarRamaOfertas($ofertaTipo);
		$op['marcas']		= $this->hobbits_model->cargaMarcasOfertas($ofertaTipo);
		$op['tematica']		= $this->hobbits_model->cargarTematicasOfertas($ofertaTipo);
		$op['productos']	= $this->hobbits_model->cargarOfertas($ofertaTipo,$rama,$marca,$tematica);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css');
					  
		//Vista//
		$this->layouts->admin('ofertasSeleccionForm-view' ,$op);
	}

	function seleccionLiquidacion()
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		
		$ofertaTipo	= $this->uri->segment(3);
		$rama		= $this->uri->segment(4);
		$marca		= $this->uri->segment(5);
		$tematica	= $this->uri->segment(6);
		
		if ($ofertaTipo == '') {
			$ofertaTipo = 'Costo regular';
		}
		
		$op['ramas']		= $this->hobbits_model->cargarRamaOfertas($ofertaTipo);
		$op['marcas']		= $this->hobbits_model->cargaMarcasOfertas($ofertaTipo);
		$op['tematica']		= $this->hobbits_model->cargarTematicasOfertas($ofertaTipo);
		$op['productos']	= $this->hobbits_model->cargarOfertas($ofertaTipo,$rama,$marca,$tematica);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css');
					  
		//Vista//
		$this->layouts->admin('ofertasSeleccionForm-view' ,$op);
	}
	
	function procesaOfertas()
	{
		$num = $this->input->post('numeroProductos');
		
		for ($i=1; $i <= $num; $i++) {
			$ofertaID = $this->input->post('val-'.$i); 
			if ($this->input->post($ofertaID) == TRUE) {
				
				$up = array('ofertaTipo' => $this->input->post('ofertaTipo') );
				$this->db->where('ofertaID', $ofertaID);
				$this->db->update('locatariosOfertas', $up);
			}
		}
		redirect('hobbits/segmento/'.$this->input->post('ofertaTipo'));
	}
	
	function bannersPromocionales()
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga menu locales//
		$op['menuLocal'] 		= $this->hobbits_model->cargarMenu();
		//Carga banners creados
		$op['promocionales'] 	= $this->hobbits_model->cargarBanners();
		//Carga tipos de Banners
		$op['bannerTipos'] 	= $this->hobbits_model->cargarTiposBanners();
		//Carga Enlaces
		$op['enlaces'] 	= $this->hobbits_model->cargarEnlaces();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css');
					  
		//Vista//
		$this->layouts->admin('promocionales-view' ,$op);
	}
	
	function borrarUrlBanners($publicidadID,$enlaceID){
	
		$publicidadID = $this->uri->segment(3);
		$enlaceID     = $this->uri->segment(4);
		
		$update = array('status'	=>	'borrado');
		$this->db->where('publicidadID', $publicidadID);
		$this->db->where('enlaceID', $enlaceID );
		$this->db->update('bannersUnion', $update);
		
		echo 'El segmento ha sido borrado';
	}
	
	function agregarBanner (){
			
		
	   $config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' 	=> 'assets/graphics/bannerPublicidad',
			'max_size' 		=> 5000,
			'encrypt_name' 	=> FALSE,
			'maintain_ration' => TRUE,
	   );
		
 	   $this->load->library('upload', $config);
	   $this->upload->do_upload();
	   $image_data = $this->upload->data();
	   
	   $config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => 'assets/graphics/bannerPublicidad',
				'create_thumb' 	=>	FALSE,
				'thumb_marker'  => '' ,
				'maintain_ration' => TRUE,
				'encrypt_name' 	=> TRUE,
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		
		$data 	= array(
						   'bannerImagen'	=>	$image_data['raw_name'].$image_data['file_ext'],
						   'publicidadID'	=>  $_POST['publicidadID'],			
						   'bannerTipoID'	=>	$_POST['bannerTipoID'],
						   );
		
		if($this->db->insert('bannersPublicidadUnion',$data)){
			
			redirect('hobbits/bannersPromocionales');
	    }
	    else{
		    echo $this->upload->display_errors();
	    }
	}
	
	function borrarBanner(){
		
		$bannerID 		= $this->input->post('bannerID');
		
		$this->db->where('bannerID', $bannerID );
		$this->db->delete('bannersPublicidadUnion');
		
		redirect('hobbits/bannersPromocionales');
	}
	
	function mails()
	{
	 	//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga mails
		$op['mails'] 	= $this->hobbits_model->cargarMails();
				
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css');
					  
		//Vista//
		$this->layouts->admin('mails-view' ,$op);
	}
	
	function agregaMails()
	{
		//Genera array para insertar los datos del usuario con cargo de envio
		$mails = array(
				'mailNombre' 	=> 'Agrega un Nombre',
			);
					
		$this-> db->insert('mail', $mails);
					  
		redirect('hobbits/mails');
	}

	function mailImagen($mailID)
	{
	   $config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' 	=> 'assets/graphics/mailing-graphics',
			'max_size' 		=> 5000,
			'encrypt_name' 	=> FALSE,
			'maintain_ration' => TRUE,
	   );
		
 	   $this->load->library('upload', $config);
	   $this->upload->do_upload();
	   $image_data = $this->upload->data();
	   
	   $this->load->library('image_lib');
		
		//[ MAIN IMAGE ]
		$img_config_1['source_image'] = $image_data['full_path'];
		$img_config_1['maintain_ratio'] = TRUE;
		$img_config_1['width'] = 890;
		$img_config_1['create_thumb'] = FALSE;
		$this->image_lib->resize();
		
		$mailID	= $this->uri->segment(3);
		
		$Imagen = array('mailImagen'	=>	$image_data['raw_name'].$image_data['file_ext']);
		$this->db->where('mailID', $mailID);
		$this->db->update('mail', $Imagen);
		
		redirect('hobbits/mails');
	}

	function comunicados()
	{
	 	//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga mails
		$op['comunicados'] 	= $this->hobbits_model->cargarComunicados();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css');
					  
		//Vista//
		$this->layouts->admin('comunicados-view' ,$op);
	}
	
	function agregaComunicado()
	{
		//Genera array para insertar los datos del usuario con cargo de envio
		$comunicados = array(
				'comunicadoTitulo' 	=> 'Agrega un Nombre',
			);
					
		$this-> db->insert('comunicadoMail', $comunicados);
					  
		redirect('hobbits/comunicados');
	}

	function comunicadoImagen($comunicadoID)
	{
	   $config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' 	=> 'assets/graphics/mailing-graphics',
			'max_size' 		=> 5000,
			'encrypt_name' 	=> FALSE,
			'maintain_ration' => TRUE,
	   );
		
 	   $this->load->library('upload', $config);
	   $this->upload->do_upload();
	   $image_data = $this->upload->data();
	   
	   $this->load->library('image_lib');
		
		//[ MAIN IMAGE ]
		$img_config_1['source_image'] = $image_data['full_path'];
		$img_config_1['maintain_ratio'] = TRUE;
		$img_config_1['width'] = 890;
		$img_config_1['create_thumb'] = FALSE;
		$this->image_lib->resize();
		
		$mailID	= $this->uri->segment(3);
		
		$comunicadoImagen = array('comunicadoImagen'	=>	$image_data['raw_name'].$image_data['file_ext']);
		$this->db->where('comunicadoID', $comunicadoID);
		$this->db->update('comunicadoMail', $comunicadoImagen);
		
		redirect('hobbits/comunicados');
	}
	
	function diary_mail()
	{
	 	//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga mails
		$op['mailDiario'] 	= $this->hobbits_model->cargarDiaryMail();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css');
					  
		//Vista//
		$this->layouts->admin('diary-view' ,$op);
	}
	
	function agregaMailDiario()
	{
		//Genera array para insertar los datos del usuario con cargo de envio
		$mailDiario = array(
				'mailNombre' => 'Agrega un Nombre',
				'tipoMail'	=> 'Mail Diario',
			);
					
		$this-> db->insert('mail', $mailDiario);
					  
		redirect('hobbits/diary_mail');
	}

	function intentosCompras()
	{
	 	//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga mails
		$op['intentosCompra'] 	= $this->hobbits_model->cargarIntentosCompra();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css')
					  ->add_include('assets/js/jquery.dataTables.min.js');
					  
		//Vista//
		$this->layouts->admin('intentos-view' ,$op);
	}
	
	function intentosComprasMail()
	{
	 	//$usuario = $this->uri->segment(3);
		$email = $this->hobbits_model->cargarUsuarioIntentosCompra($this->uri->segment(3));
		
		foreach ($email as $rowEmail) {
			
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('atencionaclientes@plazadelatecnologia.com', 'Atención a Clientes Plaza de la Tecnología');
		$this->email->to($rowEmail->email);
		$this->email->cc('');
		$this->email->subject('Intento de compra en Plaza de la Tecnologia');		
		
		
		$body ='<html>
		<head></head>
		<body><img src="http://www.plazadelatecnologia.com/assets/graphics/logo-plazadelatecnologia-color.png">
		<h3>Hola '.$rowEmail->usuarioNombre.'</h3>
		<p>Detectamos en nuestro sistema que has intentado hacer una compra del artículo:</p>';
		
		$productoName = $this->hobbits_model->cargarProductoIntentosCompra($this->uri->segment(3));		
		foreach ($productoName as $rowProduct) {
			$body .= '<p>'.$rowProduct->ofertaNombre.'</p>';
		}
		
		$body .='<p>¿Deseas asistencia para terminar tu transacción?<br>
		Envía un correo a <a href="mailto:atencionaclientes@plazadelatecnologia.com">atencionaclientes@plazadelatecnologia.com</a> y nosotros resolveremos tus dudas.</p>
		<br>O bien puedes contestar sobre este correo.<br>
		<p>Atentamente<br>
		<a href="http://www.plazadelatecnologia.com">www.plazadelatecnologia.com</a></p>
		</body>
		
		</html>';
		
		$this->email->message($body);
		$this->email->send();
			
		$email = array('mailIntentoCompra'  =>  'Enviado',);
				
		$this->db->where('folio',$rowEmail->producto);
		$this->db->update('compras', $email);
		}
						  
		//Vista//
		redirect('hobbits/intentosCompras');
	}
	
	function rentadelocales()
	{
	 	//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css')
					  ->add_include('assets/js/jquery.dataTables.min.js');
					  
		$op['infoLocales'] 	= $this->hobbits_model->infoLocales();
					  
		//Vista//
		$this->layouts->admin('rentadelocales-view' ,$op);
	}
	
	function borrarRentaLocal($contactoID){
	
		$id = $this->uri->segment(3);
		
		$data 	= array('statusActivo' => 'Borrado',);
				$this->db->where('contactoID', $id);
				$this->db->update('contactoRentadelocales', $data);
				redirect('hobbits/rentadelocales');
	}
	
	function buscarFecha(){
	//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		
		if (!isset($_GET['de'])) {
			$_GET['de'] = '0';
		}
		if (!isset($_GET['a'])) {
			$_GET['a'] = '0';
		}
		
		//Carga transacciones pagadas
		$op['pagadas'] 	= $this->hobbits_model->cargarPagadas();
		//Carga transacciones pagadas
		$op['pagadas'] 	= $this->hobbits_model->cargarPagadas();
		$op['infoLocales'] 	= $this->hobbits_model->infoLocalesFechas($_GET['de'],$_GET['a']);
		$op['localesActivos'] 	= $this->hobbits_model->localesActivos();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.dataTables.min.js')
					  ->add_include('assets/css/jquery-ui.css');
		
		//Vista//
		$this->layouts->admin('hobbit-fechas-view' ,$op);
	}
	
	function traspasos_exito(){
		
	 	//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga mails
		$op['traspasoSolicitud'] 	= $this->hobbits_model->solicitudTraspasos();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css')
					  ->add_include('assets/js/jquery.dataTables.min.js');
					  
		//Vista//
		$this->layouts->admin('traspasos-view' ,$op);
	}
	
	function confirmarTraspaso(){
		
		$folio = $this->uri->segment(3);
		
	 	//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga mails
		$op['traspasoSolicitud'] 	= $this->hobbits_model->solicitudTraspasos();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css')
					  ->add_include('assets/js/jquery.dataTables.min.js');
					  
		$email = $this->hobbits_model->solicitudTraspasos($this->uri->segment(3));
		
		foreach ($email as $rowEmail) 
			
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('atencionaclientes@plazadelatecnologia.com', 'Atención a Clientes Plaza de la Tecnología');
		$this->email->to($rowEmail->email);
		$this->email->cc('');
		$this->email->subject('Solicitud de traspaso');		
		
		
		$this->email->message('<html>
		<head></head>
		<body><img src="http://www.plazadelatecnologia.com/assets/graphics/logo-plazadelatecnologia-color.png">
		<h3>Hola '.$rowEmail->nombre.'</h3>
		<p>Buen día, te hacemos saber que tu solicitud de traspaso se ha realizado con exito</p>		
		<p>¿Tienes alguna duda o problema?<br>
		Envía un correo a atencionlocatarios@plazadelatecnología.com y nosotros resolveremos tus dudas.</p>
		<br>
		<p>Atentamente<br>
		<a href="http://www.plazadelatecnologia.com">www.plazadelatecnologia.com</a></p>
		</body>
		
		</html>');
		$this->email->send();
					  
		
		$productosComprados = array ('statusProducto' => 'traspasoExitoso');
					  
		$this->db->where('folioTraspaso',$folio);
		$this->db->update('productosComprados', $productosComprados);
		
		$statusSolicitudTras = array ('statusTraspaso' => 'confirmado');
		$this->db->where('folioTraspaso',$folio);
		$this->db->update('solicitudTraspasos', $statusSolicitudTras);
		
		
						  
		//Vista//
		redirect('hobbits/traspasos_exito');
		//echo 'se envio el mail a '.$rowEmail->nombre.' a su correo '.$rowEmail->email;
	}

	function peticiones_online()
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga mails
		$op['traspasoSolicitud'] 	= $this->hobbits_model->solicitudTraspasos();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css')
					  ->add_include('assets/js/jquery.dataTables.min.js');
					  
		$op['estados']	     = $this->carrito_model->estados();
		//Vista//
		$this->layouts->admin('peticiones-view' ,$op);
	}
	
	function ficha_oxxo()
	{
		//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga mails
		$op['traspasoSolicitud'] 	= $this->hobbits_model->solicitudTraspasos();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css')
					  ->add_include('assets/js/jquery.dataTables.min.js');
					  
		$op['estados']	     = $this->carrito_model->estados();
		//Vista//
		$this->layouts->admin('generaOxxo-view' ,$op);
	}
	
	function guardar_peticion()
	{
		$usuario 	= $this->input->post('usuario');
		$email 		= $this->input->post('email');
		$telefono 	= $this->input->post('telefono');
		$estado 	= $this->input->post('estado');
		$detalle 	= $this->input->post('detallePeticion');
		$plaza	 	= $this->input->post('plaza');
		$motivo 	= $this->input->post('motivo');
		date_default_timezone_set('America/Mexico_City');
		
		if($motivo == 'Renta de locales'){
			//Genera Array y Inserta en la BD 
			$op = array( 
				'nombre'				=> $_POST['usuario'],
				'email'					=> $_POST['email'],
				'estado'				=> $_POST['estado'],
				'telefono'				=> $_POST['telefono'],
				'comentario'			=> $_POST['detallePeticion'],
				'fecha'					=> date("Y-m-d"),  /* Inserta Fecha */
				'hora'					=> 	date("H:m:s"),	/* Inserta Hora */
				);
			$this->db->insert('contactoRentadelocales', $op);
			redirect('hobbits/rentadelocales');
		}
		else{
			$peticion = array('nombreUsuario'=> $usuario,
						  'emailUsuario'  => $email,
						  'telUsuario'    => $telefono,
						  'estado'        => $estado,
						  'detalle'       => $detalle,
						  'plaza'         => $plaza,
						  'motivo'        => $motivo,
						  'fechaAlta'     => date('Y-m-d'),
						  'horaAlta'      => date('H:i:s')
						  );
			$this->db->insert('peticionesLinea', $peticion);
			redirect('hobbits/historial_peticiones');
		}
		
		
		
	}

	function historial_peticiones(){
		
	 	//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga mails
		$op['historial'] 	= $this->hobbits_model->historialPeticiones();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css')
					  ->add_include('assets/js/jquery.dataTables.min.js');
					  
		//Vista//
		$this->layouts->admin('peticionesHistorial-view' ,$op);
	}
	
	function enviarMail()
	{
		$peticionID = $this->uri->segment(3);
		
		$peticion = $this->hobbits_model->infoPeticion($peticionID);
		
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('atencionaaclientes@plazadelatecnologia.com', 'Atención a Clientes Plaza de la Tecnología');
		$this->email->to($peticion[0]->emailUsuario);
		$this->email->subject('Solicitudes en Línea');		
		
		
		$body ='<html>
		<head></head>
		<body><img src="http://www.plazadelatecnologia.com/assets/graphics/logo-plazadelatecnologia-color.png">
		<h3>Hola '.$peticion[0]->nombreUsuario.'</h3>
		<p>Hola, recientemente te comunicaste cono nosotros para atender tu solicitud.</p>
		<p>Queremos saber si la información que recibiste te fue de utilidad.<br>
		Por favor contesta sobre este email, acerca de tu experiecia.</p>
		<br><br>
		<p>Tu solicitud y respuesta recibida:<br>'.
		$peticion[0]->detalle.'</p>
		<br>
		<p>Atentamente<br>
		<a href="http://www.plazadelatecnologia.com">www.plazadelatecnologia.com</a></p>
		</body>
		</html>';
		
		$this->email->message($body);
		$this->email->send();
		
		redirect('hobbits/historial_peticiones');
	}
	
	function estatusPeticion()
	{
		$estatus 	= $this->input->post('estatusP');
		$comentario = $this->input->post('comentario');
		$peticionID = $this->input->post('peticionID');
		
		$estatus = array('estatus' => $estatus,
						 'comentariosAdmin' => $comentario
		);
		
		$this->db->where('peticionID', $peticionID);
		$this->db->update('peticionesLinea', $estatus);
		
		redirect('hobbits/historial_peticiones');
	}

	function confirmar_pago_cliente(){
		
	 	//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga mails
		//$op['traspasoSolicitud'] 	= $this->hobbits_model->solicitudTraspasos();
		$op['confirmacionPago'] 	= $this->hobbits_model->confirmacionPagos();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css')
					  ->add_include('assets/js/jquery.dataTables.min.js');
					  
		//Vista//
		$this->layouts->admin('confirmacionPago-view' ,$op);
	}
	
	function confirmarCompra()
	{
	 	//$usuario = $this->uri->segment(3);
		$email = $this->hobbits_model->confirmarMailCompra($this->uri->segment(3));
		
		foreach ($email as $rowEmail) {
			
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('atencionalocatarios@plazadelatecnologia.com', 'Atención a Locatarios Plaza de la Tecnología');
		$this->email->to($rowEmail->emailLocatario);
		$this->email->cc('');
		$this->email->subject('Confirmación de Compra');		
		
		
		$body ='<html>
		<head></head>
		<body><img src="http://www.plazadelatecnologia.com/assets/graphics/logo-plazadelatecnologia-color.png">
		<h3>Hola '.$rowEmail->nombreLocal.'</h3>
		<p>Hola tienes una confirmación de pago, revisa el apartado de tus productos vendidos.</p>';
		
		$productoName = $this->hobbits_model->cargarProductoIntentosCompra($this->uri->segment(3));		
		foreach ($productoName as $rowProduct) {
			$body .= '<p>'.$rowProduct->ofertaNombre.'</p>';
		}
		
		$body .='<p>Si tienes alguna duda,<br>
		Envía un correo a atencionalocatarios@plazadelatecnología.com y nosotros podremos ayudarte.</p>
		<br>
		<p>Atentamente<br>
		<a href="http://www.plazadelatecnologia.com">www.plazadelatecnologia.com</a></p>
		</body>
		
		</html>';
		
		$this->email->message($body);
		$this->email->send();
			
		$statusProducto = array ('statusProducto' => 'pagada');
		$this->db->where('folioCompra',$this->uri->segment(3));
		$this->db->update('productosComprados', $statusProducto);
		
		$statusCompra = array ('status' => 'pagado');
		$this->db->where('folio',$this->uri->segment(3));
		$this->db->update('compras', $statusCompra);
		}
						  
		//Vista//
		redirect('hobbits/confirmar_pago_cliente');
		
	}
	
	function merchantGoogle()
	{
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css');
					  
		$rama		= $this->uri->segment(4);
		$marca		= $this->uri->segment(5);
		$tematica	= $this->uri->segment(6);
		
		$op['ramas']      = $this->data_model->cargarRamaDisponibles();
		$op['marcas']     = $this->hobbits_model->cargaMarcas();
		$op['tematica']   = $this->hobbits_model->cargarTematicasDisponible();
		
		$op['productos']  = $this->hobbits_model->cargarBusqueda($rama,$marca,$tematica);
		
		$this->layouts->admin('merchant-view-asignar',$op);
	}
	
	function merchantActivados()
	{
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css');
					  
		$rama		= $this->uri->segment(4);
		$marca		= $this->uri->segment(5);
		$tematica	= $this->uri->segment(6);
		
		$op['ramas']      = $this->data_model->cargarRamaDisponibles();
		$op['marcas']     = $this->hobbits_model->cargaMarcas();
		$op['tematica']   = $this->hobbits_model->cargarTematicasDisponible();
		
		$op['productos']  = $this->hobbits_model->cargarBusquedaMerchant($rama,$marca,$tematica);
		
		$this->layouts->admin('merchant-view',$op);
	}
	
	function busquedas()
	{
		
		//Validacion para identificar tipo de usuario y desglosar info
		$op['usuario']	=	$this->session->userdata('user');
		
		//Carga menu locales//
		$op['menuLocal'] 	= $this->hobbits_model->cargarMenu();
		//Carga campañas
		$op['campanias'] 	= $this->hobbits_model->cargarCampanias();
		//Carga mails
		$op['historial'] 	= $this->hobbits_model->historialBusq();
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery.editinplace.js')
					  ->add_include('assets/js/jquery.fancybox.pack.js')
					  ->add_include('assets/css/jquery.fancybox.css')
					  ->add_include('assets/js/jquery.dataTables.min.js');
					  
		//Vista//
		$this->layouts->admin('busquedasHistorial-view' ,$op);
	}
	
	function ingresaAccion()
	{
		$texto		= $this->input->post('texto');
		$comentario = $this->input->post('comentario');
		
		$accion = array('textoBusq' 	=> $texto,
						 'accion' 		=> $comentario,
						 'fechaAccion'	=> date('Y-m-d')
		);
		
		$this->db->insert('accionesBusquedas', $accion);
		
		redirect('hobbits/busquedas');
	}
	
	function salir()
	{
		$this->session->sess_destroy();
		redirect();	
	}
}