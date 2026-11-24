<?php
require_once (realpath($_SERVER["DOCUMENT_ROOT"]) .'/rh/acciones/Modelo.php');
class Users_principal  extends Modelo {
	
    private $uid; // id
    private $campos; //campos de registro	
	
	//inicializa un objeto
	public function __construct(){
		parent::__construct(); 
		$this->uid = null;
		$this->campos = array ( 
	         //  'idPaciente' 	 		=>'',
			 //  'id'  				=>'', 
			   'name'        		=>'',
			   'email'   			=>'', 
	           'pass'  				=>'', 
			   'is_active'  		=>'',
	           'created_at'  		=>date('Y-m-d H:i:s'),   
			   'planta'   			=>'',   
			   'tipo'   			=>'',   
			   'numEmpleado'   		=>'',  
			   'IdNusuario'   		=>'', 		
			   'IdUsuario'   		=>'', 			   
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
		
		$query = sprintf('INSERT INTO user(id, name, email, pass, is_active, created_at, planta, tipo, numEmpleado) VALUES ("", "%s", "%s", "%s", %d , "%s", %d, %d, %d)',
		
		
		//mysqli_real_escape_string($this->_db,$this->IdDRENC),
					mysqli_real_escape_string($this->_db,$this->name),
					mysqli_real_escape_string($this->_db,$this->email),
					mysqli_real_escape_string($this->_db,$this->pass), 
					mysqli_real_escape_string($this->_db,$this->is_active), 
					mysqli_real_escape_string($this->_db,$this->created_at), 
					mysqli_real_escape_string($this->_db,$this->planta), 
					mysqli_real_escape_string($this->_db,$this->tipo), 
					mysqli_real_escape_string($this->_db,$this->numEmpleado)
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
		$query2 = sprintf('INSERT INTO histuser (id, IdUsuario, IdNusuario, name, email, pass, is_active, created_at, planta, tipo, numEmpleado, FechaCambio) VALUES("", %d, %d, "%s", "%s", "%s", %d, "%s", %d, %d, %d, "%s")',
					//mysqli_real_escape_string($this->_db,$this->IdDRENC),
				    mysqli_real_escape_string($this->_db,$this-> IdUsuario), 
				    mysqli_real_escape_string($this->_db,$this-> IdNusuario), 
					mysqli_real_escape_string($this->_db,$this-> name), 
					mysqli_real_escape_string($this->_db,$this-> email), 
					mysqli_real_escape_string($this->_db,$this-> pass),
					mysqli_real_escape_string($this->_db,$this-> is_active), 
					mysqli_real_escape_string($this->_db,$this-> created_at), 
					mysqli_real_escape_string($this->_db,$this-> planta), 
					mysqli_real_escape_string($this->_db,$this-> tipo), 
					mysqli_real_escape_string($this->_db,$this-> numEmpleado), 
					mysqli_real_escape_string($this->_db,$this-> FechaCambio)
					);
				//echo $query2;
			if ($this->_db->query($query2)){
				$this->id2 = mysqli_insert_id($this->_db);
				return true;
			}else{
				return false;
			}
		
	}
/*
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
	}*/

	public function eliminaRecomendacion(){
		$query4 = sprintf('UPDATE user SET
		is_active= %d
		WHERE id 	= %d ',
		mysqli_real_escape_string($this->_db,$this->Estatus),
		$this->idRecomendacion);
		return $this->_db->query($query4);
	   // echo $query4;
		if ($this->_db->query($query4)){
			$this->id = mysqli_insert_id($this->_db);
			return true;
		}else{
			return false;
		}
}
	


		
}
?>