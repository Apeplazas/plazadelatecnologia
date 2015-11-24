<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends MX_Controller {
	
	function inicio()
	{
		parent::__construct();
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
	}
	
	function index()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		$url = $this->uri->uri_string(); // Genera Variable del Url
		$op['bannerSky']      = $this->data_model->cargarSkyHome($url);
		$op['slider']         = $this->data_model->cargarSlider($url);
		$op['bannerLead']     = $this->data_model->cargarLeadHome($url);
		$op['bannerBox']      = $this->data_model->cargarBoxBanner($url);
		$op['bannerLeadFoot'] = $this->data_model->cargarLeadFoot($url);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//validacion de cookie para historial de busqueda
		if (isset($_COOKIE['historial_busqueda'])){
			
			$productos = explode(' ', $_COOKIE['historial_busqueda']);
			$lista = '';
			foreach ($productos as $key => $value) {
				
				if (end($productos) != $value) {
					$lista .= "ofertaID = '".$value."' OR "; 
				} else {
					$lista .= " ofertaID = '".$value."'";
				}
			}
			
			$op['historialBusqueda'] = $this->data_model->cargarHistorialBusq($lista);
		}
		
        //Muestra las campañas que se corren durante el mes y ofertas de esas campañas//
        $op['campanias']    = $this->data_model->cargarCampanias();
		//Carga Ramas para busqueda de productos y limita a 1 para busqueda//
        $op['ramas']		= $this->data_model->cargarRamasLimitadas();
        $op['topProductos']	= $this->data_model->cargarTopProductos();
		
		//carga el Top 5 de locales//
		$op['topLocales'] = $this->data_model->cargarTopLocales();
		
        //Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/bjqs-1.3.min.js')
					  ->add_include('assets/js/jquery.touchcarousel-1.2.min.js')
					  ->add_include('assets/js/ytmenu.js')
					  ->add_include('assets/css/three-d-skin.css')
					  ->add_include('assets/css/touchcarousel.css')
					  ->add_include('assets/js/jquery.cookie.js')
					  ->add_include('assets/css/bfstyle.css')
					  ->add_include('assets/css/buenfin.css'); 
		
		//Vista//
		$this->layouts->index('index-view' ,$op);
	}
	
	function categorias()
	{
	 	$this->load->helper('breadcrumb');
	 	
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		$this->layouts->add_include('assets/js/jquery-ui.js');
		
		//Vista//
		$this->layouts->index('categorias-view' ,$op);
	}
		
	function vistaUsuario()
	{
	 	$this->load->helper('breadcrumb');
	 	
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		$this->layouts->add_include('assets/js/jquery-ui.js');
		
		//Vista//
		$this->layouts->index('registrate-view' ,$op);
	}
	
	
	function tienda()
	{
	 	$this->load->helper('breadcrumb');
	 	
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		$this->layouts->add_include('assets/js/jquery-ui.js');
		
		//Vista//
		$this->layouts->tienda('tienda-view' ,$op);
	}
	
	function busqueda_rapida()
	{
		//Iniciar variables
		$order 	= '';
	  	
	  	if($this->input->get('order')){
	  		$key = $this->input->get('query');
	  		
	  		switch ($this->input->get('order')) {
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
			$order = 'coincidencias DESC';
			$key 	= $this->input->get('query');
	 	}
		
		$key = strtolower($key);
		$key = str_replace("'", "", $key);
		
		if($key != ''){
			//almacena busqueda	en la BD
			$buscar = array('busquedaTexto' => trim($key), 
							'busquedaFecha' => date('Y-m-d'),
							'relacion'		=> trim($this->input->get('hidden'))
			);
			
			$this->db->insert('historialBusquedas', $buscar);
		}
		
		switch ($key) {
			case 'laptops':
				redirect($key);
				break;
			case 'computadoras':
				redirect($key);
				break;
			case 'tablets':
				redirect($key);
				break;
			case 'impresoras':
				redirect($key);
				break;
			case 'accesorios':
				redirect($key);
				break;
			case 'software':
				redirect($key);
				break;
			case 'celulares':
				redirect('telefonia');
				break;
			case 'telefonia':
				redirect($key);
				break;
			case 'usb':
				$key = 'memoria usb';
				break;
			case 'proyectores':
				$key = 'proyector';
				break;
			case 'memoria ram':
				redirect('accesorios/0/0/Memoria_Ram');
				break;
			case 'memoria ram':
				redirect('accesorios/0/0/Memoria_Ram');
				break;
			case 'memorias ram':
				redirect('accesorios/0/0/Memoria_Ram');
				break;
			case 'ram':
				redirect('accesorios/0/0/Memoria_Ram');
				break;
			case 'psp':
				$key = 'play station portable';
				break;
			case 'tarjeta madre':
				$key = 'motherboard';
				break;
			case 'discos duros':
				$key = 'disco duro';
				break;
			case 'pc armadas':
				redirect('computadoras/0/armadas');
				break;
			case 'cpu':
				redirect('computadoras/0/armadas');
				break;
			case '':
				redirect('');
				break;
		}
		
		$op['relacionadas'] = $this->data_model->historialBusqueda($key);
				
		///Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$op['order'] = $this->input->post('order');
		$op['hidden'] = $key;
		$op['productos'] = $productos =  $this->data_model->cargarBusquedaKey($key,$order);
		$op['marcas'] = $this->data_model->cargaMarcasTodas();
		$op['ramas'] = $this->data_model->cargarRamaDisponibles();
		if(count($productos) == 0){
			$op['productos'] =  $this->data_model->cargarBusquedaMarca($key);
		}
		//Vista//
		$this->layouts->index('busqueda-view' ,$op);
	}
	
	function comentario($ofertaID)
	{	
		///Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		if($user){
		
			//obtiene el identificador de la oferta
			$localID 		= 	$this->ofertas_model->cargarOferta($ofertaID, $extras= '');
			
			//Iniciar variables
			$comment 			= 	$this->input->post('comentario');
			$url 				= 	$this->input->post('url');
			$tipo 				= 	$this->input->post('tipo');
			$emailIDEnvia		= 	'Plaza de la tecnologia via | contacto@plazadelatecnologia.com';
			$emailRecibe 		=	$localID[0]->localEmail;
			
			$contactoID 		= 	$this->data_model->cargaUltimoContacto();
			$lastID 			= 	$contactoID[0]->contactoID + 1;
			
			//Genera Array y Inserta en la BD 
			$insert = array(
			'contactoComentario'	=> 	$comment,
			'contactoFecha'			=> 	date("Y-m-d"),  /* Inserta Fecha */
			'contactoHora'			=> 	date("H:m:s"),	/* Inserta Hora */
			'contactoTipo'			=> 	$tipo,	
			'usuarioTipo'			=> 	'usuario',
			'inboxStatus'			=> 	'Activo',
			'ofertaID'				=> 	$ofertaID,
			'parentID'				=>	$lastID,
			'estatusUsuario'		=>	'pendiente',
			'usuarioIDEnvia'		=>	$user['uid'],
			'usuarioIDRecibe'		=>	$localID[0]->localID,
			'contactoEsquema'		=>	'pregunta',
			);
			
			preg_match("/href|hello|http|www/", $comment, $registros);//si no hay spam permite realizar las operaciones

			if(count($registros) < 1){

			$this->db->insert('contactos', $insert);

			}
			
			//Manda email con contestacion//
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from('atencionaclientes@plazadelatecnologia.com', 'Comentario via | plazadelatecnologia.com');
			$this->email->to($emailRecibe);
			$this->email->cc('mdiaz@apeplazas.com');	
			$this->email->subject('Te hicieron una pregunta de tu artículo | '.$localID[0]->ofertaTitulo.'');
			$this->email->message('
<html>
  <head>
  <title>Hicieron una pregunta de tu artículo | '.$localID[0]->ofertaTitulo.' </title>
</head>
    <body>
    <p>¡Hola '.$localID[0]->localNombre.'!<br>
    Hicieron una pregunta de tu artículo '.$localID[0]->ofertaTitulo.'.</p>
    <p>Recuerda brindar una respuesta rápida, cordial y concisa a los interesados en tu producto. Esto te ayudará a aumentar tus ventas.</p>
    <a href="http://www.plazadelatecnologia.com/mi_local">Click aqui para contestar</a>
    </body>
</html>
');
		if($this->email->send())
				{
					redirect(base_url().$url);
				}
	
				else
				{
					show_error($this->email->print_debugger()); /* Muestra error de envio de email */
				}
			
		}
		else{
			redirect('registrate/logReg');
		}
	}
	
	function contactoLocal()
	{	
		///Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		
		if($user){
		
			//Iniciar variables
			$comment 			= 	$this->input->post('comentario');
			$localID			= 	$this->input->post('localID');
			$localNombre			= 	$this->input->post('localNombre');
			$url 				= 	$this->input->post('url');
			$tipo 				= 	'contactoDirecto';
			$emailIDEnvia		= 	'Plaza de la tecnologia via | contacto@plazadelatecnologia.com';
			$emailRecibe 		=	$this->input->post('localEmail');
			
			$contactoID 		= 	$this->data_model->cargaUltimoContacto();
			$lastID 			= 	$contactoID[0]->contactoID + 1;
			
			//Genera Array y Inserta en la BD 
			$insert = array(
			'contactoComentario'	=> 	$comment,
			'contactoFecha'			=> 	date("Y-m-d"),  /* Inserta Fecha */
			'contactoHora'			=> 	date("H:m:s"),	/* Inserta Hora */
			'contactoTipo'			=> 	$tipo,	
			'usuarioTipo'			=> 	'usuario',
			'inboxStatus'			=> 	'Activo',
			'ofertaID'				=> 	0,
			'parentID'				=>	$lastID,
			'estatusUsuario'		=>	'pendiente',
			'usuarioIDEnvia'		=>	$user['uid'],
			'usuarioIDRecibe'		=>	$localID,
			'contactoEsquema'		=>	'pregunta',
			);
			
			$this->db->insert('contactos', $insert);
			
			//Manda email con contestacion//
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from('atencionaclientes@plazadelatecnologia.com', 'Comentario via | plazadelatecnologia.com');
			$this->email->to($emailRecibe);
			$this->email->cc('mdiaz@apeplazas.com');	
			$this->email->subject('Te hicieron una pregunta en Plaza de la Tecnología.');
			$this->email->message('
<html>
  <head>
  <title>Te hicieron una pregunta. </title>
</head>
    <body>
    <p>¡Hola '.$localNombre.'!<br>
    Te han hecho pregunta en Plaza de la Tecnología.</p>
    <p>Recuerda brindar una respuesta rápida, cordial y concisa a los interesados en tus productos. Esto te ayudará a aumentar tus ventas.</p>
    <a href="http://www.plazadelatecnologia.com/mi_local">Click aqui para contestar</a>
    </body>
</html>
');
		if($this->email->send())
				{
					redirect(base_url().$url);
				}
	
				else
				{
					show_error($this->email->print_debugger()); /* Muestra error de envio de email */
				}
			
		}
		else{
			redirect('registrate/logReg');
		}
	}

	function cupon() 
	{
		///Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}

		$email 		= $this->input->post('email');
		$name 		= $this->input->post('nombre');	
		$usuarioID 	= $this->input->post('usuarioID');
		$ofertaID 	= $this->input->post('ofertaID');
		$localID 	= $this->input->post('localID');
		

		$query = $this->data_model->ultimoCupon();
		if(count($query) > 0){
			//Genera el folio consecutivo de las cotizaciones.
			foreach ($query as $row) {
				$id_c = $row->cuponFolio;
				$arr_folio = explode("-", $id_c);
				$fol = $arr_folio[1];
				$foll = $fol + 1;
				$folio = "PTC-".$foll;
			}
		}else{
			$fol = 0;
			$fol = $fol + 1;
			$folio = "PTC-" .$fol;
		}
				
		//Genera Array y Inserta en la BD 
		$data = array('cuponFolio'		=>  $folio,
					  'cuponFecha'		=>  date('Y-m-d'),
					  'usuarioNombre' 	=> 	$name, 
					  'usuarioEmail'	=> 	$email,
					  'usuarioID'		=>  $usuarioID,
					  'ofertaID' 		=>  $ofertaID,
					  'localID'	 		=>  $localID	  
		);
		
		$this->db->insert('cupones', $data);
		
		$this->imprime_cupon($folio);
		
		redirect('gracias/cupon');
	}
	
	function imprime_cupon($folio)
	{
		$info = $this->data_model->cargarInfoCupon($folio);
			
		//Hace busqueda de informacion de cupon
		foreach($info as $row) :
			
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from('contacto@plazadelatecnologia.com', 'Plaza de la Tecnología');
		$this->email->to($row->usuarioEmail);
		
		$this->email->subject('Cupón Plaza de la Tecnología');		
		$this->email->message('
<html>
<head>
<style type="text/css">
body{font-family:helvetica neue; color:#555;}
a{color:RoyalBlue; font-weight:normal;} 
html,body,tbody,tfoot,thead,tr,th,td,table{font-size:12px;margin:0;padding:0;border:0;outline:0;vertical-align:baseline;line-height:normal;}
#bgBottom{ background:url(http://www.plazadelatecnologia.com/assets/graphics/cupon/bck-cuponbottom.png) 10px 0 no-repeat; height:230px; display:block; padding:30px 40px 0; }
#bgBottom p{}
#Top{padding:30px 50px;}
#descripcion span{float:left; padding-right:10px;}
#descripcion p{margin:0;}
#descripcion strong{font-size:14px; margin-bottom:10px; text-transform:uppercase; display:block;}
em{font-style:normal;}
#usuario p{padding:0 0 15px;}
</style>
<title>Cupon - Plaza de la Tecnologia</title>
</head>
    <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" bgcolor="#ffffff" height="100%" width="100%">
		<center>
			<table border="0" cellpadding="0" cellspacing="20" width="655px" >
            	<tr>
					<td align="center"  valign="top">
                    <img src="http://www.plazadelatecnologia.com/assets/graphics/cupon/plazadelatecnologia-logotipo.png" alt="Plaza de la Tecnologia" />
					</td>
                </tr>
				<tr style="background-image:url(http://www.plazadelatecnologia.com/assets/graphics/cupon/bck-cupontop.png); padding:20px 40px 0; display:block; background-repeat:no-repeat; background-position:10px 0;">
					<td valign="top">
                    <div style="padding:0 0 15px;">
                      <div style="margin-bottom:10px; text-align:right;">
                          <p><span>Folio</span> <em style="background-color:#BE2226; color:#fff; font-style:normal; font-size:19px; padding:2px 10px;">'.$row->cuponFolio.'</em></p>
                        </div>

                      <p>Hola '.$row->usuarioNombre.'<br />
                      Te hacemos llegar este cupón con la oferta que has seleccionado para compra. Este documento solo es válido para este producto, ofrecido por el locatario y válido solo hasta ***.
                      </p>
                    </div>
                   	<div style="float:left; width:230px;">
                      <img src="http://www.plazadelatecnologia.com/brayant/ofertasLocatarios/'.str_replace('.', '_thumb.', $row->ofertaImagen).'" />
                    </div>
                    <div style="float:left; width:250px;">
					<strong>'.$row->ofertaTitulo.'</strong>
                    <p><span>Plaza de la Tecnologia</span></p>
                    <p><span>Local Nombre</span> <em> '.$row->name.'</em></p>
                    <p><span>Local Piso</span> <em> '.$row->localPlanta.'</em></p>
                    <p><span>Local Numero</span> <em> '.$row->localNumero.'</em></p>
					<p><span>Local Telefono</span> <em> '.$row->telefono.'</em></p>
                    <p><span>Fecha Vigencia</span> <em> '.$row->ofertaVigencia.'</em></p>
                    <p><span>Precio o Promoción</span> <em> '.$row->ofertaPrecio.'</em></p>
                    <p>
                   '.nl2br($row->ofertaDescripcion).'
                    </p>
                    </div>
                      
                    </td>
                </tr>
                <tr style="background-image:url(http://www.plazadelatecnologia.com/assets/graphics/cupon/bck-cuponbottom.png); height:230px; display:block; padding:30px 40px 0; background-repeat:no-repeat; background-position:10px 0;">
					<td align="left" valign="top">
                    <p style="font-size:10px;">* Plaza de la Tecnología no se hace responsable de ninguna oferta, negociación o transacción que se     lleve a cabo a través de la página web u originado en ella.<br />
*Este documento es meramente informativo y no tiene valor fiscal ni representa la realización o finalización de una compra. Como Plaza de la Tecnología sólo proporciona el espacio virtual, es ajeno a compra, venta, precios, paquetes y transacciones entre locatarios y usuarios.<br />
* En caso de alguno contratiempo, inconveniente en la compra, veracidad y/o caducidad de la oferta. Esta se resolverá entre el usuario y el locatario, o con las autoridades legales correspondientes, excluyendo en todo momento a Plaza de la Tecnología.</p>
					<p style="font-size:10px;">* Esta promoción es válida sólo en www.plazadelatecnologia.com. Si el usuario contacta al locatario para comprar el equipo en la plaza será a consideración del locatario en términos de inventario, se respetará la venta siempre y cuando exista producto en local. Para más información comunícate con el locatario de la oferta.</p>
					</td>
                </tr>
				 <tr style="height:263px; display:block; padding:0px 25px;">
					<td align="left" valign="top">
                    <p style="font-size:10px;">De acuerdo a la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, le informamos que su dirección de correo electrónico forma parte de los registros de PLAZA DE LA TECNOLOGÍA, pudiendo ejercer en cualquier momento los derechos de acceso, rectificación, oposición y cancelación que dicha Ley le confieren, dirigiéndose por escrito a Bosque de Duraznos No 61, interior C, Colonia Bos	ques de las Lomas. Delegaciòn Miguel Hidalgo. México, D.F. o por correo electrónico a contacto a contacto@plazadelatecnologia.com . Si ha recibido este mensaje por error, por favor, destrúyalo y notifíquelo por correo electrónico Gracias. </p>
                	</td>
                </tr>
			</table>
		</center>
    </body>
</html>
');
endforeach; 
		$this->email->send();
	}

	function salvarVentasMayoreo(){
		
		$email		= $this->input->post('email');
		$mensaje 	= $this->input->post('mensaje');
		
		if(empty($email) || empty($mensaje)){
					
			$this->session->set_flashdata('msg','<div class="msg mt20 mb20">Favor de Ingresar todos los datos.</div>');
			redirect('');	
			
		}
		
		$guardarDatos = array(
			'email'		=> $email,
			'memsaje'	=> $mensaje,
			'archivo'	=> ''	
		);
		
		//Insertar Archivos si existen
		if( isset($_FILES['archivo']['name']) && !empty($_FILES['archivo']['name']) ){

			$permitidos =  array('pdf','doc','docx','xls','xlsx');
					
			$archivoNombre	= $_FILES['archivo']['name'];
			$archivoTipo	= $_FILES['archivo']['type'];
			$tamanoH		= $_FILES['archivo']['size'];
					
			$ext = pathinfo($archivoNombre, PATHINFO_EXTENSION);			
		
			if(in_array($ext,$permitidos) ) {
						
		   		move_uploaded_file($_FILES['archivo']['tmp_name'],DIRARCHIVOS.$archivoNombre);
				
				$guardarDatos['archivo'] = $archivoNombre;
			
				$this->session->set_flashdata('msg','<div class="msg mt20 mb20">Tu datos fueron enviados correctamente.</div>');
						
			}else{
				
				$this->session->set_flashdata('msg','<div class="msg mt20 mb20">Favor de Ingresar un Formato valido.</div>');
				redirect('');
				
			}
		
		}
		
		$this->db->insert('ventasMayoreo', $guardarDatos);	
		redirect('gracias/contacto');
		
	}
	
}