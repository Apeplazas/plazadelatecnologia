<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Google extends MX_Controller {
	
	function google()
	{
		parent::__construct();
		$this->load->model('google/google_model');
		$this->load->model('ofertas/ofertas_model');
	}
	
	function pla()
	{
		$op['pla']	= $this->google_model->googlePla($opt);
		
		//Vista//
		$this->load->view('pla-view' ,$op);
	}
	
}