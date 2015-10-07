<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventos_model extends CI_Model {
	
	function cargarEvento($url)
	{
		$data = array(); 
		$q = $this->db->query("SELECT * FROM articulos
							   WHERE articuloUrl='$url'
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