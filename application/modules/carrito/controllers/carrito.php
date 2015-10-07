<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carrito extends MX_Controller {

	function test(){
		
		$user	= $this->session->userdata('user');
		var_dump($user);
		
	}
	
	function procesarPaypal(){
		
		$folio 	= $this->input->post('folioId');
		
		$compra = $this->carrito_model->compra($folio);
		
		$paypal = $this->load->library("paypal");
		
		$direccion = array(
			'cityName'			=> $compra[0]->municipio,
			'phone'				=> $compra[0]->telefono,
			'street'			=> $compra[0]->direccion . " Colonia " . $compra[0]->colonia,
			'stateOrProvince'	=> $compra[0]->estado,
			'postalCode'		=> $compra[0]->CP,
			'name'				=> $compra[0]->personaRecibe
		);
		
		$detalleCompra	= $this->carrito_model->detalleCompra($folio);
		$paypal->setAddress($direccion);		
		$paypal->setCarItems($detalleCompra);
		$paypal->sendToPaypal();
		
	}
	
	function mercadoPago(){
		
		
		$metodo = $this->input->post('paymentMethodId');
		$email = $this->input->post('email');
		$referencia = $this->input->post('folio');
		$token = $this->input->post('token');
		//var_dump($token);
		$plazos = $this->input->post('installments');
		
		/*Compara si el valor de la variable plazas es string si es así la convierte en int*/
		if(is_string($plazos)){
			$plazo = (int) $plazos; 
		}
		
		$bancoEmisor = $this->input->post('issuer'); 
		
		//echo is_bool($bancoEmisor) ? "si es bool" : "no es bool";
		//echo $bancoEmisor;
		//var_dump($bancoEmisor);
				
		$detalleCompra 	= $this->carrito_model->detalleCompra($referencia);
		$totalCompra = 0;
		
		foreach($detalleCompra as $detalle){
			
		 	$totalCompra += $detalle->ofertaPrecio;	
			
		}
		
		$mp = $this->load->library("mercadopago/MP", "APP_USR-1415841976065959-092112-1174eaaec06082b4facbdb78c682c033__LD_LA__-191726900");
		//$mp = new MP('TEST-1415841976065959-090719-f8eb671fe6ea63a4e6b2c983b344c33a__LA_LC__-191726900');
		
		$payment_data = array(
						"transaction_amount" => $totalCompra,
						"token" => "$token",
						"description" => "Pago por el Folio ".$referencia,
						"payer" => array (
											"email" => "$email"
										),
						"installments" => $plazo, /*marca error si no es int*/
						"payment_method_id" => "$metodo",
						"issuer_id" => $bancoEmisor
						);
		//var_dump($payment_data);

$payment = $mp->post("/v1/payments", $payment_data);

//var_dump($payment);
		$fecha = getdate();
		$metodoPago = "mercadopago";
		/*Actualiza datos de compra*/
		$this->actualizaCompra($fecha, $payment['status'], $metodoPago, $plazo, $referencia);
		/*Proceso de envio de respuesta*/
		$this->send_email($folioCompra,$referencia, $metodo, $plazos);
		$this->borrar_carrito();
		//var_dump($payment);
		$this->layouts->simpleLayout('graciasMP',$payment);
		
	}
	
	
	function convenienciaCarrito(){
		
		$formaPago = $this->input->post('formaPago');
		$referencia = $this->input->post('folio');
		
		$compropago = $this->load->library("compropago");
		$datos		= array();
		
		$user		= $this->session->userdata('user');
		$tipo 		= 'info_'.$user['tipoUsuario'];
		$userinfo	= $this->data_model->$tipo($user['uid']);
		
		$detalleCompra 	= $this->carrito_model->detalleCompra($referencia);

		$totalCompra	= 0;
		
		foreach($detalleCompra as $detalle){
			
		 	$totalCompra += $detalle->ofertaPrecio;	
			
		}
		
		$datos['email'] = $user["email"];
		$datos['name']	= $userinfo[0]->name;
		$datos['ref']	= $referencia;
		$datos['total'] = $totalCompra;
		
		$resultado		= $compropago->makePayment($datos,$formaPago);

		if(isset($resultado["type"])){		

			$pago = array(
				'status'		=> 'espera de pago',
				'metodoPago'	=> $formaPago,
				'payu_id'		=> $resultado["data"]["object"]["id"]
			);	
			//Actualiza el monto del presupuesto
			$this->db->where('folio', $referencia);
			$this->db->update('compras', $pago);

			$opt 				= $this->uri->segment(1);
			$op['opt'] 			= $this->data_model->cargarOptimizacion($opt);
			$op['info'] 		= array();
			
			$op['trans_referencia'] = 'Compra en Plaza de la Tecnología';
        	$op['trans_error']		= 0;
        	$op['trans_tipo'] 		= $formaPago;
			$op['trans_id'] 		= $referencia;
        	$op['trans_msg'] 		= $resultado["payment_instructions"];
			
			$op['info']	= $userinfo;
			$this->layouts->simpleLayout('pagoAutorizacion-view',$op);
		
		}

	}
	
	function webhookComproPago(){
		
		$cp_request = file_get_contents('php://input');
		$compropago = $this->load->library("compropago");
		$pagado = $compropago->validatePayment($cp_request);
		if($pagado){
			
			$pago = array(
				'fechaPago' 	=> date('Y-m-d'),
				'status'		=> 'pagado'
			);	
			//Actualiza el monto del presupuesto
			$this->db->where('payu_id', $pagado);
			$this->db->update('compras', $pago); 
			
		}
	}
	
	function procesarConekta(){
	
		//validacion para identificar tipo de usuario y desglosar info
		$user	= $this->session->userdata('user');

		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$tipoPago		= 'conekta';
		$conekta		= $this->load->library("conektapt");	
		$folioCompra	= $this->carrito_model->traeUltimoFolio($user['uid']);
		$detalleCompra	= $this->carrito_model->detalleCompra($folioCompra);

		$totalCompra	= 0;
		
		foreach($detalleCompra as $detalle){
			
		 	$totalCompra += $detalle->ofertaPrecio;	
			
		}

		$successPay		= false;
		$chargeId		= '';
		$mensajeError 	= '';
		
		if( isset($_POST['conektaChargeId']) && !empty($_POST['conektaChargeId']) ){
			
			$successPay = true;
			$chargeId 	= $_POST['conektaChargeId'];
						
		}else{
			
			$respuesta 		= $conekta->makePayment($totalCompra * 100,$folioCompra, $_POST["conektaTokenId"],$user);	
			if(isset($respuesta->status) && $respuesta->status == 'paid'){
				
				$successPay = true;
				$chargeId 	= $respuesta->id;
				
			}
				
		}
		
		if($successPay){
			
			$pago = array(
				'fechaPago' 	=> date('Y-m-d'),
				'status'		=> 'pagado',
				'metodoPago'	=> $tipoPago,
				'payu_id'		=> $chargeId				
			);	
			//Actualiza el monto del presupuesto
			$this->db->where('folio', $folioCompra);
			$this->db->update('compras', $pago); 
				
			$this->send_email($folioCompra,$folioCompra,"conekta");
			$this->borrar_carrito();
			
		}else{
			
			if(!empty($respuesta))
				$mensajeError = $respuesta;
			else
				$mensajeError = "Ha ocurrido un error, favor de intentarlo más tarde.";
			
		}
	
		
		$opt 		= $this->uri->segment(1);
		$op['opt'] 	= $this->data_model->cargarOptimizacion($opt);
		$op['info']	= array();
		$op['mensajeError']	= $mensajeError;

		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$this->layouts->simpleLayout('gracias_conekta',$op);
		
	}
	
	private function send_email($folio = "",$referencia = '',$formaPago = '',$meses = 0){

		$user 			= $this->session->userdata('user');		
		$compra 		= $this->carrito_model->compra($folio);
		$detalleCompra	= $this->carrito_model->detalleCompra($folio);
		$compraDatos	= '';
		$totalCompra	= 0;
		
		$mesesContenido = null;

		if($meses > 0)		
			$mesesContenido = '<p style="font-family:Arial, Helvetica, sans-serif;margin-left:5px;">Meses sin intereses: <span style="font-family:Arial, Helvetica, sans-serif; color:#F00;">' . $meses . '</span></p>';
		
		foreach($detalleCompra as $detalle){
			
			$compraDatos .= '<tr>
		 		<td>' . $detalle->ofertaTitulo . '</td>
		 		<td align="center">' . (($detalle->cantidadProducto == 0) ? 1 : $detalle->cantidadProducto) . '</td>
		 		<td>' . number_format($detalle->ofertaPrecio,2) . '</td></td>
		 </tr>';
		 	$totalCompra += $detalle->ofertaPrecio;	
			
		}
		
		//Genera email para el cliente con detalle de cuenta y numero de cuenta para realizar deposito
		$this->email->set_newline("\r\n");
		$this->email->from('contacto@plazadelatecnologia.com', 'Plaza de la Tecnología');
		$this->email->to("dj_enigmata@hotmail.com"); 
		$this->email->subject('Nota de compra de Plaza de la Tecnología');
		$body = '<!DOCTYPE html>
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Confirmación de compra</title>
		</head>
		
		<body bgcolor="#999999"><center>
		<table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
		  <tr>
		    <td valign="middle"><span style="margin-left:5px;"><img src="http://www.plazadelatecnologia.com/assets/graphics/logo_pt_color.png" /></span></td>
		    <td valign="middle" align="center"><span style="color:#F00; font-family:Arial, Helvetica, sans-serif; vertical-align:text-top;"> www.plazadelatecnologia.com</span></td>
		  </tr>
		  <tr>
		    <td colspan="2"><p><span style="font-family:Arial, Helvetica, sans-serif; margin-left:5px;">Hola</span></p>
		      <p style="font-family:Arial, Helvetica, sans-serif; color:#F00; margin-left:5px;">' . $user['name'] . '</p>
		      <p><span style="font-family:Arial, Helvetica, sans-serif;margin-left:5px;">Gracias por comprar en Plaza de la Tecnolog&iacute;a.</span>
		        <p style="font-family:Arial, Helvetica, sans-serif;margin-left:5px;">A continuaci&oacute;n encontraras los detalles de tu compra.</p>
		            <br />
		        <p style="font-family:Arial, Helvetica, sans-serif;margin-left:5px;"><b>Número de orden: </b><span style="font-family:Arial, Helvetica, sans-serif; color:#F00;">' . $referencia . '</span></p><br /></td>
		  </tr>
		  <tr>
		    <td colspan="2" align="center"><table width="0" border="0" cellpadding="0" cellspacing="0"><td bgcolor="#0072c6" align="center"><span style="font-family:Arial, Helvetica, sans-serif; color:#FFF;"><b>Producto</b></span></td>
		    <td bgcolor="#0072c6" align="center"><span style="font-family:Arial, Helvetica, sans-serif; color:#FFF;"><b>Cantidad</b></span></td>
		    <td bgcolor="#0072c6" align="center"><span style="font-family:Arial, Helvetica, sans-serif; color:#FFF;"><b>Precios</b></span></td>
		     ' . $compraDatos . '
		  </tr>
		  </table>
		 </td>
		  <tr>
		    <td colspan="2" align="right"><ul style="margin-right:5px; list-style-type:none; font-family:Arial, Helvetica, sans-serif;">
		    <li style="background:#999; width:205px; text-align:center"><b>Total:</b>$ ' . number_format($totalCompra,2) . '</li>
		    </ul></td>
		  </tr>
		  <tr>
		    <td colspan="2"><p style="font-family:Arial, Helvetica, sans-serif;margin-left:5px;">Forma de pago aceptada:<span style="font-family:Arial, Helvetica, sans-serif; color:#F00;">' . $formaPago . '</span></p>
		                    ' . $mesesContenido . '</td>
		  </tr>
		  <tr>
		    <td colspan="2"><table width="600" border="0" cellpadding="0" cellspacing="0">
		      <tr>
		        <td bgcolor="#0072c6" width="150" align="center"><span style="font-family:Arial, Helvetica, sans-serif; color:#FFF;"><b>Direcci&oacute;n de Env&iacute;o</b></span></td>
		      </tr>
		      	<tr>
		 			<td>' . $compra[0]->direccion . " Colonia " . $compra[0]->colonia . '</td>
				</tr>
				<tr>
		 			<td>' . $compra[0]->municipio . ', ' . $compra[0]->estado . ' CP ' . $compra[0]->CP . '</td>
				</tr>
		    </table></td>
		  </tr>
		  <tr>
		    <td colspan="2">&nbsp;</td>
		  </tr>
		  <tr>
		    <td colspan="2" style="text-align:justify; font-family:Arial, Helvetica, sans-serif; margin-left:5px;"><b><a href="http://www.plazadelatecnologia.com/terminosycondiciones"><p style="margin-left:5px; font-size:10px;">T&eacute;rminos y Condiciones</p></a></b></td>
		  </tr>
		  <tr>
		    <td colspan="2" style="text-align:justify; font-family:Arial, Helvetica, sans-serif;">&nbsp;</td>
		  </tr>
		</table>
		</center>
		</body>
		</html>';
	
			$this->email->message($body);
			$this->email->send();
		
	}
	
	function carrito()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('inicio/data_model');
		$this->load->model('registrate/registrate_model');
		$this->load->model('ofertas/ofertas_model');
		$this->load->model('carrito_model');	
		$this->load->library('session');	
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
		$apellido 	= $this->input->post('apellido');
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
		$this->load->helper('cookie');

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

		$deviceSessionId =md5(get_cookie("PHPSESSID").microtime());

		$usernameActual = trim($op['info'][0]->name);
		
		$op['folio'] 			= $folio;
		$op['user'] 			= $user;
		$op['detalleCompra']	= $this->carrito_model->detalleCompra($folio);
		$op['compra']			= $this->carrito_model->compra($folio);
		$op['deviceSessionId']			= $deviceSessionId;
		$op['usuarioFirmado']			= $usernameActual;
		
		$this->layouts->simpleLayout('formasPago-view',$op);
	}

	function resppayworks() {

		$CONTROL_NUMBER = "";

		$MERCHANT_ID  	= "";			
		$REFERENCE  	= "";
		$CUST_REQ_DATE  	= "";
		$AUTH_REQ_DATE  	= "";
		$AUTH_RSP_DATE  	= "";
		$CUST_RSP_DATE  	= "";
		$PAYW_RESULT   	= "";
		$AUTH_RESULT  	= "";
		$PAYW_CODE  	= "";
		$AUTH_CODE   	= "";
		$TEXT   	= "";
		$CARD_HOLDER  	= "";
		$ISSUING_BANK  	= "";
		$CARD_BRAND   	= "";
		$CARD_TYPE  	= "";

		$bValor = $this->input->post('CONTROL_NUMBER');		

		if($bValor){

			$CONTROL_NUMBER  	= $this->input->post('CONTROL_NUMBER');

		    $MERCHANT_ID  	= $this->input->post('MERCHANT_ID');			
			$REFERENCE  	= $this->input->post('REFERENCE');	
			$CUST_REQ_DATE  	= $this->input->post('CUST_REQ_DATE');	
			$AUTH_REQ_DATE  	= $this->input->post('AUTH_REQ_DATE');
			$AUTH_RSP_DATE  	= $this->input->post('AUTH_RSP_DATE');
			$CUST_RSP_DATE  	= $this->input->post('CUST_RSP_DATE');
			$PAYW_RESULT   	= $this->input->post('PAYW_RESULT');
			$AUTH_RESULT  	= $this->input->post('AUTH_RESULT');
			$PAYW_CODE  	= $this->input->post('PAYW_CODE');
			$AUTH_CODE   	= $this->input->post('AUTH_CODE');
			$TEXT   	= $this->input->post('TEXT');
			$CARD_HOLDER  	= $this->input->post('CARD_HOLDER');
			$ISSUING_BANK  	= $this->input->post('ISSUING_BANK');
			$CARD_BRAND   	= $this->input->post('CARD_BRAND');
			$CARD_TYPE  	= $this->input->post('CARD_TYPE');
		}else
			{
				$bValor = $this->input->get('CONTROL_NUMBER');

				if($bValor){
				    $CONTROL_NUMBER  	= $this->input->get('CONTROL_NUMBER');

				    $MERCHANT_ID  	= $this->input->get('MERCHANT_ID');			
					$REFERENCE  	= $this->input->get('REFERENCE');	
					$CUST_REQ_DATE  	= $this->input->get('CUST_REQ_DATE');	
					$AUTH_REQ_DATE  	= $this->input->get('AUTH_REQ_DATE');
					$AUTH_RSP_DATE  	= $this->input->get('AUTH_RSP_DATE');
					$CUST_RSP_DATE  	= $this->input->get('CUST_RSP_DATE');
					$PAYW_RESULT   	= $this->input->get('PAYW_RESULT');
					$AUTH_RESULT  	= $this->input->get('AUTH_RESULT');
					$PAYW_CODE  	= $this->input->get('PAYW_CODE');
					$AUTH_CODE   	= $this->input->get('AUTH_CODE');
					$TEXT   	= $this->input->get('TEXT');
					$CARD_HOLDER  	= $this->input->get('CARD_HOLDER');
					$ISSUING_BANK  	= $this->input->get('ISSUING_BANK');
					$CARD_BRAND   	= $this->input->get('CARD_BRAND');
					$CARD_TYPE  	= $this->input->get('CARD_TYPE');
				}
			}

			//echo $CONTROL_NUMBER;
			//exit();

		if(!empty($CONTROL_NUMBER)&&$CONTROL_NUMBER!=""){

			$info 	= $this->carrito_model->infoReservasPendientesPayworks($CONTROL_NUMBER);			

			$respPW = $CONTROL_NUMBER."##".$MERCHANT_ID."##".$REFERENCE."##".$CUST_REQ_DATE."##".$AUTH_REQ_DATE."##".$AUTH_RSP_DATE."##".$CUST_RSP_DATE."##".$PAYW_RESULT."##".$AUTH_RESULT."##".$PAYW_CODE."##".$AUTH_CODE."##".$TEXT."##".$CARD_HOLDER."##".$ISSUING_BANK."##".$CARD_BRAND."##".$CARD_TYPE;
				

			if(count($info)>0){
				foreach ($info as $item) {

					$amount = $item->total;
					$reference = $REFERENCE;
					$numtc = $item->num_tc;

					switch ($PAYW_RESULT) {
						case 'A':
							//echo "Aprobada";

	                            $auth = $AUTH_CODE;
	                            $cc_name = $CARD_HOLDER;

	                            /*Aqui va el codigo que guardara y enviara la carta confirma*/
                                $s_trans_referencia = $CONTROL_NUMBER;
                                $s_trans_error = 0;
	                            $s_trans_tipo = "TC";
            					$s_trans_msg = "¡Gracias por comprar en Plaza de la Tecnología!<br>
La ficha de pago ha sido enviada a tu correo electronico.<br>Recuerda que este tiene una validez unica de 3 dias habiles.<br>
Agradecemos tu preferencia.<br>
Para mayor información comunícate al 01 800 0175-292 o 1055-5320 ext.1324<br>
Recuerda que puedes seguirnos en nuestras redes sociales <a href='https://www.facebook.com/plazadelatecnologia'>Facebook</a> y <a href='https://twitter.com/plazatecnologia'>Twitter</a> para conocer más ofertas y descuentos.<br>
¿Quieres saber más sobre lanzamientos y recomendaciones? Suscríbete a nuestro canal de <a href='https://www.youtube.com/user/PlazadelaTecnologia'>YouTube</a> y disfruta de nuestras reseñas en tecnología.";
            					$s_trans_url = "";
                                $s_trans_respuesta = $amount.'#'.$reference.'#'.$auth.'#'.$cc_name.'#'.$numtc;  

                                //Aqui guardo el xml del request y response
								//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
								$opRes = array('xml_respuesta'=> $respPW,'status'=>'pagada');	
								
								//Actualiza el monto del presupuesto
								$this->db->where('folio', $CONTROL_NUMBER);
								$this->db->update('compras', $opRes);

                                $valoresTrans = array("trans_referencia"=>$s_trans_referencia,
                                	"trans_error"=>$s_trans_error,
                                	"trans_tipo"=>$s_trans_tipo,
                                	"trans_msg"=>$s_trans_msg,
                                	"trans_url"=>$s_trans_url,
                                	"trans_id"=>'',
                                	"s_trans_respuesta"=>$s_trans_respuesta);

                                $this->session->set_userdata($valoresTrans);
								
								$user			= $this->session->userdata('user');
								$folioCompra	= $this->carrito_model->traeUltimoFolio($user['uid']);
			
								$this->send_email($folioCompra,$folioCompra,$CARD_TYPE);
								$this->borrar_carrito();

	                            redirect('carrito/pagoOK');
							break;
						case 'D':
							//echo "Declinada";
							$this->borrar_carrito();
						case 'R':
							//echo "Rechazada";
								$s_trans_referencia = '';
                                $s_trans_error = 100;
	                            $s_trans_tipo = "TC";
            					$s_trans_msg = "Su cargo ha sido denegado por el Banco emisor<br>Para mayor información comunícate al 01 800 0175-292 o 1055-5320 ext.1324 <br>";
            					$s_trans_url = "";
                                $s_trans_respuesta = '';  

                                //Aqui guardo el xml del request y response
								//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
								$opRes = array('xml_respuesta'=> $respPW,'status'=>'declinada');	
								
								//Actualiza el monto del presupuesto
								$this->db->where('folio', $CONTROL_NUMBER);
								$this->db->update('compras', $opRes);

                                $valoresTrans = array("trans_referencia"=>$s_trans_referencia,
                                	"trans_error"=>$s_trans_error,
                                	"trans_tipo"=>$s_trans_tipo,
                                	"trans_msg"=>$s_trans_msg,
                                	"trans_url"=>$s_trans_url,
                                	"trans_id"=>'',
                                	"s_trans_respuesta"=>$s_trans_respuesta);

                                $this->session->set_userdata($valoresTrans);
                                $this->borrar_carrito();                    
	                            redirect('carrito/pagoAutorizacion');
							break;						
						default:							
								$s_trans_referencia = '';
                                $s_trans_error = 300;
	                            $s_trans_tipo = "TC";
            					$s_trans_msg = "Ocurrio un error al conectarse al Gateway del Banco, no se recibio una respuesta de Autorización";
            					$s_trans_url = "";
                                $s_trans_respuesta = '';  

                                //Aqui guardo el xml del request y response
								//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
								$opRes = array('status'=>'cancelada');	
								
								//Actualiza el monto del presupuesto
								$this->db->where('folio', $CONTROL_NUMBER);
								$this->db->update('compras', $opRes);

                                $valoresTrans = array("trans_referencia"=>$s_trans_referencia,
                                	"trans_error"=>$s_trans_error,
                                	"trans_tipo"=>$s_trans_tipo,
                                	"trans_msg"=>$s_trans_msg,
                                	"trans_url"=>$s_trans_url,
                                	"trans_id"=>'',
                                	"s_trans_respuesta"=>$s_trans_respuesta);

                                $this->session->set_userdata($valoresTrans);
								$this->borrar_carrito();
	                            redirect('carrito/pagoAutorizacion');
							break;
					}
				}
			}else{
				echo "La referencia ".$CONTROL_NUMBER." ya se ha actualizado. Se evita la doble respuesta a una misma referencia";
				//redirect('carrito/');	
			}
		}else{
			echo "No estan llegando los parametros";
			//redirect('carrito/');
		}

	}

	function respuesta3d() {

		//Valido la respuesta del 3d
		$ECI  	= $this->input->post('ECI');
		$CardType  	= $this->input->post('CardType');
		$XID  	= $this->input->post('XID');
		$CAVV  	= $this->input->post('CAVV');
		$Status  	= $this->input->post('Status');
		$Message  	= $this->input->post('Message');
		
		$data = $this->session->userdata('user');  

		$AMOUNT  			= number_format($data['amount'],2,'.','');
		$CONTROL_NUMBER  	= $this->input->post('Reference3D');
		$CARD_NUMBER  		= $data['card_number'];
		$CARD_EXP  			= $data['card_exp'];
		$SECURITY_CODE  	= $data['security_code'];

		if(empty($CONTROL_NUMBER)||$CONTROL_NUMBER==""){
			echo "Llego vacio el CONTROL_NUMBER";
			exit();
		}

		$info 	= $this->carrito_model->infoReservasPendientesPayworks($CONTROL_NUMBER);
		$pago_diferido = 1;	
		$pago_diferido2 = 1;						

		if(count($info)>0){
			foreach ($info as $item) {

				$pago_diferido = $item->pago_diferido;
				$pago_diferido2 = 2;

				if($pago_diferido<10)
					$pago_diferido = "0".$pago_diferido;

			}
		}

		$resp3d = $ECI."##".$CardType."##".$XID."##".$CAVV."##".$Status."##".$Message."##".$AMOUNT."##".$CONTROL_NUMBER."##".substr($CARD_NUMBER,-4);

		//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
		$opRes = array('xml_request'=> $resp3d,'num_tc'=>substr($CARD_NUMBER,-4));	
		
		//Actualiza el monto del presupuesto
		$this->db->where('folio', $CONTROL_NUMBER);
		$this->db->update('compras', $opRes);
		
		if(intval($Status)==200){
		?>
						<html>
						<body>
						<form name="payworks3d" action="https://via.banorte.com/payw2" method="post" >
									<input type="hidden" name="MERCHANT_ID" value="7599984">
									<input type="hidden" name="USER" value="a7599984">
									<input type="hidden" name="PASSWORD" value="user9984">
									<input type="hidden" name="CMD_TRANS" value="AUTH">
									<input type="hidden" name="TERMINAL_ID" value="75999841">
									<input type="hidden" name="AMOUNT" value="<?=$AMOUNT?>">
									<input type="hidden" name="MODE" value="PRD">
									<input type="hidden" name="CONTROL_NUMBER" value="<?=$CONTROL_NUMBER?>">
									<input type="hidden" name="CARD_NUMBER" value="<?=$CARD_NUMBER?>">
									<input type="hidden" name="CARD_EXP" value="<?=$CARD_EXP?>">
									<input type="hidden" name="SECURITY_CODE" value="<?=$SECURITY_CODE ?>">									 
									<input type="hidden" name="ENTRY_MODE" value="MANUAL">
									<input type="hidden" name="RESPONSE_URL" value="https://www.plazadelatecnologia.com/carrito/resppayworks">
									<input type="hidden" name="RESPONSE_LANGUAGE" value="EN">

									<?php if(!empty($XID)&&$XID!=""){?>
									<input type="hidden" name="XID" value="<?=$XID?>">
									<?php }?>

									<?php if(!empty($CAVV)&&$CAVV!=""){?>
									<input type="hidden" name="CAVV" value="<?=$CAVV?>">
									<?php }?>

									<?php if($pago_diferido2>1 && $pago_diferido>1){?>
									<input type="hidden" name="INITIAL_DEFERMENT" value="00">
									<input type="hidden" name="PAYMENTS_NUMBER" value="<?=$pago_diferido?>">
									<input type="hidden" name="PLAN_TYPE" value="03">
									<?php }?>

									<input type="hidden" name="STATUS_3D" value="200">
									<input type="hidden" name="ECI" value="<?=$ECI?>">


						</form>
						<div align="center">Procesando transaccion, por faavor espere...</div>
						</body>
						</html>
		<?php
						echo "<script language='javascript'> document.payworks3d.submit(); </script>";
						exit();
		}else{

								$payu_date_exp = '';
                                $payu_barcode = '';
                                $payu_reference = '';   
                                $payu_url = '';

                                /*Aqui va el codigo que hara cuando sea un pago pendiente*/
                                //Aqui guardo el xml del request y response
								//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
								$opRes = array('status'=>'cancelada');	
								
								//Actualiza el monto del presupuesto
								$this->db->where('folio', $CONTROL_NUMBER);
								$this->db->update('compras', $opRes);

                                $s_trans_referencia = $CONTROL_NUMBER;
                                $s_trans_error = 0;
	                            $s_trans_tipo = "TC";

	                            if($Message==""){
	                            	switch ($Message) {	                            		                            		
	                            		case '423':
	                            			$Message="Autenticación 3D Secure no fue completada. Su reservación esta pendiente por falta de pago";
	                            			break;
	                            		case '201':
	                            		case '421':
	                            			$Message="Indica que el servicio de 3DSecure o el Servicio de Visa o MasterCard están caídos por lo que
recomendamos NO se recomienda enviar la transacción a procesar a Payworks. Su reservación esta pendiente por falta de pago";
	                            			break;
	                            		default:
	                            			$Message="Autenticación Inválida 3D Secure. Su reservación esta pendiente por falta de pago";
	                            			break;
	                            	}
	                            }else{
	                            	$Message .=". Su reservación esta pendiente por falta de pago";
	                            }
	                            
	                            $s_trans_msg = $Status." ".$Message;

            					$s_trans_url = $payu_url;
                                $s_trans_respuesta = $AMOUNT.'#'.$payu_date_exp.'#'.$payu_barcode.'#'.$payu_reference; 

                                $valoresTrans = array("trans_referencia"=>$s_trans_referencia,
                                	"trans_error"=>$s_trans_error,
                                	"trans_tipo"=>$s_trans_tipo,
                                	"trans_msg"=>$s_trans_msg,
                                	"trans_url"=>$s_trans_url,
                                	"trans_id"=>'',
                                	"s_trans_respuesta"=>$s_trans_respuesta);

                                $this->session->set_userdata($valoresTrans);

                                redirect('carrito/pagoAutorizacion');


		}


	}

	function procesarPago() {
	 /*
		$this->load->helper('payusend');		
		
		//obtiene informacion del tipo de pago
		$opPagoPayu  	= $this->input->post('opPagoPayu');
		$referencia  	= $this->input->post('folio');
		$pagaraEn=1;

		//Si es TC/Debito leo los datos
		if($opPagoPayu=="TC"){
			$tipotc 	= $this->input->post('tipotc');
			$tipotc2 		= $this->input->post('tipotc2');
			$nombreth   	= $this->input->post('nombreth');
			$numtc   	= $this->input->post('numtc');
			$mestc   	= $this->input->post('mestc');
			$aniotc   	= $this->input->post('aniotc');
			$cvvtc   	= $this->input->post('cvvtc');
			$pagaraEn   	= $this->input->post('cboPagaraEn');

			$direccion_p   	= $this->input->post('direccion');
			$ciudad_p   	= $this->input->post('ciudad');
			$pais_p   	= $this->input->post('pais');
			$cp_p   	= $this->input->post('cp');
			$divice_folio = $this->input->post('deviceId');
			
		}else{
			$tipotc 	= "";
			$tipotc2 		= "";
			$nombreth   	= "";
			$numtc   	= "";
			$mestc   	= "";
			$aniotc   	= "";
			$cvvtc   	= "";
			$direccion_p   	= '';
			$ciudad_p   	= '';
			$pais_p   	= '';
			$cp_p   	= '';
			$divice_folio = '';
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
		
		$insert = array(
			'tipotc' 			=> $tipotc,
			'tipotc2' 			=> $tipotc2,
			'nombreth' 			=> $nombreth,
			'numtc' 		=> $numtc,
			'mestc' 		=> $mestc,
			'aniotc'	=> $aniotc,
			'cvvtc'	=> $cvvtc,
			'oppagopayu'=>$opPagoPayu
		);
		
		//$this->cart->insert($insert);//guarda informacion del pago

		$info2 	= $this->carrito_model->infoComprador($referencia);		
		
		if($info2){					
			
			$cart	= $this->carrito_model->detalleCompra($referencia);			
			$descripcionVenta = '';

			foreach ($cart as $item) {
				$descripcionVenta .= '- '.$item->ofertaTitulo.' ' ;					
			}
			
			$totalCarrito = $info2[0]->total;
			if($pagaraEn == 3){
				$tempCargo = ($totalCarrito * .018) + $totalCarrito;
		 		$totalCarrito = ($totalCarrito * .0412) + $tempCargo;
			}
			if($pagaraEn == 6){
				$tempCargo = ($totalCarrito * .018) + $totalCarrito;
		 		$totalCarriro = ($totalCarrito * .0716) + $tempCargo;
			}
			if($pagaraEn == 12){
				$tempCargo = ($totalCarrito * .018) + $totalCarrito;
		 		$totalCarrito = ($totalCarrito * .1311) + $tempCargo;
			}	

			$datosPago['reference'] = $referencia;    
		    $datosPago['amount']=$totalCarrito;
		    $datosPago['cc_issue']='MXN';      
		    $datosPago['descripcion_venta']=$descripcionVenta;      
		    
		    $datosPago['res_nombre_cliente']=$info2[0]->name.' '.$info2[0]->lastname;
		    $datosPago['res_email']=$info2[0]->email;
		    $datosPago['res_telefono']=$info2[0]->telefono;
		    $datosPago['res_dir']=$info2[0]->calle;
		    $datosPago['cli_ciudad']=$info2[0]->colonia;
		    $datosPago['cli_estado']=$info2[0]->estado;
		    $datosPago['cli_pais']='MX';
		    $datosPago['cli_cp']=$info2[0]->cp;

		    $datosPago['txtAPagarEn'] = $opPagoPayu;		    

		    $datosPago['number']=$numtc;
	        $datosPago['cvv-csc']=$cvvtc;
	        $datosPago['expyear']=$aniotc;
	        $datosPago['expmonth']=$mestc;
	        $datosPago['name']=$nombreth;    
	        $datosPago['cc_type']=$tipotc2; 
	        $datosPago['divice_folio']=$divice_folio;

	        $datosPago['direccion_payer']=$direccion_p;
	        $datosPago['ciudad_payer']=$ciudad_p;
	        $datosPago['pais_payer']=$pais_p;
	        $datosPago['cp_payer']=$cp_p;

		}

		$usernameActual = trim($op['info'][0]->name);

		if($opPagoPayu=="TC"&&($tipotc2=="VISA"||$tipotc2=="MASTERCARD")){

			if($tipotc2=="VISA") $pw_typeCC = "VISA"; else $pw_typeCC="MC";

			//Cambio el pago a pendiente
			$opRes = array('payu_id'=> '','status'=>'espera de pago','payworks'=>'1','pago_diferido'=>$pagaraEn);	
			
			//Actualiza el monto del presupuesto
			$this->db->where('folio', $referencia);
			$this->db->update('compras', $opRes);
			
			//Enviar datos de tarjeta por medio de session
			$data = $this->session->userdata('user');  
    		$data['amount'] 		= $info2[0]->total;
			$data['card_number'] 	= $numtc;
			$data['card_exp'] 		= $mestc.substr($aniotc,-2);
			$data['security_code'] 		= $cvvtc;
    		$this->session->set_userdata('user', $data);
		?>
				<html>
				<body>
				<form name="payworks3d" action="https://eps.banorte.com/secure3d/Solucion3DSecure.htm" method="post" >
							<input type="hidden" name="Card" value="<?=$numtc ?>">
							<input type="hidden" name="Expires" value="<?=$mestc.'/'.substr($aniotc,-2)?>">
							<input type="hidden" name="Total" value="<?=$info2[0]->total ?>">
							<input type="hidden" name="CardType" value="<?=$pw_typeCC ?>">
							<input type="hidden" name="MerchantId" value="7599984">
							<input type="hidden" name="MerchantName" value="PLAZA DE LA TECNOLOGIA">
							<input type="hidden" name="MerchantCity" value="DF">
							<input type="hidden" name="ForwardPath" value="https://www.plazadelatecnologia.com/carrito/respuesta3d">
							<input type="hidden" name="Cert3D" value="03">
							<input type="hidden" name="Reference3D" value="<?=$referencia?>">
				</form>
				<div align="center">Procesando transaccion, por faavor espere...</div>
				</body>
				</html>
		<?php
				echo "<script language='javascript'> document.payworks3d.submit(); </script>";
				exit();
		}

		
		$op["opPagoPayu"] = $opPagoPayu;

		//Llamado a la funcion que hace la cnx con PAYU		
		
		$opRespuesta = payuSend($datosPago,true);
		//print_r($datosPago);
		//print_r($opRespuesta);
		//exit();

		if($opRespuesta){

				//Aqui guardo el xml del request y response
				//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
				$opRes = array('xml_request' 		=> $opRespuesta['payu_r']['request'],
				          'xml_respuesta' 			=> $opRespuesta['payu_r']['respuesta']
				);	
				
				//Actualiza el monto del presupuesto
				$this->db->where('folio', $referencia);
				$this->db->update('compras', $opRes);


				if( intval($opRespuesta['payu_r']['error_code'])==0){        
						$xmlRes = $opRespuesta['payu_r']['datos'];

						$respParam = $xmlRes->transactionResponse->responseCode;
						$respParam .= ':'.$xmlRes->transactionResponse->orderId;
						$respParam .= ':'.$xmlRes->transactionResponse->authorizationCode;
						$respParam .= ':'.$xmlRes->nb_error;
						$respParam .= ':'.$xmlRes->cd_error;
						$respParam .= ':'.$xmlRes->cd_response;
						$respParam .= ':'.$xmlRes->amount;
						$respParam .= ':'.$xmlRes->foliocpagos;
						$respParam .= ':'.$xmlRes->nb_merchant;

						$orderIdPayu = sprintf("%s",$xmlRes->transactionResponse->orderId);

						$santander_resp = sprintf("%s",$xmlRes->transactionResponse->responseCode);                                                
                        $payu_resp = sprintf("%s",$xmlRes->transactionResponse->state); 

                        //Valida si el pago quedo como pendiente
                        switch($payu_resp){
                            case 'PENDING':

                            	$payu_date_exp = '';
                                $payu_barcode = '';
                                $payu_reference = '';   
                                $payu_url = '';
                                
                                foreach($xmlRes->transactionResponse->extraParameters as $extraParameters) {
                                    $payu_date_exp = sprintf("%s",$extraParameters->entry[0]->date);
                                    $payu_barcode = sprintf("%s",$extraParameters->entry[1]->string[1]);
                                    $payu_reference = sprintf("%s",$extraParameters->entry[2]->int);   
                                    $payu_url = sprintf("%s",$extraParameters->entry[3]->string[1]);
                                }

                                //Aqui va el codigo que hara cuando sea un pago pendiente
                                //Aqui guardo el xml del request y response
								//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
								$opRes = array('payu_id'=> $orderIdPayu,'status'=>'espera de pago');	
								
								//Actualiza el monto del presupuesto
								$this->db->where('folio', $referencia);
								$this->db->update('compras', $opRes);

                                $s_trans_referencia = $referencia;
                                $s_trans_error = 0;
	                            $s_trans_tipo = $opPagoPayu;
	                            if($opPagoPayu=='TC'){
	                            	$s_trans_msg = "¡Gracias por comprar en Plaza de la Tecnología!<br>
Espera la confirmación de tu compra y envío de producto en las próximas 24 hrs.<br>
Agradecemos tu preferencia.<br>
Para mayor información comunícate al 01 800 0175-292 o 1055-5320 ext.1324<br>
Recuerda que puedes seguirnos en nuestras redes sociales <a href='https://www.facebook.com/plazadelatecnologia'>Facebook</a> y <a href='https://twitter.com/plazatecnologia'>Twitter</a> para conocer más ofertas y descuentos.<br>
¿Quieres saber más sobre lanzamientos y recomendaciones? Suscríbete a nuestro canal de <a href='https://www.youtube.com/user/PlazadelaTecnologia'>YouTube</a> y disfruta de nuestras reseñas en tecnología.";
                                }else{
            						$s_trans_msg = "¡Gracias por comprar en Plaza de la Tecnología!<br>
La ficha de pago ha sido enviada a tu correo electronico.<br>Recuerda que este tiene una validez unica de 3 dias habiles.<br>
Agradecemos tu preferencia.<br>
Para mayor información comunícate al 01 800 0175-292 o 1055-5320 ext.1324<br>
Recuerda que puedes seguirnos en nuestras redes sociales <a href='https://www.facebook.com/plazadelatecnologia'>Facebook</a> y <a href='https://twitter.com/plazatecnologia'>Twitter</a> para conocer más ofertas y descuentos.<br>
¿Quieres saber más sobre lanzamientos y recomendaciones? Suscríbete a nuestro canal de <a href='https://www.youtube.com/user/PlazadelaTecnologia'>YouTube</a> y disfruta de nuestras reseñas en tecnología.";
            					}

            					$s_trans_url = $payu_url;
                                $s_trans_respuesta = $info2[0]->total.'#'.$payu_date_exp.'#'.$payu_barcode.'#'.$payu_reference; 

                                $valoresTrans = array("trans_referencia"=>$s_trans_referencia,
                                	"trans_error"=>$s_trans_error,
                                	"trans_tipo"=>$s_trans_tipo,
                                	"trans_msg"=>$s_trans_msg,
                                	"trans_url"=>$s_trans_url,
                                	"trans_id"=>$orderIdPayu,
                                	"s_trans_respuesta"=>$s_trans_respuesta);

                                $this->session->set_userdata($valoresTrans);

                                redirect('carrito/pagoAutorizacion');
                            break;
                        }

                        //Valida la respuesta de la transaccion
                        switch($santander_resp){
	                        case 'APPROVED':
	                            $amount = sprintf("%s",$xmlRes->amount);
	                            $reference = sprintf("%s",$xmlRes->reference);
	                            $auth = sprintf("%s",$xmlRes->auth);
	                            $cc_name = sprintf("%s",$xmlRes->cc_name);

	                            //Aqui va el codigo que guardara y enviara la carta confirma
                                $s_trans_referencia = $referencia;
                                $s_trans_error = 0;
	                            $s_trans_tipo = "TC";
            					$s_trans_msg = "¡Gracias por comprar en Plaza de la Tecnología!<br>
La ficha de pago ha sido enviada a tu correo electronico.<br>Recuerda que este tiene una validez unica de 3 dias habiles.<br>
Agradecemos tu preferencia.<br>
Para mayor información comunícate al 01 800 0175-292 o 1055-5320 ext.1324<br>
Recuerda que puedes seguirnos en nuestras redes sociales <a href='https://www.facebook.com/plazadelatecnologia'>Facebook</a> y <a href='https://twitter.com/plazatecnologia'>Twitter</a> para conocer más ofertas y descuentos.<br>
¿Quieres saber más sobre lanzamientos y recomendaciones? Suscríbete a nuestro canal de <a href='https://www.youtube.com/user/PlazadelaTecnologia'>YouTube</a> y disfruta de nuestras reseñas en tecnología.";
            					$s_trans_url = "";
                                $s_trans_respuesta = $amount.'#'.$reference.'#'.$auth.'#'.$cc_name.'#'.substr($numtc,-4);  

                                //Aqui guardo el xml del request y response
								//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
								$opRes = array('payu_id'=> $orderIdPayu,'status'=>'pagada');	
								
								//Actualiza el monto del presupuesto
								$this->db->where('folio', $referencia);
								$this->db->update('compras', $opRes);

                                $valoresTrans = array("trans_referencia"=>$s_trans_referencia,
                                	"trans_error"=>$s_trans_error,
                                	"trans_tipo"=>$s_trans_tipo,
                                	"trans_msg"=>$s_trans_msg,
                                	"trans_url"=>$s_trans_url,
                                	"trans_id"=>'',
                                	"s_trans_respuesta"=>$s_trans_respuesta);

                                $this->session->set_userdata($valoresTrans);

	                            redirect('carrito/pagoOK');
	                            break;
	                        case 'DECLINED':
            					$s_trans_referencia = '';
                                $s_trans_error = 100;
	                            $s_trans_tipo = "TC";
            					$s_trans_msg = "Su cargo ha sido denegado por el Banco emisor<br>Para mayor información comunícate al 01 800 0175-292 o 1055-5320 ext.1324 <br>";
            					$s_trans_url = "";
                                $s_trans_respuesta = '';  

                                //Aqui guardo el xml del request y response
								//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
								$opRes = array('payu_id'=> $orderIdPayu,'status'=>'declinada');	
								
								//Actualiza el monto del presupuesto
								$this->db->where('folio', $referencia);
								$this->db->update('compras', $opRes);

                                $valoresTrans = array("trans_referencia"=>$s_trans_referencia,
                                	"trans_error"=>$s_trans_error,
                                	"trans_tipo"=>$s_trans_tipo,
                                	"trans_msg"=>$s_trans_msg,
                                	"trans_url"=>$s_trans_url,
                                	"trans_id"=>'',
                                	"s_trans_respuesta"=>$s_trans_respuesta);

                                $this->session->set_userdata($valoresTrans);
                                                    
	                            redirect('carrito/pagoAutorizacion');
	                            break;	   
	                        case 'ENTITY_DECLINED':
            					$s_trans_referencia = '';
                                $s_trans_error = 100;
	                            $s_trans_tipo = "TC";
            					$s_trans_msg = "La transacción fue declinada por el banco o por la red financiera<br>Para mayor información comunícate al 01 800 0175-292 o 1055-5320 ext.1324<br>";
            					$s_trans_url = "";
                                $s_trans_respuesta = '';  

                                //Aqui guardo el xml del request y response
								//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
								$opRes = array('payu_id'=> $orderIdPayu,'status'=>'declinada');	
								
								//Actualiza el monto del presupuesto
								$this->db->where('folio', $referencia);
								$this->db->update('compras', $opRes);

                                $valoresTrans = array("trans_referencia"=>$s_trans_referencia,
                                	"trans_error"=>$s_trans_error,
                                	"trans_tipo"=>$s_trans_tipo,
                                	"trans_msg"=>$s_trans_msg,
                                	"trans_url"=>$s_trans_url,
                                	"trans_id"=>'',
                                	"s_trans_respuesta"=>$s_trans_respuesta);

                                $this->session->set_userdata($valoresTrans);
                                                    
	                            redirect('carrito/pagoAutorizacion');
	                            break;	                         
	                        case 'ERROR':

            					$s_trans_referencia = '';
                                $s_trans_error = 300;
	                            $s_trans_tipo = "TC";
            					$s_trans_msg = "Ocurrior un problema al conectarnos al Gateway de PAYU";
            					$s_trans_url = "";
                                $s_trans_respuesta = '';  

                                //Aqui guardo el xml del request y response
								//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
								$opRes = array('payu_id'=> $orderIdPayu,'status'=>'cancelada');	
								
								//Actualiza el monto del presupuesto
								$this->db->where('folio', $referencia);
								$this->db->update('compras', $opRes);

                                $valoresTrans = array("trans_referencia"=>$s_trans_referencia,
                                	"trans_error"=>$s_trans_error,
                                	"trans_tipo"=>$s_trans_tipo,
                                	"trans_msg"=>$s_trans_msg,
                                	"trans_url"=>$s_trans_url,
                                	"trans_id"=>'',
                                	"s_trans_respuesta"=>$s_trans_respuesta);

                                $this->session->set_userdata($valoresTrans);

	                            redirect('carrito/pagoAutorizacion');
	                        default:
	                        	$s_trans_referencia = '';
                                $s_trans_error = 300;
	                            $s_trans_tipo = "TC";
            					$s_trans_msg = "Ocurrior un problema al conectarnos al Gateway de PAYU";
            					$s_trans_url = "";
                                $s_trans_respuesta = ''; 

                                //Aqui guardo el xml del request y response
								//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
								$opRes = array('payu_id'=> $orderIdPayu,'status'=>'cancelada');	
								
								//Actualiza el monto del presupuesto
								$this->db->where('folio', $referencia);
								$this->db->update('compras', $opRes); 

                                $valoresTrans = array("trans_referencia"=>$s_trans_referencia,
                                	"trans_error"=>$s_trans_error,
                                	"trans_tipo"=>$s_trans_tipo,
                                	"trans_msg"=>$s_trans_msg,
                                	"trans_url"=>$s_trans_url,
                                	"trans_id"=>'',
                                	"s_trans_respuesta"=>$s_trans_respuesta);

                                $this->session->set_userdata($valoresTrans);

	                            redirect('carrito/pagoAutorizacion');
	                    }


                        //Fin de la respuesta de la transaccion
                        
                }else{

                		$s_trans_referencia = '';
                        $s_trans_error = 200;
                        $s_trans_tipo = "TC";
    					$s_trans_msg = $opRespuesta['payu_r']['error_msg'];
    					$s_trans_url = "";
                        $s_trans_respuesta = ''; 

                        //Aqui guardo el xml del request y response
						//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
						$opRes = array('payu_id'=> '0','status'=>'cancelada');	
						
						//Actualiza el monto del presupuesto
						$this->db->where('folio', $referencia);
						$this->db->update('compras', $opRes); 

                        $valoresTrans = array("trans_referencia"=>$s_trans_referencia,
                        	"trans_error"=>$s_trans_error,
                        	"trans_tipo"=>$s_trans_tipo,
                        	"trans_msg"=>$s_trans_msg,
                        	"trans_url"=>$s_trans_url,
                        	"trans_id"=>'',
                        	"s_trans_respuesta"=>$s_trans_respuesta);

                        $this->session->set_userdata($valoresTrans);

                        redirect('carrito/pagoAutorizacion');                
                }
        }else{

            $s_trans_referencia = '';
            $s_trans_error = 300;
            $s_trans_tipo = "TC";
			$s_trans_msg = "Ocurrior un problema al conectarnos al Gateway de PAYU";
			$s_trans_url = "";
            $s_trans_respuesta = ''; 

            //Aqui guardo el xml del request y response
			//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
			$opRes = array('payu_id'=> '0','status'=>'cancelada');	
			
			//Actualiza el monto del presupuesto
			$this->db->where('folio', $referencia);
			$this->db->update('compras', $opRes);  

            $valoresTrans = array("trans_referencia"=>$s_trans_referencia,
            	"trans_error"=>$s_trans_error,
            	"trans_tipo"=>$s_trans_tipo,
            	"trans_msg"=>$s_trans_msg,
            	"trans_url"=>$s_trans_url,
            	"trans_id"=>'',
            	"s_trans_respuesta"=>$s_trans_respuesta);

            $this->session->set_userdata($valoresTrans);

        	redirect('carrito/pagoAutorizacion');
        }
		
		//print_r($opRespuesta);				
		//$this->layouts->simpleLayout('procesarPago-view',$op);
		
*/
	}	

	function pagoOk() {		
		

		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}

        $op['trans_referencia'] = $this->session->userdata('trans_referencia');
        $op['trans_error'] = $this->session->userdata('trans_error');
        $op['trans_tipo'] = $this->session->userdata('trans_tipo');
        $op['trans_msg'] = $this->session->userdata('trans_msg');
        $op['trans_url'] = $this->session->userdata('trans_url');
        $op['trans_id'] = $this->session->userdata('trans_id');
        $op['s_trans_respuesta'] = $this->session->userdata('s_trans_respuesta');
		
		$this->layouts->simpleLayout('pagoOk-view',$op);
	}
