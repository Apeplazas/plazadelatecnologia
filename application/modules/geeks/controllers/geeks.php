<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Geeks extends MX_Controller {
	
	function geeks()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
	}
	
	function testmail(){
		
		$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->from('contacto@apeplazas.com', 'Reparadores.mx');
				$this->email->to("benjamin_carrera@hotmail.com");
				$this->email->subject('email del servidor de ape');		
				$this->email->message('
					<html>
						<head>
							<title>Ape</title>
						</head>
						<body>
							<p>Se esta verificando que los emails lleguen a hotmial</p>
							<p>Ape</p>
						</body>
					</html>
				');
				$this->email->send();
		
	}

	function index()
	{
		$op['order'] = $order = '';
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
		
		$ofertaTipo = '';
		$marca = $this->uri->segment(2);
		$rama = $this->uri->segment(3);
		
		$op['marcas'] = $this->ofertas_model->marcasDinamica($ofertaTipo, $rama);
		$op['ramas'] = $this->ofertas_model->ramasDinamica($ofertaTipo, $marca);
		$op['productos'] = $this->ofertas_model->cargarOfertasGeeks($marca,$rama, $order);
		
		//Vista//
		$this->layouts->index('busquedaProducto-view' ,$op);
	}

}