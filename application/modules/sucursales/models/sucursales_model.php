<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sucursales_model extends CI_Model {
	
	function cargarSucursales(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM sucursales GROUP BY sucursalCiudad ORDER BY sucursalCiudad ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
		
}