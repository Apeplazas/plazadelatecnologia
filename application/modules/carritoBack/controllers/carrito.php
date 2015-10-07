<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carrito extends MX_Controller {
	
	function carrito()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('inicio/data_model');
		$this->load->model('registrate/registrate_model');
		$this->load->model('ofertas/ofertas_model');
		$this->load->model('carrito_model');
	}

	function index() 
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
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/ytmenu.js');
		
		//Vista//
		$this->layouts->simpleLayout('carrito-view' ,$op);
	}
	
	function agregar() {
		
		//obtiene informacion del producto
		$idProducto  	= $this->input->post('ofertaID');
		$ofertaTitulo 	= $this->input->post('ofertaTitulo');
		$precio 		= $this->input->post('ofertaPrecio');
		$categoria   	= $this->input->post('categoria');
		$costoEnvio   	= $this->input->post('ofertaEnvio');
		$gananciaPt   	= $this->input->post('gananciaPt');
		
		$insert = array(
			'id' 			=> $idProducto,
			'name' 			=> $ofertaTitulo,
			'qty' 			=> 1,
			'price' 		=> $precio,
			'envio' 		=> $costoEnvio,
			'gananciaPt'	=> $gananciaPt
		);
		
		$this->cart->insert($insert);//guarda informacion del producto en el carrito
		
		$this->index();
	}
	
	function registrate()
	{
		$this->load->helper('breadcrumb');
	 	
		//Optimizacion y conexion de tags para SEO//
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		$id					= $this->session->userdata('uid');
		$op['info']			= array();
		
		if ($id != '') {
			$tipo = 'info_'.$this->session->userdata('tipoUsuario');
			$op['info']	= $this->data_model->$tipo($id);
		}
		
		$op['estados']		= $this->data_model->cargarEstadosMex();
		
		$this->layouts->add_include('assets/js/jquery-ui.js');
		
		//Vista//
		$this->layouts->index('registrate-view' ,$op);
	}
	
	function guardarRegistro()
	{
		$nickname 	= $this->input->post('nickname');
		$nombre 	= $this->input->post('nombre');
		$apellido 	= $this->input->post('');
		$email 		= $this->input->post('email');
		$password 	= $this->input->post('password');
		$state 		= $this->input->post('state');
		$gender 	= $this->input->post('gender');
		$fechaNac 	= $this->input->post('anio').'-'.$this->input->post('mes').'-'.$this->input->post('dia');
		
		$mail = $this->registrate_model->veificaRegistros($email);
		
		if (!$mail) {
			
			$registro = array('userAlias' 	=> $nickname, 
							  'userName' 	=> $nombre,
							  'lastName'	=> $apellido,
							  'email'		=> $email,
							  'gender'		=> $gender,
							  'contrasenia'	=> md5($password),
							  'hash'		=> md5($email),
							  'state'		=> $state,
							  'status'		=> 'Desactivado',
							  'registrationDate'	=> date('Y-m-d'),
							  'ip'			=> $_SERVER['SERVER_ADDR'],
							  'terminosCondiciones'	=> 'acepto');
							  
			$this->db->insert('usuarios', $registro);
			
			$verifica	= $this->carrito_model->verificaID($email);
			
			foreach($verifica as $rowV){
				
				$data['user'] = array(
		             'uid' 			=> $rowV->idRegistro,
		             'name'			=> $nombre,
		             'email' 		=> $email,
					 'tipoUsuario'	=> 'usuario',
		             'is_logged_in'	=> true
	            );
	            
	            //guardamos los datos en la sesion
				$this->session->set_userdata($data);
			}
            
			$this->session->set_flashdata('msg','<div class="msg">¡Te has registrado con éxito!</div>');
			redirect('carrito');
			
		}else {
			$this->session->set_flashdata('msg','<div class="msg">Lo sentimos, esta cuenta de email ya esta registrada.</div>');
			redirect('registrate');
		}
	}
	
	function addQty(){
		
		//obtiene informacio del producto
		$idProducto  = $this->input->post('rowid');
		$cantidad 	 = $this->input->post('qty');
		$envio 	 	 = $this->input->post('envio');
	
		$update = array(
			'rowid' 	=> $idProducto,
			'qty' 		=> $cantidad,
		);
		
		$this->cart->update($update);
		
		$cart = $this->cart->contents();
		
		foreach ($cart as $value) {
			if ($value['rowid'] == $idProducto) {
				$echo = $value['subtotal'];
				echo '$ '.number_format($echo);	
			}
		}
	}
	
	function eliminar() {
		
		$rowid = $this->uri->segment(3);
		
		$this->cart->update(array(
			'rowid' => $rowid,
			'qty' 	=> 0
		));
		
		$back = $_SERVER['HTTP_REFERER'];
		redirect($back);
	}

	function autenticacion()
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
		
		
		$this->layouts->simpleLayout('loginClient-view',$op);
	}
	
	function confirmaCarrito()
	{
		$user = $this->session->userdata('user');
		//busca el ultimo folio en la BD
		$query = $this->carrito_model->folios();
		if($query){
			//Genera el folio consecutivo de las cotizaciones.
			foreach ($query as $row) {
				$id_c = $row->folio;
				$arr_folio = explode("-", $id_c);
				$fol = $arr_folio[1];
				$foll = $fol + 1;
				$folio = "PTV-".$foll;
			}
		}else{
			$fol = 0;
			$fol = $fol + 1;
			$folio = "PTV-" .$fol;
		}
		
		$cart = $this->cart->contents();
		$total = 0;
		foreach ($cart as $item) {
				
			$gananciaPT		= $item['gananciaPt'] * $this->input->post('cantidad'.$item['id']);
			$precioLocal	= $item['price'] - $item['gananciaPt'];
			$totalSComision = ($item['price'] * $this->input->post('cantidad'.$item['id'])) - $gananciaPT;
			$subtotal 		= $item['subtotal'];
			$total += $subtotal;
			//se inserta detalle de compra
			$articulo = array('folioCompra' 		=> $folio, 
							  'ofertaID'			=> $item['id'],
							  'cantidadProducto' 	=> $this->input->post('cantidad'.$item['id']),
							  'subtotalPago'		=> $subtotal,
							  'subtotalLocal'		=> $precioLocal * $this->input->post('cantidad'.$item['id']),
							  'ofertaPrecio' 		=> $item['price'],
							  'costoEnvio'			=> $item['envio'],
							  'totalSinComision'	=> $totalSComision,
							  'gananciaPt'			=> $gananciaPT,
							  'precioLocal'			=> $precioLocal
			);
			$this->db->insert('productosComprados', $articulo);	
		}
		//se inserta generales de la compra
		$compra = array('folio' 		=> $folio, 
						'fechaCompra' 	=> date('Y-m-d'),
						'usuarioID' 	=> $user['uid'],
						'total'			=> $total,
						'idSitio'		=> '0'	
		);
		$this->db->insert('compras', $compra);
		
		redirect('carrito/entrega/'.$folio);
	}

	function entrega()
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
		
		$op['folio'] 			= $this->uri->segment(3);
		$op['compra']			= $this->carrito_model->compra($this->uri->segment(3));
		$op['detalleCompra']	= $this->carrito_model->detalleCompra($this->uri->segment(3));
		$op['estados']			= $this->carrito_model->estados();
		$op['direcciones']		= $this->carrito_model->direccionesUser($user['uid']);
		
		$this->layouts->simpleLayout('agregarSitio-view',$op);
	}
	
	function formas_pago()
	{
		$user			= $this->session->userdata('user');
		
		$estado 		= $this->input->post('estado');
		$municipio 		= $this->input->post('delSitio');
		$colonia 		= $this->input->post('colSitio');
		$cp 			= $this->input->post('codSitio');
		$tel 			= $this->input->post('telSitio');
		$resp 			= $this->input->post('nombResp');
		$calle 			= $this->input->post('dirSitio');
		$folio 			= $this->input->post('folio');
		$user			= $this->session->userdata('user');
		
		$sitio = array('usuarioID' 		=> $user['uid'], 
					   'estado'	   		=> $estado,
					   'direccion' 		=> $calle,
					   'colonia'   		=> $colonia,
					   'municipioDelegacion'	=> $municipio,
					   'CodigoPostal'	=> $cp,
					   'telefono'		=> $tel,
					   'recibe'			=> $resp
		);
		$this->db->insert('sitiosEntrega', $sitio);
		
		$ultimoSitio = $this->carrito_model->ultimoSitio();
		
		$up = array('idSitio' => $ultimoSitio[0]->idSitio);
		$this->db->where('folio', $folio);
		$this->db->update('compras', $up);
		
		$qty = $this->carrito_model->cantidadComprada($folio);
		
		foreach ($qty as $itemQ) {
			$item = $this->carrito_model->itemExistencia($itemQ->ofertaID);
			
			$upQty = array('existencia' => $item[0]->existencia - $itemQ->cantidadProducto);
			$this->db->where('ofertaID', $itemQ->ofertaID);
			$this->db->update('locatariosOfertas', $upQty);
		}
		
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$op['folio'] 			= $folio;
		$op['detalleCompra']	= $this->carrito_model->detalleCompra($folio);
		$op['compra']			= $this->carrito_model->compra($folio);
		
		$this->layouts->simpleLayout('formasPago-view',$op);
	}	

	function enviar_aqui()
	{
		$folio = $this->uri->segment(3);	
		$idSitio = $this->uri->segment(4);
		
		$up = array('idSitio' => $idSitio);
		$this->db->where('folio', $folio);
		$this->db->update('compras', $up);
		
		$qty = $this->carrito_model->cantidadComprada($folio);
		
		foreach ($qty as $itemQ) {
			$item = $this->carrito_model->itemExistencia($itemQ->ofertaID);
			
			$upQty = array('existencia' => $item[0]->existencia - $itemQ->cantidadProducto);
			$this->db->where('ofertaID', $itemQ->ofertaID);
			$this->db->update('locatariosOfertas', $upQty);
		}
		
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$op['folio'] 			= $folio;
		$op['detalleCompra']	= $this->carrito_model->detalleCompra($folio);
		$op['compra']			= $this->carrito_model->compra($folio);
		
		$this->layouts->simpleLayout('formasPago-view',$op);
	}

	function ficha_oxxo(){
		
		$parametros = array('host' => 'https://www.banwire.com/api.oxxo',
							'path' => $_SERVER['DOCUMENT_ROOT'].'/assets/oxxo_codigos/');
		
		$this->load->library('OXXO/oxxo', $parametros);
		
		$this->oxxo->usuario = 'naturista';
		$this->oxxo->referencia = $referencia;
		$this->oxxo->dias_vigencia = 3;
		$this->oxxo->monto = $monto;
		$this->oxxo->url_respuesta = 'http://www.plazadelatecnologia.com/gracias/dinero_mail';
		$this->oxxo->cliente = $nombre;
		$this->oxxo->formato = 'JSON';
		/* BnaWire enviara el mail con el PDF */
		$this->oxxo->sendPDF = TRUE;
		$this->oxxo->email = $email;
		
		if($this->oxxo->send())
		{
			// Acciones a realizar si todo salio bien.
			$this->layouts->layout('ficha_oxxo-view', $op);
		}
		else
		{
		  // Acciones a realizar si surgio un error.
		  $this->layouts->layout('failcard-view', $op);
		}
		
		$this->oxxo->getResponse();
	}

	function paypal_gracias()
	{
		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		if ($_POST) {
			
			$referencia =  $_POST['invoice'];
			$importe	=  $_POST['mc_gross'];
			$tipoPago	=  'PayPal';
			
			//$this->email_confirmation($referencia,$importe,$tipoPago);
			
		 	$pago = array('fechaPago' 		=> date('Y-m-d'),
				          'status' 			=> 'pagado',
				          'metodoPago'		=> 'paypal'
			);	
						//Actualiza el monto del presupuesto
			$this->db->where('folio', $referencia);
			$this->db->update('compras', $pago); 
			
			$this->email_confirmation($referencia, $importe, $tipoPago);
			$this->layouts->simpleLayout('gracias_paypal-view',$op);
			
		}else{
			
		
			$this->layouts->simpleLayout('gracias_paypal-view',$op);
		}
	}

	function gracias_oxxo(){
		
		if ($_POST) {
			
			$pago = array('fechaPago' 		=> date('Y-m-d'),
				          'status' 			=> 'pagado',
				          'metodoPago'		=> 'paypal'
			);	
						//Actualiza el monto del presupuesto
			$this->db->where('folio', $referencia);
			$this->db->update('compras', $pago); 
			
			$this->email_confirmation($referencia, $importe, $tipoPago);
		} else {
			echo 'no hay post';
		}
	}
	
	function email_confirmation($referencia,$importe,$tipoPago){
		
		$info 	= $this->carrito_model->infoCliente($referencia);
		
		if($info){
			
		$calle 		= $info[0]->calle;
		$colonia 	= $info[0]->colonia;
		$minicipio 	= $info[0]->municipio;
		$estado 	= $info[0]->estado;
		$cp 		= $info[0]->cp;
		$tel 		= $info[0]->telefono;
		$name		= $info[0]->name;
		$lastname	= $info[0]->lastname;
		$email 		= $info[0]->email;
		$folio 		= $info[0]->folio;
		$total 		= $info[0]->total;
		$nombre 	= $name.' '.$lastname;
		$cart		= $this->carrito_model->detalleCompra($folio);
		
		//Genera email para el cliente con detalle de cuenta y numero de cuenta para realizar deposito
		$this-> email->set_newline("\r\n");
		$this-> email->from('contacto@plazadelatecnologia.com', 'Plaza de la Tecnología');
		$this->email->to($email); 
		$list = array('bmonroy@apeplazas.com','contacto@plazadelatecnologia.com','mdiaz@apeplazas.com', 'jhernandezn@apeplazas.com');
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
		<strong>Muchas gracias  '.$nombre .'</strong>
		<br>
		<br>
		Tu folio de compra: '.$referencia.'
		<br>
		Dirección de entrega:<br>Calle:'.
		$calle.'<br>Colonia:'.
		$colonia.'<br>Municipio:'.
		$minicipio.'<br>Estado:'.
		$estado.'<br>Codigo Postal:'.
		$cp.'<br>Telefono:'.
		$tel.'<br>
		Información de pago:<br>Referencia:'.  
		$referencia.'<br>Importe pagado:'.     
		$importe.'<br>  
		<br>
		<br>
		Tu compra:
		<p style="font-weight:lighter; text-align:left; padding:0px 30px;">
		<table border="1" cellpadding="10">
			<thead>
				<tr>
					<th>Identificador</th>
					<th>Descripcion</th>
					<th>Cantidad</th>
					<th>Precio unitario</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>';
			if ($cart) {
				foreach ($cart as $item) {
					$body .= '
				<tr>
					<td> '.$item->ofertaID.'</td>
					<td> '.$item->ofertaTitulo.'</td>
					<td> '.$item->cantidadProducto.'</td>
					<td>$ '.$item->ofertaPrecio.'</td>
					<td>$ '.$item->subtotalPago .'</td>
				</tr>';
				}
				$body .= '
				<tr>
					<td class="left total">Total a pagar:</td>
					<td>&nbsp</td>
					<td></td>
					<td></td>
					<td class="center total">$'.$total.'</td>
				</tr>';
			}
		$body .= '
			</tbody>
		</table>
		</p>
		<p id="mensaje">
			Le recomendamos guardar y/o imprimir esta nota de compra ya que le sera de utilidad para futuras aclaraciones con respecto a su compra.
			<br>
			¡Todas las compras en www.plazadelatecnologia.com incluyen envío!
			<br>
			Ahora si compras en www.plazadelatecnologia.com tu producto incluye envío con seguro para respaldar tu entrega rápida y confiable.
			<br>
			Así que no esperes más y consulta nuestra ofertas.
			<br>
			Datos importantes de política de envíos
			<br>
			<b>Tiempo de entrega de producto:</b> Cada uno de nuestros locatarios ocupan diferentes compañías de mensajería, por lo que debes tomar en cuenta que antes de que te envíen el producto deberán confirmar contigo la dirección de envío y quién lo recibirá. 
			<br>
			El proceso de envío inicia después de hacer la verificación de datos personales. Después nuestro locatario te contactará para darte el número de guía y fecha de entrega. 
			<br>
			<b>Cobertura de envíos:</b> Después de confirmar tu domicilio, nuestros locatarios te harán saber si la compañía de mensajería cubre tu envío, de lo contrario te ofreceremos una solución para que llegue tu compra.
			<br>
			Recuerda que en Plaza de la Tecnología siempre encuentras, ahorras y mejoras el precio.
			<br>
			Síguenos en nuestras redes sociales y entérate de lo que sucede en Plaza de la Tecnología.			
			<br>
			En Plaza de la Tecnología queremos darte siempre el mejor servicio, dejanos tus dudas o comentarios <a href="http://www.plazadelatecnologia.com/contacto">aquí</a>.
		</p>	
		<br class="clear">
	</body>
</html>';
	
			$this->email->message($body);
			$this->email->send();
			$this->borrar_carrito();
			
			return TRUE;
		}
	
	}
	
	function borrar_carrito(){
		
		$this->cart->destroy();
		
	}
	
	function dinero_mail_ipn()
	{
		$notificacion = $_REQUEST['Notificacion'];

		/*
		Ejemplo de notificacion
		$str_RequestNotif = "<notificacion><tiponotificacion>12</tiponotificacion><operaciones>";
		$str_RequestNotif = $str_RequestNotif . "<operacion><tipo>1</tipo><id>2320</id></operacion>";
		$str_RequestNotif = $str_RequestNotif . "<operacion><tipo>1</tipo><id>434</id></operacion>";
		$str_RequestNotif = $str_RequestNotif . "</operaciones></notificacion>";
		*/
		
		$doc = new SimpleXMLElement($notificacion);
		
		$tipo_notificacion = $doc -> tiponotificacion;
		echo 'Tipo notificacion :'. $tipo_notificacion, '<br />';
		
		foreach ($doc -> operaciones -> operacion as $operacion) 
		{
		   $tipo_operacion= $operacion -> tipo;
		   $id_operacion= $operacion -> id;   
		   echo 'tipo operacion :'. $tipo_operacion, '<br />';
		   echo 'ID operacion :'. $id_operacion, '<br />';
		}
	}
	
	function dinero_mail()
	{
		$APIPassword = "TEST-TEST-TEST-TEST-TEST";
		$APIUserName = "TEST";
		$Crypt = false;
		$MerchantTransactionId = "1";
		$UniqueMessageId = "1";
		$Provider = "oxxo";
		$Currency = "MXN";
		$Amount = "50.00";
		$Hash = "";
		
		$ns = "https://sandboxapi.dineromail.com/";
		$wsdlPath = "https://sandboxapi.dineromail.com/DMAPI.asmx?WSDL";
		
		try
		{   
		   $Hash = $MerchantTransactionId.$UniqueMessageId.$Currency.$Amount.$Provider.$APIPassword;
		   $Hash = md5($Hash);
		   $MerchantTransactionId = md5($APIPassword,$MerchantTransactionId);
		   $UniqueMessageId = md5($APIPassword,$UniqueMessageId);
		   $Provider = md5($APIPassword,$Provider);
		   $Currency = md5($APIPassword,$Currency);
		   $Amount = md5($APIPassword,$Amount);
		   
		   $soap_options = array('trace' =>1,'exceptions'=>1);   
		   $client = new SoapClient($wsdlPath,$soap_options);    
		   
		   $credential = new SOAPVar(array('APIUserName' => $APIUserName,
		                           'APIPassword'=> $APIPassword)
		                           , SOAP_ENC_OBJECT, 'APICredential', $ns);
		                           
		                     
		   $request = array('Credential' =>$credential
		               ,'Crypt' =>  $Crypt
		               ,'MerchantTransactionId' => $MerchantTransactionId
		               ,'UniqueMessageId' => $UniqueMessageId
		               ,'Provider' => $Provider
		               ,'Amount' => $Amount
		               ,'Currency' => $Currency
		               ,'Hash' => $Hash);   
		   
		   $result = $client->GetPaymentTicket(utf8_encode($request));
		   
		   echo "<br/>";
		   echo "MerchantTransactionId: " . $result->GetPaymentTicketResult->MerchantTransactionId . "<br/>";
		   echo "Status: " . $result->GetPaymentTicketResult->TransactionId . "<br/>";
		   echo "Message: " . $result->GetPaymentTicketResult->Message . "<br/>";
		   echo "Status: " . $result->GetPaymentTicketResult->Status . "<br/>";
		   echo "TransactionId: " . $result->GetPaymentTicketResult->TransactionId . "<br/>";
		   echo "BarcodeDigits: " . $result->GetPaymentTicketResult->BarcodeDigits . "<br/>";
		   echo "BarcodeImageUrl: " . $result->GetPaymentTicketResult->BarcodeImageUrl . "<br/>";
		   echo "VoucherUrl: " . $result->GetPaymentTicketResult->VoucherUrl . "<br/>";
		   
		}
		catch (SoapFault $sf)
		{
		   echo "faultstring:". $sf->faultstring;
		}
	}

	function dinero_mail_reference()
	{

	$APIPassword = "TEST-TEST-TEST-TEST-TEST";
	$APIUserName = "TEST";
	$Crypt = false;
	$MerchantTransactionId = "1";
	$UniqueMessageId = "1";
	$Provider = "pagofacil";
	$Subject = "Subject";
	$Message = "Message";
	$Hash = "";
	$Currency = "ARS";
	$Amount = "10.00";
	$Code = "A001";
	$Description = "000";
	$ItemName = "Test";
	$Quantity = "1";
	$Address = "Humboldt 2500";
	$City = "Buenos Aires";
	$Country = "Argentina";
	$Email = "johndoe@johndoe.com";
	$Name = "John";
	$LastName = "Doe";
	$Phone = "45550000";
	
	$ns = "https://sandboxapi.dineromail.com/";
	$wsdlPath = "https://sandboxapi.dineromail.com/DMAPI.asmx?WSDL";
	
	try
	{   
	   $Items = $Amount.$Code.$Currency.$Description.$ItemName.$Quantity;
	   $Buyer = $Name.$LastName.$Email.$Address.$Phone.$Country.$City;
	   $Hash = $MerchantTransactionId.$UniqueMessageId.$Items.$Buyer.$Provider.$Subject.$Message.$APIPassword;
	   $Hash = MD5($Hash);
	
	   $MerchantTransactionId = encryptTripleDES($APIPassword,$MerchantTransactionId);
	   $UniqueMessageId = encryptTripleDES($APIPassword,$UniqueMessageId);
	   $Provider = encryptTripleDES($APIPassword,$Provider);
	   $Subject = encryptTripleDES($APIPassword,$Subject);
	   $Message = encryptTripleDES($APIPassword,$Message);
	      
	   $Currency=encryptTripleDES($APIPassword,$Currency);
	   $Amount=encryptTripleDES($APIPassword,$Amount);
	   $Code=encryptTripleDES($APIPassword,$Code);
	   $ItemName=encryptTripleDES($APIPassword,$ItemName);
	   $Quantity=encryptTripleDES($APIPassword,$Quantity);
	   
	   $Address = encryptTripleDES($APIPassword,$Address);
	   $City = encryptTripleDES($APIPassword,$City);
	   $Country = encryptTripleDES($APIPassword,$Country);
	   $Email = encryptTripleDES($APIPassword,$Email);
	   $Name = encryptTripleDES($APIPassword,$Name);
	   $LastName = encryptTripleDES($APIPassword,$LastName);
	   $Phone = encryptTripleDES($APIPassword,$Phone);
	         
	   $soap_options = array('trace' =>1,'exceptions'=>1);   
	   $client = new SoapClient($wsdlPath,$soap_options);    
	   
	   $credential = new SOAPVar(array('APIUserName' => $APIUserName,
	                           'APIPassword'=> $APIPassword)
	                           , SOAP_ENC_OBJECT, 'APICredential', $ns);
	                           
	   $Item = new SOAPVar(array('Amount' => $Amount
	                        ,'Code' => $Code
	                        ,'Currency' => $Currency
	                        ,'Description' => $Description
	                        ,'Name' => $ItemName
	                        ,'Quantity' => $Quantity)
	                        , SOAP_ENC_OBJECT, 'Item', $ns);   
	
	   $Items=array($Item);
	                                 
	   $BuyerObject = new SOAPVar(array('Address' => $Address
	                        ,'City' => $City
	                        ,'Country' => $Country
	                        ,'Email' => $Email
	                        ,'LastName' => $LastName
	                        ,'Name' => $Name
	                        ,'Phone' => $Phone)
	                        , SOAP_ENC_OBJECT, 'Buyer', $ns);
	
	                     
	   $request = array('Credential' =>$credential
	               ,'Crypt' =>  $Crypt
	               ,'MerchantTransactionId' => $MerchantTransactionId
	               ,'UniqueMessageId' => $UniqueMessageId
	               ,'Provider' => $Provider
	               ,'Message' => $Message
	               ,'Subject' => $Subject
	               ,'Items'=>$Items
	               ,'Buyer'=>$BuyerObject
	               ,'Hash' => $Hash);   
	   
	   $result = $client->DoPaymentWithReference($request);
	   
	   echo "<br/>";
	   echo "MerchantTransactionId: " . $result->DoPaymentWithReferenceResult->MerchantTransactionId . "<br/>";
	   echo "Status: " . $result->DoPaymentWithReferenceResult->TransactionId . "<br/>";
	   echo "Message: " . $result->DoPaymentWithReferenceResult->Message . "<br/>";
	   echo "Status: " . $result->DoPaymentWithReferenceResult->Status . "<br/>";
	   echo "TransactionId: " . $result->DoPaymentWithReferenceResult->TransactionId . "<br/>";
	   echo "BarcodeDigits: " . $result->DoPaymentWithReferenceResult->BarcodeDigits . "<br/>";
	   echo "BarcodeImageUrl: " . $result->DoPaymentWithReferenceResult->BarcodeImageUrl . "<br/>";
	   echo "VoucherUrl: " . $result->DoPaymentWithReferenceResult->VoucherUrl . "<br/>";
	   
	}
	catch (SoapFault $sf)
	{
	   echo "faultstring:". $sf->faultstring;
	}
	}
}
	
		