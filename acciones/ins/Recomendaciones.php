<?php
require_once 'Recomendaciones_principal.php';
class Recomendaciones extends Recomendaciones_principal {
		
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
			$idEmpleado );elimina
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
		public static function listaRecomendacionesxepl($id){
			$_Modul   = new Recomendaciones();
			/*$query  = sprintf('SELECT * FROM recomendados WHERE Estatus = 1 AND idRecomendador = %d',
			$id);*/
			$query  = sprintf('SELECT r.id, r.idRecomendado, e.Nombre,e.ApellidoP,e.ApellidoM,e.FechaIngreso FROM recomendados AS r  INNER JOIN empleados AS e ON (r.idRecomendado = e.IdDRENC) WHERE e.Estatus = 1 AND r.idRecomendador = %d AND r.Estatus',
			$id);

			
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

		public static function listaRutabyId($idRuta){
			$_Modul   = new Recomendaciones();
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
			}

			public static function maxIdRecomendados(){
				$_Modul   = new Recomendaciones();
				$query  = sprintf('SELECT MAX(id) AS id FROM recomendados');
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
			public static function buacaRecomendados($idRecomendador){
				$_Modul   = new Recomendaciones();
				$query  = sprintf('SELECT *, (SELECT DATE_ADD(FechaIngreso, INTERVAL 2 month)) AS dias FROM recomendados WHERE idRecomendador= %d AND now() >= (SELECT DATE_ADD(FechaIngreso, INTERVAL 2 month))  AND Estatus = 1 AND Pagado = 0;', 
									$idRecomendador);
								//	echo $query;
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