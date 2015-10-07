<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog_model extends CI_Model {
	
	function cargarNoticias(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM articulos 
							   WHERE articuloTipo !='videoblog' 
							   ORDER BY articuloFecha DESC");
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
								AND articuloFecha >= DATE_ADD(NOW(),INTERVAL -2 MONTH)
								ORDER BY articuloFecha DESC
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
							   AND articuloFecha >= DATE_ADD(NOW(),INTERVAL -2 MONTH)
							   ORDER BY articuloFecha DESC");
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
								 AND a.articuloFecha >= DATE_ADD(NOW(),INTERVAL -2 MONTH)
							   ORDER BY a.articuloFecha DESC
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
							   AND c.parentID = 0
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
	
	function respComents($parentID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM comentarios c
							   LEFT JOIN articulos a ON a.articuloID=c.articuloID
							   WHERE c.parentID = $parentID
							   ORDER BY comentarioID ASC
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function comentRaiz($parentID){
		$data = array(); 
		$q = $this->db->query("SELECT   nombre,
										email, 
										comentario,
										articuloTitulo,
										articuloUrl,
									    (SELECT comentario FROM comentarios c
									    	WHERE c.parentID = $parentID
											ORDER BY comentarioID DESC LIMIT 1) AS 'ultimoComent', 
										(SELECT nombre FROM comentarios c
											WHERE c.parentID = $parentID
											ORDER BY comentarioID DESC LIMIT 1) AS 'nombreUltimo'
								FROM comentarios c
								LEFT JOIN articulos a ON a.articuloID=c.articuloID
								WHERE c.comentarioID = $parentID");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function comentNuevo($articuloID){
		$data = array(); 
		$q = $this->db->query("SELECT   nombre,
										email, 
										comentario,
										articuloTitulo,
										articuloUrl
								FROM comentarios c
								LEFT JOIN articulos a ON a.articuloID=c.articuloID
								WHERE a.articuloID = $articuloID
								ORDER BY c.comentarioID DESC
								LIMIT 1");
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
		$q = $this->db->query("SELECT * FROM articulos 
								WHERE articuloID < '$articuloID'
								AND articuloTipo !='videoblog' 
							    AND articuloFecha >= DATE_ADD(NOW(),INTERVAL -2 MONTH)
								AND fechaVigencia > CURDATE()
							    ORDER BY articuloFecha DESC
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
		$q = $this->db->query("SELECT * FROM articulos 
							   WHERE articuloTipo='eventos' 
							   AND articuloFecha >= DATE_ADD(NOW(),INTERVAL -2 MONTH)
							   AND fechaVigencia > CURDATE()
							   ORDER BY articuloFecha DESC LIMIT 10");
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
		$q = $this->db->query("SELECT * FROM articulos 
								WHERE articuloTipo='noticias' 
								AND articuloFecha >= DATE_ADD(NOW(),INTERVAL -2 MONTH)
								AND fechaVigencia > CURDATE()
								ORDER BY articuloFecha DESC LIMIT 10");
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
		$q = $this->db->query("SELECT * FROM articulos 
								WHERE articuloTipo='sorteos' 
								AND articuloFecha >= DATE_ADD(NOW(),INTERVAL -2 MONTH)
								AND fechaVigencia > CURDATE()
								ORDER BY articuloFecha DESC LIMIT 10");
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