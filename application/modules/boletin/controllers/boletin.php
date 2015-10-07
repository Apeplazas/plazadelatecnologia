<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boletin extends MX_Controller {

	function boletin()
	{
		parent::__construct();	
		$this->load->model('boletin/boletin_model');			
	}
	
	function mailing($id)
	{
		
		$op['mail'] = $this->boletin_model->cargarMailingInfo($id);
		$op['ofertasEsp'] = $this->boletin_model->cargarOfertasEsp();
		$op['categorias'] = $this->boletin_model->cargarCategorias();
		$op['banner'] = $this->boletin_model->cargarBannerMail();
		
		
		$this->load->view('mail-view', $op);
		
	}
	
	function diary($id)
	{
		
		$op['mail'] = $this->boletin_model->cargarMailingInfo($id);
		$op['ofertasEsp'] = $this->boletin_model->cargarOfertasEsp();
		$op['banner'] = $this->boletin_model->cargarBannerMail();
		$op['categorias'] = $this->boletin_model->cargarCategorias();
		
		
		$this->load->view('diaryMail-view', $op);
		
	}
	
	function comunicados($id)
	{
		
		$op['mail'] = $this->boletin_model->cargarComunicadoMail($id);
				
		$this->load->view('comunicado-view', $op);
		
	}
}

