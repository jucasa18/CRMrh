<?php
require_once (realpath($_SERVER["DOCUMENT_ROOT"]) .'/rh/acciones/Modelo.php');
class Paradas_principal  extends Modelo {
	
    private $uid; // id
    private $campos; //campos de registro	
	
	//inicializa un objeto
	public function __construct(){
		parent::__construct(); 
		$this->uid = null;
		$this->campos = array ( 
	         //  'idPaciente' 	 		=>'',
			   'id'  				=>'', 
	           'idRuta'  			=>'', 
			   'idParada'  			=>'',
	           'idUsuario'  	 	=>'',      
	           'nombre'  	 		=>'',      
	           'Estatus'  			=>'',    
			   'Eliminar'  			=>0,   
	           'FechaCreacion'  	=>date('Y-m-d H:i:s'),     
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
		
		$query = sprintf('INSERT INTO paradas (id, idRuta, nombre, Estatus, Eliminar, FechaCreacion) VALUES ("",%d,"%s",%d,%d,"%s")',
		
		
		//mysqli_real_escape_string($this->_db,$this->IdDRENC),
					mysqli_real_escape_string($this->_db,$this->idRuta),
					mysqli_real_escape_string($this->_db,$this->nombre),
					mysqli_real_escape_string($this->_db,$this->Estatus), 
					mysqli_real_escape_string($this->_db,$this->Eliminar), 
				    mysqli_real_escape_string($this->_db,$this->FechaCreacion)
					);
				echo $query;
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
		$query2 = sprintf('INSERT INTO histparadas (id, idParada, idRuta, idUsuario, nombre, Estatus, Eliminar, FechaCambio) VALUES ("",%d,%d,%d,"%s",%d,%d,"%s")',
				//mysqli_real_escape_string($this->_db,$this->IdDRENC),
				    mysqli_real_escape_string($this->_db,$this-> idParada), 
					mysqli_real_escape_string($this->_db,$this-> idRuta), 
					mysqli_real_escape_string($this->_db,$this-> idUsuario), 
					mysqli_real_escape_string($this->_db,$this-> nombre),
					mysqli_real_escape_string($this->_db,$this-> Estatus), 
					mysqli_real_escape_string($this->_db,$this-> Eliminar), 
				    mysqli_real_escape_string($this->_db,$this-> FechaCambio)
					);
				//	echo $query2;
			if ($this->_db->query($query2)){
				$this->id2 = mysqli_insert_id($this->_db);
				return true;
			}else{
				return false;
			}
		
	}

	public function edita(){
		    $query3 = sprintf('UPDATE paradas SET
			nombre= "%s",
			Estatus= %d
			WHERE id 	= %d ',
			mysqli_real_escape_string($this->_db,$this->nombre),
			mysqli_real_escape_string($this->_db,$this->Estatus),
			$this->idParada);
			return $this->_db->query($query3);
		//echo $query3;
			if ($this->_db->query($query3)){
				$this->id = mysqli_insert_id($this->_db);
				return true;
			}else{
				return false;
			}
	}

	public function eliminaParada(){
		$query4 = sprintf('UPDATE paradas SET
		Eliminar= %d
		WHERE id 	= %d ',
		mysqli_real_escape_string($this->_db,$this->Eliminar),
		$this->idParada);
		return $this->_db->query($query4);
	  //  echo $query4;
		if ($this->_db->query($query4)){
			$this->id = mysqli_insert_id($this->_db);
			return true;
		}else{
			return false;
		}
}
	


		
}
?>