/*
	function respuestaPayuFin() {	

		$info 	= $this->carrito_model->infoReservasPendientes();
		
		$apiLogin='7fd0db4db91da36';
        $apiKey='iumk8ibsq155lfk64kpoic7b8';
        $accountId='508695';
        $merchantId='507650';  
        $urlTrans = 'https://api.payulatam.com/payments-api/4.0/service.cgi'; 
        $bandTrans = 'false'; 

        date_default_timezone_set("America/Mexico_City");
		$today = date("Y-m-d H:i:s"); 	

		if(count($info)>0){
			foreach ($info as $item) {

				$orderLlave = $item->payu_id;	
				

				$xml_datos="<?xml version='1.0' encoding='UTF-8'?>
			    <request>
			    <language>es</language>
			    <command>ORDER_DETAIL</command>
			    <merchant>
			    <apiLogin>$apiLogin</apiLogin>
			    <apiKey>$apiKey</apiKey>
			    </merchant>
			    <details class='java.util.HashMap'>
			    <entry>
			    <string>orderId</string>
			    <object class='java.lang.Integer'>$orderLlave</object>
			    </entry>
			    </details>
			    <isTest>$bandTrans</isTest>
			    </request>
			    ";
	
			    $ch = curl_init();
			    //reportes pruebas
			    //curl_setopt($ch, CURLOPT_URL, 'https://stg.api.payulatam.com/reports-api/4.0/service.cgi');
			    curl_setopt($ch, CURLOPT_URL, 'https://api.payulatam.com/reports-api/4.0/service.cgi');
			    
			    curl_setopt($ch, CURLOPT_POST, 1);
			    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			    curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/xml; charset=utf-8"));
			    curl_setopt($ch, CURLOPT_POSTFIELDS,$xml_datos);
			    
			    $resultado_c = curl_exec($ch);
			    
			    $x_xml = new SimpleXMLElement($resultado_c);

			    if($x_xml->result->payload->status=="AUTHORIZED" || $x_xml->result->payload->status=="CAPTURED"){

			    	//Aqui guardo el xml del request y response
					//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
					$opRes = array('status'=>'pagada');	
					
					//Actualiza el monto del presupuesto
					$this->db->where('payu_id', $orderLlave);
					$this->db->update('compras', $opRes);

					//Maik Aqui hay que mandar un correo avisando al cliente  

			    }//if cuando es pagaba

			    if($x_xml->result->payload->status=="DECLINED"){

			    	//Aqui guardo el xml del request y response
					//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
					$opRes = array('status'=>'declinada');	
					
					//Actualiza el monto del presupuesto
					$this->db->where('payu_id', $orderLlave);
					$this->db->update('compras', $opRes);

					//Maik Aqui hay que mandar un correo avisando al cliente 

			    }//if cuando es declinada

			    if($x_xml->result->payload->status=="CANCELLED"){

			    	//Aqui guardo el xml del request y response
					//Maik aqui debes enviar los demas datos que te comentaba de los 7 campos 
					$opRes = array('status'=>'cancelada');	
					
					//Actualiza el monto del presupuesto
					$this->db->where('payu_id', $orderLlave);
					$this->db->update('compras', $opRes);

					//Maik Aqui hay que mandar un correo avisando al cliente

			    }//if cancelada
				
			} //fin del foreach
		}
	}
*/
	function pagoAutorizacion() {		
		

		$opt = $this->uri->segment(1);
		$op['opt'] = $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}

		$s_trans_referencia = $this->session->userdata('trans_referencia');
        $s_trans_error = $this->session->userdata('trans_error');
        $s_trans_tipo = $this->session->userdata('trans_tipo');
        $s_trans_msg = $this->session->userdata('trans_msg');
        $s_trans_url = $this->session->userdata('trans_url');
        $s_trans_id = $this->session->userdata('trans_id');
        $s_trans_respuesta = $this->session->userdata('s_trans_respuesta');

        $info2 	= $this->carrito_model->infoComprador($s_trans_referencia);	

        $montoPagar =0;	    
		$nomCliente ='';
		$emailCliente = '';	
		
		if($info2){	
			   
		    $montoPagar =$info2[0]->total. ' MXN';	    
		    $nomCliente =$info2[0]->alias.' '.$info2[0]->name;
		    $emailCliente =$info2[0]->email;
		}

        $valoresR = array();

        if($s_trans_respuesta!=""){
        	$valoresR = explode("#",$s_trans_respuesta);
        }
        
        $fechaCreacion = "";
        $horaCreacion = "";
        $fechaExp = "";
        $horaExp = "";
        $barCode = "";
        $htmlPayu = '';
        $text ='';

        date_default_timezone_set('America/Mexico_City');    
    	$creacionDate = date('Y-m-d').date('\TH:i:s');

        if(count($valoresR)>0){
        	
        	$fecha_crea = explode("T",$creacionDate);
        	$fecha_exp = explode("T",$valoresR[1]);        	
        	$fechaCreacion = $fecha_crea[0];
        	$horaCreacion = $fecha_crea[1];

        	if($s_trans_tipo=='OXXO'||$s_trans_tipo=='7ELEVEN'){
	        	$fechaExp = $fecha_exp[0];
	        	$horaExp = $fecha_exp[1];
	        	$barCode = $valoresR[2];
	        }

        	$this->session->set_userdata(array("s_creacionDate"=>$creacionDate));
        }

		$op['trans_referencia'] = $s_trans_referencia;
        $op['trans_error'] = $s_trans_error;
        $op['trans_tipo'] = $s_trans_tipo;
        $op['trans_msg'] = $s_trans_msg;
        $op['trans_url'] = $s_trans_url;
        $op['s_trans_respuesta'] = $s_trans_respuesta;

        if($s_trans_error==0){

        switch($s_trans_tipo){
			      case 'OXXO':					    
					    $imgSuc = '<img id="img_oxxo" style="float: left; width: 255px; margin-left: 80px;" src="http://www.plazadelatecnologia.com/assets/graphics/payu_oxxo.png" alt="oxxo" />';
			      break;
			      case  '7ELEVEN':					    
					    $imgSuc = '<img id="eleven" style="float: left; margin-left: 80px; width: 185px; padding: 0px 20px; margin-bottom: 20px;" src="http://www.plazadelatecnologia.com/assets/graphics/payu_7eleven.png" alt="7-eleven" />';
			      break;
		}

		if($s_trans_tipo=='OXXO'||$s_trans_tipo=='7ELEVEN'){
        $htmlPayu .='<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body>	
			    <table width="700" border="0" cellpadding="2" cellspacing="0" style="border:3px solid #D93600">
			    <tr><td>
			    <img src="http://www.plazadelatecnologia.com/assets/graphics/logo-plazadelatecnologia-color.png"/>
			    <p>
			    Apreciable Cliente: <b style="font-size: 1.3em;">'.$nomCliente.'</b>
			    <br/><br/>
			    Imprime y presenta este comprobante en cualquier tienda '.$s_trans_tipo.' del país para realizar el pago por tu compra.
			    <strong>Indica al cajero de la tienda el valor exacto</strong> que figura en el presente comprobante. De lo contrario es
			    probable que no podamos validar correctamente la compra.<br/>
			    </p>
			    </td></tr>
	      		<tr><td>
	      		<table width="700" border="0" cellpadding="2" cellspacing="0">
	      		<tr><td width="290" valign="top">'.$imgSuc.'</td></tr>
			    <tr>
	      		<td width="410">
			    <table width="400" border="0" cellpadding="2" cellspacing="0" style="float: left;">
						    <tr>
						      <td colspan="4" bgcolor="#666666" style="color:#FFF; text-align: center;">DATOS PARA REALIZAR EL PAGO</td>
					    </tr>
						    <tr>
						      <td width="130" bgcolor="#CCCCCC">Número de pago:</td>
						      <td colspan="3">'.$s_trans_id.'</td>
					    </tr>
						    <tr>
						      <td bgcolor="#CCCCCC">Valor:</td>
						      <td colspan="3">$'.$montoPagar.'</td>
					    </tr>
						    <tr>
						      <td bgcolor="#CCCCCC">Nombre Comercio:</td>
						      <td colspan="3">Plaza de la Tecnología</td>
					    </tr>
						    <tr>
						      <td bgcolor="#CCCCCC">Fecha de creación:</td>
						      <td width="79">'.$fechaCreacion.'</td>
						      <td width="144" bgcolor="#CCCCCC">Hora:</td>
						      <td width="79">'.$horaCreacion.'</td>
					    </tr>
						    <tr>
						      <td bgcolor="#CCCCCC">Fecha de expiración:</td>
						      <td>'.$fechaExp.'</td>
						      <td bgcolor="#CCCCCC">Hora:</td>
						      <td>'.$horaExp.'</td>
					    </tr>
					  </table>
			    </td></tr></table>		  
				</td></tr>
				<tr><td>
					  <p>
					  ¡TEN EN CUENTA!
					  <br/>
					  <br/>
					  1) El presente recibo solo es válido para el pago que estás efectuando y se verá reflejado en la cuenta del
					  comercio 24 horas después de haberse realizado.
					  <br/><br/>
					  2) Si tienes dudas sobre tu compra comunicate al 01 800 0175-292 o 1055-5320 ext.1324 para aclarar cualquier duda sobre la compra del producto o servicio que estás pagando.
					  <br/><br/>
					  3) Una vez recibido tu pago en '.$s_trans_tipo.', se le informará a Plaza de la Tecnología, el cual procederá a hacer entrega del
					  producto/servicio que estás adquieriendo.					  
					  <br/><br/>
					  </p>	</td></tr>					
					  ';

					  define("IN_CB", true);
					  include($_SERVER["DOCUMENT_ROOT"]."/barcodegen/html/include/function.php");
					  
					  $filetype="PNG";
					  $dpi=72;
					  $scale=2;
					  $rotation=0;
					  $font_family="0";
					  $font_size=10;
					  $start="C";
					  $text=$barCode;
					  
					  registerImageKey("filetype", $filetype);
					  registerImageKey("dpi", $dpi);
					  registerImageKey("scale", $scale);
					  registerImageKey("rotation", $rotation);
					  registerImageKey("font_family", $font_family);
					  registerImageKey("font_size", 0);
					  registerImageKey("text", $text);
					  registerImageKey("start", $start);
					  registerImageKey("code", "BCGcode128");
				      
					  $finalRequest = "";
					  foreach (getImageKeys() as $key => $value) {
					      $finalRequest .= "&" . $key . "=" . urlencode($value);
					  }
					  if (strlen($finalRequest) > 0) {
					      $finalRequest[0] = "?";
					  }
					 
					  $htmlPayu .='<tr><td align="center">';

					  //if ($imageKeys["text"]!== "") { 
							if($s_trans_tipo=='OXXO'){
								      $htmlPayu .='<img width="231" height="80" src="http://www.plazadelatecnologia.com/barcodegen/html/image.php';
								      $htmlPayu .=$finalRequest;
								      $htmlPayu .='"/>';
							}else{
								      $htmlPayu .='<img width="319" height="80" src="http://www.plazadelatecnologia.com/barcodegen/html/image.php'; 
								      $htmlPayu .=$finalRequest; 
								      $htmlPayu .='"/>';
							}
					  //}					  
					  
					  $htmlPayu .='<br/>'.$barCode;
					  $htmlPayu .='</td></tr></table></body></html>';

					  

					    //Genera email para el cliente con detalle de cuenta y numero de cuenta para realizar deposito
						$this-> email->set_newline("\r\n");
						$this-> email->from('contacto@plazadelatecnologia.com', 'Plaza de la Tecnología');						
						//$emailCliente = 'mdiaz@apeplazas.com';
						$this->email->to($emailCliente); 
						//$list = array('rjuarez@apeplazas.com','contacto@plazadelatecnologia.com','mdiaz@apeplazas.com', 'jhernandezn@apeplazas.com');
						$list = array('rjuarez@apeplazas.com','mdiaz@apeplazas.com');						
						$this-> email->bcc($list);
						$this-> email->subject('Pago en '.$s_trans_tipo.' de Plaza de la Tecnología');
					    $this->email->message($htmlPayu);
					    $this->email->send();

			}

		}
		
		$this->layouts->simpleLayout('pagoAutorizacion-view',$op);
	}

	function imprimirTicket()
	{
				
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$s_trans_referencia = $this->session->userdata('trans_referencia');
        $s_trans_error = $this->session->userdata('trans_error');
        $s_trans_tipo = $this->session->userdata('trans_tipo');
        $s_trans_msg = $this->session->userdata('trans_msg');
        $s_trans_url = $this->session->userdata('trans_url');
        $s_trans_id = $this->session->userdata('trans_id');
        $s_trans_respuesta = $this->session->userdata('s_trans_respuesta');
        $creacionDate = $this->session->userdata('s_creacionDate');

        $info2 	= $this->carrito_model->infoComprador($s_trans_referencia);	
        
        $montoPagar =0;	    
		$nomCliente ='';
		$emailCliente = '';	
		
		if($info2){	
			   
		    $montoPagar =$info2[0]->total. ' MXN';	    
		    $nomCliente =$info2[0]->alias.' '.$info2[0]->name;
		    $emailCliente =$info2[0]->email;
		}

        $valoresR = array();

        if($s_trans_respuesta!=""){
        	$valoresR = explode("#",$s_trans_respuesta);
        }
        
        $fechaCreacion = "";
        $horaCreacion = "";
        $fechaExp = "";
        $horaExp = "";
        $barCode = "";
        $htmlPayu = '';
        $text ='';

        if(count($valoresR)>0){
        	
        	$fecha_crea = explode("T",$creacionDate);
        	$fecha_exp = explode("T",$valoresR[1]);        	
        	$fechaCreacion = $fecha_crea[0];
        	$horaCreacion = $fecha_crea[1];
        	$fechaExp = $fecha_exp[0];
        	$horaExp = $fecha_exp[1];
        	$barCode = $valoresR[2];
        }

		$op['trans_referencia'] = $s_trans_referencia;
        $op['trans_error'] = $s_trans_error;
        $op['trans_tipo'] = $s_trans_tipo;
        $op['trans_msg'] = $s_trans_msg;
        $op['trans_url'] = $s_trans_url;
        $op['s_trans_respuesta'] = $s_trans_respuesta;

        if($s_trans_error==0){

        switch($s_trans_tipo){
			      case 'OXXO':					    
					    $imgSuc = '<img id="img_oxxo" style="float: left; width: 255px; margin-left: 80px;" src="http://www.plazadelatecnologia.com/assets/graphics/payu_oxxo.png" alt="oxxo" />';
			      break;
			      case  '7ELEVEN':					    
					    $imgSuc = '<img id="eleven" style="float: left; margin-left: 80px; width: 185px; padding: 0px 20px; margin-bottom: 20px;" src="http://www.plazadelatecnologia.com/assets/graphics/payu_7eleven.png" alt="7-eleven" />';
			      break;
		}

        $htmlPayu .='<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body>	
			    <table width="700" align="center" border="0" cellpadding="2" cellspacing="0" style="border:3px solid #ccc">
			    <tr><td>
			    <p>
			    Apreciable Cliente: '.$nomCliente.'
			    <br/><br/>
			    Imprime y presenta este comprobante en cualquier tienda '.$s_trans_tipo.' del país para realizar el pago por tu compra.
			    <strong>Indica al cajero de la tienda el valor exacto</strong> que figura en el presente comprobante. De lo contrario es
			    probable que no podamos validar correctamente la compra.<br/><br/>
			    </p>
			    </td></tr>
	      		<tr><td>
	      		<table width="700" border="0" cellpadding="2" cellspacing="0">
			    <tr><td width="290" valign="top">'.$imgSuc.'</td>
	      		<td width="410">
			    <table width="400" border="0" cellpadding="2" cellspacing="0" style="float: left;">
						    <tr>
						      <td colspan="4" bgcolor="#666666" style="color:#FFF; text-align: center;">DATOS PARA REALIZAR EL PAGO</td>
					    </tr>
						    <tr>
						      <td width="130" bgcolor="#CCCCCC">Número de pago:</td>
						      <td colspan="3">'.$s_trans_id.'</td>
					    </tr>
						    <tr>
						      <td bgcolor="#CCCCCC">Valor:</td>
						      <td colspan="3">'.$montoPagar.'</td>
					    </tr>
						    <tr>
						      <td bgcolor="#CCCCCC">Nombre Comercio:</td>
						      <td colspan="3">PASAJE DE ELECTRONICA EL SALVADOR SA DE CV</td>
					    </tr>
						    <tr>
						      <td bgcolor="#CCCCCC">Fecha de creación:</td>
						      <td width="79">'.$fechaCreacion.'</td>
						      <td width="144" bgcolor="#CCCCCC">Hora:</td>
						      <td width="79">'.$horaCreacion.'</td>
					    </tr>
						    <tr>
						      <td bgcolor="#CCCCCC">Fecha de expiración:</td>
						      <td>'.$fechaExp.'</td>
						      <td bgcolor="#CCCCCC">Hora:</td>
						      <td>'.$horaExp.'</td>
					    </tr>
					  </table>
			    </td></tr></table>		  
				</td></tr>
				<tr><td>
					     
					  
					  <p>
					  ¡TEN EN CUENTA!
					  <br/>
					  <br/>
					  1) El presente recibo solo es válido para el pago que estás efectuando y se verá reflejado en la cuenta del
					  comercio 24 horas después de haberse realizado.
					  <br/><br/>
					  2) Si tienes dudas sobre tu compra comunicate con PASAJE DE ELECTRONICA EL SALVADOR SA DE CV, es responsababilidad del Comercio aclarar cualquier reclamo sobre la compra del producto o servicio que estás pagando.
					  <br/><br/>
					  3) Una vez recibido tu pago en '.$s_trans_tipo.', PayU informará al comercio PASAJE DE ELECTRONICA EL SALVADOR SA DE CV, el cual procederá a hacer entregar del
					  producto/servicio que estás adquieriendo.					  
					  <br/><br/>
					  </p>	</td></tr>						
					  ';

					  define("IN_CB", true);
					  include($_SERVER["DOCUMENT_ROOT"]."/barcodegen/html/include/function.php");
					  
					  $filetype="PNG";
					  $dpi=72;
					  $scale=2;
					  $rotation=0;
					  $font_family="0";
					  $font_size=10;
					  $start="C";
					  $text=$barCode;
					  
					  registerImageKey("filetype", $filetype);
					  registerImageKey("dpi", $dpi);
					  registerImageKey("scale", $scale);
					  registerImageKey("rotation", $rotation);
					  registerImageKey("font_family", $font_family);
					  registerImageKey("font_size", 0);
					  registerImageKey("text", $text);
					  registerImageKey("start", $start);
					  registerImageKey("code", "BCGcode128");
				      
					  $finalRequest = "";
					  foreach (getImageKeys() as $key => $value) {
					      $finalRequest .= "&" . $key . "=" . urlencode($value);
					  }
					  if (strlen($finalRequest) > 0) {
					      $finalRequest[0] = "?";
					  }
					 
					  $htmlPayu .='<tr><td align="center">';

					  //if ($imageKeys["text"]!== "") { 
							if($s_trans_tipo=='OXXO'){
								      $htmlPayu .='<img width="231" height="80" src="http://www.plazadelatecnologia.com/barcodegen/html/image.php';
								      $htmlPayu .=$finalRequest;
								      $htmlPayu .='"/>';
							}else{
								      $htmlPayu .='<img width="319" height="80" src="http://www.plazadelatecnologia.com/barcodegen/html/image.php'; 
								      $htmlPayu .=$finalRequest; 
								      $htmlPayu .='"/>';
							}
					  //}					  
					  
					  $htmlPayu .='<br/>'.$barCode;
					  $htmlPayu .='</td></tr></table></body></html>';

					  echo $htmlPayu;

		}
	}

	function enviar_aqui()
	{
		/*Está funcion es unicamente si queremos utilizar un checkout basico*/
		/*function procesarMercadoPago($referencia){
		//$referencia = $this->input->post('folioId');
		$CI = get_instance();
		$mp = $CI->load->library('MP', array('1415841976065959', 'PIZgZKXhAggO1VuFbN6tLycEaa1sdV8O'));
		//$mp = new MP('1415841976065959', 'PIZgZKXhAggO1VuFbN6tLycEaa1sdV8O');
		
		$detallecompra = $CI->carrito_model->detallecompra($referencia);
		var_dump($detallecompra);
		$totalCompra = 0;
		
		foreach($detalleCompra as $detalle){
			
		 	$totalCompra += $detalle->ofertaPrecio;
			
		}
		
		/*Datos para mercado pago*
		$preference_data = array(
    								"items" => array( 
    													array("id" => $referencia,
    														  "title" => "Compra Plaza de la Tecnología", 
    														  "quantity" => 1, 
    														  "currency_id" => "MXN", 
    														  "unit_price" => $totalCompra 
		   												)
												)
    								#"notification_url" => "http://.php");
    						);
		$preference = $mp->create_preference($preference_data);
		
		return $preference;
		
		}*/
		
		
		$this->load->helper('cookie');

		$folio		= $this->input->post('folio');	
		$idSitio 	= $this->input->post('idSitio');
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/jquery.easing.1.3.js');
		
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

		$usernameActual = trim($op['info'][0]->name);

		$deviceSessionId =md5(get_cookie("PHPSESSID").microtime());
		
		$op['folio'] 			= $folio;
		$op['user'] 			= $user;
		$op['detalleCompra']	= $this->carrito_model->detalleCompra($folio);
		$op['compra']			= $this->carrito_model->compra($folio);
		$op['deviceSessionId']	= $deviceSessionId;
		$op['usuarioFirmado']	= $usernameActual;
		
		$op['tiendasConveniencia'] = $this->data_model->cargarTiendasConveniencia();
		
		$op['deviceSessionId']	= $deviceSessionId;
		$op['usuarioFirmado']	= $usernameActual;
		
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
		$opt 		= $this->uri->segment(1);
		$op['opt'] 	= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();

		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$paypal 	= $this->load->library("paypal");
		$respuesta 	= $paypal::getResponse();
		
		if ($respuesta) {
			
			$folioCompra	= $this->carrito_model->traeUltimoFolio($user['uid']);
			$referencia 	= $respuesta['transactionID'];
			$importe		= $respuesta['total'];
			$tipoPago		= 'PayPal';
			
		 	$pago = array('fechaPago' 		=> date('Y-m-d'),
				          'status' 			=> 'pagado',
				          'metodoPago'		=> 'paypal',
				          'payu_id'			=> $referencia
			);	
			//Actualiza el monto del presupuesto
			$this->db->where('folio', $folioCompra);
			$this->db->update('compras', $pago); 
			
			//$this->email_confirmation($folioCompra, $importe, $tipoPago);
			$this->send_email($folioCompra,$folioCompra,"paypal");
			$this->borrar_carrito();
					
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
		$list = array('rjuarez@apeplazas.com','contacto@plazadelatecnologia.com','mdiaz@apeplazas.com', 'jhernandezn@apeplazas.com');
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
	
		