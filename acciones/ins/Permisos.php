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
		echo $query;
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

				public static function listaVacacionesxempleado($idEmpleado){
					$_Modul   = new Incidencias();
					$query  = sprintf('SELECT * FROM vacaciones WHERE CURDATE() BETWEEN FechaInicio AND FechaFin  AND Estatus = 1  AND idEmpleado = %d',
						$idEmpleado );
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

		public static function maxIdVacaciones(){
				$_Modul   = new Incidencias();
				$query  = sprintf('SELECT MAX(id) AS id FROM vacaciones');
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
}
?>