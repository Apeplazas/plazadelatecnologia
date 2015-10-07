<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class encuesta_modelo extends  CI_Model{
    		
    	function obtiene_encuesta($encuestaID){
    		$data = array(); 
			$q = $this->db->query("SELECT *
									FROM encuestas e
									left outer join encuestaPregunta ep ON ep.encuestaID = e.encuestaID
									where e.encuestaID = '$encuestaID'"
									);
			if($q->num_rows() > 0) {
				foreach($q->result() as $row){
					$data[] = $row;
				}
				$q->free_result();  	
			}
			return $data;
		}
		
		function obtiene_respuestas($respuestasID){
    		$data = array(); 
			$q = $this->db->query("SELECT *
									FROM encuestaRespuesta er
									left outer join encuestaPregunta ep ON ep.encuestaPreguntaID = er.encuestaPreguntaID
									left outer join encuestas e ON e.encuestaID = ep.encuestaID
									where e.encuestaID = '$respuestasID'
									group by pregunta
									");
			if($q->num_rows() > 0) {
				foreach($q->result() as $row){
					$data[] = $row;
				}
				$q->free_result();  	
			}
			return $data;
		}
		
		function obtiene_opciones($encuestaPreguntaID){
		$data = array(); 
		$q = $this->db->query("SELECT 
								ep.encuestaPreguntaID as 'ID',
								eo.encuestaOpcion as 'opcion',
								ep.porqueStatus as 'status',
								ep.encuestaTipo	as 'tipo'
								FROM encuestaPregunta ep
								left outer join encuestaOpciones eo ON ep.encuestaPreguntaID = eo.encuestaPreguntaID
								where eo.encuestaPreguntaID='$encuestaPreguntaID'
								");
		
		return $q->result_array();	
	}
	
	function obtieneRespuestasName(){
    		$data = array(); 
			$q = $this->db->query("select encuestaPreguntaID from encuestaPregunta where encuestaID='1'");
			return $q->result_array();
		}
	
	function obtieneNumPreguntas($encuestaID){
    		$data = array(); 
			$q = $this->db->query("SELECT COUNT(*) as numero FROM encuestaPregunta where encuestaID='$encuestaID'");
			if($q->num_rows() > 0) {
				foreach($q->result() as $row){
					$data[] = $row;
				}
				$q->free_result();  	
			}
			return $data;
		}
		
	function validate()
    {
        $usuarioEmail = trim($this->input->post('usuarioEmail'));
        
        //si no existen los datos regresamos false
        if( empty($usuarioEmail) || !isset($usuarioEmail) )
            return false;
        
       
        //ejecutamos la consulta
        $query = $this->db->query("SELECT * from intranet_usuarios WHERE usuarioEmail='$usuarioEmail'");
        
        //si todo sale bien, regresamos un objeto
        if( $query->num_rows() > 0 )
            return $query->result();
        else
            return false;
    }
	
	function busquedaEncuesta($usuarioID)
    {
        $data = array(); 
			$q = $this->db->query("SELECT es.encuestaID as encuestas
									FROM intranet_usuarios iu 
									left outer join encuestaSucursal es
									ON es.sucursalID = iu.usuarioSucursal
									where iu.usuarioID='$usuarioID'
				");
			if($q->num_rows() > 0) {
				foreach($q->result() as $row){
					$data[] = $row;
				}
				$q->free_result();  	
			}
			return $data;
    }
	
	function preguntaID($preguntaID)
    {
        $data = array(); 
			$q = $this->db->query("SELECT *
									FROM encuestaRespuesta er
									left outer join encuestaPregunta ep ON ep.encuestaPreguntaID = er.encuestaPreguntaID
									left outer join intranet_usuarios iu ON iu.usuarioID = er.usuarioID
									where ep.encuestaPreguntaID= '$preguntaID'
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
?>