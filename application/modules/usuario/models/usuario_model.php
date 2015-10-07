<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {
	
	function cargarInbox_usuario($id){
		$data = array(); 
		$q = $this->db->query("SELECT
							   c.estatusUsuario AS 'estatus',
							   c.contactoId AS 'contactoID',
							   c.contactoTipo AS 'contactoTipo',
							   c.contactoComentario AS 'contactoComentario',
							   c.contactoFecha AS 'contactoFecha',
							   c.contactoHora AS 'contactoHora',
							   u.userAlias AS 'userAlias',
							   u.userName AS 'userName',
							   u.lastName AS 'lastName'
							   FROM contactos c
							   LEFT JOIN usuarios u ON u.idRegistro=c.usuarioIDEnvia
							   WHERE usuarioIDRecibe='$id'
							   AND inboxStatus='Activo'
							   AND c.estatusUsuario!='borrado'
							   AND c.estatusUsuario='pendiente'				   
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
	
	function borrado($mensajeID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM contactos WHERE parentID='$mensajeID'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}

	function cargarInbox($id){
		$data = array(); 
		$q = $this->db->query("SELECT 
							     c.estatusUsuario AS 'estatus',
							     c.contactoID AS 'contactoID',
							     c.contactoTipo AS 'contactoTipo',
							     c.contactoComentario AS 'contactoComentario',
							     c.contactoFecha AS 'contactoFecha',
							     c.contactoHora AS 'contactoHora',
							     l.localNombre AS 'userAlias',
							     l.localContacto AS 'userName',
							     c.parentID AS 'parentID'
							   FROM contactos c
							   LEFT JOIN locatarios l ON l.localID=c.usuarioIDEnvia
							     WHERE c.usuarioIDRecibe='$id'
							     AND c.inboxStatus='Activo'
							     AND c.estatusUsuario!='borrado'
							     GROUP BY c.parentID
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
	
	function cargarUltimoCom($parentID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								c.contactoComentario AS 'contactoComentario',
								c.estatusUsuario AS 'estatus',
								c.parentID AS 'parentID'
								FROM contactos c 
								WHERE parentID='$parentID'
								AND usuarioTipo='usuario'
								ORDER BY c.contactoID ASC
								limit 1
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarUltimoLoc($parentID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								c.contactoComentario AS 'contactoComentario',
								c.estatusUsuario AS 'estatus',
								c.parentID AS 'parentID'
								FROM contactos c 
								WHERE parentID='$parentID'
								AND usuarioTipo='local'
								ORDER BY c.contactoID DESC
								limit 1
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarMenuUsuario(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM enlaces WHERE menuType='menuBackUsers'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarMensajeID($mensajeID){
		$data = array(); 
		$q = $this->db->query("SELECT 
							     c.contactoComentario AS 'contactoComentario',
							     c.contactoID AS 'contactoID',
							     c.contactoTipo AS 'contactoTipo',
							     l.localContacto AS 'userAlias',
							     c.usuarioIDRecibe AS 'usuarioIDRecibe',
							     c.usuarioIDEnvia AS 'usuarioIDEnvia',
							     c.estatusUsuario AS 'estatus',
							     c.ofertaID AS 'ofertaID',
							     c.contactoFecha AS 'contactoFecha',
							     c.contactoHora AS 'contactoHora',
							     c.usuarioTipo AS 'usuarioTipo',
							     l.localNombre AS 'userName',
							     l.localEmail AS 'email',
							     lo.ofertaTitulo AS 'ofertaTitulo',
							     lo.ofertaImagen AS 'ofertaImagen',
							     lo.ofertaPrecio AS 'ofertaPrecio',
							     r.ramaNombre AS 'ramaNombre'
							   FROM contactos c 
					  		     LEFT JOIN locatarios l ON c.usuarioIDRecibe=l.localID
					  		     LEFT JOIN locatariosOfertas lo ON lo.ofertaID=c.ofertaID
					  		     LEFT JOIN ramas r ON r.ramaID=lo.ramaID
							   WHERE contactoID='$mensajeID'
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
							     c.usuarioTipo AS 'usuarioTipo',
							     c.contactoID AS 'contactoID'
							   FROM contactos c 
					  		     LEFT JOIN locatarios l ON c.usuarioIDEnvia=l.localID
					  		     LEFT JOIN usuarios u ON u.idRegistro=c.usuarioIDEnvia
							   WHERE parentID='$parentID'
							   ORDER BY c.contactoID ASC
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//Carga y cuenta si hay mensajes pendientes
	function cargarCuentaMsg($id,$parentID){
		$data = array(); 
		$q = $this->db->query("SELECT COUNT(*) as 'cuentaMsg'
							   FROM contactos c
							   LEFT JOIN usuarios u ON u.idRegistro=c.usuarioIDEnvia
							   WHERE usuarioIDRecibe='$id'
							   AND inboxStatus='Activo'
							   AND c.estatusUsuario!='borrado'
							   AND c.estatusUsuario='pendiente'
							   AND c.parentID='$parentID'	   
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
	
	function limpiarContestaciones($parentID){
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
							     c.usuarioTipo AS 'usuarioTipo',
							     c.contactoID AS 'contactoID'
							   FROM contactos c 
					  		     LEFT JOIN locatarios l ON c.usuarioIDEnvia=l.localID
					  		     LEFT JOIN usuarios u ON u.idRegistro=c.usuarioIDEnvia
							   WHERE parentID='$parentID'
							   ORDER BY c.contactoID ASC
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarUsuarioInfo($id){
		$data = array(); 
		$q = $this->db->query("SELECT
							   u.userAlias AS 'userAlias',
							   u.userName AS 'userName',
							   u.email AS 'email',
							   u.idRegistro AS 'idRegistro',
							   u.uidFacebook AS 'uidFacebook'
							   FROM usuarios u
							   WHERE idRegistro='$id'
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function ajustesCuenta($id){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM usuarios WHERE idRegistro='$id'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function passIgual($id){
		$data = array(); 
		$q = $this->db->query("SELECT contrasenia FROM usuarios WHERE idRegistro='$id'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	function pedidosLista($id){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM compras WHERE usuarioID = '$id'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function detalleCompra($folio){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM productosComprados pc 
								LEFT JOIN locatariosOfertas lo ON pc.ofertaID = lo.ofertaID
								LEFT JOIN compras c ON c.folio = pc.folioCompra
								LEFT JOIN sitiosEntrega s ON s.idSitio = c.idSitio
								LEFT JOIN estadosMexico em ON s.estado = em.claveEstado 
								WHERE  s.CodigoPostal = em.codigoCP 
								AND s.municipioDelegacion = em.claveMunicipio 
								AND s.colonia = em.claveColonia 
								AND pc.folioCompra = '$folio'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function direccionesCuenta($usuarioID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM sitiosEntrega s
								LEFT JOIN estadosMexico em ON s.estado = em.claveEstado 
								WHERE  s.CodigoPostal = em.codigoCP 
								AND s.municipioDelegacion = em.claveMunicipio 
								AND s.colonia = em.claveColonia 
								AND s.usuarioID = '$usuarioID'
								AND s.estatus = 'activo'
								ORDER BY s.idSitio DESC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarDireccion($idSitio){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM sitiosEntrega s
								LEFT JOIN estadosMexico em ON s.estado = em.claveEstado 
								WHERE  s.CodigoPostal = em.codigoCP 
								AND s.municipioDelegacion = em.claveMunicipio 
								AND s.colonia = em.claveColonia 
								AND s.idSitio = '$idSitio'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
}