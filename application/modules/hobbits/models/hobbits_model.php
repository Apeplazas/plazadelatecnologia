<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hobbits_model extends CI_Model {
	
	function cargarMenu(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM enlaces WHERE menuType='admin' AND enlaceEstatus='Activo'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
		
	function cargarCampanias(){
		$data = array(); 
		$q = $this->db->query("SELECT 
								c.campaniaID AS 'campaniaID',
								c.campaniaNombre AS 'campaniaNombre',
								c.campaniaDescripcion AS 'campaniaDescripcion',
								c.campaniaUrl AS 'campaniaUrl',
								c.fechaInicio AS 'fechaInicio',
								c.fechaFin AS 'fechaFin',
								c.colorPromocion AS 'colorPromocion',
								c.status AS 'status',
								b.bannerImagen AS 'bannerImagen'
								FROM campanias c
								LEFT JOIN bannersPublicidad b ON b.campaniaID=c.campaniaID
								WHERE status !='borrada' 
								ORDER BY campaniaID desc");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarEnlaces(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM enlaces");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function buscaEnlace($enlace){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM enlaces WHERE paginaUrl='$enlace'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function existeEnlace($publicidadID, $enlaceID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM bannersUnion WHERE publicidadID='$publicidadID' and enlaceID='$enlaceID' AND status='activo'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function buscaUrlBanners($publicidadID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM bannersUnion bu
							   LEFT JOIN enlaces e ON e.enlaceID=bu.enlaceID
							   WHERE publicidadID='$publicidadID'
							   AND status='activo'
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}

	function cargarBannersPromocion(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM bannersPublicidad");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarCampaniaID($campaniaID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM campanias WHERE campaniaID='$campaniaID'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargaMarcas(){
		$data = array(); 
		$q = $this->db->query("SELECT 
								  m.marca as 'marca',
								  m.marcaUrl as 'marcaUrl',
								  count(m.marca) AS 'total'
								  FROM locatariosOfertas p
								  LEFT JOIN catMarcas m ON m.marcaID=p.marcaID
								  WHERE p.ofertaStatus = 'Activo'
								  AND m.marca !=''
								  GROUP BY m.marca
								  ORDER BY m.marca				
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//Carga Tematicas basadas en locatariosOfertas disponibles
	function cargarTematicasDisponible(){
		$data = array(); 
		$q = $this->db->query("SELECT 
								  t.tematicaNombre as 'tematicaNombre',
								  t.tematicaUrl as 'tematicaUrl',
								  count(t.tematicaNombre) AS 'total'
								FROM locatariosOfertas p
								LEFT JOIN tematicas t ON t.tematicaID=p.tematicaID
								WHERE p.ofertaStatus = 'Activo'
								AND t.tematicaNombre !=''
								GROUP BY t.tematicaNombre
								ORDER BY t.tematicaNombre
							  ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarOfertas($ofertaTipo,$rama,$marca,$tematica)
	{
		$cad_busqueda = "";
		
		if( !empty($ofertaTipo) )
			$cad_busqueda.="AND lo.ofertaTipo = '$ofertaTipo'";
			
		if( !empty($rama) )
			$cad_busqueda.="AND r.ramaUrl='$rama'";
			
		if( !empty($marca) )
			$cad_busqueda.="AND m.marcaUrl='$marca'";
		
		if( !empty($tematica) )
			$cad_busqueda.="AND t.tematicaUrl='$tematica'";
		
			$query = $this->db->query("SELECT 
										lo.ofertaTitulo as 'ofertaTitulo',
									    lo.ofertaDescripcion as 'ofertaDescripcion',
									    lo.ofertaPrecio as 'ofertaPrecio',
									    lo.ofertaImagen as 'ofertaImagen',
									    lo.envio as 'envio',
									    lo.ofertaID as 'ofertaID',
									    lo.descuentoPorcentaje as 'descuentoPorcentaje',
									    lo.descuentoTotal as 'descuentoTotal',
									    lo.gananciaPt as 'gananciaPt',
									    lo.precioLocal as 'precioLocal',
									    r.ramaNombre as 'rama',
									    r.ramaID as 'ramaID',
									    m.marca as 'marca',
									    (SELECT ROUND(12Meses,2) FROM bancos) as meses,
									    (SELECT ROUND(comisionCC, 1) FROM bancos) as comision
									    FROM locatariosOfertas lo
									      LEFT JOIN ramas r ON r.ramaID=lo.ramaID
										  LEFT JOIN catMarcas m ON m.marcaID=lo.marcaID
										  LEFT JOIN tematicas t ON t.tematicaID=lo.tematicaID
										  LEFT JOIN unionProductosTipo u ON u.ofertaID=lo.ofertaID
										  LEFT JOIN unionCatalogo uc ON uc.ID=u.unionCatalogoID
										  LEFT JOIN ofertasCampania oc ON oc.ofertaID=lo.ofertaID
										WHERE lo.ofertaStatus = 'Activo'
										AND (lo.envio = 'No' AND lo.costoEnvio > 0 OR lo.envio = 'Si' AND lo.costoEnvio = 0)
										AND lo.ofertaPrecio != 0
										AND lo.existencia > '0'
										$cad_busqueda
										GROUP BY lo.ofertaID
									");
		if( $query->num_rows()>0 )
			return $query->result();
		else
			return NULL;
	}
	
	function cargarBusquedaCampania($campaniaID,$rama,$marca,$tematica)
	{
		$cad_busqueda = "";
		
		if( !empty($campaniaID) )
			$cad_busqueda.="AND oc.campaniaID='$campaniaID'";
			
		if( !empty($rama) )
			$cad_busqueda.="AND r.ramaUrl='$rama'";
			
		if( !empty($marca) )
			$cad_busqueda.="AND m.marcaUrl='$marca'";
		
		if( !empty($tematica) )
			$cad_busqueda.="AND t.tematicaUrl='$tematica'";
		
			$query = $this->db->query("SELECT 
										lo.ofertaTitulo as 'ofertaTitulo',
									    lo.ofertaDescripcion as 'ofertaDescripcion',
									    lo.ofertaPrecio as 'ofertaPrecio',
									    lo.ofertaImagen as 'ofertaImagen',
									    lo.envio as 'envio',
									    lo.ofertaID as 'ofertaID',
									    lo.descuentoPorcentaje as 'descuentoPorcentaje',
									    lo.descuentoTotal as 'descuentoTotal',
									    lo.gananciaPt as 'gananciaPt',
									    lo.precioLocal as 'precioLocal',
									    r.ramaNombre as 'rama',
									    r.ramaID as 'ramaID',
									    m.marca as 'marca',
									    (SELECT ROUND(12Meses,2) FROM bancos) as meses,
									    (SELECT ROUND(comisionCC, 1) FROM bancos) as comision
									    FROM locatariosOfertas lo
									      LEFT JOIN ramas r ON r.ramaID=lo.ramaID
										  LEFT JOIN catMarcas m ON m.marcaID=lo.marcaID
										  LEFT JOIN tematicas t ON t.tematicaID=lo.tematicaID
										  LEFT JOIN unionProductosTipo u ON u.ofertaID=lo.ofertaID
										  LEFT JOIN unionCatalogo uc ON uc.ID=u.unionCatalogoID
										  LEFT JOIN ofertasCampania oc ON oc.ofertaID=lo.ofertaID
										WHERE lo.ofertaStatus='Activo'
										AND lo.existencia > '0'
										AND oc.ofertaCampaniaStatus = 'Autorizada'
										$cad_busqueda
										GROUP BY lo.ofertaID
									");
		if( $query->num_rows()>0 )
			return $query->result();
		else
			return NULL;
	}
	
	function cargarBusqueda($rama,$marca,$tematica)
	{
		$cad_busqueda = "";
		
		if( !empty($rama) )
			$cad_busqueda.="AND r.ramaUrl='$rama'";
			
		if( !empty($marca) )
			$cad_busqueda.="AND m.marcaUrl='$marca'";
		
		if( !empty($tematica) )
			$cad_busqueda.="AND t.tematicaUrl='$tematica'";
		
			$query = $this->db->query("SELECT 
										lo.ofertaTitulo as 'ofertaTitulo',
									    lo.ofertaDescripcion as 'ofertaDescripcion',
									    lo.ofertaPrecio as 'ofertaPrecio',
									    lo.ofertaImagen as 'ofertaImagen',
									    lo.envio as 'envio',
									    lo.costoEnvio  as 'costoEnvio',
									    lo.ofertaID as 'ofertaID',
									    lo.descuentoPorcentaje as 'descuentoPorcentaje',
									    lo.descuentoTotal as 'descuentoTotal',
									    lo.gananciaPt as 'gananciaPt',
									    lo.precioLocal as 'precioLocal',
									    lo.ofertaFecha as 'ofertaFecha',
									    lo.googleMerchant as 'googleMerchant',
									    r.ramaNombre as 'rama',
									    r.ramaID as 'ramaID',
									    m.marca as 'marca',
									    (SELECT ROUND(12Meses,2) FROM bancos where bancoID = 1) as meses,
									    (SELECT ROUND(comisionCC, 1) FROM bancos where bancoID = 1) as comision
									    FROM locatariosOfertas lo
									      LEFT JOIN ramas r ON r.ramaID=lo.ramaID
										  LEFT JOIN catMarcas m ON m.marcaID=lo.marcaID
										  LEFT JOIN tematicas t ON t.tematicaID=lo.tematicaID
										  LEFT JOIN unionProductosTipo u ON u.ofertaID=lo.ofertaID
										  LEFT JOIN unionCatalogo uc ON uc.ID=u.unionCatalogoID
										WHERE lo.ofertaStatus='Activo'
										AND lo.existencia > '0'
										AND lo.costoEnvio > 0 
										AND lo.ofertaPrecio != 0
										$cad_busqueda
										GROUP BY lo.ofertaID
										ORDER BY lo.ofertaID desc
									");
		if( $query->num_rows()>0 )
			return $query->result();
		else
			return -1;
	}
	
	function cargarBusquedaMerchant($rama,$marca,$tematica)
	{
		$cad_busqueda = "";
		
		if( !empty($rama) )
			$cad_busqueda.="AND r.ramaUrl='$rama'";
			
		if( !empty($marca) )
			$cad_busqueda.="AND m.marcaUrl='$marca'";
		
		if( !empty($tematica) )
			$cad_busqueda.="AND t.tematicaUrl='$tematica'";
		
			$query = $this->db->query("SELECT 
										lo.ofertaTitulo as 'ofertaTitulo',
									    lo.ofertaDescripcion as 'ofertaDescripcion',
									    lo.ofertaPrecio as 'ofertaPrecio',
									    lo.ofertaImagen as 'ofertaImagen',
									    lo.envio as 'envio',
									    lo.costoEnvio  as 'costoEnvio',
									    lo.ofertaID as 'ofertaID',
									    lo.descuentoPorcentaje as 'descuentoPorcentaje',
									    lo.descuentoTotal as 'descuentoTotal',
									    lo.gananciaPt as 'gananciaPt',
									    lo.precioLocal as 'precioLocal',
									    lo.googleMerchant as 'googleMerchant',
									    lo.existencia as 'inventario',
									    r.ramaNombre as 'rama',
									    r.ramaID as 'ramaID',
									    m.marca as 'marca',
									    (SELECT ROUND(12Meses,2) FROM bancos where bancoID = 1) as meses,
									    (SELECT ROUND(comisionCC, 1) FROM bancos where bancoID = 1) as comision
									    FROM locatariosOfertas lo
									      LEFT JOIN ramas r ON r.ramaID=lo.ramaID
										  LEFT JOIN catMarcas m ON m.marcaID=lo.marcaID
										  LEFT JOIN tematicas t ON t.tematicaID=lo.tematicaID
										  LEFT JOIN unionProductosTipo u ON u.ofertaID=lo.ofertaID
										  LEFT JOIN unionCatalogo uc ON uc.ID=u.unionCatalogoID
										WHERE lo.ofertaStatus='Activo'
										AND lo.costoEnvio > 0 
										AND lo.ofertaPrecio != 0
										AND lo.googleMerchant = 'activado'
										$cad_busqueda
										GROUP BY lo.ofertaID
										ORDER BY lo.ofertaID desc
									");
		if( $query->num_rows()>0 )
			return $query->result();
		else
			return -1;
	}
	
	//Checa si existe oferta en la campaña
	function checaOfertaCampania($campaniaID,$ofertaID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM ofertasCampania WHERE ofertaID='$ofertaID' AND campaniaID='$campaniaID'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//Marca las ofertas autorizadas para cada campaña 
	function marcaAutorizadas($ofertaID,$campaniaID){
		$data = array(); 
		$q = $this->db->query("SELECT ofertaCampaniaStatus 
							   FROM ofertasCampania 
							   WHERE ofertaID='$ofertaID' 
							   AND campaniaID='$campaniaID'
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
	function cargarRamaOfertas($ofertaTipo){
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
								e.enlaceID as 'enlaceID',
								count(p.ofertaID) AS 'total'
							  FROM locatariosOfertas p
							  LEFT JOIN enlaces e ON e.ramaID=p.ramaID
							  LEFT JOIN ramas r ON r.ramaID=e.ramaID
							  WHERE e.giros = 'rama'
							  AND p.ofertaStatus = 'Activo'
							  AND r.ramaNombre !=''
							  AND p.ofertaTipo = '$ofertaTipo'
							  GROUP BY enlaceTitulo
							  ORDER BY e.enlaceOrden
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargaMarcasOfertas($ofertaTipo){
		$data = array(); 
		$q = $this->db->query("SELECT 
								  m.marca as 'marca',
								  m.marcaUrl as 'marcaUrl',
								  count(m.marca) AS 'total'
								  FROM locatariosOfertas p
								  LEFT JOIN catMarcas m ON m.marcaID=p.marcaID
								  WHERE p.ofertaStatus = 'Activo'
								  AND p.ofertaTipo = '$ofertaTipo'
								  AND m.marca !=''
								  GROUP BY m.marca
								  ORDER BY m.marca				
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//Carga Tematicas basadas en ofertas seleccionadas de administrador
	function cargarTematicasOfertas($ofertaTipo){
		$data = array(); 
		$q = $this->db->query("SELECT 
								  t.tematicaNombre as 'tematicaNombre',
								  t.tematicaUrl as 'tematicaUrl',
								  count(t.tematicaNombre) AS 'total'
								FROM locatariosOfertas p
								LEFT JOIN tematicas t ON t.tematicaID=p.tematicaID
								WHERE p.ofertaStatus = 'Activo'
								AND t.tematicaNombre !=''
								AND p.ofertaTipo = '$ofertaTipo'
								GROUP BY t.tematicaNombre
								ORDER BY t.tematicaNombre
							  ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//Carga Banners Campañas
	function cargarBanners(){
		$data = array(); 
		$q = $this->db->query("SELECT
								bp.bannerTitulo AS 'bannerTitulo',
								bp.bannerStatus AS 'bannerStatus',
								bp.publicidadID AS 'publicidadID',
								bp.bannerUrl AS bannerUrl,
								bp.bannerVigencia AS 'bannerVigencia'
							   FROM bannersPublicidad bp
							   WHERE bp.bannerStatus !='Borrado'
							   ORDER BY bp.publicidadID DESC
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	//Carga Tipos banners por campaña
	function cargarBannerInventario($publicidadID,$bannerTipo){
		$data = array(); 
		$q = $this->db->query("SELECT 
								bt.bannerTipo AS 'bannerTipo',
								bu.bannerID AS 'bannerID',
								bu.bannerImagen AS 'bannerImagen'
								FROM bannersPublicidadUnion bu
								LEFT JOIN bannersPublicidad bp ON bp.publicidadID=bu.publicidadID
								LEFT JOIN bannersTipos bt ON bt.bannerTipoID=bu.bannerTipoID
								WHERE bt.bannerTipo !=''
								AND bu.publicidadID='$publicidadID'
								AND bt.bannerTipoID='$bannerTipo'
							  ");
		if( $q->num_rows() > 0 )
			return $q->result();
		else
			return 1;
	}
	
	//Carga Tipos banners por campaña
	function cargarTiposBanners(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM bannersTipos");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarMails(){
		$data = array(); 
		$q = $this->db->query("SELECT mailID as 'mailID',
								mailNombre as 'nombreMail',
								mailFecha as 'Fecha',
								mailImagen as 'Imagen',
								mailURL as 'Url',
								mailTipoURL as 'UrlActivo',
								mailStatus as 'Status'
								FROM mail WHERE mailStatus != 'Desactivado' ORDER BY mailID DESC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarComunicados(){
		$data = array(); 
		$q = $this->db->query("SELECT comunicadoID as 'comunicadoID',
								comunicadoTitulo as 'Titulo',
								comunicadoDesc as 'Descripcion',
								comunicadoFecha as 'Fecha',
								comunicadoImagen as 'comunicadoImagen',
								comunicadoUrl as 'Url',
								comunicadoTipoUrl as 'urlActivo'
								FROM comunicadoMail ORDER BY comunicadoID DESC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarDiaryMail(){
		$data = array(); 
		$q = $this->db->query("SELECT mailID as 'mailID',
								mailNombre as 'nombreMail',
								mailFecha as 'Fecha',
								mailImagen as 'Imagen',
								mailURL as 'Url',
								mailTipoURL as 'UrlActivo',
								mailStatus as 'Status',
								tipoMail as 'tipoMail'
								FROM mail WHERE mailStatus != 'Desactivado' and tipoMail = 'Mail Diario' ORDER BY mailID DESC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarIntentosCompra(){
		$data = array(); 
		$q = $this->db->query("select 
								c.usuarioID as 'usuario',
								c.fechaCompra as 'fechadeCompra',
								c.folio as 'producto',
								u.username as 'usuarioNombre',
								u.email as 'email',
								lo.ofertaTitulo as 'ofertaNombre',
								c.mailIntentoCompra as 'status'
								from compras c 
								LEFT JOIN usuarios u on u.idRegistro = c.usuarioID
								LEFT JOIN productosComprados pc on pc.folioCompra=c.folio
								LEFT JOIN locatariosOfertas lo on lo.ofertaID = pc.ofertaID 
								WHERE c.status = 'espera de pago' AND c.mailIntentoCompra != 'Enviado' GROUP BY c.folio ORDER BY fechaCompra DESC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarUsuarioIntentosCompra($producto){
		$data = array(); 
		$q = $this->db->query("select 
								c.usuarioID as 'usuario',
								c.fechaCompra as 'fechadeCompra',
								c.folio as 'producto',
								u.username as 'usuarioNombre',
								u.email as 'email',
								c.mailIntentoCompra as 'status'
								from compras c 
								LEFT JOIN usuarios u on u.idRegistro = c.usuarioID
								WHERE c.folio = '$producto' AND c.status = 'espera de pago'  ORDER BY fechaCompra DESC ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarProductoIntentosCompra($producto){
		$data = array(); 
		$q = $this->db->query("select 
								c.usuarioID as 'usuario',
								c.fechaCompra as 'fechadeCompra',
								c.folio as 'producto',
								u.username as 'usuarioNombre',
								u.email as 'email',
								lo.ofertaTitulo as 'ofertaNombre',
								c.mailIntentoCompra as 'status'
								from compras c 
								LEFT JOIN usuarios u on u.idRegistro = c.usuarioID
								LEFT JOIN productosComprados pc on pc.folioCompra=c.folio
								LEFT JOIN locatariosOfertas lo on lo.ofertaID = pc.ofertaID 
								WHERE c.folio = '$producto' AND c.status = 'espera de pago'  ORDER BY fechaCompra DESC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarPagadas(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM compras WHERE status='pagado'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarPagadasTipos($solicitud){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM compras WHERE status='pagado' AND statusTraspaso='$solicitud'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarPagadasTiposFechas($solicitud,$de,$a){
		$data = array(); 
		$q = $this->db->query("SELECT *, (total - pagoLocal) - comisionBanco as 'gananciaPT' FROM compras WHERE status='pagado' AND statusTraspaso='$solicitud' and fechaCompra BETWEEN '$de' AND '$a'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}

	
	function cargarPagadasSolicitadas(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM compras WHERE status='pagado' AND statusTraspaso='solicitado' AND statusPagoLocal='si'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarPagadasSolicitadasFechas($de,$a){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM compras WHERE status='pagado' AND statusTraspaso='solicitado' AND statusPagoLocal='si' and fechaCompra BETWEEN '$de' AND '$a'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function solicitudLocalesenlinea(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM solicitudLocalenlinea group by email");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function solicitudLocalesenlineaFechas($de,$a){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM solicitudLocalenlinea WHERE fecha BETWEEN '$de' AND '$a' group by email");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function localesActivos(){
		$data = array(); 
		$q = $this->db->query("SELECT 
								l.localNombre as 'localNombre',
								l.localEmail as 'localEmail'
								FROM locatariosOfertas lo
								LEFT JOIN locatarios l ON l.localID=lo.localID
								group by l.localEmail");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function ofertasInfo($status){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM locatariosOfertas where ofertaStatus='$status' and ofertaVigencia > curdate()");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
		
	function infoLocales(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM contactoRentadelocales WHERE statusActivo='Activo' order by contactoID desc");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function infoLocalesFechas($de,$a){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM contactoRentadelocales 
							   WHERE statusActivo='Activo' 
							   AND fecha BETWEEN '$de' AND '$a' 
							   GROUP BY email 
							   ORDER BY contactoID desc
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function solicitudTraspasos(){
		$data = array(); 
		$q = $this->db->query("SELECT st.solicitudID as 'solicitudID',
								st.folioTraspaso as 'folio',
								st.montoTraspaso as 'monto',
								st.comisionPT as 'comisionPT',
								st.fechaSolicitud as 'fecha',
								st.nombreSolicitante as 'nombre',
								st.emailsolicitante as 'email',
								pc.statusProducto as 'status'
								FROM solicitudTraspasos st
								LEFT JOIN productosComprados pc on pc.folioTraspaso = st.folioTraspaso
								WHERE pc.statusProducto = 'solicitudTraspaso'
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  
		}
			return $data;	
	}
	
	function historialPeticiones(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM peticionesLinea");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  
		}
		return $data;	
	}
	
	function confirmacionPagos(){
		$data = array(); 
		$q = $this->db->query("SELECT pc.productosCompradosID as 'productoID',
								pc.folioCompra as 'folioCompra',
								pc.ofertaID as 'ofertaID',
								pc.statusProducto as 'statusProdutos',
								c.status as 'statusCompra',
								c.total as 'monto',
								c.fechaCompra as 'fechaCompra'
								FROM productosComprados pc
								LEFT JOIN compras c ON pc.folioCompra = c.folio
								WHERE pc.statusProducto = 'inconclusa' AND c.status = 'espera de pago'
								ORDER BY pc.productosCompradosID DESC
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function confirmarMailCompra($folioCompra){
		$data = array(); 
		$q = $this->db->query("SELECT pc.productosCompradosID as 'productoID',
								pc.folioCompra as 'folioCompra',
								pc.ofertaID as 'ofertaID',
								pc.statusProducto as 'statusProdutos',
								l.localEmail as 'emailLocatario',
								l.localNombre as 'nombreLocal'
								FROM productosComprados pc
								LEFT JOIN locatariosOfertas lo on pc.ofertaID = lo.ofertaID
								LEFT JOIN locatarios l on lo.localID = l.localID
								WHERE pc.folioCompra = '$folioCompra' GROUP BY l.localEmail");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function infoPeticion($peticionID){
		$data = array(); 
		$q = $this->db->query("SELECT *	FROM peticionesLinea
								WHERE peticionID = $peticionID");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function historialBusq(){
		$data = array(); 
		$q = $this->db->query("SELECT busquedaTexto, 
									  COUNT(hb.busquedaTexto) AS veces
								FROM historialBusquedas hb 
								WHERE hb.busquedaFecha >= '2014-".date('m')."-01' 
								AND hb.busquedaFecha <= CURDATE() 
								AND hb.busquedaTexto != '0'
								AND hb.busquedaTexto != ''
								GROUP BY hb.busquedaTexto HAVING COUNT(hb.busquedaTexto) > 20 
								ORDER BY veces DESC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function resultadosDevuelve($texto){
		$data = array(); 
		$q = $this->db->query("SELECT COUNT(*) as numRes
								FROM locatariosOfertas lo
								LEFT JOIN ramas r ON lo.ramaID = r.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE MATCH(lo.ofertaTitulo) AGAINST ('$texto' IN BOOLEAN MODE)
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
	
	function accionesBusq($texto){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM accionesBusquedas WHERE textoBusq = '$texto';");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
}