<?php
require_once 'Incidencias_principal.php';
class Incidencias extends Incidencias_principal {
		
	//inicializa un objeto Usuario
	public function __construct(){   
		parent::__construct();
	}

//se listan todas las rutas. activas e inactivas, ya que solo es para los administradores
public static function listaEmpleadosActivos(){
	$_Modul   = new Incidencias();
	$query  = sprintf('SELECT * FROM empleados WHERE Estatus=1');
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

public static function VacacionesbyId($idEmpleado){
	$_Modul   = new Incidencias();
	$query  = sprintf('SELECT * FROM  vacaciones WHERE idEmpleado =%d',
		$idEmpleado );
	//	echo $query;
		$result = $_Modul->_db->query($query);
		$return =0;
		if ($result->num_rows){
			while( $row = $result->fetch_assoc() ){
				$return = $row;
			}
			mysqli_free_result($result);
		}
		
		$_Modul->desconectar();
		return $return;
	}

	public static function añostrabajados23($idEmpleado){
		$_Modul   = new Incidencias();
		$query  = sprintf('SELECT floor (TIMESTAMPDIFF(YEAR,FechaIngreso,CURDATE())) AS antiguedad  FROM empleados WHERE IdDRENC= %d',
			$idEmpleado );
			//echo $query;
			$result = $_Modul->_db->query($query);
			$return =0;
			if ($result->num_rows){
				while( $row = $result->fetch_assoc() ){
					$return = $row;
				}
				mysqli_free_result($result);
			}
			
			$_Modul->desconectar();
			return $return;
		}




		public static function añostrabajadosold($idEmpleado){
			$_Modul   = new Incidencias();
			$query  = sprintf('SELECT floor (DATEDIFF("2022-12-31",FechaIngreso)/360)  AS antiguedadold FROM empleados WHERE IdDRENC = %d',
				$idEmpleado);
				//echo $query;
				$result = $_Modul->_db->query($query);
				$return =0;
				if ($result->num_rows){
					while( $row = $result->fetch_assoc() ){
						$return = $row;
					}
					mysqli_free_result($result);
				}
				
				$_Modul->desconectar();
				return $return;
			}

			public static function vacaciones2023($idEmpleado){
				$_Modul   = new Incidencias();
				$query  = sprintf('SELECT ((12/365)* (DATEDIFF(NOW(),FechaIngreso)+1))  AS diasVacaciones FROM `empleados` WHERE IdDRENC= %d',
					$idEmpleado );
				//	echo $query;
					$result = $_Modul->_db->query($query);
					$return =0;
					if ($result->num_rows){
						while( $row = $result->fetch_assoc() ){
							$return = $row;
						}
						mysqli_free_result($result);
					}
					
					$_Modul->desconectar();
					return $return;
				}

				public static function listaIncidenciasxempleado($idEmpleado, $tipo){
					$_Modul   = new Incidencias();
					//$query  = sprintf('SELECT * FROM incidencias WHERE FechaIncidencia >= CURDATE() AND Estatus = 1 AND TipoIncidencia = %d  AND idEmpleado = %d',
					//	$tipo,$idEmpleado );
					$query  = sprintf('SELECT * FROM incidencias WHERE Estatus = 1 AND TipoIncidencia = %d  AND idEmpleado = %d',
						$tipo,$idEmpleado );
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

		public static function maxIncidencias(){
				$_Modul   = new Incidencias();
				$query  = sprintf('SELECT MAX(id) AS id FROM incidencias');
				$result = $_Modul->_db->query($query);
				$return =0;
				if ($result->num_rows){
					while( $row = $result->fetch_assoc() ){
						$return = $row;
					}
					mysqli_free_result($result);
				}
		
				$_Modul->desconectar();
				return $return;
			}

			
		public static function listaParadabyId($idParada){
			$_Modul   = new Incidencias();
			$query  = sprintf('SELECT * FROM paradas WHERE  id = %d',    
				$idParada );
				//echo $query;
				$result = $_Modul->_db->query($query);
				$return =0;
				if ($result->num_rows){
					while( $row = $result->fetch_assoc() ){
						$return = $row;
					}
					mysqli_free_result($result);
				}
				
				$_Modul->desconectar();
				return $return;
			}

			public static function listaEmpleadobyId($idEmpleado){
				$_Modul   = new Incidencias();
				$query  = sprintf('SELECT * FROM empleados WHERE IdDRENC =%d',
					$idEmpleado );
					//echo $query;
					$result = $_Modul->_db->query($query);
					$return =0;
					if ($result->num_rows){
						while( $row = $result->fetch_assoc() ){
							$return = $row;
						}
						mysqli_free_result($result);
					}
					
					$_Modul->desconectar();
					return $return;
				}
				public static function listaContingencias(){
					$_Modul   = new Incidencias();
					$query  = sprintf('SELECT * FROM incidencias WHERE TipoIncidencia = 6 AND Estatus = 1');
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

				public static function listaDiasFestivos(){
					$_Modul   = new Incidencias();
					$query  = sprintf('SELECT * FROM incidencias WHERE TipoIncidencia = 8 AND Estatus = 1');
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
				public static function listaMediasHoras(){
					$_Modul   = new Incidencias();
					$query  = sprintf('SELECT * FROM incidencias WHERE TipoIncidencia = 11 AND Estatus = 1');
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

				public static function listaBonoAntiguedad(){
					$_Modul   = new Incidencias();
					$query  = sprintf('SELECT * FROM incidencias WHERE TipoIncidencia = 13 AND Estatus = 1');
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
				public static function listaComlJor(){
					$_Modul   = new Incidencias();
					$query  = sprintf('SELECT * FROM incidencias WHERE TipoIncidencia = 14 AND Estatus = 1');
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