<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MX_Controller {
	
	function ajax()
	{
		parent::__construct();
		$this->load->model('ajax/ajax_model');
		$this->load->model('inicio/data_model');
		$this->load->model('inicio/ofertas_model');
	}
	
	function inboxNotificacion()
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$tipoInbox = 'cargarInbox_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Manda informacion de contador notificaciones /////////
		$op['notificaciones']	= $this->ajax_model->$tipoInbox($user['uid']);

		$this->load->view('ajax/notificationsInbox',$op);
		
	}
	
	function addVendedor($var)
	{		
		$date = date("Y-m-d");
		$id = $this->uri->segment(3);
		
		$update = array('asignado' => $_POST['update_value'], 'fechaAsignado' => $date);
				$this->db->where('contactoID', $id);
				$this->db->update('contactoRentadelocales', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function updateStat($var)
	{		
		$date = date("Y-m-d");
		$id = $this->uri->segment(3);
		
		$update = array('status' => $_POST['update_value'], 'finProceso' => $date);
				$this->db->where('contactoID', $id);
				$this->db->update('contactoRentadelocales', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function inboxUsuario()
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}

		
		//Manda informacion de contador notificaciones /////////
		$op['notificaciones']	= $this->ajax_model->cargarInbox($user['uid']);

		$this->load->view('ajax/notificationsInbox',$op);
		
	}
	
	function cargaEmailsUsuario()
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Carga inbox locales//
		$op['inbox'] = $this->usuario_model->cargarInbox($user['uid']);
		
		$this->load->view('ajax/cargaEmails',$op);
	}
	
	function ventaNotificacion()
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//Manda informacion de contador notificaciones /////////
		$op['venConf']	= $this->ajax_model->cargarCuentaVenta($user['uid']);

		$this->load->view('ajax/notificacionVenta',$op);
		
	}
	
	function editarDescripcion()
	{		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$leido = array('localDescripcion' => $_POST['update_value'],);
				$this->db->where('localID', $user['uid']);
				$this->db->update('locatarios', $leido);
		
		
		if (!$_POST['update_value']){
			$actualiza 	= 	array('ofertaStatus'=>	'No Publicado');
			$this->db->where('localID', $user['uid']);
			$this->db->where('ofertaID', $ofertaID);
			$this->db->update('locatariosOfertas', $actualiza);
			
			echo'Producto sin descripción, si no proporcion una no sera publicado';
		}
		else{
			echo nl2br($_POST['update_value']);
		}
	}
	
	function statusProducto()
	{		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$status		= $_POST['update_value'];
		$ofertaID	= $this->uri->segment(3);
		
		if($ofertaID){
			$update = array('estadoProducto' => $status,);
			$this->db->where('localID', $user['uid']);
			$this->db->where('ofertaID', $ofertaID);
			$this->db->update('locatariosOfertas', $update);
			
			echo $_POST['update_value'];
		}
		
	}
	
	function garantias()
	{		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$status		= $_POST['update_value'];
		$ofertaID	= $this->uri->segment(3);
		
		if($ofertaID){
			$update = array('garantia' => $status,);
			$this->db->where('localID', $user['uid']);
			$this->db->where('ofertaID', $ofertaID);
			$this->db->update('locatariosOfertas', $update);
			
			echo $_POST['update_value'];
		}
		
	}
	
	function colorProducto()
	{		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$status		= $_POST['update_value'];
		$ofertaID	= $this->uri->segment(3);
		
		if($ofertaID){
			$update = array('color' => $status,);
			$this->db->where('localID', $user['uid']);
			$this->db->where('ofertaID', $ofertaID);
			$this->db->update('locatariosOfertas', $update);
			
			echo $_POST['update_value'];
		}
		
	}
	
	function addTematica($ofertaID)
	{		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$tematicaNombre	= $_POST['update_value'];
		$ofertaID		= $this->uri->segment(3);
		$tematica    	= $this->ofertas_model->obtenerIdTematica($tematicaNombre);
		
		if($tematica){
			$update = array('tematicaID' => $tematica[0]->tematicaID,);
			$this->db->where('localID', $user['uid']);
			$this->db->where('ofertaID', $ofertaID);
			$this->db->update('locatariosOfertas', $update);
			
			echo nl2br($_POST['update_value']);
		}
		else if (!$_POST['update_value']){
			$actualiza 	= 	array('ofertaStatus'=>	'No Publicado', 'tematicaID'=>	'0');
			$this->db->where('localID', $user['uid']);
			$this->db->where('ofertaID', $ofertaID);
			$this->db->update('locatariosOfertas', $actualiza);
			
			echo'Su producto no contiene tematica, seleccione una opcion para poder publicarlo.';
		}
		else{
			echo nl2br($_POST['update_value']);
		}
		
	}
	
	function editProDesc($ofertaID)
	{		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//obtiene el identificador de la oferta
		$oferta = $this->uri->segment(4);
		
		$update = array('ofertaDescripcion' => $_POST['update_value'],);
				$this->db->where('localID', $user['uid']);
				$this->db->where('ofertaID', $ofertaID);
				$this->db->update('locatariosOfertas', $update);
		
		if (!$_POST['update_value']){
			$actualiza 	= 	array('ofertaStatus'=>	'No Publicado');
			$this->db->where('localID', $user['uid']);
			$this->db->where('ofertaID', $ofertaID);
			$this->db->update('locatariosOfertas', $actualiza);
			
			echo'Producto sin descripción, si no proporcion una no sera publicado';
		}
		else{
			echo nl2br($_POST['update_value']);
		}
	}
	
	function editStatusCampanias($campaniaID)
	{		
		//obtiene el identificador de la oferta
		$campaniaID = $this->uri->segment(3);
		
		$update = array('status' => $_POST['update_value'],);
				$this->db->where('campaniaID', $campaniaID);
				$this->db->update('campanias', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editStatusMail($mailID)
	{		
		//obtiene el identificador de la oferta
		$mailID = $this->uri->segment(3);
		
		$update = array('mailStatus' => $_POST['update_value'],);
				$this->db->where('mailID', $mailID);
				$this->db->update('mail', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editNameEma($mailID)
	{		
		//obtiene el identificador de la oferta
		$mailID = $this->uri->segment(3);
		
		$update = array('mailNombre' => $_POST['update_value'],);
				$this->db->where('mailID', $mailID);
				$this->db->update('mail', $update);
		
		echo nl2br($_POST['update_value']);
	}

	function editUrlMail($mailID)
	{		
		//obtiene el identificador de la oferta
		$campaniaID = $this->uri->segment(3);
		
		$update = array('mailUrl' => $_POST['update_value'],);
				$this->db->where('mailID', $mailID);
				$this->db->update('mail', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editFechaMail($mailID)
	{		
		//obtiene el identificador de la oferta
		$campaniaID = $this->uri->segment(3);
		
		$update = array('mailFecha' => $_POST['update_value'],);
				$this->db->where('mailID', $mailID);
				$this->db->update('mail', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editUrlActivo($mailID)
	{		
		//obtiene el identificador de la oferta
		$campaniaID = $this->uri->segment(3);
		
		$update = array('mailUrlTipo' => $_POST['update_value'],);
				$this->db->where('mailID', $mailID);
				$this->db->update('mail', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editNameCom($comunicadoID)
	{		
		//obtiene el identificador de la oferta
		$comunicadoID = $this->uri->segment(3);
		
		$update = array('comunicadoTitulo' => $_POST['update_value'],);
				$this->db->where('comunicadoID', $comunicadoID);
				$this->db->update('comunicadoMail', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editDescCom($comunicadoID)
	{		
		//obtiene el identificador de la oferta
		$comunicadoID = $this->uri->segment(3);
		
		$update = array('comunicadoDesc' => $_POST['update_value'],);
				$this->db->where('comunicadoID', $comunicadoID);
				$this->db->update('comunicadoMail', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editUrlCom($comunicadoID)
	{		
		//obtiene el identificador de la oferta
		$comunicadoID = $this->uri->segment(3);
		
		$update = array('comunicadoUrl' => $_POST['update_value'],);
				$this->db->where('comunicadoID', $comunicadoID);
				$this->db->update('comunicadoMail', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editUrlActivoCom($comunicadoID)
	{		
		//obtiene el identificador de la oferta
		$comunicadoID = $this->uri->segment(3);
		
		$update = array('comunicadoTipoUrl' => $_POST['update_value'],);
				$this->db->where('comunicadoID', $comunicadoID);
				$this->db->update('comunicadoMail', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editFechaCom($comunicadoID)
	{		
		//obtiene el identificador de la oferta
		$comunicadoID = $this->uri->segment(3);
		
		$update = array('comunicadoFecha' => $_POST['update_value'],);
				$this->db->where('comunicadoID', $comunicadoID);
				$this->db->update('comunicadoMail', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editNameCam($campaniaID)
	{		
		//obtiene el identificador de la oferta
		$mailingID = $this->uri->segment(3);
		
		$update = array('campaniaNombre' => $_POST['update_value'],);
				$this->db->where('campaniaID', $campaniaID);
				$this->db->update('campanias', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editPubliTitulo($publicidadID)
	{		
		//obtiene el identificador de la oferta
		$publicidadID = $this->uri->segment(3);
		
		$update = array('bannerTitulo' => $_POST['update_value'],);
				$this->db->where('publicidadID', $publicidadID);
				$this->db->update('bannersPublicidad', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editPubliStat($publicidadID)
	{		
		//obtiene el identificador de la oferta
		$publicidadID = $this->uri->segment(3);
		
		$update = array('bannerStatus' => $_POST['update_value'],);
				$this->db->where('publicidadID', $publicidadID);
				$this->db->update('bannersPublicidad', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editPubliUrl($publicidadID)
	{
		//obtiene el identificador de la oferta
		$publicidadID = $this->uri->segment(3);
		$paginaUrl = $_POST['update_value'];		
		//Busca enlaces
		$row = $this->hobbits_model->buscaEnlace($paginaUrl);
		//Busca si existe
		$verifica = $this->hobbits_model->existeEnlace($publicidadID, $row[0]->enlaceID);
		
		if(empty($verifica)){
			$update = array('enlaceID' => $row[0]->enlaceID, 'publicidadID' => $publicidadID,);
				$this->db->insert('bannersUnion', $update);
		
		echo nl2br($_POST['update_value']);
		}
		else{
			echo 'Ya se dio de alta este enlace';
		}
	}
	
	function editEnl($publicidadID)
	{
		//obtiene el identificador de la oferta
		$publicidadID = $this->uri->segment(3);	
		
		$update = array('bannerUrl' => $_POST['update_value'],'bannerLink' => 'si');
				$this->db->where('publicidadID', $publicidadID);
				$this->db->update('bannersPublicidad', $update);
		
		echo nl2br($_POST['update_value']);
	
	}
	
	function editPubliVig($publicidadID)
	{		
		//obtiene el identificador de la oferta
		$publicidadID = $this->uri->segment(3);
		
		$update = array('bannerVigencia' => $_POST['update_value'],);
				$this->db->where('publicidadID', $publicidadID);
				$this->db->update('bannersPublicidad', $update);
		
		echo nl2br($_POST['update_value']);
	}

	function editUrlCam($campaniaID)
	{		
		//obtiene el identificador de la oferta
		$campaniaID = $this->uri->segment(3);
		
		$update = array('campaniaUrl' => $_POST['update_value'],);
				$this->db->where('campaniaID', $campaniaID);
				$this->db->update('campanias', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editInicioCam($campaniaID)
	{		
		//obtiene el identificador de la oferta
		$campaniaID = $this->uri->segment(3);
		
		$update = array('fechaInicio' => $_POST['update_value'],);
				$this->db->where('campaniaID', $campaniaID);
				$this->db->update('campanias', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editFinCam($campaniaID)
	{		
		//obtiene el identificador de la oferta
		$campaniaID = $this->uri->segment(3);
		
		$update = array('fechaFin' => $_POST['update_value'],);
				$this->db->where('campaniaID', $campaniaID);
				$this->db->update('campanias', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editDescripcionCam($campaniaID)
	{		
		//obtiene el identificador de la oferta
		$campaniaID = $this->uri->segment(3);
		
		$update = array('campaniaDescripcion' => $_POST['update_value'],);
				$this->db->where('campaniaID', $campaniaID);
				$this->db->update('campanias', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editColorCampanias($campaniaID)
	{		
		//obtiene el identificador de la oferta
		$campaniaID = $this->uri->segment(3);
		
		$update = array('colorPromocion' => $_POST['update_value'],);
				$this->db->where('campaniaID', $campaniaID);
				$this->db->update('campanias', $update);
		
		echo nl2br($_POST['update_value']);
	}

	function editarNombre()
	{		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$nombre = array('localNombre' => $_POST['update_value'],);
				$this->db->where('localID', $user['uid']);
				$this->db->update('locatarios', $nombre);
		
		if (!$_POST['update_value']){
			$actualiza 	= 	array('ofertaStatus'=>	'No Publicado');
			$this->db->where('localID', $user['uid']);
			$this->db->where('ofertaID', $ofertaID);
			$this->db->update('locatariosOfertas', $actualiza);
			
			echo'Su producto no contiene titulo, en caso de no ser proporcionado no sera publicado.';
		}
		else{
			echo nl2br($_POST['update_value']);
		}
	}
	
	function editarUrl()
	{		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$url = explode('/', $_POST['update_value']);
		$nombre = array('localUrl' => end($url));
				$this->db->where('localID', $user['uid']);
				$this->db->update('locatarios', $nombre);
		
		echo '<b>'.($_POST['update_value']).'</b>';
		
	}
	
	function editarTel()
	{		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$url = explode('/', $_POST['update_value']);
		$nombre = array('localTelefono' => end($url));
				$this->db->where('localID', $user['uid']);
				$this->db->update('locatarios', $nombre);
		
		echo '<b>'.($_POST['update_value']).'</b>';
		
	}
	
	function editarNum()
	{		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$url = explode('/', $_POST['update_value']);
		$nombre = array('localNumero' => end($url));
				$this->db->where('localID', $user['uid']);
				$this->db->update('locatarios', $nombre);
		
		echo '<b>'.($_POST['update_value']).'</b>';
		
	}
	
	function editarEmail()
	{		
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$url = explode('/', $_POST['update_value']);
		$nombre = array('localEmail' => end($url));
				$this->db->where('localID', $user['uid']);
				$this->db->update('locatarios', $nombre);
		
		echo '<b>'.($_POST['update_value']).'</b>';
		
	}
	
	function editCarat($caracteristicaID)
	{
		$caracteristicaID	=	$this->uri->segment(4);
		
		$carat = array('caracteristica' => $_POST['update_value'],);
				$this->db->where('caracteristicaID', $caracteristicaID);
				$this->db->update('caracteristicasOferta', $carat);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editPrec($ofertaID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//obtiene el identificador de la oferta
		$oferta = $this->uri->segment(4);
		$number = number_format($_POST['update_value']);
		$update = array('ofertaPrecio' => $number,);
				$this->db->where('localID', $user['uid']);
				$this->db->where('ofertaID', $ofertaID);
				$this->db->update('locatariosOfertas', $update);
		
		if (!$_POST['update_value']){
			$actualiza 	= 	array('ofertaStatus'=>	'No Publicado');
			$this->db->where('localID', $user['uid']);
			$this->db->where('ofertaID', $ofertaID);
			$this->db->update('locatariosOfertas', $actualiza);
			
			echo 'Producto sin Precio';
		}
		else{
			echo $number.'.00';
		}
		
	}
	
	function editEnvio($ofertaID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//obtiene el identificador de la oferta
		$oferta = $this->uri->segment(4);
		
		$update = array('envio' => $_POST['update_value'],);
				$this->db->where('localID', $user['uid']);
				$this->db->where('ofertaID', $ofertaID);
				$this->db->update('locatariosOfertas', $update);
		
		if (!$_POST['update_value']){
			$actualiza 	= 	array('ofertaStatus'=>	'No Publicado');
			$this->db->where('localID', $user['uid']);
			$this->db->where('ofertaID', $ofertaID);
			$this->db->update('locatariosOfertas', $actualiza);
			
			echo'No especificaste si cuenta con envio a domicilio';
		}
		else{
			echo nl2br($_POST['update_value']);
		}
	}
	
	function editInv($ofertaID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//obtiene el identificador de la oferta
		$oferta = $this->uri->segment(4);
		
		$update = array('existencia' => $_POST['update_value'],);
				$this->db->where('localID', $user['uid']);
				$this->db->where('ofertaID', $ofertaID);
				$this->db->update('locatariosOfertas', $update);
		
		if ($_POST['update_value'] <= '0'){
			$actualiza 	= 	array('ofertaStatus'=>	'No Publicado');
			$this->db->where('localID', $user['uid']);
			$this->db->where('ofertaID', $ofertaID);
			$this->db->update('locatariosOfertas', $actualiza);
			
			echo'No has puesto cuantas piezas tienes';
		}
		else{
			echo nl2br($_POST['update_value']);
		}
	}
	
	function editTitu($ofertaID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//obtiene el identificador de la oferta
		$oferta = $this->uri->segment(4);
		
		$update = array('ofertaTitulo' => $_POST['update_value'],);
				$this->db->where('localID', $user['uid']);
				$this->db->where('ofertaID', $ofertaID);
				$this->db->update('locatariosOfertas', $update);
		
		echo nl2br($_POST['update_value']);
	}
	
	function editMarca($ofertaID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//obtiene el identificador de la oferta
		$oferta = $this->uri->segment(4);
		$marca	= $_POST['update_value'];
		
		$marcaInfo 	= $this->ofertas_model->cargarMarcasID($marca);
		
		foreach($marcaInfo as $rowM):
		$marcaID = $rowM->marcaID;
		endforeach;
		
		
		$update = array('marcaID' => $marcaID,);
				$this->db->where('ofertaID', $ofertaID);
				$this->db->update('locatariosOfertas', $update);
		
		echo $marca;
	}
	
	function editsubCat($ofertaID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//obtiene el identificador de la oferta
		$oferta 	= $this->uri->segment(3);
		$changeID	= $this->uri->segment(4);
		$subCat		= $_POST['update_value'];
		
		$scID 	= $this->ofertas_model->cargarSubcatID($subCat);
		
		foreach($scID as $rowS):
		$ID = $rowS->ID;
		endforeach;
		
		
		$update = array('unionCatalogoID' => $ID,);
		
				$this->db->where('ofertaID', $ofertaID);
				$this->db->where('unionCatalogoID', $changeID);
				$this->db->update('unionProductosTipo', $update);
		
		echo $subCat;
		
	}
	
	function insertSubCat($ofertaID,$tipoID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		//obtiene el identificador de la oferta
		$ofertaID	= $this->uri->segment(3);
		$subCat		= $_POST['update_value'];
		
		$scID 		= $this->ofertas_model->cargarSubcatID($subCat,$tipoID);
		$busqueda 	=  $this->ofertas_model->cargarBusquedaCat($ofertaID,$scID[0]->catTipoID);
		
		if (!$busqueda) {
			  $insert = array('unionCatalogoID' => $scID[0]->ID, 'ofertaID' => $ofertaID);
			  $this->db->insert('unionProductosTipo', $insert);
			  
			  echo $subCat;
		} 
		
		elseif ($busqueda){
		
		$update = array('unionCatalogoID' => $scID[0]->ID,);
		
				$this->db->where('unionTipoID', $busqueda[0]->unionTipoID);
				$this->db->update('unionProductosTipo', $update);
				
				echo $subCat;
		}
		
		else{
			echo $subCat;
		}	
	}
	
	function cargarBancos()
	{
			
		$number       = $_POST['filtro'];
		$costoEnvio   = $_POST['filtro2'];
		$descuento    = $_POST['filtro3'];
		
		$precioLocal = str_replace(",", "", $number);
		$envio		 = str_replace(",", "", $costoEnvio);
		$descuento	 = str_replace(",", "", $descuento);
		
		$sc = $this->db->query("select * from bancos where bancoID = 1");

		$total = '<option class="fmedium" value="0">Seleccione una cantidad</option>';
		
		foreach($sc->result() as $row){
			$comision 		= str_replace(",", "", $row->comisionPt);
			$descuentoPesos	= ($precioLocal * $descuento) / 100;
			$precioOferta	= $precioLocal - $descuentoPesos;
			$precioOferta   = $precioOferta + $envio;
			$comisionPT 	= ($precioLocal * $comision)/100;
			$precioOferta   = $precioOferta + $comisionPT;
			$TotalRecibiras = $precioOferta - $comisionPT;
			
		}
		
		$total = "
		<div id='totales'>
		<span><b>Precio por pieza</b>$". $number."</span>
		<span><b>Costo envio</b><div class='comInpAja'>$ ".$costoEnvio."</div></span>
		<span><b>Descuento de ".$descuento."%<img class='tip' title='Descuento calculado sobre precio por pieza mas costo por transacción $".$precioLocal."'  src='".base_url()."assets/graphics/gnome-help.png' /></b><div class='comInpAja'>$ -".$descuentoPesos."</div></span>
		<span><b>Costo transacción bancaria</b><div class='comInpAja'>$ ".$comisionPT."</div></span>
		<span><b>Precio x por al pieza publico</b><div class='comInpAja'>$ ".number_format(ceil($precioOferta)).".00</div></span>
		<span><b>Total que recibiras</b><div class='comInpAja resaltar'>$ ".number_format(ceil($TotalRecibiras)).".00</div></span>
		</div>	 
				 ";
		
		echo $total;
	}
	
	function addTipo($ofertaID)
	{
		//validacion para identificar tipo de usuario y desglosar info
		$user				= $this->session->userdata('user');
		$op['info']			= array();
		
		if ($user['uid'] != '') {
			$tipo = 'info_'.$user['tipoUsuario'];
			$info = $op['info']	= $this->data_model->$tipo($user['uid']);
		}
		
		$tipoVenta		= $_POST['update_value'];
		$ofertaID		= $this->uri->segment(3);
		
		if ($_POST['update_value']){
			$actualiza 	= 	array('ofertaTipo'=>	$tipoVenta,);
			$this->db->where('localID', $user['uid']);
			$this->db->where('ofertaID', $ofertaID);
			$this->db->update('locatariosOfertas', $actualiza);
			
			echo nl2br($_POST['update_value']);
		}
	}
	
	function cargarMunicipios()
	{
		$estadoFiltro = strtolower($_POST['estadoFiltro']);

		$sc = $this->db->query("SELECT claveMunicipio AS idMunicipio, 
									   nombreMunicipio AS nombreMunicipio 
									   FROM estadosMexico 
									   WHERE claveEstado = '$estadoFiltro' 
									   GROUP BY claveMunicipio  
									   ORDER BY claveMunicipio");

		$lista_opciones = '<option value="0">Municipio</option>
		';
		
		foreach($sc->result() as $row){
			$lista_opciones .= "<option value='".$row->idMunicipio."'>".$row->nombreMunicipio."</option>";
		}
		
		echo $lista_opciones;	
	}
	
	function cargarColonias()
	{
		$municipioFiltro 	= strtolower($_POST['municipioFiltro']);
		$estadoFiltro 		= strtolower($_POST['estadoFiltro']);

		$sc = $this->db->query("SELECT claveColonia AS idColonia, 
									   nombreColonia AS nombreColonia 
									   FROM estadosMexico 
									   WHERE claveEstado = '$estadoFiltro'
									   AND claveMunicipio = '$municipioFiltro' 
									   GROUP BY claveColonia  
									   ORDER BY nombreColonia ASC");

		$lista_opciones = '<option value="0">Colonia</option>
		';
		
		foreach($sc->result() as $row){
			$lista_opciones .= "<option value='".$row->idColonia."'>".$row->nombreColonia."</option>";
		}
		
		echo $lista_opciones;	
	}
	
	function cargarCP()
	{
		$municipioFiltro 	= strtolower($_POST['municipioFiltro']);
		$estadoFiltro 		= strtolower($_POST['estadoFiltro']);
		$coloniaFiltro 		= strtolower($_POST['coloniaFiltro']);

		$sc = $this->db->query("SELECT codigoCP
									   FROM estadosMexico 
									   WHERE claveEstado = '$estadoFiltro'
									   AND claveMunicipio = '$municipioFiltro' 
									   AND claveColonia = '$coloniaFiltro'");

		
		
		foreach($sc->result() as $row){
			$lista_opciones = $row->codigoCP;
		}
		
		echo $lista_opciones;	
		
	}
	
	function addMerchant($ofertaID)
	{	
		$status			= $_POST['update_value'];
		$ofertaID		= $this->uri->segment(3);
		
		if ($_POST['update_value']){
			$actualiza 	= 	array('googleMerchant'	=>	$status,);
			$this->db->where('ofertaID', $ofertaID);
			$this->db->update('locatariosOfertas', $actualiza);
			
			echo nl2br($_POST['update_value']);
		}
	}
	
	function cargarTit()
	{
		$op['filtro'] = $filtro = strtolower($_POST['q']);
			$op['marca']		= $this->ajax_model->cargarAjaxMarcas($filtro);
	        $op['rama']			= $this->ajax_model->cargarAjaxTitulo($filtro);
			
			//Vista//
			$this->load->view('busquedaAuto-view' ,$op);
		
        
	}
}