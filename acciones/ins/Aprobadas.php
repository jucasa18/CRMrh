<?php
require_once 'PreNomina_principal.php';
class Aprobadas extends PreNomina_principal {
		
	//inicializa un objeto Usuario
	public function __construct(){   
		parent::__construct();
	}
	

		public static function listaAprobadas(){ //Función para listar las pro-Nóminas aprobadas Quincenales
			$_Modul   = new Aprobadas();
			$query  = sprintf('SELECT DISTINCT NumQuincena, FechaInicio, FechaFin FROM prenomina WHERE TipoNomina = 1');
			$result = $_Modul->_db->query($query);
			$return =[];
			if ($result->num_rows){
				while( $row = $result->fetch_assoc() ){
					$return []= $row;
				}
				mysqli_free_result($result);
			}
	
			$_Modul->desconectar();
			return $return;
		}

		public static function listaAprobadasXNQ($nq){ //Función para listar por numero de quincena formato NOI
			$_Modul   = new Aprobadas();
			$query  = sprintf('SELECT * FROM fnoi WHERE NumQuincena=%d', $nq);
			$result = $_Modul->_db->query($query);
			$return =[];
			if ($result->num_rows){
				while( $row = $result->fetch_assoc() ){
					$return []= $row;
				}
				mysqli_free_result($result);
			}
	
			$_Modul->desconectar();
			return $return;
		}
		public static function listaAprobadasXNQPnomina($nq){ //Función para listar por numero de quincena prenomina Excel
			$_Modul   = new Aprobadas();
			$query  = sprintf('SELECT * FROM prenomina WHERE NumQuincena =%d', $nq);
			//echo $query;
			$result = $_Modul->_db->query($query);
			$return =[];
			if ($result->num_rows){
				while( $row = $result->fetch_assoc() ){
					$return []= $row;
				}
				mysqli_free_result($result);
			}
	
			$_Modul->desconectar();
			return $return;
		}

		public static function listaAprobadasS(){ //Función para listar las pro-Nóminas aprobadas Quincenales
			$_Modul   = new Aprobadas();
			$query  = sprintf('SELECT DISTINCT NumQuincena, FechaInicio, FechaFin FROM prenomina WHERE TipoNomina = 2');
			$result = $_Modul->_db->query($query);
			$return =[];
			if ($result->num_rows){
				while( $row = $result->fetch_assoc() ){
					$return []= $row;
				}
				mysqli_free_result($result);
			}
	
			$_Modul->desconectar();
			return $return;
		}


		






}
?>