<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_model extends CI_Model {

	//Carga emails en inbox de usuarios
	function cargarInbox_mi_local($localID){
		$data = array(); 
		$q = $this->db->query("SELECT COUNT(*) as 'cuenta' 
							   FROM contactos c
							   LEFT JOIN usuarios u ON u.idRegistro=c.usuarioIDEnvia
							   WHERE usuarioIDRecibe='$localID'
							   AND inboxStatus='Activo'
							   AND estatusLocal='pendiente'				   
							   ORDER BY contactoID DESC
							   ");
		
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//Carga emails en inbox de usuarios
	function cargarInbox_usuario($usuarioID){
		$data = array(); 
		$q = $this->db->query("SELECT COUNT(*) as 'cuenta' 
							   FROM contactos c
							   LEFT JOIN locatarios l ON l.localID=c.usuarioIDEnvia
							   WHERE usuarioIDRecibe='$usuarioID'
							   AND inboxStatus='Activo'
							   AND estatusUsuario='pendiente'			   
							   ORDER BY contactoID DESC
							   ");
		
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	

	//Carga y cuenta si hay venta
	function cargarCuentaVenta($localID){
		$data = array(); 
		$q = $this->db->query("SELECT COUNT(*) as 'cuentaVenta' 
							   FROM productosComprados pc
							   LEFT JOIN compras c ON c.folio=pc.folioCompra
							   LEFT JOIN locatariosOfertas lo ON lo.ofertaID=pc.ofertaID
							   LEFT JOIN usuarios u ON u.idRegistro=c.usuarioID
							   LEFT JOIN sitiosEntrega s ON s.idSitio=c.idSitio
							   WHERE pc.statusProducto = 'pagada'
							   AND c.status='ptConfirmada'
							   AND lo.localID='$localID'
							   ");
		
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//Carga lo que encuentra con las letras escritas por marca
	function cargarAjaxMarcas($filtro){
		$data = array(); 
		$q = $this->db->query("Select
								lo.ofertaID as 'ofertaID',
								cm.marca as 'marca',
								cm.marcaID as 'marcaID'
								FROM locatariosOfertas lo
								LEFT JOIN catMarcas cm ON cm.marcaID=lo.marcaID
								WHERE lower(cm.marca) LIKE '%$filtro%'
								AND lo.ofertaStatus = 'Activo'
								GROUP BY cm.marca
							   ");
		
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//Carga lo que encuentra con las letras escritas por rama
	function cargarAjaxTitulo($filtro){
		$data = array(); 
		$q = $this->db->query("SELECT 
								lo.ofertaTitulo as 'ofertaTitulo',
										lo.ofertaID as 'ofertaID',
										r.ramaNombre as 'ramaNombre',
										r.ramaID as 'ramaID',
										cm.marca as 'marca',
										cm.marcaID as 'marcaID'
										FROM locatariosOfertas lo
										LEFT JOIN ramas r ON lo.ramaID=r.ramaID
										LEFT JOIN catMarcas cm ON lo.marcaID=cm.marcaID
										WHERE lower(lo.ofertaTitulo) LIKE '%$filtro%' 
										AND r.ramaNombre != ''
										AND lo.ofertaStatus = 'Activo'
										group by lo.ofertaTitulo
										limit 15
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
