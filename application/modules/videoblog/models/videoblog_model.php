<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videoblog_model extends CI_Model {
	
	function cargarVideos($tipo){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM articulos WHERE articuloTipo = 'videoblog' AND videoTipo='$tipo' ORDER BY articuloID DESC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarVideosDestacados(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM articulos WHERE articuloTipo = 'videoblog' ORDER BY articuloID DESC LIMIT 5");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarVideoMain(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM articulos WHERE articuloTipo = 'videoblog' AND articuloSlider='1' ORDER BY articuloID DESC LIMIT 1");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarNoticiasTematica($tematica){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM categoriasBlogUnion c
								LEFT JOIN articulos a ON a.articuloID=c.articuloID
								LEFT JOIN categoriasBlog cb ON c.catBlogID=cb.catBlogID
								WHERE cb.categoriaUrl='$tematica'
								ORDER BY a.articuloID DESC
								LIMIT 20
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarNoticiasSucursales($ciudadUrl){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM articulos a
								LEFT JOIN sucursales s ON s.sucursalID=a.sucursalID
							   WHERE s.ciudadUrl='$ciudadUrl' 
							   ORDER BY articuloID 
							   DESC LIMIT 30");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarArticuloPaginaTem($tematica,$articuloID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM categoriasBlogUnion c
								LEFT JOIN articulos a ON a.articuloID=c.articuloID
								LEFT JOIN categoriasBlog cb ON c.catBlogID=cb.catBlogID
								WHERE cb.categoriaUrl='$tematica'
								AND a.articuloID < '$articuloID'
								ORDER BY a.articuloID DESC
								LIMIT 0,20
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarComentarios($articuloUrl){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM comentarios c
							   LEFT JOIN articulos a ON a.articuloID=c.articuloID
							   WHERE a.articuloUrl='$articuloUrl'
							   ORDER BY comentarioID DESC
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarArticulo($articuloUrl){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM articulos WHERE articuloUrl='$articuloUrl'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarArticuloPagina($articuloID){
		$data = array(); 
		$q = $this->db->query("SELECT *
								FROM articulos 
								WHERE articuloID < '$articuloID'
								ORDER BY articuloID DESC
								LIMIT 0,20
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarUltimosEventos(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM articulos WHERE articuloTipo='eventos' ORDER BY articuloID DESC LIMIT 10");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarUltimosDestacados(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM articulos WHERE articuloTipo='noticias' ORDER BY rand() LIMIT 10");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarUltimosSorteos(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM articulos WHERE articuloTipo='sorteos' ORDER BY articuloID DESC LIMIT 10");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarTags($articuloID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								ta.tagNombre as 'tagNombre'
								from tagUnionCatalogo tc 
								LEFT JOIN tagsArticulos ta ON ta.tagID=tc.tagID
								WHERE tc.articuloID='$articuloID'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cuentaComentarios($articuloID){
		$data = array(); 
		$q = $this->db->query("SELECT COUNT(c.comentarioID) as total
								FROM comentarios c
								WHERE articuloID='$articuloID'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
}