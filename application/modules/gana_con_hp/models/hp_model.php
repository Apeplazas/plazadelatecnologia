<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hp_model extends CI_Model {
	
	function confirmaEmail($email){
		 
	    $q = $this->db->query("SELECT * FROM dinamicaHp WHERE correoElectronico='$email'");	
		 if($q->num_rows() > 0) 
        {
           return TRUE;
        } else {
        	return FALSE;    
        }
	}
	
	function validaEmail($email, $contrasenia)
    {
        $data = array();
        //si no existen los datos regresamos false
        if(empty($email) || empty($contrasenia) || !isset($email) || !isset($contrasenia) )
            return false;
        
        //si todo va bien, creamos el md5 del pwd.
        $contraShai = sha1($contrasenia);
        
        //ejecutamos la consulta
        $query = $this->db->query("SELECT * FROM dinamicaHp WHERE correoElectronico='$email' AND contrasenia='$contraShai'");
        
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
	
	function cargaTickets($localID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM dinamicaTicketsHp WHERE localID='$localID'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargaTicketsTicket($ticketID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM dinamicaCatalogoProductosHp WHERE ticketID='$ticketID'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	
	function sumaCantidadProductosTicket($localID, $ticketID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								sum(dc.cantidad) AS 'cantidad' 
								FROM dinamicaHp dh
								left join dinamicaTicketsHp dt ON dt.localID=dh.localID
								left join dinamicaCatalogoProductosHp dc ON dc.ticketID=dt.ticketID
								WHERE dh.localID='$localID'
								AND dt.ticketID='$ticketID'
							");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function sumaTickets($localID, $ticketID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								sum(dc.costoUnitaro * cantidad)  AS 'total' 
								FROM dinamicaHp dh
								left join dinamicaTicketsHp dt ON dt.localID=dh.localID
								left join dinamicaCatalogoProductosHp dc ON dc.ticketID=dt.ticketID
								WHERE dh.localID='$localID'
								AND dt.ticketID='$ticketID'
							");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function sumaTotal($localID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								sum(dc.costoUnitaro * cantidad)  AS 'total' 
								FROM dinamicaHp dh
								left join dinamicaTicketsHp dt ON dt.localID=dh.localID
								left join dinamicaCatalogoProductosHp dc ON dc.ticketID=dt.ticketID
								WHERE dh.localID='$localID'
							");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cantidadTotal($localID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								count(dc.costoUnitaro * cantidad)  AS 'total' 
								FROM dinamicaHp dh
								left join dinamicaTicketsHp dt ON dt.localID=dh.localID
								left join dinamicaCatalogoProductosHp dc ON dc.ticketID=dt.ticketID
								WHERE dh.localID='$localID'
							");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
		
}