<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gracias extends MX_Controller {
	
	function gracias()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
	}
	
	function solicitudLocal()
	{
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
		$this->layouts->index('gracias-solicitudLocal-view' ,$op);
	}
	
	function contacto()
	{
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
		$this->layouts->index('gracias-contacto-view' ,$op);
	}
	
	function clientedistinguido()
	{
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
		$this->layouts->index('clientedistinguido-view' ,$op);
	}
	
	function cupon()
	{
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
		$this->layouts->index('gracias-cupon-view' ,$op);
	}
	
	function recuperarContrasenia()
	{
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
		$this->layouts->index('recuperarContrasenia-view' ,$op);
	}
	
	function visa_mastercard()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		$op['tipo']    		= 'Dinero Mail';
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		$this->dineroMail_confirmacion($tipoPago = 'Visa ó MasterCard');
		$this->load->library('cart');
		$this->cart->destroy();
		//Vista//
		$this->layouts->index('gracias-venta-view' ,$op);
	}
	
	function americanexpress()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		$op['tipo']    		= 'Dinero Mail';
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		$this->dineroMail_confirmacion($tipoPago = 'American Express');
		$this->load->library('cart');
		$this->cart->destroy();
		//Vista//
		$this->layouts->index('gracias-venta-view' ,$op);
	}
	
	function oxxo_y_7eleven()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		$op['tipo']    		= 'Dinero Mail';
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		$this->dineroMail_confirmacion($tipoPago = 'Oxxo o Seven Eleven');
		$this->load->library('cart');
		$this->cart->destroy();
		//Vista//
		$this->layouts->index('gracias-venta-view' ,$op);
	}
	
	function suscripcion()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		$op['tipo']    		= 'Dinero Mail';
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Vista//
		$this->layouts->index('suscripcion-view' ,$op);
	}

	function dineroMail_confirmacion($tipoPago){
		
		//Genera email para el cliente con detalle de cuenta y numero de cuenta para realizar deposito
		$this-> email->set_newline("\r\n");
		$this-> email->from('contacto@plazadelatecnologia.com', 'Plaza de la Tecnología');
		$this->email->to('jhernandezn@apeplazas.com'); 
		$list = array('rjuarez@apeplazas.com','contacto@plazadelatecnologia.com','mdiaz@apeplazas.com');
		$this-> email->bcc($list);
		$this-> email->subject('Pago en '.$tipoPago.' de Plaza de la Tecnología');
		$body = '
<html>
	<head>
	<title>Nota de compra de Plaza de la Tecnología</title>
	<style>
	html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,font,img,ins,kbd,q,s,samp,small,strike,sub,sup,tt,var,b,u,i,center,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody, .filters ul li p{margin:0;padding:0;border:0;outline:0;vertical-align:baseline; background:transparent; line-height:normal; font-size:99%; font-weight:normal;}
body{font-family:Helvetica; font-size:.8em; overflow-x:hidden;}
img{color:#fff;}
th{background:#;}
ol,ul,li{list-style:none;}
blockquote,q{quotes:none;}
ins{text-decoration:none;}
del{text-decoration:line-through;}
table{border-collapse:collapse;border-spacing:0;}
em{font-style:normal;}
a{text-decoration:none; color:#555;}
a:hover{color:#58902F;}
p{font-weight: 100;}
th{background-color:#F3F3F3;}
	</style>
	</head>
	<body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="#fff" height="100%" width="100%">
		<img src="http://www.plazadelatecnologia.com/assets/graphics/logo-plazadelatecnologia-color.png" />
		<p id="datosCliente">
		<strong>Compraron con '.$tipoPago.'</strong>
		<br>
		<br>
		
		
		<br class="clear">
	</body>
</html>';
	
			$this->email->message($body);
			$this->email->send();
			$this->load->library('cart');
			$this->cart->destroy();
			
			return TRUE;
	}
}