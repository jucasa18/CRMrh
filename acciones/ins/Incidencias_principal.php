<?php
require_once (realpath($_SERVER["DOCUMENT_ROOT"]) .'/rh/acciones/Modelo.php');
class Incidencias_principal  extends Modelo {
	
    private $uid; // id
    private $campos; //campos de registro	
	
	//inicializa un objeto
	public function __construct(){
		parent::__construct(); 
		$this->uid = null;
		$this->campos = array ( 
	         //  'idPaciente' 	 		=>'',
			   'id'  				=>'',   
	           'IdUsuario'  		=>'', 
	           'idIncidencia'  	 	=>'',      
	           'idEmpleado'  	 	=>'',      
	           'FechaIncidencia'  	=>'',    
			   'Motivo'  			=>'',  
			   'TipoIncidencia'  	=>'', 
	           'Horario'  	 		=>'',      
	           'Otro'  				=>'',      
	           'Origen'  			=>'',    
			   'Destino'  			=>'', 
			   'Contacto'  			=>'', 
	           'Sueldo'  	 		=>'',   
			   'Hora'  	 		    =>'', 
			   'HoraR'  	 		=>'',  
			   'Regreso'  	 		=>'',  
			   'Turno'  	 		=>'',      
	           'FechaCreacion'  	=>date('Y-m-d H:i:s'),      
	           'Estatus'  			=>'', 
			   'Cantidad'  			=>'', 
			   'FechaCambio'		=>date('Y-m-d H:i:s'),

			//datospara el insert de las entradas y salidas
				
				'Fecha'  	 		=>'',      
				'Dia'  	 			=>'',      
				'Entrada'  			=>'',    
				'Salida'  			=>'',  
				'Tiempo'  			=>'', 
				'Retardo'  	 		=>''   
			


	    );
	}

	public function __get($field){
		if ($field == 'id'){
		 	return $this->id;
		}else{
			return $this->campos[$field];
		}	
	}

	public function __set($campo, $valor){
		if (array_key_exists($campo, $this->campos))
			$this->campos[$campo] = $valor;
		elseif($campo=='id')
			$this->id=$valor;
	}
	

	public function save(){
		
		$query = sprintf('INSERT INTO  incidencias(id, idEmpleado, FechaIncidencia, Motivo, TipoIncidencia, Horario, Otro, Origen, Destino, Contacto, Sueldo, Hora, HoraR, Regreso, Cantidad, FechaCreacion, Estatus) VALUES ("", %d, "%s", "%s", %d, %d, "%s", "%s", "%s", "%s", %d, "%s", "%s", "%s","%s", "%s", %d)',
					mysqli_real_escape_string($this->_db,$this->idEmpleado), 
				    mysqli_real_escape_string($this->_db,$this->FechaIncidencia),
					mysqli_real_escape_string($this->_db,$this->Motivo),
					mysqli_real_escape_string($this->_db,$this->TipoIncidencia), 
					mysqli_real_escape_string($this->_db,$this->Horario), 
				    mysqli_real_escape_string($this->_db,$this->Otro),
					mysqli_real_escape_string($this->_db,$this->Origen),
					mysqli_real_escape_string($this->_db,$this->Destino), 
					mysqli_real_escape_string($this->_db,$this->Contacto), 
					mysqli_real_escape_string($this->_db,$this->Sueldo),
					mysqli_real_escape_string($this->_db,$this->Hora),
					mysqli_real_escape_string($this->_db,$this->HoraR),
					mysqli_real_escape_string($this->_db,$this->Regreso),
					mysqli_real_escape_string($this->_db,$this->Cantidad),
					mysqli_real_escape_string($this->_db,$this->FechaCreacion), 
					mysqli_real_escape_string($this->_db,$this->Estatus)

					);
				//echo $query;
				//exit();
			if ($this->_db->query($query)){
				$this->id = mysqli_insert_id($this->_db);
				return true;
			}else{
				return false;
			}
	}
	/*public static function deleteBydId($idPaciente){
		$_M001 = new M001Atencion_principal();
		$query = sprintf('DELETE FROM paciente WHERE idPaciente  = %d ',
							mysqli_real_escape_string($_M001->_db,$idPaciente) );
		return $_M001->_db->query($query);
	}*/
	public function save2(){
		
		$query2 = sprintf('INSERT INTO  histincidencias (id, IdUsuario, idIncidencia, idEmpleado, FechaIncidencia, Motivo, TipoIncidencia, Horario, Otro, Origen, Destino, Contacto, Sueldo, Hora, HoraR, Regreso, Cantidad, FechaCreacion, Estatus, FechaCambio) VALUES ("", %d, %d, %d, "%s", "%s", %d, %d, "%s", "%s", "%s", "%s", %d, "%s", "%s","%s","%s", "%s", %d, "%s")',
				//mysqli_real_escape_string($this->_db,$this->IdDRENC),
				mysqli_real_escape_string($this->_db,$this->IdUsuario), 
				mysqli_real_escape_string($this->_db,$this->idIncidencia), 
				mysqli_real_escape_string($this->_db,$this->idEmpleado), 
				mysqli_real_escape_string($this->_db,$this->FechaIncidencia), 
				mysqli_real_escape_string($this->_db,$this->Motivo),
				mysqli_real_escape_string($this->_db,$this->TipoIncidencia),
				mysqli_real_escape_string($this->_db,$this->Horario), 
				mysqli_real_escape_string($this->_db,$this->Otro), 
				mysqli_real_escape_string($this->_db,$this->Origen),
				mysqli_real_escape_string($this->_db,$this->Destino),
				mysqli_real_escape_string($this->_db,$this->Contacto), 
				mysqli_real_escape_string($this->_db,$this->Sueldo), 
				mysqli_real_escape_string($this->_db,$this->Hora), 
				mysqli_real_escape_string($this->_db,$this->HoraR), 
				mysqli_real_escape_string($this->_db,$this->Regreso),
				mysqli_real_escape_string($this->_db,$this->Cantidad), 
				mysqli_real_escape_string($this->_db,$this->FechaCreacion),
				mysqli_real_escape_string($this->_db,$this->Estatus), 
				mysqli_real_escape_string($this->_db,$this->FechaCambio)
					);
					//echo $query2;
			if ($this->_db->query($query2)){
				$this->id2 = mysqli_insert_id($this->_db);
				return true;
			}else{
				return false;
			}
		
	
}

public function saveTt(){
		
	$query2 = sprintf('INSERT INTO  es2 (id, idEmpleado, Fecha, Dia, Entrada, Salida, Tiempo, Retardo,Turno, FechaCreacion) VALUES ("",%d,"%s","%s","%s","%s","%s",%d,%d,"%s")',
			//mysqli_real_escape_string($this->_db,$this->IdDRENC),
			mysqli_real_escape_string($this->_db,$this->idEmpleado), 
			mysqli_real_escape_string($this->_db,$this->Fecha), 
			mysqli_real_escape_string($this->_db,$this->Dia), 
			mysqli_real_escape_string($this->_db,$this->Entrada), 
			mysqli_real_escape_string($this->_db,$this->Salida),
			mysqli_real_escape_string($this->_db,$this->Tiempo),
			mysqli_real_escape_string($this->_db,$this->Retardo), 
			mysqli_real_escape_string($this->_db,$this->Turno), 
			mysqli_real_escape_string($this->_db,$this->FechaCreacion)			
			);
				//echo $query2;
		if ($this->_db->query($query2)){
			$this->id2 = mysqli_insert_id($this->_db);
			return true;
		}else{
			return false;
		}
	

}

