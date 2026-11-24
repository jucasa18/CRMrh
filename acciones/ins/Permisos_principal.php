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
	           'FechaIncidencia'  		=>'',    
			   'Motivo'  		=>'',  
			   'TipoIncidencia'  			=>'', 
	           'Horario'  	 	=>'',      
	           'Otro'  	=>'',      
	           'Origen'  	=>'',    
			   'Destino'  	=>'', 
			   'Contacto'  		=>'', 
	           'Sueldo'  	 		=>'',      
	           'FechaCreacion'  	=>'',      
	           'Estatus'  	=>'', 
			   'FechaCambio'		=>date('Y-m-d H:i:s')
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
		
		$query = sprintf('INSERT INTO  vacaciones(id, idEmpleado, FechaIncidencia, Motivo, TipoIncidencia, Horario, Otro, Origen, Destino, Contacto, Sueldo, FechaCreacion, Estatus) VALUES ("", %d, "%s", "%s", %d, "%s", "%s", "%s", "%s", "%s", %d, "%s", %d)',
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
					mysqli_real_escape_string($this->_db,$this->FechaCreacion), 
					mysqli_real_escape_string($this->_db,$this->Estatus)

					);
				//echo $query;
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
		
		$query2 = sprintf('INSERT INTO  histvacaciones (id, IdUsuario, idIncidencia, idEmpleado, FechaIncidencia, Motivo, TipoIncidencia, Horario, Otro, Origen, Destino, Contacto, Sueldo, FechaCreacion, Estatus, FechaCambio) VALUES ("", %d, %d, %d, "%s", "%s", %d, "%s", "%s", "%s", "%s", "%s", %d, s, %d, "%s")',
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

	/*public function edita(){
		    $query3 = sprintf('UPDATE rutas SET
			nombre= "%s",
			Estatus= %d
			WHERE id 	= %d ',
			mysqli_real_escape_string($this->_db,$this->nombre),
			mysqli_real_escape_string($this->_db,$this->Estatus),
			$this->idRuta);
			return $this->_db->query($query3);
		//echo $query;
			if ($this->_db->query($query3)){
				$this->id = mysqli_insert_id($this->_db);
				return true;
			}else{
				return false;
			}
	}*/

	public function eliminaVacaciones(){
		$query4 = sprintf('UPDATE vacaciones SET
		Estatus= %d
		WHERE id 	= %d',
		mysqli_real_escape_string($this->_db,$this->Estatus),
		$this->idVacaciones);
		return $this->_db->query($query4);
	    //echo $query4;
		if ($this->_db->query($query4)){
			$this->id = mysqli_insert_id($this->_db);
			return true;
		}else{
			return false;
		}
}
	


		
}
?>