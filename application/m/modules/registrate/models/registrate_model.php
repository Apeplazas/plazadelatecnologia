<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registrate_model extends CI_Model {
	
	function veificaRegistros ($email){
		 
	    $q = $this->db->query("SELECT * FROM usuarios WHERE email='$email'");	
		 if($q->num_rows() > 0) 
        {
           return TRUE;
        } else {
        	return FALSE;    
        }
	}
	
	function validate($email, $contrasenia)
    {
        $data = array();
        //si no existen los datos regresamos false
        if(empty($email) || empty($contrasenia) || !isset($email) || !isset($contrasenia) )
            return false;
        
        //si todo va bien, creamos el md5 del pwd.
        $contraseniamd5 = md5($contrasenia);
        
        //ejecutamos la consulta
        $query = $this->db->query("SELECT idRegistro,userAlias,email FROM usuarios WHERE email='$email' and contrasenia='$contraseniamd5'");
        
		if($query->num_rows() > 0) 
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            $query->free_result(); 
			
			 return $data;	 	
        }else{
        	return FALSE;
        }
       	
    }
	
	function validateLocal($email, $contrasenia)
    {
        $data = array();
        //si no existen los datos regresamos false
        if(empty($email) || empty($contrasenia) || !isset($email) || !isset($contrasenia) )
            return false;
        
        //si todo va bien, creamos el md5 del pwd.
        $contraseniamd5 = md5($contrasenia);
        
        //ejecutamos la consulta
        $query = $this->db->query("SELECT localID,localNombre,localEmail,localUrl FROM locatarios WHERE localEmail='$email' and contrasenia='$contraseniamd5'");
        
		if($query->num_rows() > 0) 
        {
            foreach($query->result() as $row)
            {
                $data[] = $row;
            }
            $query->free_result(); 
			
			 return $data;	 	
        }else{
        	return FALSE;
        }
       	
    }
}