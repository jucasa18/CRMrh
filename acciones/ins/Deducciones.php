<?php
require_once 'Deducciones_principal.php';
class Deducciones extends Deducciones_principal {
		
	//inicializa un objeto Usuario
	public function __construct(){   
		parent::__construct();
	}

//se listan todas las rutas. activas e inactivas, ya que solo es para los administradores


	public static function listaDeducciones($tipo){
		$_Modul   = new Deducciones();
		
	/*	$query  = sprintf('SELECT DISTINCT(Fecha),id, (id +1)as id2, idEmpleado, Fecha, Entrada, Salida, (SELECT idPlanta FROM empleados WHERE IdDRENC = idEmpleado ) AS pl, (SELECT Salida FROM es2 WHERE id = id2 ) as Salida2, (SELECT Fecha FROM es2 WHERE id = id2 ) as fechas2 FROM es2 WHERE idEmpleado = %d AND Fecha BETWEEN "%s" AND "%s";',    
		$idEmpleado,$fechaInicio, $fechaFin);*/

		$query  = sprintf('SELECT * FROM deducciones WHERE Tipo = %d AND Status = 1;',    
		$tipo);
			echo $query;
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


public static function maxDeducciones(){
	$_Modul   = new Deducciones();
	$query  = sprintf('SELECT MAX(id) AS id FROM deducciones');
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
public static function DeduccionByid($id){
	$_Modul   = new Deducciones();
	$query  = sprintf('SELECT *  FROM deducciones WHERE id = %d', $id);
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

public static function ListaConceptos($idempleado){
	
		$_Modul   = new Deducciones();
		
	/*	$query  = sprintf('SELECT DISTINCT(Fecha),id, (id +1)as id2, idEmpleado, Fecha, Entrada, Salida, (SELECT idPlanta FROM empleados WHERE IdDRENC = idEmpleado ) AS pl, (SELECT Salida FROM es2 WHERE id = id2 ) as Salida2, (SELECT Fecha FROM es2 WHERE id = id2 ) as fechas2 FROM es2 WHERE idEmpleado = %d AND Fecha BETWEEN "%s" AND "%s";',    
		$idEmpleado,$fechaInicio, $fechaFin);*/

		$query  = sprintf('SELECT * FROM deducciones WHERE  idEmpleado =%d AND Status = 1;',    
		$idempleado);
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

public static function listaEmpleadobyId($idEmpleado){
	$_Modul   = new Deducciones();
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