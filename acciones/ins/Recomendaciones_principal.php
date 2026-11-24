<?php
require_once (realpath($_SERVER["DOCUMENT_ROOT"]) .'/rh/acciones/Modelo.php');
class Recomendaciones_principal  extends Modelo {
	
    private $uid; // id
    private $campos; //campos de registro	
	
	//inicializa un objeto
	public function __construct(){
		parent::__construct(); 
		$this->uid = null;
		$this->campos = array ( 
	         //  'idPaciente' 	 		=>'',
			  // 'id'  				=>'', 
			   'idUsuario'          =>'',
			   'idRecomendacion'    =>'', 
	           'idRecomendador'  	=>'', 
			   'idRecomendado'  	=>'',
	           'Estatus'  			=>'',    
			   'FechaIngreso'   	=>'',     
			   'Pagado'   			=>0,  
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
		
		$query = sprintf('INSERT INTO recomendados (id, idRecomendador, idRecomendado, FechaIngreso, Estatus, Pagado, FechaCambio) VALUES ("",%d, %d, "%s", %d, %d, "%s")',
		
		
		//mysqli_real_escape_string($this->_db,$this->IdDRENC),
					mysqli_real_escape_string($this->_db,$this->idRecomendador),
					mysqli_real_escape_string($this->_db,$this->idRecomendado),
					mysqli_real_escape_string($this->_db,$this->FechaIngreso), 
					mysqli_real_escape_string($this->_db,$this->Estatus), 
					mysqli_real_escape_string($this->_db,$this->Pagado), 
				    mysqli_real_escape_string($this->_db,$this->FechaCambio)
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
		$query2 = sprintf('INSERT INTO histrecomendados (id, idUsuario, idRecomendacion, idRecomendador, idRecomendado, Estatus,Pagado, FechaIngreso, FechaCambio) VALUES ("",%d, %d, %d, %d, %d, %d,"%s","%s")',
				//mysqli_real_escape_string($this->_db,$this->IdDRENC),
				    mysqli_real_escape_string($this->_db,$this-> idUsuario), 
				    mysqli_real_escape_string($this->_db,$this-> idRecomendacion), 
					mysqli_real_escape_string($this->_db,$this-> idRecomendador), 
					mysqli_real_escape_string($this->_db,$this-> idRecomendado), 
					mysqli_real_escape_string($this->_db,$this-> Estatus),
					mysqli_real_escape_string($this->_db,$this-> Pagado),
					mysqli_real_escape_string($this->_db,$this-> FechaIngreso), 
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
		$query4 = sprintf('UPDATE recomendados SET
		Estatus= %d
		WHERE id 	= %d ',
		mysqli_real_escape_string($this->_db,$this->Estatus),
		$this->idRecomendacion);
		//echo $query4;
		return $this->_db->query($query4);
	   
		if ($this->_db->query($query4)){
			$this->id = mysqli_insert_id($this->_db);
			return true;
		}else{
			return false;
		}
}

public function pagaRecomendaciones(){
	$query4 = sprintf('UPDATE recomendados SET
	Pagado= %d
	WHERE id 	= %d',
	mysqli_real_escape_string($this->_db,$this->Pagado),
	$this->id);
	//echo $query4;
	return $this->_db->query($query4);
	
	if ($this->_db->query($query4)){
		$this->id = mysqli_insert_id($this->_db);
		return true;
	}else{
		return false;
	}
	


		
	}
	public function quitarNquincenal(){
		$query5 = sprintf('UPDATE empleados SET
		IdRecomendador= %d
		WHERE IdDRENC  	= %d',
		mysqli_real_escape_string($this->_db,$this->idRecomendador),
		$this->id);
		//echo $query5;
		return $this->_db->query($query5);
		
		if ($this->_db->query($query5)){
			$this->id = mysqli_insert_id($this->_db);
			return true;
		}else{
			return false;
		}
		
	
	
			
		}
}
?>