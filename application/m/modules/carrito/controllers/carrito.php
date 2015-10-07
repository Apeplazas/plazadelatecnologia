<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carrito extends MX_Controller {
	
	function carrito()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('inicio/data_model');
		$this->load->model('registrate/registrate_model');
		$this->load->model('inicio/ofertas_model');
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
		$this->layouts->mobileSencillo('carrito-view' ,$op);
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
		$this->layouts->mobileSencillo('registrate-view' ,$op);
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
			header('Location: http://m.plazadelatecnologia.com/carrito');
		}else {
			$this->session->set_flashdata('msg','<div class="msg">Lo sentimos, esta cuenta de email ya esta registrada.</div>');
			header('Location: http://m.plazadelatecnologia.com/carrito/registrate/');
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
		header('Location: '.$back);
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
		header('Location: http://m.plazadelatecnologia.com/carrito/entrega/'.$folio);
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
		
		$this->layouts->mobileSencillo('agregarSitio-view',$op);
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
		
		$op['folio'] 			= $folio;
		$op['detalleCompra']	= $this->carrito_model->detalleCompra($folio);
		$op['compra']			= $this->carrito_model->compra($folio);
		$op['deviceSessionId']			= $deviceSessionId;
		
		$this->layouts->mobileSencillo('formasPago-view',$op);
	}

	function pago_tc()
	{
		$this->load->helper('cookie');
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
		$op['deviceSessionId']	= $deviceSessionId;
		$op['folio'] 			= $this->uri->segment(3);
		$op['detalleCompra']	= $this->carrito_model->detalleCompra($this->uri->segment(3));
		$op['compra']			= $this->carrito_model->compra($this->uri->segment(3));
		
		$this->layouts->mobileSencillo('formTC-view',$op);
	}	

	function procesarPago() {

		$this->load->helper('payusend');		
		
		//obtiene informacion del tipo de pago
		$opPagoPayu  	= $this->input->post('opPagoPayu');
		$referencia  	= $this->input->post('folio');

		//Si es TC/Debito leo los datos
		if($opPagoPayu=="TC"){
			$tipotc 	= $this->input->post('tipotc');
			$tipotc2 	= $this->input->post('tipotc2');
			$nombreth   = $this->input->post('nombreth');
			$numtc   	= $this->input->post('numtc');
			$mestc   	= $this->input->post('mestc');
			$aniotc   	= $this->input->post('aniotc');
			$cvvtc   	= $this->input->post('cvvtc');

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

			$datosPago['reference'] = $referencia;    
		    $datosPago['amount']=$info2[0]->total;
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

                                /*Aqui va el codigo que hara cuando sea un pago pendiente*/
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
                                
								header('Location: http://m.plazadelatecnologia.com/carrito/pagoAutorizacion');
                                
                            break;
                        }

                        //Valida la respuesta de la transaccion
                        switch($santander_resp){
	                        case 'APPROVED':
	                            $amount = sprintf("%s",$xmlRes->amount);
	                            $reference = sprintf("%s",$xmlRes->reference);
	                            $auth = sprintf("%s",$xmlRes->auth);
	                            $cc_name = sprintf("%s",$xmlRes->cc_name);

	                            /*Aqui va el codigo que guardara y enviara la carta confirma*/
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
								
								header('Location: http://m.plazadelatecnologia.com/carrito/pagoOK');
	                            
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
                                                    
	                            header('Location: http://m.plazadelatecnologia.com/carrito/pagoAutorizacion');
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
                                                    
								header('Location: http://m.plazadelatecnologia.com/carrito/pagoAutorizacion');					
	                            
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

	                            header('Location: http://m.plazadelatecnologia.com/carrito/pagoAutorizacion');
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

	                            header('Location: http://m.plazadelatecnologia.com/carrito/pagoAutorizacion');
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

                        header('Location: http://m.plazadelatecnologia.com/carrito/pagoAutorizacion');                
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

        	header('Location: http://m.plazadelatecnologia.com/carrito/pagoAutorizacion');
        }
		
		//print_r($opRespuesta);				
		//$this->layouts->simpleLayout('procesarPago-view',$op);
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
		
		$this->layouts->mobileSencillo('pagoOk-view',$op);
	}

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
			    <table width="700" border="0" cellpadding="2" cellspacing="0" style="border:3px solid #ccc">
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
		
		$this->layouts->mobileSencillo('pagoAutorizacion-view',$op);
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
		$this->load->helper('cookie');

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

		$deviceSessionId =md5(get_cookie("PHPSESSID").microtime());
		
		$op['folio'] 			= $folio;
		$op['detalleCompra']	= $this->carrito_model->detalleCompra($folio);
		$op['compra']			= $this->carrito_model->compra($folio);
		$op['deviceSessionId']	= $deviceSessionId;
		
		$this->layouts->mobileSencillo('formasPago-view',$op);
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
}
	
		