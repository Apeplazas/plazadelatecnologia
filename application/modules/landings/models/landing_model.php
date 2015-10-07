<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landing_model extends CI_Model {
	
	function cargaMainPromo(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM locatariosOfertas lo
							   LEFT JOIN ramas r ON r.ramaID=lo.ramaID
							   LEFT JOIN catMarcas cm ON cm.marcaID=lo.marcaID
							   WHERE ramaUrl='computadoras'
							   AND lo.ofertaVigencia > CURDATE()
							   AND lo.ofertaStatus = 'Activo'
							   AND lo.existencia > '0'
							   AND promoLandingMain='1'
							   AND promoLanding='1'
							   ORDER BY RAND()
							   LIMIT 1
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargaOfeDestacadas(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM locatariosOfertas lo
							   LEFT JOIN ramas r ON r.ramaID=lo.ramaID
							   LEFT JOIN catMarcas cm ON cm.marcaID=lo.marcaID
							   WHERE ramaUrl='computadoras'
							   AND lo.ofertaVigencia > CURDATE()
							   AND lo.ofertaStatus = 'Activo'
							   AND lo.existencia > '0'
							   AND promoLandingMain !='1'
							   AND promoLanding='1'
							   ORDER BY RAND()
							   LIMIT 4
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