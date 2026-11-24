<?php
require_once 'Vacaciones_principal.php';
class Vacaciones extends Vacaciones_principal {
		
	//inicializa un objeto Usuario
	public function __construct(){   
		parent::__construct();
	}
	
/*
	public static function listaEmpleadosActivos(){
		$_Modul   = new Empleados();
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

	public static function listaEmpleadosInactivos(){
		$_Modul   = new Empleados();
		$query  = sprintf('SELECT * FROM empleados WHERE Estatus=0');
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

	public static function listaEmpleadobyId($idEmpleado){
		$_Modul   = new Empleados();
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
		}*/

//se listan todas las rutas. activas e inactivas, ya que solo es para los administradores
public static function listaEmpleadosActivos(){
	$_Modul   = new Vacaciones();
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
	$_Modul   = new Vacaciones();
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
		$_Modul   = new Vacaciones();
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
			$_Modul   = new Vacaciones();
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
				$_Modul   = new Vacaciones();
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
					$_Modul   = new Vacaciones();
					$query  = sprintf('SELECT * FROM vacaciones WHERE  Estatus = 1  AND idEmpleado = %d',
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

		/*public static function listaRutas(){
			$_Modul   = new Rutas();
			$query  = sprintf('SELECT * FROM rutas');
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

		public static function listaRutabyId($idRuta){
			$_Modul   = new Rutas();
			$query  = sprintf('SELECT * FROM rutas WHERE  id = %d',    
				$idRuta );
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
			}*/

			public static function maxIdVacaciones(){
				$_Modul   = new Vacaciones();
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
			$_Modul   = new Vacaciones();
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
				$_Modul   = new Vacaciones();
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



			

	/*

	public static function listaCitasByIdUser($idCita){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT * FROM cita WHERE idCita=%d',
			$idCita );
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
	
	

	public static function CitaByIdUserId($idPaciente){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT * FROM cita WHERE idPaciente=%d',
			$idPaciente );
		//echo 	$query;
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
	    
    public static function eliminarexpedienteById($idExpediente){
		$_soporte   =   new Citas();
		$query = sprintf('UPDATE cita SET
						eliminado = 1
						WHERE idExpediente = %d ',$idExpediente );
		if ($_soporte->_db->query($query) ){
			return true;
		}else{
			return false;
		}
		$_soporte->desconectar();
		return false;
    }
    
	public static function CitaByPaciente($idPaciente){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT * FROM paciente WHERE idPaciente=%d',
			$idPaciente );
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
	public static function listaRetrasos(){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT *, TIME(fecha_hora) as Hora FROM cita WHERE (DATE(fecha_hora) = CURDATE() AND TIME(fecha_hora) < CURTIME()) ORDER BY TIME(fecha_hora) DESC;');
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
	public static function listaProximas(){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT *, TIME(fecha_hora) as Hora FROM cita WHERE DATE(fecha_hora) > CURDATE() ORDER BY TIME(fecha_hora) ASC;');
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
	public static function Doctores(){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT * FROM usuarios WHERE consultas=1');
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
	public static function DatosDoctor($idDoctor){
		$_Modul   = new Citas();
		$query  = sprintf('SELECT * FROM usuarios WHERE idUsuario=%d',
			$idDoctor );
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
	}*/

}
?>