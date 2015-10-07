<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acceso_model extends CI_Model {
	
	
	function validate($email, $contrasenia)
    {
        $data = array();
        //si no existen los datos regresamos false
        if(empty($email) || empty($contrasenia) || !isset($email) || !isset($contrasenia) )
            return false;
        
        //si todo va bien, creamos el md5 del pwd.
        $contraseniamd5 = md5($contrasenia);
        
        //ejecutamos la consulta
        $query = $this->db->query("SELECT administradorID,nombre,email FROM administradores WHERE email='$email' and contrasenia='$contraseniamd5' and status='activa'");
        
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