<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Arrendador extends MX_Controller {
	
	function arrendador()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
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
		
		$op['ciudades'] = $this->data_model->cargarCiudades();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->blog('vendesorentas-view' ,$op);
	}
	
	function guardarDatos(){
		
		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('privacidad', 'Aviso de privacidad', 'required');
		$this->form_validation->set_rules('googleMaps', 'Google Maps', 'required');
		
		$tipo		= $this->input->post('tipo');
		$googleMaps = $this->input->post('googleMaps');
		$usoSuelo 	= $this->input->post('usoSuelo');
		
		if ($this->form_validation->run() == FALSE || sizeof($_FILES['fotosInterior']['name']) <= 0 || sizeof($_FILES['fotosExterior']['name']) <= 0){
			
			$this->session->set_flashdata("error_message","Favor de ingresar los campos obligatorios");
			redirect('arrendador');
			
		}else{
			
			$fotosInternas 	= array();
			$fotosExterior 	= array();
			$planos			= array();

			//Insertar fotos del interior
			foreach( $_FILES['fotosInterior']['name'] as $key => $val ){
					
				$autorizados    = array('jpg','png','gif');
				$archivoNombre  = $_FILES['fotosInterior']['name'][$key];
				$archivoTipo    = $_FILES['fotosInterior']['type'][$key];
				$tamano         = $_FILES['fotosInterior']['size'][$key];
						
				$ext = pathinfo($archivoNombre, PATHINFO_EXTENSION);
						
				if(in_array($ext,$autorizados) ) {
					
			   		$fotosInternas[] = array(
			   			'nombre'	=> $archivoNombre,
						'tmp'		=> $_FILES['fotosInterior']['tmp_name'][$key]);
						
				}else{
					
					$this->session->set_flashdata('error_message','La imagen para los interiores es de un tipo NO permitido, las extensiones validas son jpg, png, gif.</div>');
					redirect('arrendador');
					
				}	
			}
			
			//Insertar fotos del exterior
			foreach( $_FILES['fotosExterior']['name'] as $key => $val ){
					
				$autorizados    = array('jpg','png','gif');
				$archivoNombre  = $_FILES['fotosExterior']['name'][$key];
				$archivoTipo    = $_FILES['fotosExterior']['type'][$key];
				$tamano         = $_FILES['fotosExterior']['size'][$key];
						
				$ext = pathinfo($archivoNombre, PATHINFO_EXTENSION);
						
				if(in_array($ext,$autorizados) ) {
					
			   		$fotosExterior[] = array(
			   			'nombre'	=> $archivoNombre,
						'tmp'		=> $_FILES['fotosExterior']['tmp_name'][$key]
					);
						
				}else{
					
					$this->session->set_flashdata('error_message','La imagen para los exteriores es de un tipo NO permitido, las extensiones validas son jpg, png, gif.</div>');
					redirect('arrendador');
					
				}	
			}
			
			//Insertar planos
			if(sizeof($_FILES['planos']['name']) > 0 && !empty($_FILES['planos']['name'][0])){
				foreach( $_FILES['planos']['name'] as $key => $val ){
						
					$autorizados    = array('jpg','png','gif');
					$archivoNombre  = $_FILES['planos']['name'][$key];
					$archivoTipo    = $_FILES['planos']['type'][$key];
					$tamano         = $_FILES['planos']['size'][$key];
							
					$ext = pathinfo($archivoNombre, PATHINFO_EXTENSION);
							
					if(in_array($ext,$autorizados) ) {
						
				   		$planos[] = array(
				   			'nombre'	=> $archivoNombre,
				   			'tmp'		=> $_FILES['planos']['tmp_name'][$key]
						);
							
					}else{
						
						$this->session->set_flashdata('error_message','Tu archivo para los planos es de un tipo NO permitido, las extensiones validas son jpg, png, gif.</div>');
						redirect('arrendador');
						
					}	
				}
			}
			
			$info = array(
				'tipo'       		=> $tipo,
				'coordenadasGoogle'	=> $googleMaps,
				'usoSuelo'       	=> $usoSuelo			
			);
			$this->db->insert('arrendadores', $info);
			$arrendador_id = $this->db->insert_id();
			
			foreach($fotosInternas as $val){
				move_uploaded_file($val['tmp'],DIRFOTOSINTERNAS.$val['nombre']);
				$info = array(
					'arrendadorId'	=> $arrendador_id,
					'nombreArchivo'	=> $val['nombre'],
					'tipoArchivo'	=> 'fotoInterna'		
				);
				$this->db->insert('arrendadoresArchivos', $info);	
			}
			
			foreach($fotosExterior as $val){
				move_uploaded_file($val['tmp'],DIRFOTOSEXTERNAS.$val['nombre']);
				$info = array(
					'arrendadorId'	=> $arrendador_id,
					'nombreArchivo'	=> $val['nombre'],
					'tipoArchivo'	=> 'fotoExterior'		
				);
				$this->db->insert('arrendadoresArchivos', $info);	
			}

			if(!empty($planos)){
				foreach($planos as $val){
					move_uploaded_file($val['tmp'],DIRPLANOS.$val['nombre']);
					$info = array(
						'arrendadorId'	=> $arrendador_id,
						'nombreArchivo'	=> $val['nombre'],
						'tipoArchivo'	=> 'plano'		
					);
					$this->db->insert('arrendadoresArchivos', $info);	
				}
			}
			
			redirect('gracias/contacto');
			
		}
		
	}
	
}