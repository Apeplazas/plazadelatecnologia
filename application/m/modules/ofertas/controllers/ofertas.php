<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ofertas extends MX_Controller {
	
	function ofertas()
	{
		parent::__construct();	
		$this->load->model('inicio/data_model');
		$this->load->model('inicio/ofertas_model');
	}

	function index()
	{
		$order = '';
	  	if($_POST){
			switch ($this->input->post('order')) {
				case 'precio':
					$order = 'lo.ofertaPrecio ASC';
					break;
				
				case'titulo':
					$order = 'lo.ofertaTitulo ASC';
					break;
				case'marca':
					$order = 'lo.marcaID ASC';
					break;
			}
		}else{
			$order = 'RAND()';
	 	}
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
		
		$ofertaTipo = 'Oferta';
		$marca = $this->uri->segment(2);
		$rama = $this->uri->segment(3);
				
		$op['order'] = $this->input->post('order');
		$op['hidden'] = '';
		$op['productos'] = $this->ofertas_model->cargarOfertasTodas($ofertaTipo, $marca,$rama, $order);
		$op['marcas'] = $this->ofertas_model->marcasDinamica($ofertaTipo, $rama);
		$op['ramas'] = $this->ofertas_model->ramasDinamica($ofertaTipo, $marca);
		//$op['caracteristicas'] = $this->ofertas_model->caractTitulo($op['productos'][0]->ramaID);
		
		//Vista//
		$this->layouts->index('busquedaProducto-view' ,$op);
	}

	function redirect()
	{
		//Despliega informacion solo del usuario que logeo//
        $userprofile  	= $this->session->userdata('userRegistration');
		$id 			= $userprofile['id'];
        $op['info'] 	= $this->muro_model->cargarInfoAdministrador($id);
		
		$tit_post = $this->uri->segment(2);
		
		$q = $this->data_model->cargarInfoOfertas($tit_post);
		
		if( $q > 0 )
		{
			foreach ($q as $row)
			{
				$catUrl	  		= $row->categoriaUrl;	
				$ofertaTitulo 	= url_title(strtolower(trim($row->ofertaTitulo)),'_');
			}
		}
		
		redirect('ofertas/'.$catUrl.'/'.$ofertaTitulo.'/'.$tit_post);
	}
	
	function busqueda()
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
		$extras = "AND lo.ofertaStatus = 'Activo'
        		   AND lo.costoEnvio > 0 
           		   AND lo.ofertaPrecio != 0";
		
		$op['producto'] 			= $producto = $this->ofertas_model->cargarOferta($this->uri->segment(4), $extras);
		$op['caracteristicas']    	= $this->ofertas_model->cargarOfertaCaract($this->uri->segment(4));
		$op['presentacion']       	= $this->ofertas_model->cargarOfertaPresen($this->uri->segment(4));
		$op['comentarios']        	= $this->ofertas_model->cargarComentarios($this->uri->segment(4));
		/*
		$ofertaID = $op['producto'][0]->ofertaID;
		//valida si hay cookie de historial de busquedas, de lo contrario la crea.
		if (!isset($_COOKIE['historial_busqueda'])) {
			
			setcookie('historial_busqueda', $ofertaID, time() + (60 * 60 * 24 * 365), '/');
			
		}else{
			$productos = $_COOKIE['historial_busqueda'];
			$productos .= $ofertaID;
			setcookie("historial_busqueda", "", time()-3600);
			setcookie('historial_busqueda', $productos, time() + (60 * 60 * 24 * 365), '/'); 
			 
		}*/		
		$this->layouts->add_include('assets/css/multizoom.css')
					  ->add_include('assets/js/multizoom.js');
		
		if (count($producto) > 0 ) {
			//Vista//
			$this->layouts->mobileSencillo('inicio/producto-view' ,$op);
		}else{
			redirect($this->uri->segment(1));
		}
	}
	
	function computo($variable,$otra){
		redirect('computadoras');
	}
}
