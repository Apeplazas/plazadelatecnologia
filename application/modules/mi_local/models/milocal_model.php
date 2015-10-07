<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Milocal_model extends CI_Model {
	
	function cargarInbox_mi_local($id){
		$data = array(); 
		$q = $this->db->query("SELECT
							   c.estatusLocal AS 'estatus',
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
							   AND c.inboxStatus='Activo'
							   AND c.estatusLocal='pendiente'		   
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
	
	function cargarInbox($id){
		$data = array(); 
		$q = $this->db->query("SELECT 
							   c.estatusLocal AS 'estatus',
							   c.contactoID AS 'contactoID',
							   c.contactoTipo AS 'contactoTipo',
							   c.contactoComentario AS 'contactoComentario',
							   c.contactoFecha AS 'contactoFecha',
							   c.contactoHora AS 'contactoHora',
							   u.userAlias AS 'userAlias',
							   u.userName AS 'userName',
							   u.lastName AS 'lastName',
							   c.parentID AS 'parentID'
							   FROM contactos c
							   LEFT JOIN usuarios u ON u.idRegistro=c.usuarioIDEnvia
							   WHERE usuarioIDRecibe='$id'
							   AND c.inboxStatus='Activo'
							   AND c.estatusLocal!='borrado'
							   GROUP BY parentID
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
	
	function cargarUltimoLoc($parentID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								c.contactoComentario AS 'contactoComentario',
								c.estatusUsuario AS 'estatus',
								c.parentID AS 'parentID'
								FROM contactos c 
								WHERE parentID='$parentID'
								AND usuarioTipo='usuario'
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
	
	function cargarUltimoCom($parentID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								c.contactoComentario AS 'contactoComentario',
								c.estatusLocal AS 'estatus',
								c.parentID AS 'parentID'
								FROM contactos c 
								WHERE parentID='$parentID'
								AND usuarioTipo='usuario'
								ORDER BY contactoID ASC
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
	
	//Carga y cuenta si hay mensajes pendientes
	function cargarCuentaMsg($id,$parentID){
		$data = array(); 
		$q = $this->db->query("SELECT COUNT(*) as 'cuentaMsg' 
							   FROM contactos c
							   LEFT JOIN usuarios u ON u.idRegistro=c.usuarioIDEnvia
							   WHERE usuarioIDRecibe='$id'
							   AND inboxStatus='Activo'
							   AND parentID='$parentID'
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
	
	function cargarMensajeID($mensajeID){
		$data = array(); 
		$q = $this->db->query("SELECT 
							     c.contactoComentario AS 'contactoComentario',
							     c.contactoID AS 'contactoID',
							     c.contactoTipo AS 'contactoTipo',
							     u.userAlias AS 'userAlias',
							     c.usuarioIDRecibe AS 'usuarioIDRecibe',
							     c.usuarioIDEnvia AS 'usuarioIDEnvia',
							     c.estatusLocal AS 'estatus',
							     c.ofertaID AS 'ofertaID',
							     c.contactoFecha AS 'contactoFecha',
							     c.contactoHora AS 'contactoHora',
							     c.usuarioTipo AS 'usuarioTipo',
							     c.parentID AS 'parentID',
							     u.userName AS 'userName',
							     u.lastName AS 'lastName',
							     u.email AS 'email',
							     lo.ofertaTitulo AS 'ofertaTitulo',
							     lo.ofertaImagen AS 'ofertaImagen',
							     lo.ofertaPrecio AS 'ofertaPrecio',
							     r.ramaNombre AS 'ramaNombre'
							   FROM contactos c 
					  		     LEFT JOIN usuarios u ON c.usuarioIDEnvia=u.idRegistro
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
	
	function cargarLocalInfo($id){
		$data = array(); 
		$q = $this->db->query("SELECT
							   l.localNombre AS 'localNombre',
							   l.localEmail AS 'localEmail',
							   l.localId AS 'localID',
							   l.localLogo AS 'localLogo'
							   FROM locatarios l
							   WHERE localID='$id'
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarBannerTienda($id, $tipo){
		$data = array(); 
		$q = $this->db->query("SELECT 
							   b.imagen AS 'bannerImagen',
							   b.bannerLink AS 'bannerLink',
							   b.bannerUrl AS 'bannerUrl'
							   FROM banners b
							   WHERE b.usuarioID='$id'
							   AND b.bannerTipo='$tipo'
							   AND b.bannerStatus='Activado'
							   ORDER BY b.bannerID DESC
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
	
	function cargarMenuLocal(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM enlaces WHERE menuType='menuBacklocal'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function porConf($localID){
		$data = array(); 
		$q = $this->db->query("SELECT
								c.fechaCompra AS 'fecha',
								c.folio AS 'folio',
								lo.localID AS 'localID',
								lo.ofertaTitulo AS 'ofertaTitulo',
								lo.ofertaImagen AS 'ofertaImagen',
								lo.ofertaDescripcion AS 'ofertaDescripcion',
								lo.ofertaID AS 'ofertaID',
								u.userAlias AS 'userAlias',
								u.email AS 'email',
								u.userName AS 'userName',
								u.lastName AS 'lastName'
							   FROM compras c
							   LEFT JOIN productosComprados pc ON pc.folioCompra=c.folio
							   LEFT JOIN locatariosOfertas lo ON lo.ofertaID=pc.ofertaID
							   LEFT JOIN usuarios u ON u.idRegistro=c.usuarioID
							   LEFT JOIN sitiosEntrega s ON s.idSitio=c.idSitio
							   WHERE c.status='ptConfirmada'
							   AND (pc.statusProducto ='pagada' OR pc.statusProducto ='vista')
							   AND lo.localID='$localID'
							   ORDER BY c.compraID DESC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function verificaCompra($localID,$ofertaID){
		$data = array(); 
		$q = $this->db->query("SELECT
								pc.statusProducto AS 'statusProducto'
							   FROM productosComprados pc
							   LEFT JOIN locatariosOfertas lo ON lo.ofertaID=pc.ofertaID
							     WHERE pc.statusProducto='Aprobada'
							     AND lo.localID='$localID'
							     AND pc.ofertaID='$ofertaID'
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	
	function cargaProductosVen($localID){
		$data = array(); 
		$q = $this->db->query("SELECT
								c.fechaCompra AS 'fecha',
								c.folio AS 'folio',
								lo.localID AS 'localID',
								lo.ofertaTitulo AS 'ofertaTitulo',
								lo.ofertaImagen AS 'ofertaImagen',
								lo.ofertaDescripcion AS 'ofertaDescripcion',
								lo.ofertaID AS 'ofertaID',
								u.userAlias AS 'userAlias',
								u.email AS 'email',
								u.userName AS 'userName',
								u.lastName AS 'lastName',
								pc.statusProducto AS 'statusProducto',
								pc.ofertaPrecio AS 'ofertaPrecio',
								pc.cantidadProducto AS 'cantidad',
								pc.gananciaPt AS 'gananciaPt',
								pc.totalSinComision AS 'totalSinComision',
								pc.subtotalLocal AS 'subtotalLocal'
							   FROM compras c
							   LEFT JOIN productosComprados pc ON c.folio=pc.folioCompra
							   LEFT JOIN locatariosOfertas lo ON lo.ofertaID=pc.ofertaID
							   LEFT JOIN usuarios u ON u.idRegistro=c.usuarioID
							   LEFT JOIN sitiosEntrega s ON s.idSitio=c.idSitio
							   WHERE pc.statusProducto != ''
							   AND lo.localID='$localID'
							   ORDER BY c.compraID DESC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargaProductosConfirmados($localID){
		$data = array(); 
		$q = $this->db->query("SELECT
								c.fechaCompra AS 'fecha',
								c.folio AS 'folio',
								lo.localID AS 'localID',
								lo.ofertaTitulo AS 'ofertaTitulo',
								lo.ofertaImagen AS 'ofertaImagen',
								lo.ofertaDescripcion AS 'ofertaDescripcion',
								lo.ofertaID AS 'ofertaID',
								pc.folioCompra AS 'folioCompra',
								u.userAlias AS 'userAlias',
								u.email AS 'email',
								pc.cantidadProducto AS 'cantidad',
								u.userName AS 'userName',
								u.lastName AS 'lastName',
								pc.statusProducto AS 'statusProducto',
								pc.ofertaPrecio AS 'ofertaPrecio',
								pc.totalSinComision AS 'totalSinComision',
								pc.gananciaPt AS 'gananciaPt'
							   FROM compras c
							    LEFT JOIN productosComprados pc ON c.folio=pc.folioCompra
							   LEFT JOIN locatariosOfertas lo ON lo.ofertaID=pc.ofertaID
							   LEFT JOIN usuarios u ON u.idRegistro=c.usuarioID
							   LEFT JOIN sitiosEntrega s ON s.idSitio=c.idSitio
							   WHERE c.status='ptConfirmada'
							   AND pc.statusProducto ='usuarioRecibio'
							   AND lo.localID='$localID'
							   ORDER BY c.compraID DESC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function productoLocalRama($localID){
		$data = array(); 
		$q = $this->db->query("SELECT
								l.ramaID AS 'ramaID',
								r.ramaNombre AS 'ramaNombre'
								  FROM locatariosOfertas l
								  LEFT JOIN ramas r ON r.ramaID=l.ramaID
								WHERE localID='$localID' 
								  AND l.ramaID > '0'
								  AND l.ofertaStatus = 'Activo'
								GROUP BY r.ramaID
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
	
	function cargarOfertaRama($ramaID, $localID){
		$data = array(); 
		$q = $this->db->query("SELECT
							     lo.ofertaTitulo AS 'ofertaTitulo',
							     lo.ofertaID AS 'ofertaID',
							     lo.ofertaImagen AS 'ofertaImagen',
							     lo.ofertaDescripcion AS 'ofertaDescripcion',
							     lo.ofertaPrecio AS 'ofertaPrecio',
							     lo.ofertaStatus AS 'ofertaStatus',
							     lo.cantidadInicial AS 'cantidadInicial',
							     lo.existencia AS 'existencia' 
							   FROM locatariosOfertas lo
							   WHERE lo.ramaID = '$ramaID'
							     AND lo.localID = '$localID'
							     AND lo.ofertaStatus = 'Activo'
							     OR  lo.ofertaStatus = 'Pendiente'
							     AND existencia > '0'
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
	
	function cargarRamas(){
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
	
	function cargarTematicasRama($ramaID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM tematicas WHERE ramaID='$ramaID'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function foliosTraspasos()
    {
        $data = array(); 
        $q = $this->db->query("SELECT * FROM solicitudTraspasos order by solicitudID DESC limit 1");
        if($q->num_rows() > 0) 
        {
            foreach($q->result() as $row)
            {
                $data[] = $row;
            }
            $q->free_result();  	
        }
        return $data;
    }
	
	function passIgual($id){
		$data = array(); 
		$q = $this->db->query("SELECT contrasenia FROM locatarios WHERE localID='$id'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cuentaVentasporOferta($ofertaID)
	{
	 	$data = array(); 
	  	$q = $this->db->query("SELECT 
								        c.status AS 'status', 
								        COUNT(*) as 'Cuenta'
								          FROM productosComprados pc
								          LEFT JOIN compras c ON c.folio=pc.folioCompra 
								          WHERE ofertaID='$ofertaID'
								          AND c.status='pagado'
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