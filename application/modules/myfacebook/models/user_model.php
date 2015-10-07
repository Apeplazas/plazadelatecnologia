<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	
	function saveProfileData($data)
    {
        $profile['uidFacebook']    	= trim($data['id']);
		$profile['userAlias']    	= trim($data['name']);
        $profile['userName']    	= trim($data['first_name']);
		$profile['lastName']    	= trim($data['last_name']);
		$profile['email']  			= trim($data['email']);
		$profile['gender']  		= trim($data['gender']);
		$profile['access_token'] 	= trim($data['access_token']);
		$profile['tipoRegistro'] 	= 'facebook';
		$profile['status'] 			= 'Activado';
		$profile['registrationDate']= date('Y-m-d');
		$profile['terminosCondiciones']= 'acepto';
		
		
        //si no existen los datos regresamos false
        if( empty($profile['email']) || empty($profile['uidFacebook']) || !isset($profile['email']) || !isset($profile['uidFacebook']) )
            return false;
       //ejecutamos la consultaaccess_token
        $query = $this->db->query("SELECT * FROM usuarios WHERE email='".$data['email']."'")->result();
        $url ="";
		//si todo sale bien, regresamos un objeto
        if(count($query) == 0){//no hay registro alguno, se genera nuevo
        
        	$this->db->insert("usuarios",$profile);
			
		}else{//se encontro un registro igual
		
			foreach($query as $row)
       		{
        		$valorPass = $row->contrasenia;
			}
			
			if($valorPass != ''){//si hay registro normal, actualizar con info facebook
				
				$registroActualiza = array(
									'uidFacebook'			=> $profile['uidFacebook'] ,
									'access_token'			=> $profile['access_token'] ,
									'tipoRegistro'			=> 'web-facebook' 
				);
	
				$this->db->where('email', $profile['email']);
				$this->db->update('usuarios', $registroActualiza);
				$url = "usuario";
				
			}else{//hay registro facebook se actualiza el id facebook
			
				unset($profile['uidFacebook']);
            	$this->db->update("usuarios",$profile,array('uidFacebook'=>$data['id'],'tipoRegistro'=> 'facebook'));
            }
		}
		return TRUE;
	 }	
}