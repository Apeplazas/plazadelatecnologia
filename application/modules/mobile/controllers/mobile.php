<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile extends MX_Controller {
	
	function mobile()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
	}
	
	function index()
	{
		//Muestra las campañas que se corren durante el mes y ofertas de esas campañas//
        $op['campanias']    = $this->data_model->cargarCampanias();
        	
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/idangerous.swiper-2.1.min.js')
					  ->add_include('assets/css/idangerous.swiper.css');
					  
		//Vista//
		$this->layouts->mobile('inicio-mobile-view', $op);
	}
}