<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Boletin_model extends CI_Model {
	
	function cargarMailingInfo($id){
		$data = array(); 
		$q = $this->db->query("select 
								mailNombre as mailNombre,
								mailImagen as mailImagen,
								mailTipoUrl as mailTipoUrl,
								mailUrl as mailUrl
								from mail where mailID='$id'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarCategorias(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM ramas");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarOfertasEsp(){
		$data = array(); 
		$q = $this->db->query("SELECT lo.ofertaID as ofertaID, 
							   lo.ofertaTitulo as tituloOferta,
							   lo.ofertaDescripcion as descripcionOferta,
							   lo.ofertaImagen as imagenOferta,
							   lo.ofertaPrecio as precioOferta,
							   lo.ofertaVigencia as vigenciaOferta,
							   r.ramaUrl as ofertaCategoria
							   FROM locatariosOfertas lo LEFT JOIN ramas r on lo.ramaID = r.ramaID
							   WHERE lo.ofertaEspMail = '1' 
						       AND lo.costoEnvio > 0
							   AND lo.ofertaPrecio != 0  ORDER BY RAND() LIMIT 3
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarOfertasCat($ramaUrl){
		$data = array(); 
		$q = $this->db->query("SELECT lo.ofertaID as ofertaID,
							   lo.ofertaTitulo as tituloOferta,
							   lo.ofertaDescripcion as descripcionOferta,
							   lo.ofertaImagen as imagenOferta,
							   lo.ofertaPrecio as precioOferta,
							   lo.ofertaVigencia as vigenciaOferta,
							   r.ramaUrl as ofertaCategoria
							   FROM locatariosOfertas lo LEFT JOIN ramas r on lo.ramaID = r.ramaID
							   WHERE lo.ofertaMail = '1' 
								AND lo.ofertaStatus = 'Activo'
								AND lo.ofertaPrecio != 0 
							   and r.ramaNombre = '$ramaUrl' ORDER BY RAND() LIMIT 3");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarBannerMail(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM bannersPublicidad WHERE bannerTipo = 'mailBanner' 
							   and bannerStatus = 'Activado' and bannerVigencia > CURDATE() 
							   ORDER BY RAND() LIMIT 1");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarOfertasComputo(){
		$data = array(); 
		$q = $this->db->query("SELECT lo.ofertaID as ofertaID,
							   lo.ofertaTitulo as tituloOferta,
							   lo.ofertaDescripcion as descripcionOferta,
							   lo.ofertaImagen as imagenOferta,
							   lo.ofertaPrecio as precioOferta,
							   lo.ofertaVigencia as vigenciaOferta,
							   r.ramaUrl as ofertaCategoria
							   FROM locatariosOfertas lo LEFT JOIN ramas r on lo.ramaID = r.ramaID
							   WHERE lo.ofertaMail = '1' AND lo.ofertaStatus = 'Activo' 
							   and r.ramaNombre = 'Computadoras' and lo.ofertaVigencia > CURDATE() ORDER BY RAND() LIMIT 3");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarOfertasTablets(){
		$data = array(); 
		$q = $this->db->query("SELECT lo.ofertaID as ofertaID,
							   lo.ofertaTitulo as tituloOferta,
							   lo.ofertaDescripcion as descripcionOferta,
							   lo.ofertaImagen as imagenOferta,
							   lo.ofertaPrecio as precioOferta,
							   lo.ofertaVigencia as vigenciaOferta,
							   r.ramaUrl as ofertaCategoria
							   FROM locatariosOfertas lo LEFT JOIN ramas r on lo.ramaID = r.ramaID
							   WHERE lo.ofertaMail = '1' AND lo.ofertaStatus = 'Activo' 
							   and r.ramaNombre = 'Tablets' and lo.ofertaVigencia > CURDATE() ORDER BY RAND() LIMIT 3");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarOfertasTelefonia(){
		$data = array(); 
		$q = $this->db->query("SELECT lo.ofertaID as ofertaID,
							   lo.ofertaTitulo as tituloOferta,
							   lo.ofertaDescripcion as descripcionOferta,
							   lo.ofertaImagen as imagenOferta,
							   lo.ofertaPrecio as precioOferta,
							   lo.ofertaVigencia as vigenciaOferta,
							   r.ramaUrl as ofertaCategoria
							   FROM locatariosOfertas lo LEFT JOIN ramas r on lo.ramaID = r.ramaID
							   WHERE lo.ofertaMail = '1' AND lo.ofertaStatus = 'Activo' 
							   and r.ramaNombre = 'Telefonia' and lo.ofertaVigencia > CURDATE() ORDER BY RAND() LIMIT 3");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarDiaryMail($ramaUrl){
		$data = array(); 
		$q = $this->db->query("SELECT lo.ofertaID as ofertaID,
							   lo.ofertaTitulo as tituloOferta,
							   lo.ofertaDescripcion as descripcionOferta,
							   lo.ofertaImagen as imagenOferta,
							   lo.ofertaPrecio as precioOferta,
							   lo.ofertaVigencia as vigenciaOferta,
							   r.ramaUrl as ofertaCategoria
							   FROM locatariosOfertas lo LEFT JOIN ramas r on lo.ramaID = r.ramaID
							   WHERE lo.ofertaStatus = 'Activo'
								AND (lo.envio = 'No' AND lo.costoEnvio > 0 OR lo.envio = 'Si' AND lo.costoEnvio = 0)
								AND lo.ofertaPrecio != 0 
							   and r.ramaNombre = '$ramaUrl' and lo.ofertaVigencia >= CURDATE() ORDER BY RAND() LIMIT 3");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarComunicadoMail($id){
		$data = array(); 
		$q = $this->db->query("select comunicadoTitulo as Titulo,
								comunicadoDesc as Descripcion,
								comunicadoImagen as Imagen,
								comunicadoTipoUrl as tipoUrl,
								comunicadoUrl as comunicadoUrl
								from comunicadoMail where comunicadoID='$id'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
}