	public function editaes2E(){
		    $query3 = sprintf('UPDATE es2 SET
			Entrada= "%s",
			Retardo= %d
			WHERE idEmpleado 	= %d AND Fecha = "%s"',
			mysqli_real_escape_string($this->_db,$this->Entrada),
			mysqli_real_escape_string($this->_db,$this->Retardo),
			mysqli_real_escape_string($this->_db,$this->idEmpleado),
			$this->Fecha);
			return $this->_db->query($query3);
		//echo $query;
			if ($this->_db->query($query3)){
				$this->id = mysqli_insert_id($this->_db);
				return true;
			}else{
				return false;
			}
	}

	public function editaes2S(){
		$query3 = sprintf('UPDATE es2 SET
		Salida= "%s",
		Retardo= %d
		WHERE idEmpleado 	= %d AND Fecha = "%s"',
		mysqli_real_escape_string($this->_db,$this->Salida),
		mysqli_real_escape_string($this->_db,$this->Retardo),
		mysqli_real_escape_string($this->_db,$this->idEmpleado),
		$this->Fecha);
		return $this->_db->query($query3);
	echo $query;
		if ($this->_db->query($query3)){
			$this->id = mysqli_insert_id($this->_db);
			return true;
		}else{
			return false;
		}
}

	public function eliminaIncidencias(){
		$query4 = sprintf('UPDATE incidencias SET
		Estatus= %d
		WHERE id 	= %d',
		mysqli_real_escape_string($this->_db,$this->Estatus),
		$this->idIncidencia);
		return $this->_db->query($query4);
	    //echo $query4;
		if ($this->_db->query($query4)){
			$this->id = mysqli_insert_id($this->_db);
			return true;
		}else{
			return false;
		}
}

public function eliminaESTarjetaT(){
	$query4 = sprintf('DELETE FROM es2 WHERE
	idEmpleado= %d
	AND Fecha = "%s"
	AND Retardo = 1',
	mysqli_real_escape_string($this->_db,$this->idEmpleado),
	$this->FechaIncidencia);
	//echo $query4;
	return $this->_db->query($query4);
	
	if ($this->_db->query($query4)){
		$this->id = mysqli_insert_id($this->_db);
		return true;
	}else{
		return false;
	}
}




		
}
?>