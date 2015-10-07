<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Google_model extends CI_Model {
	
	function cargarPla(){
		$data = array(); 
		$q = $this->db->query("SELECT * from locatariosOfertas where googleMerchant='activado'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
		
	
}