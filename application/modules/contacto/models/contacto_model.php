<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_model extends CI_Model {
	
	function cargarOptimizacion($opt){
		$data = array(); 
		$q = $this->db->query("SELECT 
								s.metaTitle as 'metaTitle', 
								s.metaDescripcion as 'metaDescripcion',
								s.metaKeyword as 'metaKeyword'
								FROM enlaces s 
								WHERE paginaUrl='$opt'
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarMenu($menuType, $typeSubmenu){
		$data = array(); 
		$q = $this->db->query(" SELECT * FROM enlaces 
								WHERE menuType='$menuType'
								AND catalogoID = '$typeSubmenu'
								AND enlaceEstatus='Activo'
								ORDER BY enlaceOrden ASC
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarEnlace($ramaNombre){
		$data = array(); 
		$q = $this->db->query(" SELECT * FROM enlaces 
								WHERE enlaceNombre='$ramaNombre'
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}	
	
	
	//Carga ramas basadas en productos disponibles
	function cargarRamaDisponibles(){
		$data = array(); 
		$q = $this->db->query("SELECT 
								e.enlaceTitulo as 'enlaceTitulo',
								e.enlaceNombre as 'enlaceNombre',
								e.paginaUrl	as 'paginaUrl',
								e.microFormatos as 'microFormatos',
								e.ramaID as 'ramaID',
								r.ramaNombre as 'ramaNombre',
								e.giros as 'menuTipo',
								e.subMenu as 'subMenu',
								e.enlaceID as 'enlaceID'
							  FROM 
							  productos p
							  LEFT JOIN enlaces e ON e.ramaID=p.ramaID
							  LEFT JOIN ramas r ON r.ramaID=e.ramaID
							  WHERE e.giros = 'rama'
							  group by enlaceTitulo
							  order by e.enlaceOrden
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	//Carga Tematicas basadas en productos disponibles
	function cargarTematicasDisponibles($ramaID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								e.enlaceTitulo as 'enlaceTitulo',
								e.enlaceNombre as 'enlaceNombre',
								e.paginaUrl	as 'paginaUrl',
								e.microFormatos as 'microFormatos',
								e.ramaID as 'ramaID',
								e.tematicaID as 'tematicaID',
								e.categoriaID as 'categoriaID',
								e.giros as 'menuTipo',
								e.subMenu as 'subMenu',
								e.enlaceID as 'enlaceID',
								t.tematicaNombre as 'tematicaNombre'
							  FROM 
							  productos p
							  LEFT JOIN enlaces e ON e.tematicaID=p.tematicaID
							  LEFT JOIN tematicas t ON t.tematicaID=p.tematicaID
							  WHERE e.ramaID='$ramaID'
							  GROUP BY e.tematicaID
							  
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//Carga categorias dependiendo de los articulos existentes
	function cargarCatDisponibles($tematicaID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								e.enlaceTitulo as 'enlaceTitulo',
								e.enlaceNombre as 'enlaceNombre',
								e.paginaUrl	as 'paginaUrl',
								e.microFormatos as 'microFormatos',
								e.ramaID as 'ramaID',
								e.tematicaID as 'tematicaID',
								e.categoriaID as 'categoriaID',
								e.giros as 'menuTipo',
								e.subMenu as 'subMenu',
								e.enlaceID as 'enlaceID',
								t.tematicaNombre as 'tematicaNombre'
							  FROM 
							    productos p
							  LEFT JOIN enlaces e ON e.tematicaID=p.tematicaID
							  LEFT JOIN tematicas t ON t.tematicaID=p.tematicaID
							  WHERE e.giros='categoria'
							  AND e.tematicaID='$tematicaID'
							  GROUP BY e.categoriaID
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