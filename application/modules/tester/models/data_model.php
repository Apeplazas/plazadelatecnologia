<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_model extends CI_Model {
	
	function cargarOptimizacion($opt){
		$data = array(); 
		$q = $this->db->query("SELECT 
								s.metaTitle as 'metaTitle', 
								s.metaDescripcion as 'metaDescripcion',
								s.metaKeyword as 'metaKeyword',
								s.scriptDFPGoogle as 'scriptDFPGoogle',
								s.divGoogleBox as 'divGoogleBox',
								s.divGoogleSky as 'divGoogleSky',
								s.DivGoogleSeg2 as 'DivGoogleSeg2'
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
		$q = $this->db->query("SELECT * FROM enlaces 
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
	
	function cargarMetodoCredito(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM pagosTipos WHERE status='activado' and credito='1'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarMetodoDiferido(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM pagosTipos WHERE diferidos='1'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarMetodoDebito(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM pagosTipos WHERE debito='1'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarSkyHome($url){
		$data = array(); 
		$q = $this->db->query("SELECT
								bu.bannerImagen AS 'imagen',
								bp.fondoColor AS 'fondoColor',
								bp.bannerTitulo AS 'bannerTitulo',
								bp.bannerLink AS 'bannerLink',
								bp.bannerUrl AS 'bannerUrl',
								bp.bannerBotonAbrir AS 'abrir',
								bp.bannerBotonCerrar AS 'cerrar',
								bp.bannerFecha,
								e.paginaUrl AS 'paginaUrl',
								e.enlaceNombre AS 'enlaceNombre'
								FROM bannersPublicidadUnion bu
								LEFT JOIN bannersPublicidad bp ON bp.publicidadID=bu.publicidadID
								LEFT JOIN bannersTipos bt ON bt.bannerTipoID=bu.bannerTipoID
								LEFT JOIN bannersUnion ba ON ba.publicidadID=bu.publicidadID
								LEFT JOIN enlaces e ON e.enlaceID=ba.enlaceID
								WHERE bt.bannerTipo !=''
								AND bp.bannerStatus='Activado'
								AND bt.bannerTipoID='3' 
								AND e.paginaUrl = '$url'
								AND ba.status = 'activo'
								GROUP BY bu.bannerImagen
								ORDER BY RAND()
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
	
	function cargarSliderCampanias(){
		$data = array(); 
		$q = $this->db->query("SELECT
								bu.bannerImagen AS 'imagen',
								bp.fondoColor AS 'fondoColor',
								bp.bannerTitulo AS 'bannerTitulo',
								bp.bannerLink AS 'bannerLink',
								bp.bannerUrl AS 'bannerUrl',
								bp.bannerBotonAbrir AS 'abrir',
								bp.bannerBotonCerrar AS 'cerrar',
								e.paginaUrl AS 'paginaUrl',
								e.enlaceNombre AS 'enlaceNombre'
								FROM bannersPublicidadUnion bu
								LEFT JOIN bannersPublicidad bp ON bp.publicidadID=bu.publicidadID
								LEFT JOIN bannersTipos bt ON bt.bannerTipoID=bu.bannerTipoID
								LEFT JOIN bannersUnion ba ON ba.publicidadID=bu.publicidadID
								LEFT JOIN enlaces e ON e.enlaceID=ba.enlaceID
								WHERE bt.bannerTipo !=''
								AND bp.bannerStatus='Activado'
								AND bt.bannerTipoID='1'
								GROUP BY ba.publicidadID
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarSky($url){
		$data = array(); 
		$q = $this->db->query("SELECT
								bu.bannerImagen AS 'imagen',
								bp.fondoColor AS 'fondoColor',
								bp.bannerTitulo AS 'bannerTitulo',
								bp.bannerLink AS 'bannerLink',
								bp.bannerUrl AS 'bannerUrl',
								bp.bannerBotonAbrir AS 'abrir',
								bp.bannerBotonCerrar AS 'cerrar',
								e.paginaUrl AS 'paginaUrl',
								e.enlaceNombre AS 'enlaceNombre'
								FROM bannersPublicidadUnion bu
								LEFT JOIN bannersPublicidad bp ON bp.publicidadID=bu.publicidadID
								LEFT JOIN bannersTipos bt ON bt.bannerTipoID=bu.bannerTipoID
								LEFT JOIN bannersUnion ba ON ba.publicidadID=bu.publicidadID
								LEFT JOIN enlaces e ON e.enlaceID=ba.enlaceID
								WHERE bt.bannerTipo !=''
								AND e.paginaUrl='$url'
								AND bp.bannerStatus='Activado'
								AND bt.bannerTipoID='3'
								GROUP BY ba.publicidadID
								ORDER BY RAND()
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
	
	//busca nombre estado
	function cargarNombreEstado($claveEstado){
		$data = array(); 
		$q = $this->db->query("
								SELECT e.nombreEstado as 'Estado' 
								FROM estadosMexico e WHERE e.claveEstado='$claveEstado' 
								GROUP BY e.nombreEstado
		");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//busca nombre delegacion
	function cargarNombreColonia($claveMunicipio,$claveEstado){
		$data = array(); 
		$q = $this->db->query("
								SELECT e.nombreColonia as 'Colonia' 
								FROM estadosMexico e 
								WHERE e.claveColonia='$claveMunicipio' 
								AND e.claveEstado='$claveEstado' 
								GROUP BY e.nombreColonia
		");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarSlider($url){
		$data = array();
		$q = $this->db->query("SELECT
								bu.bannerImagen AS 'bannerSlider',
								bp.fondoColor AS 'fondoColor',
								bp.bannerTitulo AS 'bannerTitulo',
								bp.bannerLink AS 'bannerLink',
								bp.bannerUrl AS 'bannerUrl',
								bp.bannerBotonAbrir AS 'abrir',
								bp.bannerBotonCerrar AS 'cerrar',
								bp.publicidadID AS 'id',
								bp.bannerFecha AS 'bannerFecha'
								FROM bannersPublicidadUnion bu
								LEFT JOIN bannersPublicidad bp ON bp.publicidadID=bu.publicidadID
								LEFT JOIN bannersTipos bt ON bt.bannerTipoID=bu.bannerTipoID
								WHERE bt.bannerTipo !=''
								AND bp.bannerStatus='Activado'
								AND bt.bannerTipoID='1'
								GROUP BY bp.publicidadID
								ORDER BY RAND()
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarLeadFoot($url){
		$data = array(); 
		$q = $this->db->query("SELECT
								bu.bannerImagen AS 'imagen',
								bp.fondoColor AS 'fondoColor',
								bp.bannerTitulo AS 'bannerTitulo',
								bp.bannerLink AS 'bannerLink',
								bp.bannerUrl AS 'bannerUrl',
								bp.bannerBotonAbrir AS 'abrir',
								bp.bannerBotonCerrar AS 'cerrar',
								bp.bannerFecha,
								e.paginaUrl AS 'paginaUrl',
								e.enlaceNombre AS 'enlaceNombre'
								FROM bannersPublicidadUnion bu
								LEFT JOIN bannersPublicidad bp ON bp.publicidadID=bu.publicidadID
								LEFT JOIN bannersTipos bt ON bt.bannerTipoID=bu.bannerTipoID
								LEFT JOIN bannersUnion ba ON ba.publicidadID=bu.publicidadID
								LEFT JOIN enlaces e ON e.enlaceID=ba.enlaceID
								WHERE bt.bannerTipo !=''
								AND bp.bannerStatus='Activado'
								AND bt.bannerTipoID='8'
								GROUP BY ba.publicidadID
								ORDER BY RAND()
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
	
	function cargarLeadHome($url){
		$data = array(); 
		$q = $this->db->query("SELECT
								bu.bannerImagen AS 'imagen',
								bp.fondoColor AS 'fondoColor',
								bp.bannerTitulo AS 'bannerTitulo',
								bp.bannerLink AS 'bannerLink',
								bp.bannerUrl AS 'bannerUrl',
								bp.bannerBotonAbrir AS 'abrir',
								bp.bannerBotonCerrar AS 'cerrar',
								e.paginaUrl AS 'paginaUrl',
								e.enlaceNombre AS 'enlaceNombre'
								FROM bannersPublicidadUnion bu
								LEFT JOIN bannersPublicidad bp ON bp.publicidadID=bu.publicidadID
								LEFT JOIN bannersTipos bt ON bt.bannerTipoID=bu.bannerTipoID
								LEFT JOIN bannersUnion ba ON ba.publicidadID=bu.publicidadID
								LEFT JOIN enlaces e ON e.enlaceID=ba.enlaceID
								WHERE bt.bannerTipo !=''
								AND bp.bannerStatus='Activado'
								AND bt.bannerTipoID='5'
								AND bu.bannerHome='si'
								ORDER BY RAND()
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
	
	function cargarLead($url){
		$data = array(); 
		$q = $this->db->query("SELECT
								bu.bannerImagen AS 'imagen',
								bp.fondoColor AS 'fondoColor',
								bp.bannerTitulo AS 'bannerTitulo',
								bp.bannerLink AS 'bannerLink',
								bp.bannerUrl AS 'bannerUrl',
								bp.bannerBotonAbrir AS 'abrir',
								bp.bannerBotonCerrar AS 'cerrar',
								bp.bannerFecha,
								e.paginaUrl AS 'paginaUrl',
								e.enlaceNombre AS 'enlaceNombre'
								FROM bannersPublicidadUnion bu
								LEFT JOIN bannersPublicidad bp ON bp.publicidadID=bu.publicidadID
								LEFT JOIN bannersTipos bt ON bt.bannerTipoID=bu.bannerTipoID
								LEFT JOIN bannersUnion ba ON ba.publicidadID=bu.publicidadID
								LEFT JOIN enlaces e ON e.enlaceID=ba.enlaceID
								WHERE bt.bannerTipo !=''
								AND bp.bannerStatus='Activado'
								AND bt.bannerTipoID='5'
								AND e.paginaUrl = '$url'
								ORDER BY RAND()
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
	
	function cargarBoxBanner($url){
		$data = array(); 
		$q = $this->db->query("SELECT
								bu.bannerImagen AS 'imagen',
								bp.fondoColor AS 'fondoColor',
								bp.bannerTitulo AS 'bannerTitulo',
								bp.bannerLink AS 'bannerLink',
								bp.bannerUrl AS 'bannerUrl',
								bp.bannerBotonAbrir AS 'abrir',
								bp.bannerBotonCerrar AS 'cerrar',
								bp.bannerFecha,
								e.paginaUrl AS 'paginaUrl',
								e.enlaceNombre AS 'enlaceNombre'
								FROM bannersPublicidadUnion bu
								LEFT JOIN bannersPublicidad bp ON bp.publicidadID=bu.publicidadID
								LEFT JOIN bannersTipos bt ON bt.bannerTipoID=bu.bannerTipoID
								LEFT JOIN bannersUnion ba ON ba.publicidadID=bu.publicidadID
								LEFT JOIN enlaces e ON e.enlaceID=ba.enlaceID
								WHERE bt.bannerTipo !=''
								AND bp.bannerStatus='Activado'
								AND bu.bannerTipoID='2'
								ORDER BY rand()
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
	
	function cargarFolletos(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM sucursales WHERE folleto!='' ORDER BY sucursalCiudad ASC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargaUltimoContacto(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM contactos ORDER BY contactoID DESC LIMIT 1");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarSucursales(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM sucursales ORDER BY sucursalNombre");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarInfoCiudad($ciudadUrl)
	{
		$data = array(); 
		$q = $this->db->query("SELECT * FROM sucursales WHERE sucursalUrl='$ciudadUrl'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarCiudades(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM sucursales ORDER BY sucursalNombre ASC");
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
	
	//Hice este modelo para cargar ramas existentes
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
								r.ramaUrl as 'ramaUrl',
								e.giros as 'menuTipo',
								e.subMenu as 'subMenu',
								e.enlaceID as 'enlaceID',
								count(p.ofertaID) AS 'total'
							  FROM locatariosOfertas p
							  LEFT JOIN enlaces e ON e.ramaID=p.ramaID
							  LEFT JOIN ramas r ON r.ramaID=e.ramaID
							  WHERE e.giros = 'rama'
							  AND p.ofertaStatus = 'Activo'
							  AND p.costoEnvio > 0 
							  AND p.ofertaPrecio != 0
							  AND r.ramaNombre !=''
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
	
	//Carga Tematicas basadas en locatariosOfertas disponibles
	function cargarTematicasDisponibles($ramaID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM catTipo ct LEFT JOIN ramas r ON ct.ramaID = r.ramaID WHERE ct.ramaID = '$ramaID'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//Carga categorias dependiendo de los articulos existentes
	function cargarCatDisponibles($rama,$caracteristica){
		$data = array(); 
		$q = $this->db->query("SELECT uc.descripcion, uc.ID
								FROM ramas r
								LEFT JOIN locatariosOfertas lo ON r.ramaID = lo.ramaID
								LEFT JOIN unionProductosTipo upt ON upt.ofertaID = lo.ofertaID
								LEFT JOIN unionCatalogo uc ON uc.ID = upt.unionCatalogoID
								WHERE r.ramaID = '$rama'
								AND uc.catTipoID = '$caracteristica'
								AND lo.ofertaVigencia > CURDATE()
								AND lo.ofertaStatus = 'Activo'
								GROUP BY uc.descripcion 
								ORDER BY uc.descripcion ASC
							  ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function info_usuario($id){
		$data = array(); 
		$q = $this->db->query("SELECT idRegistro AS 'id',	
									   userAlias AS 'name',
									   imagenPersonalizada AS 'avatar',
									   email AS 'email',
									   state AS 'estado'
								FROM usuarios 
								WHERE idREgistro = '$id'");
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
	
	function info_mi_local($id){
		$data = array(); 
		$q = $this->db->query("SELECT 
								localID AS 'id',
								localNombre AS 'name',
								localID AS 'localID',
								localNombre AS 'localNombre',
								localLogo AS 'avatar',
								localEmail AS 'email',
								localLogo AS 'localLogo',
								localDescripcion AS 'localDescripcion',
								localUrl AS 'localUrl',
								localTelefono AS 'localTel',
								localNumero AS 'localNum'
							  FROM locatarios l
							  WHERE localID = '$id'
							  ");
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
	
	function buscaCampaniaID($campaniaNombre){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM campanias WHERE campaniaUrl='$campaniaNombre'");
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
		$q = $this->db->query("SELECT * FROM campanias 
							   WHERE fechaInicio <= CURDATE()
							   AND fechaFin > CURDATE()
							   AND status = 'activa'
							   order by ordenador
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarProPromociones($campaniaID){
		$data = array(); 
		$q = $this->db->query("SELECT
								lo.ofertaTitulo as 'ofertaTitulo',
								lo.ofertaDescripcion as 'ofertaDescripcion',
								lo.ofertaPrecio as 'ofertaPrecio',
								lo.ofertaImagen as 'ofertaImagen',
								lo.envio as 'envio',
								lo.ofertaID as 'ofertaID',
								lo.descuentoPorcentaje as 'descuentoPorcentaje',
								lo.descuentoTotal as 'descuentoTotal',
								lo.promoBuenFin as 'promoBuenFin',
								lo.gananciaPt as 'gananciaPt',
								lo.precioLocal as 'precioLocal',
								 r.ramaNombre as 'rama',
								 r.ramaID as 'ramaID',
								 m.marca as 'marca',
								 (SELECT ROUND(12Meses,2) FROM bancos where bancoID = 1) as meses,
								 (SELECT ROUND(comisionCC, 1) FROM bancos where bancoID = 1) as comision
								 FROM ofertasCampania oc
								 LEFT JOIN locatariosOfertas lo ON lo.ofertaID=oc.ofertaID
								 LEFT JOIN ramas r ON r.ramaID=lo.ramaID
								 LEFT JOIN catMarcas m ON m.marcaID=lo.marcaID
								 LEFT JOIN tematicas t ON t.tematicaID=lo.tematicaID
								 LEFT JOIN unionProductosTipo u ON u.ofertaID=lo.ofertaID
								 LEFT JOIN unionCatalogo uc ON uc.ID=u.unionCatalogoID
								 WHERE oc.campaniaID='$campaniaID'
								AND lo.ofertaStatus='Activo'
								
								AND lo.costoEnvio > 0 
								AND lo.ofertaPrecio != 0
								GROUP BY lo.ofertaID
								ORDER BY RAND()
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarOfertaCampania($campaniaID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								oc.ofertaID as 'ofertaID',
								lo.ofertaTitulo as 'ofertaTitulo',
								lo.ofertaDescripcion as 'ofertaDescripcion',
								lo.ofertaPrecio as 'ofertaPrecio',
								lo.ofertaImagen as 'ofertaImagen',
								lo.promoBuenFin as 'promoBuenFin',
								lo.ofertaID as 'ofertaID',
								r.ramaNombre as 'rama',
								cm.marca as 'marca',
								(SELECT ROUND(12Meses,2) FROM bancos where bancoID = 1) as meses,
								(SELECT ROUND(comisionCC, 1) FROM bancos where bancoID = 1) as comision
								FROM ofertasCampania oc
								LEFT JOIN locatariosOfertas lo ON lo.ofertaID=oc.ofertaID
								LEFT JOIN ramas r ON r. ramaID = lo.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE oc.campaniaID = '$campaniaID'
								AND oc.ofertaCampaniaStatus = 'Autorizada'
								AND lo.ofertaStatus = 'Activo'
								AND lo.costoEnvio > 0 
								AND lo.ofertaPrecio != 0
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarIDCampania($campaniaID){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM campanias");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarBox(){
		$data = array(); 
		$q = $this->db->query("SELECT
							   bp.bannerImagen AS 'bannerBox',
							   bp.bannerTitulo AS 'bannerTitulo',
							   bp.bannerUrl	AS 'bannerUrl'
							   FROM bannersPublicidad bp
							   WHERE bannerStatus = 'Activado'
							   AND bannerTipo = 'boxBanner'
							   ORDER BY RAND() LIMIT 1
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	//// MODELOS NUEVOS //////
	function cargarRamasLimitadas(){
		$data = array(); 
		$q = $this->db->query("SELECT 
								e.ramaID as 'ramaID',
								r.ramaNombre as 'ramaNombre'
							   FROM locatariosOfertas p
							   LEFT JOIN enlaces e ON e.ramaID=p.ramaID
							   LEFT JOIN ramas r ON r.ramaID=e.ramaID
							   WHERE e.giros = 'rama'
							   GROUP BY enlaceTitulo
							   ORDER BY RAND()
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
	
	function cargarOfertasRama($ramaID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								lo.ofertaTitulo AS 'ofertaTitulo',
								lo.ofertaImagen AS 'ofertaImagen',
								lo.ofertaPrecio AS 'ofertaPrecio',
								lo.promoBuenFin as 'promoBuenFin',
								lo.ofertaID AS 'ofertaID',
							    r.ramaNombre as 'rama'
							   FROM locatariosOfertas lo
							   LEFT JOIN ramas r ON lo.ramaID = r.ramaID
							   WHERE lo.ramaID = '$ramaID'
							   AND lo.ofertaStatus = 'Activo'
							   AND lo.costoEnvio > 0 
							   AND lo.ofertaPrecio != 0
							   ORDER BY RAND()
							   LIMIT 5
							  ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarTopProductos(){
		$data = array(); 
		$q = $this->db->query(" SELECT 
								lo.ofertaTitulo AS 'ofertaTitulo',
								lo.ofertaImagen AS 'ofertaImagen',
								lo.ofertaPrecio AS 'ofertaPrecio',
								SUM(pc.cantidadProducto) AS 'total',
								lo.promoBuenFin as 'promoBuenFin',
								lo.ofertaID AS 'ofertaID'
								FROM productosComprados pc
								LEFT JOIN locatariosOfertas lo ON lo.ofertaID=pc.ofertaID
								WHERE lo.ofertaVigencia > CURDATE()
								AND lo.ofertaStatus = 'Activo'	  
								GROUP BY lo.ofertaID
								ORDER BY total DESC
								LIMIT 6
							  ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}

	function cargarHistorialBusq($lista){
		$data = array(); 
		$q = $this->db->query("SELECT 
								lo.ofertaTitulo as 'ofertaTitulo',
								lo.ofertaDescripcion as 'ofertaDescripcion',
								lo.ofertaPrecio as 'ofertaPrecio',
								lo.ofertaImagen as 'ofertaImagen',
								lo.promoBuenFin as 'promoBuenFin',
								lo.ofertaID as 'ofertaID',
								r.ramaNombre as 'rama'
								FROM locatariosOfertas lo
								LEFT JOIN ramas r ON lo.ramaID = r.ramaID
								WHERE $lista
								AND lo.ofertaVigencia > CURDATE()
								AND lo.ofertaStatus = 'Activo'
								ORDER BY RAND()
								LIMIT 10");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarEstadosMex(){
		$data = array(); 
		$q = $this->db->query("SELECT claveEstado AS idEstado, 
        							  nombreEstado AS nombreEstado 
		        					  FROM estadosMexico 
		        					  GROUP BY claveEstado  
		        					  ORDER BY claveEstado");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//nuevo query agregado
	function cargarVentasLocal($localID){
		$data = array(); 
		$q = $this->db->query("SELECT
								c.fecha AS 'fecha',
								c.folio AS 'folio',
								c.localID AS 'localID',
								lo.ofertaTitulo AS 'ofertaTitulo',
								lo.ofertaImagen AS 'ofertaImagen',
								lo.ofertaDescripcion AS 'ofertaDescripcion',
								lo.ofertaID AS 'ofertaID',
								lo.promoBuenFin as 'promoBuenFin',
								u.userAlias AS 'userAlias',
								u.email AS 'email',
								u.userName AS 'userName',
								u.lastName AS 'lastName'
							   FROM compras c
							   LEFT JOIN locatariosOfertas lo ON lo.ofertaID=c.ofertaID
							   LEFT JOIN usuarios u ON u.idRegistro=c.usuarioID
							   LEFT JOIN sitiosEntrega s ON s.idSitio=c.idSitio
							   WHERE c.status='Aprobada'
							   AND c.statusProducto='ptConfirmada'
							   AND c.localID='$localID'
							   ORDER BY c.compraID DESC
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//nuevo query agregado
	function cargarVentasSinConfirmar($localID){
		$data = array(); 
		$q = $this->db->query("SELECT
								c.fecha AS 'fecha',
								c.folio AS 'folio',
								c.localID AS 'localID',
								lo.ofertaTitulo AS 'ofertaTitulo',
								lo.ofertaImagen AS 'ofertaImagen',
								lo.promoBuenFin as 'promoBuenFin',
								lo.ofertaDescripcion AS 'ofertaDescripcion',
								lo.ofertaID AS 'ofertaID',
								u.userAlias AS 'userAlias',
								u.email AS 'email',
								u.userName AS 'userName',
								u.lastName AS 'lastName'
							   FROM compras c
							   LEFT JOIN locatariosOfertas lo ON lo.ofertaID=c.ofertaID
							   LEFT JOIN usuarios u ON u.idRegistro=c.usuarioID
							   LEFT JOIN sitiosEntrega s ON s.idSitio=c.idSitio
							   WHERE c.status='Aprobada'
							   AND c.localID='$localID'
							   ORDER BY c.compraID DESC
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//nuevo query agregado
	function cargarVenta($ofertaID, $localID,$folio){
		$data = array(); 
		$q = $this->db->query("SELECT
								c.fechaPago AS 'fecha',
								c.folio AS 'folio',
								lo.ofertaTitulo AS 'ofertaTitulo',
								lo.ofertaPrecio AS 'ofertaPrecio',
								lo.ofertaImagen AS 'ofertaImagen',
								lo.ofertaDescripcion AS 'ofertaDescripcion',
								lo.ofertaID AS 'ofertaID',
								lo.promoBuenFin as 'promoBuenFin',
								u.userAlias AS 'userAlias',
								u.email AS 'email',
								u.userName AS 'userName',
								u.lastName AS 'lastName',
								s.estado AS 'estado',
								s.titulo AS 'titulo',
								s.direccion AS 'direccion',
								s.colonia AS 'colonia',
								s.municipioDelegacion AS 'delegacion',
								s.telefono AS 'telefono',
								s.recibe AS 'recibe',
								s.detallesSitio AS 'detallesSitio',
								pc.statusProducto AS 'statusProducto',
								m.marca AS 'marca',
								r.ramaNombre AS 'ramaNombre',
								lo.ramaID AS 'ramaID',
								c.idSitio AS 'idSitio'
							   FROM productosComprados pc
							   LEFT JOIN compras c ON c.folio=pc.folioCompra
							   LEFT JOIN locatariosOfertas lo ON lo.ofertaID=pc.ofertaID
							   LEFT JOIN usuarios u ON u.idRegistro=c.usuarioID
							   LEFT JOIN sitiosEntrega s ON s.idSitio=c.idSitio
							   LEFT JOIN catMarcas m ON m.marcaID=lo.marcaID
							   LEFT JOIN ramas r ON r.ramaID=lo.ramaID
							   WHERE lo.localID='$localID'
							   AND pc.ofertaID='$ofertaID'
							   AND c.folio='$folio'
							   ORDER BY c.compraID DESC
							   ");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	//nuevo query agregado
	function cargarDireccion($idSitio){
		$data = array(); 
		$q = $this->db->query("SELECT * from sitiosEntrega where idSitio='$idSitio'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarBusquedaKey($key){
			
		$data = array(); 
		$q = $this->db->query("SELECT lo.ofertaTitulo as 'ofertaTitulo',
									    lo.ofertaDescripcion as 'ofertaDescripcion',
									    lo.ofertaPrecio as 'ofertaPrecio',
									    lo.ofertaImagen as 'ofertaImagen',
									    lo.envio as 'envio',
									    lo.costoEnvio  as 'costoEnvio',
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
									    (SELECT ROUND(comisionCC, 1) FROM bancos where bancoID = 1) as comision,
									    MATCH(lo.ofertaTitulo,lo.ofertaDescripcion) AGAINST ('$key' IN BOOLEAN MODE) as coincidencias
								FROM locatariosOfertas lo
								LEFT JOIN ramas r ON lo.ramaID = r.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE (lo.ofertaTitulo LIKE '%$key%'
								OR lo.ofertaDescripcion LIKE '%$key%')
								AND lo.ofertaStatus = 'Activo'
								AND lo.costoEnvio > 0 
								AND lo.ofertaPrecio != 0
								ORDER BY coincidencias DESC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarOptFace($rama,$marca,$tematica,$cat,$cat1,$cat2,$cat3,$cat4)
	{
		
		$data = array(); 
		$q = $this->db->query("SELECT r.ramaNombre as 'ofertaTitulo', 
			r.imagen as 'ofertaImagen', 
			r.ramaID as 'ramaID'
			FROM ramas r
			WHERE r.ramaUrl='$rama'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarBusquedaMarca($key){
			
		$data = array(); 
		$q = $this->db->query("SELECT lo.ofertaTitulo as 'ofertaTitulo',
									    lo.ofertaDescripcion as 'ofertaDescripcion',
									    lo.ofertaPrecio as 'ofertaPrecio',
									    lo.ofertaImagen as 'ofertaImagen',
									    lo.envio as 'envio',
									    lo.costoEnvio  as 'costoEnvio',
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
								FROM locatariosOfertas lo
								LEFT JOIN ramas r ON lo.ramaID = r.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE cm.marca LIKE '$key'
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
	
	function marcasBusquedaKey($key){
		$data = array(); 
		$q = $this->db->query("SELECT cm.marca, COUNT(lo.ofertaID) as total, marcaUrl
								FROM locatariosOfertas lo
								LEFT JOIN ramas r ON lo.ramaID = r.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE MATCH(lo.ofertaTitulo) AGAINST ('%$key%' IN BOOLEAN MODE)
								
								AND lo.ofertaStatus = 'Activo'
								GROUP BY cm.marca ORDER BY cm.marca ASC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function ramasBusquedaKey($key){
		$data = array(); 
		$q = $this->db->query("SELECT ramaNombre, COUNT(lo.ofertaID) as total, ramaUrl
								FROM locatariosOfertas lo
								LEFT JOIN ramas r ON lo.ramaID = r.ramaID
								LEFT JOIN catMarcas cm ON lo.marcaID = cm.marcaID
								WHERE MATCH(lo.ofertaTitulo) AGAINST ('%$key%' IN BOOLEAN MODE)
								
								AND lo.ofertaStatus = 'Activo'
								GROUP BY r.ramaNombre ORDER BY r.ramaNombre ASC");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarBusqueda($rama,$marca,$tematica,$cat,$cat1,$cat2,$cat3,$cat4)
	{
		$cad_busqueda = "";
		$cadena       = "";
		$cadena1      = "";
		$cadena2      = "";
		$cadena3      = "";
		$cadena4      = "";
		
		if( !empty($rama) )
			$cad_busqueda="AND r.ramaUrl='$rama'";
			
		if( !empty($marca) )
			$cad_busqueda.="AND m.marcaUrl='$marca'";
		
		if( !empty($tematica) )
			$cad_busqueda.="AND t.tematicaUrl='$tematica'";	
		
		if( !empty($cat) )
			$cadena.="uc.catUrl='$cat' ";
		
		if( !empty($cat1) )
			$cadena1.="OR uc.catUrl='$cat1' ";
			
		if( !empty($cat2) )
			$cadena2.="OR uc.catUrl='$cat2' ";
		
		if( !empty($cat3) )
			$cadena3.="OR uc.catUrl='$cat3' ";
		
		if( !empty($cat4) )
			$cadena4.="OR uc.catUrl='$cat4' ";
			
		if( !empty($cat) )
			$cad_busqueda.="AND ($cadena $cadena1 $cadena2 $cadena3 $cadena4)";
		
		$data = array(); 
		$q = $this->db->query("SELECT 
										lo.ofertaTitulo as 'ofertaTitulo',
									    lo.ofertaDescripcion as 'ofertaDescripcion',
									    lo.ofertaPrecio as 'ofertaPrecio',
									    lo.ofertaImagen as 'ofertaImagen',
									    lo.envio as 'envio',
									    lo.costoEnvio  as 'costoEnvio',
									    lo.ofertaID as 'ofertaID',
									    lo.descuentoPorcentaje as 'descuentoPorcentaje',
									    lo.promoBuenFin as 'promoBuenFin',
									    lo.descuentoTotal as 'descuentoTotal',
									    lo.gananciaPt as 'gananciaPt',
									    lo.precioLocal as 'precioLocal',
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
										$cad_busqueda
										GROUP BY lo.ofertaID
										ORDER BY lo.descuentoPorcentaje desc, lo.ofertaPrecio asc
									");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarBusquedaPagada($rama,$marca,$tematica,$cat,$cat1,$cat2,$cat3,$cat4)
	{
		$cad_busqueda = "";
		$cadena       = "";
		$cadena1      = "";
		$cadena2      = "";
		$cadena3      = "";
		$cadena4      = "";
		
		if( !empty($rama) )
			$cad_busqueda="AND r.ramaUrl='$rama'";
			
		if( !empty($marca) )
			$cad_busqueda.="AND m.marcaUrl='$marca'";
		
		if( !empty($tematica) )
			$cad_busqueda.="AND t.tematicaUrl='$tematica'";	
		
		if( !empty($cat) )
			$cadena.="uc.catUrl='$cat' ";
		
		if( !empty($cat1) )
			$cadena1.="OR uc.catUrl='$cat1' ";
			
		if( !empty($cat2) )
			$cadena2.="OR uc.catUrl='$cat2' ";
		
		if( !empty($cat3) )
			$cadena3.="OR uc.catUrl='$cat3' ";
		
		if( !empty($cat4) )
			$cadena4.="OR uc.catUrl='$cat4' ";
			
		if( !empty($cat) )
			$cad_busqueda.="AND ($cadena $cadena1 $cadena2 $cadena3 $cadena4)";
		
		$data = array(); 
		$q = $this->db->query("SELECT
								lo.ofertaStatus as 'ofertaStatus',
								lo.ramaID as 'ramaID',
								lo.ofertaTitulo as 'ofertaTitulo',
								lo.ofertaDescripcion as 'ofertaDescripcion',
								lo.ofertaPrecio as 'ofertaPrecio',
								lo.ofertaImagen as 'ofertaImagen',
								lo.envio as 'envio',
								lo.costoEnvio  as 'costoEnvio',
								lo.ofertaID as 'ofertaID',
								lo.descuentoPorcentaje as 'descuentoPorcentaje',
								lo.promoBuenFin as 'promoBuenFin',
								lo.descuentoTotal as 'descuentoTotal',
								lo.gananciaPt as 'gananciaPt',
								lo.precioLocal as 'precioLocal',
								m.marca as 'marca',
								r.ramaNombre as 'rama',
								r.ramaID as 'ramaID',
								(SELECT ROUND(12Meses,2) FROM bancos where bancoID = 1) as meses,
								(SELECT ROUND(comisionCC, 1) FROM bancos where bancoID = 1) as comision
								FROM patrocinioProductos pp
								LEFT JOIN locatariosOfertas lo ON lo.marcaID=pp.marcaID
								LEFT JOIN catMarcas m ON m.marcaID = lo.marcaID
								LEFT JOIN ramas r ON r.ramaID=lo.ramaID
								LEFT JOIN tematicas t ON t.tematicaID=lo.tematicaID
								LEFT JOIN unionProductosTipo u ON u.ofertaID=lo.ofertaID
								LEFT JOIN unionCatalogo uc ON uc.ID=u.unionCatalogoID
								WHERE lo.ofertaStatus='Activo'
								
								AND lo.costoEnvio > 0 
								AND lo.ofertaPrecio != 0
								$cad_busqueda
								GROUP BY lo.ofertaID
								ORDER BY lo.descuentoPorcentaje desc, lo.ofertaPrecio asc LIMIT 6
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargarBusquedaCampanias($rama,$marca,$tematica,$cat,$cat1,$cat2,$cat3,$cat4)
	{
		$cad_busqueda = "";
		$cadena       = "";
		$cadena1      = "";
		$cadena2      = "";
		$cadena3      = "";
		$cadena4      = "";
		
		if( !empty($rama) )
			$cad_busqueda="AND r.ramaUrl='$rama'";
			
		if( !empty($marca) )
			$cad_busqueda.="AND m.marcaUrl='$marca'";
		
		if( !empty($tematica) )
			$cad_busqueda.="AND t.tematicaUrl='$tematica'";	
		
		if( !empty($cat) )
			$cadena.="uc.catUrl='$cat' ";
		
		if( !empty($cat1) )
			$cadena1.="OR uc.catUrl='$cat1' ";
			
		if( !empty($cat2) )
			$cadena2.="OR uc.catUrl='$cat2' ";
		
		if( !empty($cat3) )
			$cadena3.="OR uc.catUrl='$cat3' ";
		
		if( !empty($cat4) )
			$cadena4.="OR uc.catUrl='$cat4' ";
			
		if( !empty($cat) )
			$cad_busqueda.="AND ($cadena $cadena1 $cadena2 $cadena3 $cadena4)";
		
		$data = array(); 
		$q = $this->db->query("SELECT 
										lo.ofertaTitulo as 'ofertaTitulo',
									    lo.ofertaDescripcion as 'ofertaDescripcion',
									    lo.ofertaPrecio as 'ofertaPrecio',
									    lo.ofertaImagen as 'ofertaImagen',
									    lo.envio as 'envio',
									    lo.ofertaID as 'ofertaID',
									    lo.descuentoPorcentaje as 'descuentoPorcentaje',
									    lo.descuentoTotal as 'descuentoTotal',
									    lo.promoBuenFin as 'promoBuenFin',
									    lo.gananciaPt as 'gananciaPt',
									    lo.precioLocal as 'precioLocal',
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
										$cad_busqueda
										GROUP BY lo.ofertaID
									");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargaMarcas($rama,$tematica){
	$cad_busqueda = "";
	if( !empty($tematica) )
			$cad_busqueda.="AND t.tematicaUrl ='$tematica'";
			
		$data = array(); 
		$q = $this->db->query("SELECT 
								m.marca as 'marca',
								m.marcaUrl as 'marcaUrl',
								t.tematicaNombre as 'tematicaNombre',
								m.marca, COUNT(lo.ofertaID) as total
							    FROM locatariosOfertas lo
								LEFT JOIN ramas r ON r.ramaID=lo.ramaID
								LEFT JOIN catMarcas m ON m.marcaID=lo.marcaID
								LEFT JOIN tematicas t ON t.tematicaID=lo.tematicaID
								WHERE lo.ofertaStatus='Activo'
								AND r.ramaUrl='$rama'
								
								AND lo.costoEnvio > 0 
								AND lo.ofertaPrecio != 0
								AND m.marca!=''
								$cad_busqueda
								GROUP BY m.marca				
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargaMarcasTodas(){
	
		$data = array(); 
		$q = $this->db->query("SELECT 
								m.marca as 'marca',
								m.marcaUrl as 'marcaUrl',
							 	m.marca, COUNT(lo.ofertaID) as total,
							 	r.ramaUrl as 'ramaUrl'
							  	FROM locatariosOfertas lo
								LEFT JOIN ramas r ON r.ramaID=lo.ramaID
								LEFT JOIN catMarcas m ON m.marcaID=lo.marcaID
								LEFT JOIN tematicas t ON t.tematicaID=lo.tematicaID
								WHERE lo.ofertaStatus='Activo'
								
								AND m.marca!=''
								GROUP BY m.marca				
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargaTematicas($rama,$marca){
	
	$cad_busqueda = "";
	if( !empty($marca) )
			$cad_busqueda.="AND m.marcaUrl='$marca'";
			
			
		$data = array(); 
		$q = $this->db->query("SELECT 
								t.tematicaUrl as 'tematicaUrl',
							    t.tematicaNombre as 'tematicaNombre'
							    FROM locatariosOfertas lo
								LEFT JOIN ramas r ON r.ramaID=lo.ramaID
								LEFT JOIN catMarcas m ON m.marcaID=lo.marcaID
								LEFT JOIN tematicas t ON t.tematicaID=lo.tematicaID
								WHERE lo.ofertaStatus='Activo'
								AND r.ramaUrl='$rama'
								AND t.tematicaUrl!=''
								
								AND lo.costoEnvio > 0 
										AND lo.ofertaPrecio != 0
								$cad_busqueda
								GROUP BY t.tematicaUrl			
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargaCaracteristicas($rama,$marca){
	
	$cad_busqueda = "";
	if( !empty($marca) )
			$cad_busqueda.="AND m.marcaUrl='$marca'";
			
		$data = array(); 
		$q = $this->db->query("SELECT 
								c.descripcion as 'descripcion',
								c.tipoID as 'tipoID'
								FROM locatariosOfertas lo
								LEFT JOIN ramas r ON r.ramaID=lo.ramaID
								LEFT JOIN catMarcas m ON m.marcaID=lo.marcaID
								LEFT JOIN tematicas t ON t.tematicaID=lo.tematicaID
								LEFT JOIN unionProductosTipo u ON u.ofertaID=lo.ofertaID
								LEFT JOIN unionCatalogo uc ON uc.ID=u.unionCatalogoID
								LEFT JOIN catTipo c ON c.tipoID=uc.catTipoID
								WHERE lo.ofertaStatus='Activo'
								AND lo.costoEnvio > 0 
										AND lo.ofertaPrecio != 0
								AND r.ramaUrl='$rama'
								AND c.descripcion !=''
								$cad_busqueda
								GROUP BY c.descripcion			
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function cargaSubCat($rama,$marca,$tipoID){
		$cad_busqueda = "";
		if( !empty($marca) )
				$cad_busqueda.="AND m.marcaUrl='$marca'";
		
		$data = array(); 
		$q = $this->db->query("SELECT 
								uc.descripcion as 'descripcion',
								c.tipoID as 'tipoID',
								lo.ofertaTitulo as 'oferta',
								c.descripcion as 'tipo',
								uc.catUrl as 'catUrl'
								FROM locatariosOfertas lo
								LEFT JOIN ramas r ON r.ramaID=lo.ramaID
								LEFT JOIN catMarcas m ON m.marcaID=lo.marcaID
								LEFT JOIN tematicas t ON t.tematicaID=lo.tematicaID
								LEFT JOIN unionProductosTipo u ON u.ofertaID=lo.ofertaID
								LEFT JOIN unionCatalogo uc ON uc.ID=u.unionCatalogoID
								LEFT JOIN catTipo c ON c.tipoID=uc.catTipoID
								WHERE lo.ofertaStatus='Activo'
								AND lo.costoEnvio > 0 
								AND lo.ofertaPrecio != 0
								AND r.ramaUrl='$rama'
								$cad_busqueda
								AND c.tipoID='$tipoID'
								group by uc.descripcion
								limit 6
								");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
			$q->free_result();  	
		}
		return $data;
	}
	
	function ultimoCupon(){
		$data = array(); 
		$q = $this->db->query("SELECT * FROM cupones ORDER BY cuponID DESC LIMIT 1");
		
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}
	
	function cargarInfoCupon($cuponFolio){
		$data = array(); 
		$q = $this->db->query("SELECT cuponFolio as 'cuponFolio',
									 c.usuarioNombre as 'usuarioNombre',
									 c.usuarioEmail as 'usuarioEmail',
									 l.localID  as 'localID',
									 l.localNombre as 'name',
									 l.localPlanta as 'localPlanta',
									 l.localNumero as 'localNumero',
									 l.localTelefono as 'telefono',
									 lo.ofertaTitulo as 'ofertaTitulo',
									 lo.ofertaImagen as 'ofertaImagen',
									 lo.ofertaID as 'ofertaID',
									 lo.ofertaVigencia as 'ofertaVigencia',
									 lo.ofertaPrecio as 'ofertaPrecio',
									 lo.ofertaDescripcion as 'ofertaDescripcion'
								FROM cupones c
								LEFT JOIN locatariosOfertas lo on c.ofertaID=lo.ofertaID
								LEFT JOIN locatarios l on c.localID = l.localID
								WHERE cuponFolio='$cuponFolio'"
		);
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}
	
	function cargarTopLocales(){
		$data = array(); 
		$q = $this->db->query("SELECT localNombre as 'nombreLocal',
								localUrl as 'urlLocal',
								localLogo as 'imagenLocal'
								from locatarios
								WHERE destacado = 1 AND RAND() LIMIT 5");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}
	
	function historialBusqueda($key){
		$data = array(); 
		$q = $this->db->query("SELECT busquedaTexto AS 'texto', 
												 COUNT(busquedaTexto) AS veces  
											FROM historialBusquedas
											WHERE MATCH(busquedaTexto) AGAINST ('%$key%' IN BOOLEAN MODE) 
											AND busquedaTexto != '$key'
											GROUP BY busquedaTexto 
											ORDER BY veces DESC
											LIMIT 5;");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
		}
		return $data;
	}
	
	function cargarTiendasConveniencia(){
		
		$data = array(); 
		$q = $this->db->query("SELECT * FROM pagosTipos WHERE tipo='Departamentales'");
		if($q->num_rows() > 0) {
			foreach($q->result() as $row){
				$data[] = $row;
			}
		}
		return $data;
		
	}
	
}	