<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ofertas extends MX_Controller {
	
	function ofertas()
	{
		parent::__construct();	
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas_model');
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
		
		$url = $this->uri->uri_string(); // Genera Variable del Url
		$op['bannerSky']    = $this->data_model->cargarSkyHome($url);
		$op['slider']    = $this->data_model->cargarSlider($url);
		$op['bannerLead']   = $this->data_model->cargarLead($url);
		$op['bannerBox']    = $this->data_model->cargarBoxBanner($url);
		$op['bannerLeadFoot']    = $this->data_model->cargarLeadFoot($url);
		
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
		
		$op['productosRecomendados'] = $this->ofertas_model->cargarOfertasCat($this->uri->segment(1),'RAND()');
		
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
					  ->add_include('assets/js/multizoom.js')
					  ->add_include('assets/js/jquery.touchcarousel-1.2.min.js')
					  ->add_include('assets/css/touchcarousel.css');
		
		if (count($producto) > 0 ) {
			//Vista//
			$this->layouts->index('producto-view' ,$op);
		}else{
			redirect($this->uri->segment(1));
		}
	}
	
	function computo($variable,$otra){
		redirect('computadoras');
	}

	function adroll()
	{
		$producto = $this->ofertas_model->ofertasAdRoll();
		
		$xml = '<?xml version="1.0" encoding="utf-8"?>
				<rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
				<channel>
					<title>Plaza de la Tecnología</title>
					<link>http://www.plazadelatecnologia.com</link>
					<description>Compra desde el portal de Plaza de la Tecnología. Encuentra  computadoras, laptops, tablets, impresoras a los precios más baratos del mercado en México.</description>';
		foreach ($producto as $oferta) {
			$xml .= '<product>
						<title><![CDATA['.$oferta->ofertaTitulo.']]></title>
						<product_type>'.$oferta->ramaNombre.'</product_type>
						<description><![CDATA['.$oferta->ofertaDescripcion.']]></description>
						<link>http://www.plazadelatecnologia.com/'.strtolower($oferta->ramaNombre).'/oferta/'.url_title(trim($oferta->ofertaTitulo), '_').'/'.$oferta->ofertaID.'</link>
						<id>'.$oferta->ofertaID.'</id>
						<image_link>http://www.plazadelatecnologia.com/ofertasLocatarios/'.$oferta->ofertaImagen.'</image_link>
						<price>$'.$oferta->ofertaPrecio.'</price>
					 </product>';
		}			
		
		$xml .= '</channel>
					 </rss>';
		header('Content-Type: text/xml'); 
		echo $xml;	
	}

}
