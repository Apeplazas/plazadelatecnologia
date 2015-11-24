<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buenfin extends MX_Controller {
	
	function buenfin()
	{
		parent::__construct();	
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas_model');
	}

	function index()
	{
		
		$this->layouts->add_include('assets/js/bjqs-1.3.min.js');
		
		$order = 'RAND()';
		
		//echo $plaza = $this->input->post('plaza');
	  	if($_POST){
			$plaza = $this->input->post('plaza');
		}elseif($this->input->post('plaza') == 'Selecciona una opcion '){
			$plaza = 'MEXICO';
	 	}else{
	 		$plaza = 'MEXICO';
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
		//$marca = $this->uri->segment(2);
		
		//$rama = $this->uri->segment(3);
		$rama = '';
		
		$url = $this->uri->uri_string(); // Genera Variable del Url
		$op['bannerSky']    = $this->data_model->cargarSkyHome($url);
		$op['slider']    = $this->data_model->cargarSlider($url);
		$op['bannerLead']   = $this->data_model->cargarLead($url);
		$op['bannerBox']    = $this->data_model->cargarBoxBanner($url);
		$op['bannerLeadFoot']    = $this->data_model->cargarLeadFoot($url);
		
		$op['order'] = $this->input->post('plaza');
		$op['hidden'] = '';
		#$op['productos'] = $this->ofertas_model->cargarOfertasTodas($ofertaTipo, $marca,$rama, $order);
		//$plaza = '';
		if($plaza != ''){
			$op['productos'] = $this->ofertas_model->cargarOfertasPlaza($plaza);
		}else{
			$op['productos'] = $this->ofertas_model->cargarOfertasTodas();
		}
		$op['masofertas'] = $this->ofertas_model->cargarOfertasTodas();
		
		$op['plaza'] = $plaza;
		//$op['marcas'] = $this->ofertas_model->marcasDinamica($ofertaTipo, $rama);
		//$op['ramas'] = $this->ofertas_model->ramasDinamica($ofertaTipo, $marca);
		//$op['caracteristicas'] = $this->ofertas_model->caractTitulo($op['productos'][0]->ramaID);
		$op['ofertaImagen'] = '';
		$this->layouts->add_include('assets/css/bfstyle.css')
					  ->add_include('assets/bootstrap/css/bootstrap.css')
					  ->add_include('assets/bootstrap/css/buenfin.css')
					  ->add_include('assets/js/bjqs-1.3.min.js')
					  ->add_include('assets/bootstrap/js/bootstrap.min.js');
		//Vista//
		//$this->layouts->simpleLayout('busquedaProducto-view', $op);
		$this->layouts->simpleLayout('busqprod-view', $op);
	}

	function index_($plaza)
	{
		
		$this->layouts->add_include('assets/js/bjqs-1.3.min.js');
		
		$order = 'RAND()';
	  	
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
		//$marca = $this->uri->segment(2);
		
		//$rama = $this->uri->segment(3);
		$rama = '';
		
		$url = $this->uri->uri_string(); // Genera Variable del Url
		$op['bannerSky']    = $this->data_model->cargarSkyHome($url);
		$op['slider']    = $this->data_model->cargarSlider($url);
		$op['bannerLead']   = $this->data_model->cargarLead($url);
		$op['bannerBox']    = $this->data_model->cargarBoxBanner($url);
		$op['bannerLeadFoot']    = $this->data_model->cargarLeadFoot($url);
		
		$op['order'] = $this->input->post('plaza');
		$op['hidden'] = '';
		#$op['productos'] = $this->ofertas_model->cargarOfertasTodas($ofertaTipo, $marca,$rama, $order);
		//$plaza = '';
		if($plaza != ''){
			$op['productos'] = $this->ofertas_model->cargarOfertasPlaza($plaza);
		}else{
			$op['productos'] = $this->ofertas_model->cargarOfertasTodas();
		}
		$op['masofertas'] = $this->ofertas_model->cargarOfertasTodas();
		
		$op['plaza'] = $plaza;
		//$op['marcas'] = $this->ofertas_model->marcasDinamica($ofertaTipo, $rama);
		//$op['ramas'] = $this->ofertas_model->ramasDinamica($ofertaTipo, $marca);
		//$op['caracteristicas'] = $this->ofertas_model->caractTitulo($op['productos'][0]->ramaID);
		$op['ofertaImagen'] = '';
		$this->layouts->add_include('assets/css/bfstyle.css')
					  ->add_include('assets/bootstrap/css/bootstrap.css')
					  ->add_include('assets/bootstrap/css/buenfin.css')
					  ->add_include('assets/js/bjqs-1.3.min.js')
					  ->add_include('assets/bootstrap/js/bootstrap.min.js');
		//Vista//
		//$this->layouts->simpleLayout('busquedaProducto-view', $op);
		$this->layouts->simpleLayout('busqprod-view', $op);
	}

	function plazas(){
		$plaza = $this->uri->segment(3);
		//echo $plaza;
		
		$this->index_($plaza);
		
	}
	
	function gracias(){
		$usuario = $this->input->post('nombre');
		$correo = $this->input->post('email');
		
		$query = $this->ofertas_model->insertaUsuarios($usuario, $correo);
		
		if(count($query) > 0){
			redirect('gracias/cupon');
		}else{
			redirect('buenfin');
		}
		redirect('buenfin');
		
	}
	
	
	function send_email(){
		
		$email = $this->input->post('email');
		$nombre = $this->input->post('nombre');
		$art = $this->input->post('art');
		$detArt = $this->ofertas_model->detalleArt($art);
		//print_r($detArt);
		foreach($detArt as $det){
			$datos[] = $det;
			
		}
		
		/*print_r($datos);
		echo $datos[0]->id;
		echo $datos[0]->nombreCte;*/
		//var_dump($datos);
		
		//Genera email para el cliente con detalle de cuenta y numero de cuenta para realizar deposito
		$this->email->set_newline("\r\n");
		$this->email->from('contacto@plazadelatecnologia.com', 'Plaza de la Tecnología');
		$this->email->to("$email"); 
		$this->email->subject('Cupón de Plaza de la Tecnología');
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<style>
					@charset "utf-8";
						/* CSS Document */
						body {margin:0;padding:0;}
						#cupon{display: block;float: left;width: 760px;padding: 20px;background-image: url(img/bg01.jpg);background-repeat: no-repeat;font-family: "Roboto Condensed", sans-serif;border: 1px solid #ccc;}
						#cuponx{display: block;float: left;width: 100%;border: 1px dashed #000;padding-bottom: 20px;}
						#cupon01{display: block;float: left;width: 100%;margin-bottom: 20px;}
						#central{display:block;float:left;width:100%;margin-bottom:20px;}
						#cupon02{display: block;float: left;width: 280px;padding-left: 28px;margin-right: 30px;}
						#cupon02_tit{display: block;float: left;width: 100%;font-size: 25px;color: #E74692;margin-bottom: 10px;line-height: 34px;min-height: 80px;}
						#cupon02_empresa{display: block;float: left;width: 100%;font-size: 21px;margin-bottom: 10px;min-height:40px;}  
						#cupon02_descripcion{display: block;float: left;width: 100%;font-size: 18px;margin-bottom: 10px;color:#999;min-height:50px;}
						#cupon03{display: block;float: left;width: 325px;}
						#cupon03_img{display: block;float: left;width: 100%;margin-bottom: 20px; max-width:300px}
						.cupon03_img{display:block;float:left;vertical-align: bottom;}
						#cupon03_precio{display: block;float: left;width: 70%;background-image: url(img/etiqueta.jpg);height: 64px;background-repeat: no-repeat;margin-left: 50px;}
						.cupon03_precio{display: block;float: left;font-size: 36px;color: #000;width: 100%;text-align: center;margin-top: 10px;font-weight: bold;}
						#cupon04{width:100%;float:left;display:block;}
						#cupon04_barras{display:block;width:538px;margin:0px 28px;}
					</style>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet" type="text/css">
					<link rel="stylesheet" href="css.css" type="text/css" media="all" />
					<title>Untitled Document</title>
					</head>
					<body>
					<DIV ID="cupon">
					   <DIV ID="cuponx">
					        <div id="cupon01"><img src="'.base_url().'/assets/graphics/BF2015/img02.jpg" width="650" height="142" /></div>
					        <div id="central">
					        	<table>
					        	<tr>
					        		<td>
					        			<div id="cupon02" style="max-width: 256px;">
						        			<div id="cupon02_tit">'.$datos[0]->ofertaTitulo.'</div>
								          	<div id="cupon02_empresa">'.$datos[0]->nombreCte.'</div>
								          	<div id="cupon02_descripcion">'.$datos[0]->ofertaDescripcion.'</div>
								          	<div id="cupon02_descripcion">Plaza: '.$datos[0]->plaza.'</div>
							          	</div>
							         </td>
					        		<td>
								        <div id="cupon03">
								         <div id="cupon03_img" style="margin-left: 140px;">
								         <img src="'.base_url().'/assets/graphics/BF2015/'.$datos[0]->id.'.jpg" width="" height="160" class="cupon03_img" />
								         </div>
								         <div id="cupon03_precio" style="margin-left: 140px;padding: 10px;font-size: -webkit-xxx-large;">
								          <span class="cupon03_precio">$'.number_format($datos[0]->precio).'</span>
								         </div>
								         <p>Imprime este cupón y haz válido tu descuento</p>
								        </div>
									</td>
								</tr>
								</table>
					        </div>
					   <div id="cupon04">
					     <div id="cupon04_barras">
					   <img src="'.base_url().'/assets/graphics/BF2015/img03.jpg" width="538" height="141"/>
					      </div>
					   </div>
					   </DIV>
					 </DIV>
					</body>
					</html>';
	
			$this->email->message($body);
			$enviado = $this->email->send();
		redirect('gracias/cupon');
	}
	
	function redirect()
	{
		redirect('buenfin');
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

	function caracteristicas(){
		
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		$art = $this->uri->segment(3);
		$op['producto'] 			= $producto = $this->ofertas_model->cargarDatoProd($art);//($this->uri->segment(3));/*tomamos el datos del producto del segmento*/
		$op['caracteristicas']    	= $this->ofertas_model->cargarOfertaCaract($this->uri->segment(4));
		$op['presentacion']       	= $this->ofertas_model->cargarOfertaPresen($this->uri->segment(4));
		$op['comentarios']        	= $this->ofertas_model->cargarComentarios($this->uri->segment(4));
		
		$op['productosRecomendados'] = $this->ofertas_model->cargarOfertasCat($this->uri->segment(1),'RAND()');
		/*$op['productosRecomendados'] = $this->ofertas_model->cargarOfertasCat($plaza,'RAND()');*/
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		//$ofertaID = $op['producto'][0]->ofertaID;
		//valida si hay cookie de historial de busquedas, de lo contrario la crea.
		/*if (!isset($_COOKIE['historial_busqueda'])) {
			
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
					  ->add_include('assets/css/touchcarousel.css')
					  ->add_include('assets/css/bfstyle.css');
					  
		$this->layouts->simpleLayout('producto-view', $op);
		//echo "caracteristicas";
	}

}
