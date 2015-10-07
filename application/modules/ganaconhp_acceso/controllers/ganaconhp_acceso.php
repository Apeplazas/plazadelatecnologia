<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ganaconhp_acceso extends MX_Controller {
	
	function ganaconhp_acceso()
	{
		parent::__construct();
		$this->form_validation->CI = & $this;
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
		$this->load->model('gana_con_hp/hp_model');
		$this->is_logged_in();
		
	}
	
	function test (){
		
		$this->load->view('test-view');
	}
	
	function index()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/autoNumeric-1.7.1.min.js')
					  ->add_include('assets/js/jquery-datepicker.js')
					  ->add_include('assets/css/jquery-datepicker.css')
					  ->add_include('assets/css/dinamicaHp.css')
					  ->add_include('assets/css/tables.css');

		//validacion para identificar tipo de usuario y desglosar info
		$usuario			= $this->session->userdata('usuarioHP');
		$op['info']			= array();
		
		$op['ciudades']    		= $this->data_model->cargarCiudades();
		// Solicita Tickets
		$op['tickets']    		= $this->hp_model->cargaTickets($usuario['localID']);
		
		//Vista//
		$this->layouts->light('admin-view' ,$op);
	}
	
	function vistaTicket($ticketID)
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/autoNumeric-1.7.1.min.js')
					  ->add_include('assets/js/jquery-datepicker.js')
					  ->add_include('assets/css/jquery-datepicker.css')
					  ->add_include('assets/css/dinamicaHp.css')
					  ->add_include('assets/css/tables.css');

		//validacion para identificar tipo de usuario y desglosar info
		$usuario			= $this->session->userdata('usuarioHP');
		$op['info']			= array();
		
		$op['ciudades']    		= $this->data_model->cargarCiudades();
		// Solicita Tickets
		$op['tickets']    		= $this->hp_model->cargaTicketsTicket($ticketID);
		
		//Vista//
		$this->layouts->light('ticket-view' ,$op);
	}
	
	
	function tickets()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/autoNumeric-1.7.1.min.js')
					  ->add_include('assets/js/jquery-datepicker.js')
					  ->add_include('assets/js/jquery.dataTables.min.js')
					  ->add_include('assets/css/jquery-datepicker.css')
					  ->add_include('assets/css/dinamicaHp.css')
					  ->add_include('assets/css/tables.css');
					  
		//validacion para identificar tipo de usuario y desglosar info
		$usuario				= $this->session->userdata('usuarioHP');
		$op['info']			= array();
		
		$op['ciudades']    		= $this->data_model->cargarCiudades();
		// Solicita Tickets
		$op['tickets']    		= $this->hp_model->cargaTickets($usuario['localID']);
		
		//Vista//
		$this->layouts->light('tickets-view' ,$op);
	}
	
	//verifica que la sesion esta inciada para poder dar acceso a modulo
	function is_logged_in()
    {
        $userprofile = $this->session->userdata('usuarioHP');
        if(!isset($userprofile) || $userprofile != true)
        {
                    redirect('gana_con_hp');
        }
        
    }
    
    function guardarProducto($ticketID)
    {
	    //Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/autoNumeric-1.7.1.min.js')
					  ->add_include('assets/js/jquery-datepicker.js')
					  ->add_include('assets/css/jquery-datepicker.css')
					  ->add_include('assets/css/dinamicaHp.css')
					  ->add_include('assets/css/tables.css');

		//validacion para identificar tipo de usuario y desglosar info
		$usuario			= $this->session->userdata('usuarioHP');
		$op['info']			= array();
		
		$op['ciudades']    		= $this->data_model->cargarCiudades();
		// Solicita Tickets
		$op['tickets']    		= $this->hp_model->cargaTickets($usuario['localID']);
		
		//Vista//
		$this->layouts->light('guardarProducto-view' ,$op);
    }
	
	function agregarTicket(){
		
		$this->form_validation->set_rules('txtboxToFilter', 'Númerp de ticket', 'required');
		$this->form_validation->set_rules('fechaVneta', 'Fecha de venta', 'required');
		$this->form_validation->set_rules('totVe', 'Venta Total', 'required');
		
		$noTicket	= $this->input->post('txtboxToFilter');
		$fechaVenta = $this->input->post('fechaVneta');
		$totVenta	= $this->input->post('totVe');
		
		if ($this->form_validation->run() == FALSE){
			
			//Optimizacion y conexion de tags para SEO//
			$opt         		= $this->uri->segment(1);
			$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
			
			//Carga el javascript para jquery//
			$this->layouts->add_include('assets/js/autoNumeric-1.7.1.min.js')
						  ->add_include('assets/js/jquery-datepicker.js')
						  ->add_include('assets/css/jquery-datepicker.css')
						  ->add_include('assets/css/dinamicaHp.css')
						  ->add_include('assets/css/tables.css');
	
			//validacion para identificar tipo de usuario y desglosar info
			$usuario			= $this->session->userdata('usuarioHP');
			$op['info']			= array();
			
			$op['ciudades']    		= $this->data_model->cargarCiudades();
			// Solicita Tickets
			$op['tickets']    		= $this->hp_model->cargaTickets($usuario['localID']);
			
			//Vista//
			$this->layouts->light('admin-view' ,$op);
			
		}else{
			
			$datosImagen = null;
			  
			if( isset($_FILES['imagen']) && !empty($_FILES['imagen']) ){
				
				$permitidos =  array('jpeg','png','bmp','jpg','tif','gif','pdf','doc','docx');
						
				$archivoNombre	= $_FILES['imagen']['name'];
				$archivoTipo	= $_FILES['imagen']['type'];
				$tamanoH		= $_FILES['imagen']['size'];
						
				$ext = pathinfo($archivoNombre, PATHINFO_EXTENSION);			
			
				if(in_array($ext,$permitidos) ) {
							
			   		move_uploaded_file($_FILES['imagen']['tmp_name'],DIRHP.$archivoNombre);
			   		$datosImagen = $archivoNombre . $ext;
							
				}
			
			}
			
			$usuario = $this->session->userdata('usuarioHP');
				
			//Insertar Datos 
			$op = array(
				'ticketImagen'          => $datosImagen,
				'ticketNumero'          => $noTicket,
				'fechaVenta'      	    => $fechaVenta,
				'costoTicket'      	    => $totVenta,
				'localId'				=> $usuario['localID']
				);
			$this->db->insert('dinamicaTicketsHp', $op);
			$ticketID = $this->db->insert_id();
			
			redirect('ganaconhp_acceso/guardarProducto/'.$ticketID);
			
		}
		
	}

	function productosGuardar(){
		
		$productos 	= $_POST['producto'];
		$idTicket 	= $_POST['va'];
	
		foreach($productos as $key => $val){
			
			if(empty($_POST['modelo'][$key]) || empty($_POST['cantidad'][$key])){
			
				$this->session->set_flashdata('msg','<div class="msg">Favor de ingresar todos los campos.</div>');
				redirect('ganaconhp_acceso/guardarProducto/'.$_POST['va']);
				break;
				
			}
				
			$datosProductos[] = array(
				'producto'		=> $val,
				'modelo'		=> $_POST['modelo'][$key],
				'tipo'			=> $_POST['tipo'][$key],
				'cantidad'		=> $_POST['cantidad'][$key],
				'ticketID'		=> $idTicket,
				'costoUnitaro'	=> ''
			);
			
		}
			
		$this->db->insert_batch('dinamicaCatalogoProductosHp', $datosProductos);
			
		redirect('ganaconhp_acceso');
		
	}
	
	function registraTickets()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/autoNumeric-1.7.1.min.js')
					  ->add_include('assets/js/jquery-datepicker.js')
					  ->add_include('assets/css/jquery-datepicker.css')
					  ->add_include('assets/css/dinamicaHp.css')
					  ->add_include('assets/css/tables.css');
					  
		//validacion para identificar tipo de usuario y desglosar info
		$usuario				= $this->session->userdata('usuarioHP');
		$op['info']			= array();
		
		$op['ciudades']    		= $this->data_model->cargarCiudades();
		// Solicita Tickets
		$op['tickets']    		= $this->hp_model->cargaTickets($usuario['localID']);
		
		//Vista//
		$this->layouts->light('registraTickets-view' ,$op);
	}
		
}