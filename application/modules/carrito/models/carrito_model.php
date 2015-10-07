<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Carrito_model extends CI_Model {

	

	function itemInfo($ofertaID)

    {

        $data = array(); 

        $q = $this->db->query("SELECT * FROM locatariosOfertas lo

        					   LEFT JOIN ramas r ON r.ramaId = lo.ramaID

        					   WHERE ofertaID ='$ofertaID'");

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

	

	function folios()

    {

        $data = array(); 

        $q = $this->db->query("SELECT * FROM compras order by compraID DESC limit 1");

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

	

	function verificaID($email)

    {

        $data = array(); 

        $q = $this->db->query("SELECT * from usuarios where email='$email'");

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

    

	function estados(){

		

		$data = array(); 

        $q = $this->db->query("SELECT claveEstado AS idEstado, 

        							  nombreEstado AS nombreEstado 

		        					  FROM estadosMexico 

		        					  GROUP BY claveEstado  

		        					  ORDER BY claveEstado");

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

	

	function municipios($estadoFiltro){

		

		$data = array(); 

        $q = $this->db->query("SELECT claveMunicipio AS idMunicipio, 

									   nombreMunicipio AS nombreMunicipio 

									   FROM estadosMexico 

									   WHERE claveEstado = '$estadoFiltro' 

									   GROUP BY claveMunicipio  

									   ORDER BY claveMunicipio ASC");

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

	

	function colonias($estadoFiltro,$municipioFiltro){

		

		$data = array(); 

        $q = $this->db->query("SELECT claveColonia AS idColonia, 

									   nombreColonia AS nombreColonia 

									   FROM estadosMexico

									   WHERE claveEstado = '$estadoFiltro'

									   AND claveMunicipio = '$municipioFiltro' 

									   GROUP BY claveColonia  

									   ORDER BY nombreColonia ASC");

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

	

	function ultimoSitio(){

		

		$data = array(); 

        $q = $this->db->query("SELECT * FROM sitiosEntrega  

		        					  ORDER BY idSitio DESC LIMIT 1");

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

	

	function compra($folio){

		

		$data = array(); 

        $q = $this->db->query("SELECT s.telefono as 'telefono',
										s.direccion as 'direccion',
										em.nombreEstado as 'estado',
										em.nombreMunicipio as 'municipio',
										em.nombreColonia as 'colonia',
										em.codigoCP as 'CP',
										s.recibe as 'personaRecibe',
										c.total as 'total',
										c.folio as 'folio'
										FROM compras c 
										LEFT JOIN productosComprados pc ON pc.folioCompra=c.folio
										LEFT JOIN usuarios u ON u.idRegistro=c.usuarioID
										LEFT JOIN sitiosEntrega s ON s.idSitio=c.idSitio
										LEFT JOIN estadosMexico em ON s.estado = em.claveEstado 
										WHERE s.CodigoPostal = em.codigoCP 
										AND s.municipioDelegacion = em.claveMunicipio 
										AND s.colonia = em.claveColonia 
										AND c.folio='$folio'");

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

	function actualizaCompra($fechaPago, $status, $metodoPago, $plazo,$folio){
		$q = $this->db->query("UPDATE compras 
								SET fechaPago = '$fechaPago', status = '$status', metodoPago = '$metodoPago', pago_diferido = $plazo 
								WHERE folio = '$folio'");
		//return	$q;
	}

	function detalleCompra($folio){

		

		$data = array(); 

        $q = $this->db->query("SELECT lo.ofertaID,

        							 lo.ofertaTitulo, 

									 pc.cantidadProducto,

									 pc.ofertaPrecio,

									 pc.costoEnvio,

									 pc.subtotalPago

								FROM productosComprados pc 

								LEFT JOIN locatariosOfertas lo ON pc.ofertaID = lo.ofertaID

								WHERE folioCompra = '$folio'");

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

	

	function infoCliente($folio){

		

		$data = array(); 

        $q = $this->db->query("SELECT folio as 'folio',

									 fechaCompra as 'fechaCompra',

									 fechaPago as 'fechaPago',

									 total as 'total',

									 metodoPago as 'metodoPago',

									 userAlias as 'alias',

									 userName as 'name',

									 lastName as 'lastname',

									 email as 'email',

									 direccion as 'calle',

									 nombreColonia as 'colonia',

									 nombreMunicipio as 'municipio',

									 nombreEstado as 'estado',

									 CodigoPostal as 'cp',

									 telefono as 'telefono'

							FROM compras c

							LEFT JOIN usuarios ur ON ur.idRegistro = c.usuarioID

							LEFT JOIN sitiosEntrega se ON se.idSitio = c.idSitio

							LEFT JOIN estadosMexico em ON se.estado = em.claveEstado 

							WHERE c.status = 'pagado'

							AND se.CodigoPostal = em.codigoCP 

						  AND se.municipioDelegacion = em.claveMunicipio 

						  AND se.colonia = em.claveColonia 

						 	AND c.folio = '$folio'");

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


    function infoComprador($folio){
        
        $data = array(); 
        $q = $this->db->query("SELECT folio as 'folio',
                                     fechaCompra as 'fechaCompra',
                                     fechaPago as 'fechaPago',
                                     total as 'total',
                                     metodoPago as 'metodoPago',
                                     userAlias as 'alias',
                                     userName as 'name',
                                     lastName as 'lastname',
                                     email as 'email',
                                     direccion as 'calle',
                                     nombreColonia as 'colonia',
                                     nombreMunicipio as 'municipio',
                                     nombreEstado as 'estado',
                                     CodigoPostal as 'cp',
                                     telefono as 'telefono'
                            FROM compras c
                            LEFT JOIN usuarios ur ON ur.idRegistro = c.usuarioID
                            LEFT JOIN sitiosEntrega se ON se.idSitio = c.idSitio
                            LEFT JOIN estadosMexico em ON se.estado = em.claveEstado 
                            WHERE 1=1
                            AND se.CodigoPostal = em.codigoCP 
                          AND se.municipioDelegacion = em.claveMunicipio 
                          AND se.colonia = em.claveColonia 
                            AND c.folio = '$folio'");
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

    function infoReservasPendientes(){

        

        $data = array(); 

        $q = $this->db->query("SELECT payu_id FROM compras WHERE STATUS='espera de pago' AND payu_id>0 AND payworks=0 ");

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

    function infoReservasPendientesPayworks($referencia){

        

        $data = array(); 

        $q = $this->db->query("SELECT * FROM compras WHERE STATUS='espera de pago' AND payworks=1 and folio='$referencia' ");

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

	

	function cantidadComprada($folio){

		

		$data = array(); 

        $q = $this->db->query("SELECT ofertaID, cantidadProducto FROM productosComprados WHERE folioCompra = '$folio'");

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

	

	function itemExistencia($ofertaID){

		

		$data = array(); 

        $q = $this->db->query("SELECT existencia FROM locatariosOfertas WHERE ofertaID = '$ofertaID'");

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

	

	function direccionesUser($usuarioID){

		$data = array(); 

        $q = $this->db->query("SELECT * FROM sitiosEntrega WHERE usuarioID = '$usuarioID' AND estatus = 'activo'");

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
	
	function traeUltimoFolio($usuarioID){

		$data = array(); 
        $q = $this->db->query("SELECT folio FROM compras WHERE usuarioID = '$usuarioID' ORDER BY compraID DESC LIMIT 1");
        if($q->num_rows() > 0) {
            foreach($q->result() as $row){
                $data = $row->folio;
            }
            $q->free_result();  	
        }
        return $data;		
		
	}

}