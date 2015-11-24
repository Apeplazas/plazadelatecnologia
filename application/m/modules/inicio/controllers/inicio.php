<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends MX_Controller {
	
	function inicio()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('inicio/ofertas_model');
	}
	
	function index()
	{
		$url = $this->uri->uri_string(); // Genera Variable del Url
		$op['slider']         = $this->data_model->cargarSlider($url);
		//Muestra las campañas que se corren durante el mes y ofertas de esas campañas//
        $op['campanias']    = $this->data_model->cargarCampanias();
        	
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/idangerous.swiper-2.1.min.js')
					  ->add_include('assets/css/idangerous.swiper.css')
					  ->add_include('assets/css/bfstyle.css');
					  
		//Vista//
		$this->layouts->mobile('inicio-mobile-view', $op);
	}
	
	function gracias_cupon(){
		$usuario = $this->input->post('nombre');
		$correo = $this->input->post('email');
		
		$query = $this->data_model->insertaUsuarios($usuario, $correo);
		
		if($query > 0){
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
		$this->layouts->mobile('gracias-cupon-view' ,$op);
		}else{
			redirect('inicio');
		}
		//var_dump($query);
		
		/*if(count($query) > 0){
			redirect('gracias/cupon');
		}else{
			redirect('buenfin');
		}
		redirect('buenfin');*/
		
	}
	
	
	function busqueda_rapida()
	{
		//Iniciar variables
		$order 	= '';
	  	
	  	if($this->input->post('order')){
	  		$key = $this->input->post('keyhide');
	  		
	  		switch ($this->input->post('order')) {
				case 'precio':
					$order = 'lo.ofertaPrecio ASC';
					break;
				
				case'titulo':
					$order = 'lo.ofertaTitulo ASC';
					break;
				case'marca':
					$order = 'lo.marcaID DESC';
					break;
			}
			
		}else{
			$order = 'lo.marcaID DESC';
			$key 	= $this->input->post('key');
	 	}
		
		$savekey = str_replace("'", "", $this->input->post('key'));
		if($savekey != ''){
			//almacena busqueda	en la BD
			$buscar = array('busquedaTexto' => trim($savekey), 
							'busquedaFecha' => date('Y-m-d'),
							'relacion'		=> trim($this->input->post('hidden'))
			);
			
			$this->db->insert('historialBusquedas', $buscar);
		}
		
		switch (strtolower($key)) {
			case 'laptops':
				header('Location: http://m.plazadelatecnologia.com/'.$key);
				break;
			case 'computadoras':
				header('Location: http://m.plazadelatecnologia.com/'.$key);
				break;
			case 'tablets':
				header('Location: http://m.plazadelatecnologia.com/'.$key);
				break;
			case 'impresoras':
				header('Location: http://m.plazadelatecnologia.com/'.$key);
				break;
			case 'accesorios':
				header('Location: http://m.plazadelatecnologia.com/'.$key);
				break;
			case 'software':
				header('Location: http://m.plazadelatecnologia.com/'.$key);
				break;
			case 'celulares':
				header('Location: http://m.plazadelatecnologia.com/telefonia');
				break;
			case 'telefonia':
				header('Location: http://m.plazadelatecnologia.com/'.$key);
				break;
			case 'usb':
				$key = 'memoria usb';
				break;
			case 'proyectores':
				$key = 'proyector';
				break;
			case 'memoria ram':
				header('Location: http://m.plazadelatecnologia.com/accesorios/0/0/Memoria_Ram');
				break;
			case 'memoria ram':
				header('Location: http://m.plazadelatecnologia.com/accesorios/0/0/Memoria_Ram');
				break;
			case 'memorias ram':
				header('Location: http://m.plazadelatecnologia.com/accesorios/0/0/Memoria_Ram');
				break;
			case 'ram':
				header('Location: http://m.plazadelatecnologia.com/accesorios/0/0/Memoria_Ram');
				break;
			case 'psp':
				$key = 'play station portable';
				break;
			case 'tarjeta madre':
				$key = 'motherboard';
				break;
			case '':
				header('Location: http://m.plazadelatecnologia.com');
				break;
		}
		
		$op['relacionadas'] = $this->data_model->historialBusqueda($key);
				
		///Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/idangerous.swiper-2.1.min.js')
					  ->add_include('assets/css/idangerous.swiper.css');
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$op['order'] = $this->input->post('order');
		$op['hidden'] = $key;
		$op['productos'] = $productos =  $this->data_model->cargarBusquedaKey($key);
		$op['marcas'] = $this->data_model->cargaMarcasTodas();
		$op['tematica'] = '';
		$op['caracteristicas'] = '';
		
		if(count($productos) == 0){
			$op['productos'] =  $this->data_model->cargarBusquedaMarca($key);
		}
		//Vista//
		$this->layouts->mobile('generals/template-subCat-view-mobile',$op);
	}
}