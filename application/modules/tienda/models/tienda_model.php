<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tienda_model extends CI_Model {

	function cargarLocalID ($localUrl){
		 $data = array(); 
	    $q = $this->db->query("SELECT l.localID AS 'id' FROM locatarios l
								WHERE l.localUrl = '$localUrl'");	
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarLocal ($localID){
		 $data = array(); 
	    $q = $this->db->query("SELECT l.localID AS 'id',	
									   l.localNombre AS 'name',
									   l.localLogo AS 'avatar',
									   l.localEmail AS 'email',
									   l.localDescripcion AS 'descripcion',
									   l.localEmail AS 'email',
									   l.localNumero AS 'numero',
									   l.localPlanta AS 'planta',
									   l.localTelefono AS 'telefono',
									   l.sucursal AS 'sucursal',
									   l.localUrl AS 'localUrl',
									   (select b.imagen AS 'bannerImagen' from banners b WHERE b.usuarioID=l.localID  AND b.bannerTipo='leaderBoard' AND b.bannerStatus='Activado' ORDER BY b.bannerID DESC LIMIT 1) as 'bannerCabecera',
									   (select b.imagen AS 'bannerImagen' from banners b WHERE b.usuarioID=l.localID  AND b.bannerTipo='boxBanner' AND b.bannerStatus='Activado' ORDER BY b.bannerID DESC LIMIT 1) as 'bannerIzq',
									   (select b.imagen AS 'bannerImagen' from banners b WHERE b.usuarioID=l.localID  AND b.bannerTipo='leadBanner' AND b.bannerStatus='Activado' ORDER BY b.bannerID DESC LIMIT 1) as 'bannerCurl',
									   (select b.imagen AS 'bannerImagen' from banners b WHERE b.usuarioID=l.localID  AND b.bannerTipo='boxBanner' AND b.bannerStatus='Activado' ORDER BY b.bannerID DESC LIMIT 1) as 'bannerIurl'
								FROM locatarios l
								WHERE l.localID = '$localID'");	
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarDestacados($localID){
		 $data = array(); 
	    $q = $this->db->query("SELECT 
									lo.ofertaTitulo as 'ofertaTitulo',
									lo.ofertaDescripcion as 'ofertaDescripcion',
									lo.ofertaPrecio as 'ofertaPrecio',
									lo.ofertaImagen as 'ofertaImagen',
									lo.ofertaID as 'ofertaID',
									r.ramaNombre as 'rama',
									r.ramaID as 'ramaID',
									cm.marca as 'marca',
									(SELECT ROUND(12Meses,2) FROM bancos) as meses,
									(SELECT ROUND(comisionCC, 1) FROM bancos) as comision
								FROM locatariosOfertas lo 
								LEFT JOIN ramas r ON r. ramaID = lo.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE lo.localID= '$localID' 
								AND lo.ofertaStatus = 'Activo'
								AND lo.ofertaPrecio != 0
								
								LIMIT 16");	
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarProductos($localID, $ramaID){
		 $data = array(); 
	    $q = $this->db->query("SELECT 
									lo.ofertaTitulo as 'ofertaTitulo',
									lo.ofertaDescripcion as 'ofertaDescripcion',
									lo.ofertaPrecio as 'ofertaPrecio',
									lo.ofertaImagen as 'ofertaImagen',
									lo.ofertaID as 'ofertaID',
									r.ramaNombre as 'rama',
									r.ramaID as 'ramaID',
									cm.marca as 'marca',
									(SELECT ROUND(12Meses,2) FROM bancos) as meses,
									(SELECT ROUND(comisionCC, 1) FROM bancos) as comision
								FROM locatariosOfertas lo 
								LEFT JOIN ramas r ON r. ramaID = lo.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE lo.localID= '$localID'
								$ramaID 
								AND lo.ofertaStatus = 'Activo'
								AND lo.ofertaPrecio != 0");
								
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarRamasLocal($localID){
		 $data = array(); 
	    $q = $this->db->query("SELECT 
									r.ramaNombre as 'rama',
									r.ramaID as 'ramaID',
									r.ramaUrl as 'ramaUrl'
								FROM locatariosOfertas lo 
								LEFT JOIN ramas r ON r. ramaID = lo.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE lo.localID= '$localID' 
								AND lo.ofertaStatus = 'Activo'
								
							  	GROUP BY r.ramaID
								ORDER BY r.ramaNombre");	
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
}