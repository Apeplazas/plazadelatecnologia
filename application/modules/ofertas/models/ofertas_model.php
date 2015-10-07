<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ofertas_model extends CI_Model {
	
	function cargarOfertasCat($categoria, $order){
		$data = array(); 
		$q = $this->db->query("SELECT 
									lo.ofertaTitulo as 'ofertaTitulo',
									lo.ofertaDescripcion as 'ofertaDescripcion',
									lo.ofertaPrecio as 'ofertaPrecio',
									lo.ofertaImagen as 'ofertaImagen',
									lo.promoBuenFin as 'promoBuenFin',
									lo.ofertaID as 'ofertaID',
									r.ramaNombre as 'rama',
									cm.marca as 'marca',
									r.ramaID as 'ramaID',
									(SELECT ROUND(12Meses,2) FROM bancos where bancoID = 1) as meses,
									(SELECT ROUND(comisionCC, 1) FROM bancos where bancoID = 1) as comision
								FROM ramas r
								LEFT JOIN locatariosOfertas lo ON r.ramaID = lo.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE r.ramaNombre = '$categoria' 
								AND lo.ofertaStatus = 'Activo'
								
								ORDER BY $order 
		");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function marcas($categoria){
		$data = array(); 
		$q = $this->db->query("SELECT marca, COUNT(lo.ofertaID) as total, marcaUrl 
								FROM ramas r
								LEFT JOIN locatariosOfertas lo ON r.ramaID = lo.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE r.ramaNombre = '$categoria' 
								AND lo.ofertaStatus = 'Activo'
								AND lo.costoEnvio > 0 
								AND lo.ofertaPrecio != 0
								
								GROUP BY marca ORDER BY marca ASC LIMIT 6
		");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarPendientesLocal($localID){
		$data = array(); 
		$q = $this->db->query("SELECT
							     lo.ofertaTitulo AS 'ofertaTitulo',
							     lo.ofertaID AS 'ofertaID',
							     lo.ofertaImagen AS 'ofertaImagen',
							     lo.promoBuenFin as 'promoBuenFin',
							     lo.ofertaDescripcion AS 'ofertaDescripcion',
							     lo.ofertaPrecio AS 'ofertaPrecio',
							     lo.ofertaStatus AS 'ofertaStatus',
							     lo.ramaID as 'ramaID'
							   FROM locatariosOfertas lo
							   WHERE lo.localID = '$localID'
							   AND (lo.ofertaStatus = 'Pendiente' OR lo.ofertaStatus = 'No Publicado')
							   ORDER BY lo.ofertaID DESC
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	
	// HICE CAMBIOS EN ESTE OJO
	function cargarOferta($ofertaID, $extras){
		$data = array(); 
		$q = $this->db->query("SELECT 
								lo.ofertaTitulo as 'ofertaTitulo',
								lo.estadoProducto as 'statusProducto',
								lo.garantia as 'garantia',
								lo.ofertaDescripcion as 'ofertaDescripcion',
								lo.ofertaPrecio as 'ofertaPrecio',
								lo.ofertaImagen as 'ofertaImagen',
								lo.envio as 'envio',
								lo.costoEnvio as 'costoEnvio',
								lo.ofertaID as 'ofertaID',
								lo.ofertaPrecio as 'ofertaPrecio',
								lo.existencia as 'existencia',
								lo.precioLocal as 'precioLocal',
								lo.ofertaStatus as 'ofertaStatus',
								lo.costoEnvio as 'costoEnvio',
								lo.diasEntrega as 'diasEntrega',
								l.localNombre as 'localNombre',
								lo.promoBuenFin as 'promoBuenFin',
								l.localTelefono as 'localTelefono',
								l.localUrl as 'localUrl',
								l.localEmail as 'localEmail',
								lo.localID as 'localID',
								lo.ramaID as 'ramaID',
								lo.envio as 'envio',
								lo.color as 'color',
								lo.descuentoPorcentaje as 'descuento',
							    lo.descuentoTotal as 'descuentoTotal',
							    lo.gananciaPt as 'gananciaPt',
								r.ramaNombre as 'ramaNombre',
								r.ramaID as 'ramaID',
								lo.existencia as 'disponibles',
								t.tematicaNombre as 'tematicaNombre',
								cm.marca as 'marca',
								(SELECT ROUND(12Meses,2) FROM bancos where bancoID = 1) as meses,
								(SELECT ROUND(comisionCC, 1) FROM bancos where bancoID = 1) as comision
								FROM locatariosOfertas lo 
								LEFT JOIN locatarios l ON lo.localID = l.localID
								LEFT JOIN ramas r ON r.ramaID=lo.ramaID
								LEFT JOIN tematicas t ON t.tematicaID=lo.tematicaID
								LEFT JOIN catMarcas cm ON cm.marcaID=lo.marcaID
								WHERE lo.ofertaID = '$ofertaID'
								$extras
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	// HICE CAMBIOS EN ESTE OJO
	function cargarMarcasRama($cat){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM catMarcas WHERE ramaID='$cat'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function imgsProducto($ofertaID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM imagenesProductos  WHERE ofertaID = '$ofertaID' 
		");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	// agregue este modelo para cargar marcas
	function cargarCatTipo($ofertaID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								uc.catTipoID as 'catID',
								uc.ID as 'subCatID',
								ct.descripcion as 'categoria',
								uc.descripcion as 'subcategoria'
								FROM unionProductosTipo up
							   LEFT JOIN unionCatalogo uc ON uc.ID=up.unionCatalogoID
							   LEFT JOIN catTipo ct ON ct.tipoID=uc.catTipoID
							   WHERE up.ofertaID='$ofertaID'
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	
	function cargarCatTipoRama($cat){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM catTipo WHERE ramaID='$cat'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarBusquedaCat($ofertaID, $ID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								ut.unionTipoID AS 'unionTipoID',
								ut.ofertaID AS 'ofertaID',
								ut.unionCatalogoID AS 'unionCatalogoID',
								ct.catTipoID AS 'catTipoID',
								ct.descripcion AS 'descripcion'
							  FROM unionProductosTipo ut 
							  LEFT JOIN unionCatalogo ct ON ct.ID=ut.unionCatalogoID
							  WHERE ut.ofertaID='$ofertaID' 
							  AND ct.catTipoID='$ID'
							  GROUP BY ct.catTipoID
							  ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  
				
		}
		return $data;
	}


	// agregue este modelo para cargar marcas
	function cargarCatInfo($catID){
		$data = array(); 
		$q = $this->db->query("SELECT 
							     descripcion as 'descripcion' 
							   FROM unionCatalogo 
							   WHERE catTipoID='$catID'
		");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	// agregue este modelo para cargar marcas
	function cargarMarcas(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM catMarcas ORDER BY marca ASC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	// agregue este modelo para buscar ID de marca
	function cargarMarcasID($marca){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM catMarcas WHERE marca='$marca'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	// agregue este modelo para buscar ID de marca
	function cargarSubcatID($subCatID,$tipoID){
		$data = array(); 
		$q = $this->db->query("SELECT *  FROM unionCatalogo WHERE descripcion='$subCatID' and catTipoID='$tipoID' GROUP BY ramaID");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarOfertaCaract($ofertaID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM caracteristicasOferta WHERE ofertaID = '$ofertaID'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarFotosExtras($ofertaID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM imagenesProductos WHERE ofertaID = '$ofertaID'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarOfertaPresen($ofertaID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM presentacionOferta WHERE ofertaID = '$ofertaID'
		");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarUltimoIdOferta($localID){
		$data = array(); 
		$q = $this->db->query("SELECT ofertaID FROM locatariosOfertas WHERE localID='$localID' ORDER BY ofertaID desc LIMIT 1");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function obtenerIdTematica($tematicaNombre){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM tematicas WHERE tematicaNombre='$tematicaNombre'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarPendientes($localID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM locatariosOfertas WHERE localID='$localID' and ofertaStatus='Pendiente' or ofertaStatus = 'No Publicado'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarComentarios($ofertaID){
		$data = array(); 
		$q = $this->db->query("SELECT * 
								FROM contactos c
								LEFT JOIN usuarios u ON c.usuarioIDEnvia=u.idRegistro
								WHERE c.contactoTipo='oferta' 
								AND c.usuarioTipo='usuario' 
								AND c.ofertaID='$ofertaID'
								ORDER BY c.contactoID DESC
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarContestaciones($parentID){
		$data = array(); 
		$q = $this->db->query("SELECT 
							     c.contactoComentario AS 'contactoComentario',
							     c.usuarioTipo AS 'usuarioTipo',
							     u.userName AS 'userName',
							     l.localNombre AS 'localNombre',
							     l.localLogo AS 'localLogo',
							     c.contactoHora AS 'contactoHora',
							     c.contactoFecha AS 'contactoFecha',
							     c.usuarioIDRecibe AS 'usuarioIDRecibe',
							     c.usuarioIDEnvia AS 'usuarioIDEnvia',
							     c.contactoTipo AS 'contactoTipo',
							     c.usuarioTipo AS 'usuarioTipo'
							   FROM contactos c 
					  		     LEFT JOIN locatarios l ON c.usuarioIDEnvia=l.localID
					  		     LEFT JOIN usuarios u ON u.idRegistro=c.usuarioIDEnvia
							   WHERE parentID='$parentID'
							   AND usuarioTipo!='usuario'
							   
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function ofertas_filtro($rama, $marca, $filtro1){
		$data = array(); 
		$q = $this->db->query("SELECT 
									lo.ofertaTitulo as 'ofertaTitulo',
									lo.ofertaDescripcion as 'ofertaDescripcion',
									lo.ofertaPrecio as 'ofertaPrecio',
									lo.promoBuenFin as 'promoBuenFin',
									lo.ofertaImagen as 'ofertaImagen',
									lo.ofertaID as 'ofertaID',
									r.ramaNombre as 'rama',
									cm.marca as 'marca',
									r.ramaID as 'ramaID',
									(SELECT ROUND(12Meses,2) FROM bancos where bancoID = 1) as meses,
									(SELECT ROUND(comisionCC, 1) FROM bancos where bancoID = 1) as comision
									
								FROM ramas r
								LEFT JOIN locatariosOfertas lo ON r.ramaID = lo.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								LEFT JOIN unionProductosTipo upt ON upt.ofertaID = lo.ofertaID
								LEFT JOIN unionCatalogo uc ON uc.ID = upt.unionCatalogoID
								WHERE r.ramaNombre = '$rama'
								$marca
								AND upt.unionCatalogoID = $filtro1
								AND lo.ofertaStatus = 'Activo'
								
							   
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarOfertasTodas($ofertaTipo, $marca,$rama, $order){
		
		$marcaAnd = '';		
		$ramaAnd = '';
			
		if ($marca != '0') {
			$marcaAnd = "AND cm.marcaUrl = '$marca'";
		}
		
		if ($rama != '0') {
			$ramaAnd = "AND r.ramaUrl = '$rama'";
		}
		
		$data = array();
		$q = $this->db->query("SELECT 
									lo.ofertaTitulo as 'ofertaTitulo',
									    lo.ofertaDescripcion as 'ofertaDescripcion',
									    lo.ofertaPrecio as 'ofertaPrecio',
									    lo.ofertaImagen as 'ofertaImagen',
									    lo.envio as 'envio',
									    lo.costoEnvio as 'costoEnvio',
									    lo.ofertaID as 'ofertaID',
									    lo.promoBuenFin as 'promoBuenFin',
									    lo.descuentoPorcentaje as 'descuentoPorcentaje',
									    lo.descuentoTotal as 'descuentoTotal',
									    lo.gananciaPt as 'gananciaPt',
									    lo.precioLocal as 'precioLocal',
									    r.ramaNombre as 'rama',
									    r.ramaID as 'ramaID',
									    cm.marca as 'marca',
									    (SELECT ROUND(12Meses,2) FROM bancos where bancoID = 1) as meses,
									    (SELECT ROUND(comisionCC, 1) FROM bancos where bancoID = 1) as comision
								FROM ramas r
								LEFT JOIN locatariosOfertas lo ON r.ramaID = lo.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE lo.ofertaTipo = '$ofertaTipo'
								AND lo.ofertaStatus = 'Activo'
								AND lo.costoEnvio > 0 
								AND lo.ofertaPrecio != 0
								
								$marcaAnd
								$ramaAnd
								ORDER BY $order ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarOfertasGamers($marca,$rama, $order){
		
		$marcaAnd = '';		
		$ramaAnd = '';
			
		if ($marca != '0') {
			$marcaAnd = "AND cm.marcaUrl = '$marca'";
		}
		
		if ($rama != '0') {
			$ramaAnd = "AND r.ramaUrl = '$rama'";
		}
		
		$data = array();
		$q = $this->db->query("SELECT 
									lo.ofertaTitulo as 'ofertaTitulo',
									    lo.ofertaDescripcion as 'ofertaDescripcion',
									    lo.ofertaPrecio as 'ofertaPrecio',
									    lo.ofertaImagen as 'ofertaImagen',
									    lo.envio as 'envio',
									    lo.costoEnvio as 'costoEnvio',
									    lo.ofertaID as 'ofertaID',
									    lo.descuentoPorcentaje as 'descuentoPorcentaje',
									    lo.descuentoTotal as 'descuentoTotal',
									    lo.promoBuenFin as 'promoBuenFin',
									    lo.gananciaPt as 'gananciaPt',
									    lo.precioLocal as 'precioLocal',
									    r.ramaNombre as 'rama',
									    r.ramaID as 'ramaID',
									    cm.marca as 'marca',
									    (SELECT ROUND(12Meses,2) FROM bancos where bancoID = 1) as meses,
									    (SELECT ROUND(comisionCC, 1) FROM bancos where bancoID = 1) as comision
								FROM ramas r
								LEFT JOIN locatariosOfertas lo ON r.ramaID = lo.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE campaniaGamers = '1'
								AND lo.ofertaStatus = 'Activo'
								AND lo.costoEnvio > 0 
								AND lo.ofertaPrecio != 0
								
								$marcaAnd
								$ramaAnd
								ORDER BY $order ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarOfertasGeeks($marca,$rama, $order){
		
		$marcaAnd = '';		
		$ramaAnd = '';
			
		if ($marca != '0') {
			$marcaAnd = "AND cm.marcaUrl = '$marca'";
		}
		
		if ($rama != '0') {
			$ramaAnd = "AND r.ramaUrl = '$rama'";
		}
		
		$data = array();
		$q = $this->db->query("SELECT 
									lo.ofertaTitulo as 'ofertaTitulo',
									    lo.ofertaDescripcion as 'ofertaDescripcion',
									    lo.ofertaPrecio as 'ofertaPrecio',
									    lo.ofertaImagen as 'ofertaImagen',
									    lo.envio as 'envio',
									    lo.costoEnvio as 'costoEnvio',
									    lo.ofertaID as 'ofertaID',
									    lo.descuentoPorcentaje as 'descuentoPorcentaje',
									    lo.descuentoTotal as 'descuentoTotal',
									    lo.gananciaPt as 'gananciaPt',
									    lo.promoBuenFin as 'promoBuenFin',
									    lo.precioLocal as 'precioLocal',
									    r.ramaNombre as 'rama',
									    r.ramaID as 'ramaID',
									    cm.marca as 'marca',
									    (SELECT ROUND(12Meses,2) FROM bancos where bancoID = 1) as meses,
									    (SELECT ROUND(comisionCC, 1) FROM bancos where bancoID = 1) as comision
								FROM ramas r
								LEFT JOIN locatariosOfertas lo ON r.ramaID = lo.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE campaniaGeeks = '1'
								AND lo.ofertaStatus = 'Activo'
								AND lo.costoEnvio > 0 
								AND lo.ofertaPrecio != 0
								
								$marcaAnd
								$ramaAnd
								ORDER BY $order ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function marcasDinamica($ofertaTipo, $rama){
				
		$ramaAnd = '';
			
		if ($rama != '0') {
			$ramaAnd = "AND r.ramaUrl = '$rama'";
		}	
		
		$data = array(); 
		$q = $this->db->query("SELECT marca, COUNT(lo.ofertaID) as total, marcaUrl 
								FROM ramas r
								LEFT JOIN locatariosOfertas lo ON r.ramaID = lo.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE lo.ofertaStatus = 'Activo'
								
								AND lo.costoEnvio > 0 
								AND lo.ofertaPrecio != 0
								AND lo.ofertaTipo = '$ofertaTipo'
								$ramaAnd
								GROUP BY marca ORDER BY marca ASC
		");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function ramasDinamica($ofertaTipo, $marca){
				
		$marcaAnd = '';
			
		if ($marca != '0') {
			$marcaAnd = "AND cm.marcaUrl = '$marca'";
		}		
		
		$data = array(); 
		$q = $this->db->query("SELECT ramaNombre, COUNT(lo.ofertaID) as total, ramaUrl
								FROM ramas r
								LEFT JOIN locatariosOfertas lo ON r.ramaID = lo.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE lo.ofertaStatus = 'Activo'
								
								AND lo.costoEnvio > 0 
								AND lo.ofertaPrecio != 0
								AND lo.ofertaTipo = '$ofertaTipo'
								$marcaAnd
								GROUP BY ramaNombre ORDER BY ramaNombre ASC
		");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function ofertasAdRoll(){
			
		$data = array(); 
		$q = $this->db->query("SELECT lo.ofertaID as 'ofertaID',
										lo.ofertaTitulo as 'ofertaTitulo',
										lo.ofertaDescripcion as 'ofertaDescripcion',
										lo.ofertaPrecio as 'ofertaPrecio',
										lo.promoBuenFin as 'promoBuenFin',
										lo.ofertaImagen as 'ofertaImagen',
										lo.ofertaPrecio as 'ofertaPrecio',
										r.ramaNombre as 'ramaNombre',
										t.tematicaNombre as 'tematicaNombre',
										cm.marca as 'marca'
								FROM locatariosOfertas lo 
								LEFT JOIN locatarios l ON lo.localID = l.localID
								LEFT JOIN ramas r ON r.ramaID=lo.ramaID
								LEFT JOIN tematicas t ON t.tematicaID=lo.tematicaID
								LEFT JOIN catMarcas cm ON cm.marcaID=lo.marcaID
								WHERE lo.adroll = '1'
								AND lo.ofertaStatus = 'Activo'
			        		    AND lo.costoEnvio > 0 
			           		    AND lo.ofertaPrecio != 0");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
}