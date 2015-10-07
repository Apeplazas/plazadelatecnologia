<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Encuestas extends MX_Controller {
	
	function encuestas()
	{
		parent::__construct();	
		$this->load->model('encuesta_modelo');
		
	}
	
	function index(){
		
		$this->load->view('login-view');
		
	}
	
	function ape(){
		
		$data['sucursales'] = $this->encuesta_modelo->obtiene_sucursal();
		$this->load->view('ape-view',$data);
		
	}
	
	function preguntas($encuestaID){
	
		$encuestaID = $this->uri->segment(3);
		$data['encuesta'] = $this->encuesta_modelo->obtiene_encuesta($encuestaID);
		
		//Carga los extras al Template Layout//
		$this->layouts->add_include('assets/js/validationSurvey.js');
					  
		$this->layouts->encuestas('vista_encuesta', $data);
		
	}
	
	function preguntasApe($encuestaID){
				
	
		$encuestaID = $this->uri->segment(3);
		$data['encuesta'] = $this->encuesta_modelo->obtiene_encuesta($encuestaID);
		
		//Carga los extras al Template Layout//
		$this->layouts->add_include('assets/js/validationSurvey.js');
					  
		$this->layouts->encuestasApe('vista_encuesta_ape', $data);
		
	}
	
	function respuestas($respuestasID){
	
		$respuestasID = $this->uri->segment(3);
		$data['respuestas'] = $this->encuesta_modelo->obtiene_respuestas($respuestasID);
		
		//Carga los extras al Template Layout//
		$this->layouts->add_include('assets/js/validationSurvey.js');
					  
		$this->layouts->encuestas('vista_respuestas', $data);
		
	}
	
	function enviar_respuestas(){
		
		$mailUsuario = $_POST['usuarioEmail'];
		$query = $this->db->query("SELECT usuarioEmail FROM usuariosApe WHERE usuarioEmail = '$mailUsuario'");
			
		if( $query->num_rows()>0 )
		{
			$this->session->set_flashdata('mensaje','<strong class="mensaje">Ya has contestado esta encuesta con anterioridad, gracias!!</strong>');
					redirect('encuestas/ape');
		}else{
				
			if($this->input->post('encuestaID') == '4'){
				
				$query = $this->db->query('SELECT MAX(usuarioID) AS usuarioID FROM usuariosApe');
				
				if( $query->num_rows()>0 )
					{
						foreach($query->result() as $row)
						{
							$id_usuario = $row->usuarioID;
						}
					}
					
				$user = array(
								'usuarioID'				=> $id_usuario+1,
								'usuarioNombre' 		=> $_POST['usuarioNombre'], 
								'usuarioApellido' 		=> $_POST['usuarioApellido'],
								'usuarioEmail' 			=> $_POST['usuarioEmail'],
								'usuarioSucursal' 		=> $_POST['sucursal'], 
				);
				
				$this -> db -> insert('usuariosApe', $user);		
				
				$encuestaID = $this->input->post('encuestaID');
				$numero		= $this->encuesta_modelo->obtieneNumPreguntas($encuestaID);
				
				foreach($numero as $num){
					$numero_filas = $num->numero;
				}
				
				for ($i=1; $i <= $numero_filas; $i++) {
					
					$res = implode(" - ", $this->input->post('txt'.$i));
		
					$data 		= $res;
					$id   		= array($this->input->post('ep'.$i));
					$order 	 	= array($this->input->post('order'.$i));
					$porque 	= array($this->input->post('porque'.$i));
					$cual 		= array($this->input->post('cual'.$i));
					$usuarioID 	= $id_usuario+1;
					
					$op = array(
						'respuesta' 			=> $data,
						'encuestaPreguntaID' 	=> $id[0],
						'orderRespuesta' 		=> $order[0],
						'porque' 				=> $porque[0],
						'cual' 					=> $cual[0],
						'usuarioID' 			=> $usuarioID,
					);
					
					$this -> db -> insert('encuestaRespuesta', $op);
				}
				redirect('encuestas/gracias');
			}
		
			$IDusuario 	= $this->input->post('usuarioID');
			$encuestaID = $this->input->post('encuestaID');
			$numero		= $this->encuesta_modelo->obtieneNumPreguntas($encuestaID);
			$email 		= $this->input->post('email');
			
				
			foreach($numero as $num){
				$numero_filas = $num->numero;
			}
			
			for ($i=1; $i <= $numero_filas; $i++) {
				
				$res = implode(" - ", $this->input->post('txt'.$i));
	
				$data 		= $res;
				$id   		= array($this->input->post('ep'.$i));
				$order 	 	= array($this->input->post('order'.$i));
				$porque 	= array($this->input->post('porque'.$i));
				$cual 		= array($this->input->post('cual'.$i));
				$usuarioID 	= $IDusuario;
				
				$op = array(
					'respuesta' 			=> $data,
					'encuestaPreguntaID' 	=> $id[0],
					'orderRespuesta' 		=> $order[0],
					'porque' 				=> $porque[0],
					'cual' 					=> $cual[0],
					'usuarioID' 			=> $usuarioID,
				);
				$this -> db -> insert('encuestaRespuesta', $op);
				
				
			}
			redirect('encuestas/gracias');
		}	
	
	}
	function validate_credentials()
    {		
        // carga validacion de contraseña y usuario para login
        $query = $this->encuesta_modelo->validate();
         
        if($query) // si las contraseña y usuario es valida enseña..
        {
            $usuarioID = $query[0]->usuarioID;
            $data = array(
                'usuarioID' => $usuarioID,
                'usuarioEmail' => $this->input->post('usuarioEmail'),
                'is_logged_in' => true
            );
            
            //guardamos los datos en la sesion
            $this->session->set_userdata($data);
			if($query){
				$encuestaSucursal = $this->encuesta_modelo->busquedaEncuesta($usuarioID);
				
						foreach($encuestaSucursal as $row){
							$encuesta = $row->encuestas;
							redirect('encuestas/preguntas/'.$encuesta.'');
					}
					
				};
        }
		
	else //si la contraseña esta incorrecta vuelve al index
		{
			$this->session->set_flashdata('msg','<div id="msgLoginAdmin">Su email no es valido por favor contacte a Mercadotecnia.</div>');
			//envia email
			redirect('encuestas');
		}
    }

	function validate_credentialsAPE()
    {		
        // carga validacion de contraseña y usuario para login
        $query = $this->encuesta_modelo->validateAPE();
         
        if($query) // si las contraseña y usuario es valida enseña..
        {
            $usuarioID = $query[0]->usuarioID;
            $data = array(
                'usuarioID' => $usuarioID,
                'usuarioEmail' => $this->input->post('usuarioEmail'),
                'is_logged_in' => true
            );
            
            //guardamos los datos en la sesion
            $this->session->set_userdata($data);
			
			redirect('encuestas/preguntasApe/14');
        }else{ //si la contraseña esta incorrecta vuelve al index
		
			$this->session->set_flashdata('msg','<div id="msgLoginAdmin">Su email no es valido por favor contacte a Mercadotecnia.</div>');
			//envia email
			redirect('encuestas/ape');
		}
    }
	
	function gracias(){
		$this->session->sess_destroy();
		$this->layouts->encuestas('gracias_encuesta');
		
	}
	
	function bazargames($encuestaID){
		
		$encuestaID = $this->uri->segment(3);
		$data['encuesta'] = $this->encuesta_modelo->obtiene_encuesta($encuestaID);
		
		//Carga los extras al Template Layout//
		$this->layouts->add_include('assets/js/validationSurvey.js');
					  
		$this->layouts->encuestasBazar('vista_encuesta_bazar', $data);
		
	}
	
	function enviar_respuestas_bazar(){
		
		
		$encuestaID = $this->input->post('encuestaID');
		$numero= $this->encuesta_modelo->obtieneNumPreguntas($encuestaID);

		foreach($numero as $num){
			$numero_filas = $num->numero;
		}
		
		for ($i=1; $i <= $numero_filas; $i++) {
			
			$res = implode(" - ", $this->input->post('txt'.$i));

			$data 		= $res;
			$id   		= array($this->input->post('ep'.$i));
			$order 	 	= array($this->input->post('order'.$i));
			$porque 	= array($this->input->post('porque'.$i));
			$cual 		= array($this->input->post('cual'.$i));
			$usuarioID 	= $this->input->post('usuarioID');
			
			$op = array(
				'respuesta' 			=> $data,
				'encuestaPreguntaID' 	=> $id[0],
				'orderRespuesta' 		=> $order[0],
				'porque' 				=> $porque[0],
				'cual' 					=> $cual[0],
				'usuarioID' 			=> $usuarioID,
			);
			$this -> db -> insert('encuestaRespuesta', $op);
			
			
		}
		redirect('encuestas/graciasBazar');
	}
	
	function enviar_respuestas_ape(){
		
		
		$encuestaID = $this->input->post('encuestaID');
		$numero= $this->encuesta_modelo->obtieneNumPreguntas($encuestaID);

		foreach($numero as $num){
			$numero_filas = $num->numero;
		}
		
		for ($i=1; $i <= $numero_filas; $i++) {
			
			$res = implode(" - ", $this->input->post('txt'.$i));

			$data 		= $res;
			$id   		= array($this->input->post('ep'.$i));
			$order 	 	= array($this->input->post('order'.$i));
			$porque 	= array($this->input->post('porque'.$i));
			$cual 		= array($this->input->post('cual'.$i));
			$otros 		= array($this->input->post('otros'.$i));
			$usuarioID 	= $this->input->post('usuarioID');
			
			$op = array(
				'respuesta' 			=> $data,
				'encuestaPreguntaID' 	=> $id[0],
				'orderRespuesta' 		=> $order[0],
				'porque' 				=> $porque[0],
				'cual' 					=> $cual[0],
				'otros' 				=> $otros[0],
				'usuarioID' 			=> $usuarioID,
			);
			$this -> db -> insert('encuestaRespuesta', $op);
			
			
		}
		redirect('encuestas/gracias');
	}
	
	function is_logged_in()
    {
		$this->load->library('session');
        $is_logged_in = $this->session->userdata('is_logged_in');
        if(!isset($is_logged_in) || $is_logged_in != true)
        {
			redirect('encuestas', $op);
        }		
    }
	
	function graciasBazar(){
	
		$this->layouts->encuestasBazar('graciasBazar');
		
	}
	
	
}
