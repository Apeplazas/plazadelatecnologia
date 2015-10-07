<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gana_con_hp extends MX_Controller {
	
	function gana_con_hp()
	{
		parent::__construct();
		$this->form_validation->CI = & $this;
		$this->load->model('inicio/data_model');
		$this->load->model('ofertas/ofertas_model');
		$this->load->model('hp_model');
		
	}
	
	function index()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery-datepicker.js')
					  ->add_include('assets/css/dinamicaHp.css')
					  ->add_include('assets/css/tables.css');
					  
		$op['ciudades']    		= $this->data_model->cargarCiudades();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Vista//
		$this->layouts->light('inicio-view' ,$op);
	}
	
	function acceso()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery-datepicker.js')
					  ->add_include('assets/css/dinamicaHp.css')
					  ->add_include('assets/css/tables.css');
					  
		$op['ciudades']    		= $this->data_model->cargarCiudades();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Vista//
		$this->layouts->light('acceso-view' ,$op);
	}
	
	function premios()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery-datepicker.js')
					  ->add_include('assets/css/dinamicaHp.css')
					  ->add_include('assets/css/tables.css');
					  
		$op['ciudades']    	= $this->data_model->cargarCiudades();
		
		
		//Vista//
		$this->layouts->light('premios-view' ,$op);
	}
	
	function numeroLocal($str)
	{
		if (!$str) {
			$this->form_validation->set_message('numeroLocal', '%s');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	function nombreLocal($str)
	{
		if (!$str) {
			$this->form_validation->set_message('nombreLocal', '%s');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	function razonSocial($str)
	{
		if (!$str) {
			$this->form_validation->set_message('razonSocial', '%s');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	function contra($str)
	{
		if (!$str) {
			$this->form_validation->set_message('contra', '%s');
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	function email($email)
	{
		$mail = $this->hp_model->confirmaEmail($email);
			
		if ($mail)
		{
			$this->form_validation->set_message('email', 'Este correo ya se encuentra registrado');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function registro()
	{	
		
		$this->form_validation->set_rules('numeroLocal', 'Escríbe tú numero de local', 'callback_numeroLocal');
		$this->form_validation->set_rules('nombreLocal', 'Que marca o nombre de local tienes', 'callback_nombreLocal');
		$this->form_validation->set_rules('razonSocial', 'Proporciona tú Razón Social', 'callback_razonSocial');
		$this->form_validation->set_rules('email', 'Se requiere un email', 'trim|required|valid_email|callback_email');
		$this->form_validation->set_rules('contra', 'Escriba una contraseña', 'callback_contra');
		
		$plaza        = $this->input->post('plazasParticipantes');
		$numeroLocal  = $this->input->post('numeroLocal');
		$nombreLocal  = $this->input->post('nombreLocal');
		$razonSocial  = $this->input->post('razonSocial');
		$contrasenia  = $this->input->post('contra');
		$email        = $this->input->post('email');
		$hash         = sha1(mt_rand(10000,99999).time().$email);
		
		if ($this->form_validation->run($this) == FALSE)
		{
			//Genera metatags
			$uno = $this->uri->segment(1);
			$op['opt'] = $this->data_model->cargarOptimizacion($uno);
			
			//Carga el javascript para jquery//
			$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery-datepicker.js')
					  ->add_include('assets/css/dinamicaHp.css')
					  ->add_include('assets/css/tables.css');
					  
			//validacion para identificar tipo de usuario y desglosar info
			$user				= $this->session->userdata('user');
			$op['info']			= array();
			
			if ($user['uid'] != '') {
				$tipo = 'info_'.$user['tipoUsuario'];
				$op['info']	= $this->data_model->$tipo($user['uid']);
			}
			
			//Carga el javascript y CSS //
			$this->layouts->add_include('assets/js/jquery-ui.js')
						  ->add_include('assets/js/jquery-ui.min.js');
						  
			$this->layouts->light('registro-view', $op);
		}
		else
		{
			//Valida la informacion que se inserta y revisa inserciones
			$cadena = $numeroLocal." ".$nombreLocal." ".$contrasenia." ".$email." ".$razonSocial;
			preg_match("/\b(href|declare|select|or|OR|limit|LIMIT|somebody|\:|http|www)\b/",$cadena,$regis);
				
			if(count($regis) == 0){
			$registro = array(
							  'plazaParticipante'    => $plaza,
							  'numeroLocal'          => $numeroLocal,
							  'nombreLocal'          => $nombreLocal,
							  'razonSocial'          => $razonSocial,
							  'correoElectronico'    => $email,
							  'contrasenia'          => sha1($contrasenia),
							  'hash'                 => $hash,
							  'terminosCondiciones'  => 'acepto'
							  
							  );
							  
			$this->db->insert('dinamicaHp', $registro);
			
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from('noresponder@plazadelatecnologia.com', 'HP  - Gana Vendiendo Articulos HP');
			$this->email->to($email);
			$this->email->cc('atencionaclientes@plazadelatecnologia.com');
			$this->email->subject('Bienvenido a nuestra dinámica | Gana vendiendo productos HP');
			$this->email->message('
<html>
<head>
<meta charset="utf-8">
<title>Bienvenido a nuestra dinámica "Gana Vendiendo Artículos de Impresión HP"</title>
<style>
	h1, h2{font-size:20px; font-weight:700; margin:25px 0 3px}
	body{font-family:helvetica,arial,sans-serif; background-color:#f4f5f7; font-size:.8em; line-height:20px; color:#555}
	.wrap{margin:10px auto; width:500px; border:1px solid #ccc; padding:20px 40px; background-color:#fff; border-top:10px solid #c30}
	.wrapTwo{margin:10px auto; width:500px; border:1px solid #ccc; padding:20px 40px; background-color:#fff; border-top:10px solid #c30}
	a{color:#c30}
	#regEmail{display:inline; width:200px; margin:40px auto; height:28px; text-align:center; background-color: #B81C2D; color:#fff; text-transform:uppercase; font-size:16px; padding:12px 30px 9px; border-radius:6px; text-decoration:none;}
	li{list-style:none}
	ul{margin:0; padding:0}
	#foot{color:#777; font-size:10px;b order-top:1px solid #ccc; padding:10px 0}
	em{color:#c30; font-style: normal}
</style>
</head>
<body style="background-color:#eee;">
<table cellpadding="40" align="center" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px font-family:helvetica,arial,sans-serif; border:1px solid #ccc; color:#555; margin-top:30px;">
  <tr>
    <td>
    <div class="wrap">
    <a href="http://www.plazadelatecnologia.com/gana_con_hp/registro"><img src="http://www.plazadelatecnologia.com/assets/graphics/logo-plazadelatecnologia-color.png" alt="Plazadelatecnologia Gana Vendiendo Productos HP" /></a>
    <h1>Hola '.$nombreLocal.'!</h1>
    <p>Bienvenido a nuestra dinámica <em>Gana Vendiendo Productos HP.</em><br><br>Usted acaba de registrarse para participar por diferentes premios al vender productos HP. Estamos muy contentos de recibir su registro. Para completar su registro, necesitamos confirmar que el proceso no fue realizado por ningún robot. Por favor dé click en el botón</p>
    <br>
    <a id="regEmail" class="mb" title="Complete su registro" href="http://www.plazadelatecnologia.com/gana_con_hp/hashActivation/'.$hash.'"><img src="http://www.plazadelatecnologia.com/assets/graphics/completesuregistroHp.png" alt="Complete su registro" /></a>
    <br><br>
    <p>Una vez confirmado su registro, comience subiendo los tickets de venta en nuestra plataforma para empezar a acumular puntos y pueda ganar alguno de los premios disponibles.
Para cualquier duda acerca de nuestros términos y condiciones, dé click aquí  <a href="http://www.plazadelatecnologia.com/terminosycondiciones"> Terminos y Condiciones</a>, Nuestros 3 consejos serían.</p>
    <h2>Le recomendamos</h2>
    <ul>
      <li>Informarse bien de los beneficios que conlleva comprar productos HP.</li>
	  <li>Tener producto HP disponible para venta.</li>
	  <li>Siempre ofrecer la marca HP a sus clientes diarios.</li>
    </ul>
    <p>Gracias por participar. Seguiremos en contacto por medio del correo electrónico atencionaclientes@plazadelatecnologia.com Para nosotros será un placer aclarar cualquier duda o pregunta referente a la dinámica.</p>
    <p id="foot"Para cualquier pregunta de click aquí <a href="http://www.facebook.com/plazadelatecnologia">facebook</a> or <a href="http://www.plazadelatecnologia.com/contacto">contacto</a></p>
    </div>
    </td>
  </tr>
</table>

</body>
</html>
			 ');
				if($this->email->send())
					{
						$this->session->set_flashdata('msg','<div><img src="http://www.plazadelatecnologia.com/assets/graphics/sendEmail.png" alt="Se envio a su correo un email de confirmaci´n" /></div><br><div class="cWhite">Se ha enviado a su correo electronico un email de confirmación para completar el proceso de su registro.<br> Gracias por participar.</div>');
						redirect('gana_con_hp/gracias');
					}
				else{
						echo 'Algo paso';
					}
			// Si estan tratando de agregar codigo o spameando el formulario les pinto .|.
			}
			else
			{ 
				echo '.|.  - Looser';
			}	

		}
	}
	
	function hashActivation($hash)
	{
		$hash	= trim($this->uri->segment(3));
		$query	= $this->db->query("SELECT * from dinamicaHp WHERE hash='$hash'");
		
		if( $query->num_rows()>0 ){
			foreach ($query->result() as $row){
				$numeroLocal    = $row->numeroLocal;
				$nombreLocal    = $row->nombreLocal;
				$plaza          = $row->plazaParticipante;
				$razonSocial    = $row->razonSocial;
				$email          = $row->correoElectronico;
				$status         = $row->status;
				$localID        = $row->localID;
			}
			
			$data = array(
               'status' => 'Activado'
            );
	        $this->db->where('localID', $localID);
	        $status = $this->db->update('dinamicaHp', $data);
	        
			if ($status){
				$data['usuarioHP'] = array(
	              'numeroLocal'    => $numeroLocal,
	              'nombreLocal'    => $nombreLocal,
	              'plaza'          => $plaza,
	              'razonSocial'    => $razonSocial,
	              'email'          => $email,
	              'localID'        => $localID,
	              'status'         => 'Activado',
	              'is_logged_in'   => true
	            );
	            
			//guardamos los datos en la sesion
			$this->session->set_userdata($data);
			// Enviamos a area de locatarios
			redirect('ganaconhp_acceso');
			
			}
			else{
			$this->session->set_flashdata('msgSuc','<div><img src="http://www.plazadelatecnologia.com/assets/graphics/sadFace.png" alt="" /></div><br><br><div class="cWhite">Algo ocurrio en el proceso de su registro!,<br> por favor<a href="http://www.plazadelatecnologia.com/gana_con_hp">Intenta registrando de nuevo.</a> o <a href="http://www.plazadelatecnologia.com/contacto">Contáctanos</a></div>');
				redirect('gana_con_hp');
			}
			
		}
		else{
			$this->session->set_flashdata('msgSuc','<div><img src="http://www.plazadelatecnologia.com/assets/graphics/sadFace.png" alt="" /></div><br><br><div class="cWhite">Algo ocurrio en el proceso de su registro!,<br> por favor<a href="http://www.plazadelatecnologia.com/gana_con_hp">Intenta registrando de nuevo.</a> o <a href="http://www.plazadelatecnologia.com/contacto">Contáctanos</a></div>');
				redirect('gana_con_hp');
		}
		
		
	}
	
	function verificaUrl()
	{
		$var       = $_POST['filtro'];
		$base = base_url();
		
		$verificado = $this->hp_model->confirmaEmail($var);
		
		if ($verificado){
			$aviso = "<img src='$base/assets/graphics/alert.png' /> <p>Este email ya se encuentra registrado.</p>";
				 
			echo $aviso;
		}
	}
	
	function gracias()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery-datepicker.js')
					  ->add_include('assets/css/dinamicaHp.css')
					  ->add_include('assets/css/tables.css');
					  
		$op['ciudades']    		= $this->data_model->cargarCiudades();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Vista//
		$this->layouts->light('gracias' ,$op);
	}
	
	function validarAcceso()
	{
		$email          = $this->input->post('correoElectronico');
		$contrasenia  	= $this->input->post('contrasenia');
		
		$l = $this->hp_model->validaEmail($email, $contrasenia);	
		
		if ($l) {
			foreach ($l as $row){
				$numeroLocal    = $row->numeroLocal;
				$nombreLocal    = $row->nombreLocal;
				$plaza          = $row->plazaParticipante;
				$razonSocial    = $row->razonSocial;
				$email          = $row->correoElectronico;
				$status         = $row->status;
				$localID        = $row->localID;
			}
				
			$data['usuarioHP'] = array(
				  'numeroLocal'    => $numeroLocal,
	              'nombreLocal'    => $nombreLocal,
	              'plaza'          => $plaza,
	              'razonSocial'    => $razonSocial,
	              'email'          => $email,
	              'localID'        => $localID,
	              'is_logged_in'   => true
	        );
	        //guardamos los datos en la sesion
	        $this->session->set_userdata($data);
	            
	        redirect('ganaconhp_acceso');
	    }
	    else {
			$this->session->set_flashdata('msg','<p class="msg">El email ó la contraseña han sido incorrectos,<br> intenta de nuevo.</p>');
			redirect('gana_con_hp');
		}
	}
	
	function terminosycondiciones()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/autoNumeric-1.7.1.min.js')
					  ->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery-datepicker.js')
					  ->add_include('assets/css/dinamicaHp.css')
					  ->add_include('assets/css/tables.css');
					  
		$op['ciudades']    		= $this->data_model->cargarCiudades();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Vista//
		$this->layouts->light('terminosycondiciones-view' ,$op);
	}
	
	function salir()
	{
		$this->session->sess_destroy();
		redirect('');
	}
	
	function privacidad()
	{
		//Optimizacion y conexion de tags para SEO//
		$opt         		= $this->uri->segment(1);
		$op['opt']    		= $this->data_model->cargarOptimizacion($opt);
		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		//Carga el javascript para jquery//
		$this->layouts->add_include('assets/js/autoNumeric-1.7.1.min.js')
					  ->add_include('assets/js/jquery-ui.js')
					  ->add_include('assets/js/jquery-datepicker.js')
					  ->add_include('assets/css/dinamicaHp.css')
					  ->add_include('assets/css/tables.css');
					  
		$op['ciudades']    		= $this->data_model->cargarCiudades();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Vista//
		$this->layouts->light('privacidad' ,$op);
	}
}