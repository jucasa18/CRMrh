<?php
require_once (realpath($_SERVER["DOCUMENT_ROOT"]) .'/rh/acciones/Modelo.php');
class Deducciones_principal  extends Modelo {
	
    private $uid; // id
    private $campos; //campos de registro	
	
	//inicializa un objeto
	public function __construct(){
		parent::__construct(); 
		$this->uid = null;
		$this->campos = array ( 
	         //  'idPaciente' 	 		=>'',
			  // 'id'  				=>'',   
	           'idEmpleado'  		=>'', 
			   'idDeduccion'  			=>'',
	           'Tipo'  	 	=>'',      
	           'Cantidad'  	 	=>'',    
			   'DP'  	 	=>'',  
			   'Concepto'  	 	=>'',    
			   'Motivo'  	 	=>'',  
	           'FechaCreacion'  	=>date('Y-m-d H:i:s'),     
			   'IdUsuario'  			=>'',  
			   'Fecha'  	 		=>'',   
			   'Status'  			=>1,  
			   'FechaModificacion'  	=>date('Y-m-d H:i:s')
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
		
		$query = sprintf('INSERT INTO  deducciones (id, idEmpleado, Tipo, Cantidad, DP, Concepto, Motivo, Fecha, Status,  FechaCreacion) VALUES ("", %d, %d,"%s","%s","%s","%s", "%s", %d, "%s")',
					mysqli_real_escape_string($this->_db,$this->idEmpleado), 
				    mysqli_real_escape_string($this->_db,$this->Tipo),
					mysqli_real_escape_string($this->_db,$this->Cantidad),
					mysqli_real_escape_string($this->_db,$this->DP),
					mysqli_real_escape_string($this->_db,$this->Concepto),
					mysqli_real_escape_string($this->_db,$this->Motivo),
					mysqli_real_escape_string($this->_db,$this->Fecha),
					mysqli_real_escape_string($this->_db,$this->Status),
					mysqli_real_escape_string($this->_db,$this->FechaCreacion)			

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
		
		$query2 = sprintf('INSERT INTO histdeducciones (id, idEmpleado, idDeduccion,Tipo, Cantidad, DP, Concepto, Motivo, FechaCreacion, IdUsuario, Fecha, Status, FechaModificacion) VALUES ("",%d, %d, %d,"%s","%s","%s","%s","%s","%s", %d, %d,"%s")',
				//mysqli_real_escape_string($this->_db,$this->IdDRENC),
				mysqli_real_escape_string($this->_db,$this->idEmpleado), 
				mysqli_real_escape_string($this->_db,$this->idDeduccion), 
				mysqli_real_escape_string($this->_db,$this->Tipo), 
				mysqli_real_escape_string($this->_db,$this->Cantidad), 
				mysqli_real_escape_string($this->_db,$this->DP),
				mysqli_real_escape_string($this->_db,$this->Concepto),
				mysqli_real_escape_string($this->_db,$this->Motivo),
				mysqli_real_escape_string($this->_db,$this->FechaCreacion), 
				mysqli_real_escape_string($this->_db,$this->IdUsuario),
				mysqli_real_escape_string($this->_db,$this->Fecha),
				mysqli_real_escape_string($this->_db,$this->Status),
				mysqli_real_escape_string($this->_db,$this->FechaModificacion)
					);
					//echo $query2;
			if ($this->_db->query($query2)){
				$this->id2 = mysqli_insert_id($this->_db);
				return true;
			}else{
				return false;
			}
		
	
}
	public function editaDeduccion(){
		    $query3 = sprintf('UPDATE deducciones SET
			Tipo= %d,
			Cantidad= "%s"
			WHERE id = %d',
			mysqli_real_escape_string($this->_db,$this->Tipo),
			mysqli_real_escape_string($this->_db,$this->Cantidad),
			$this->id);
			return $this->_db->query($query3);
		//echo $query;
			if ($this->_db->query($query3)){
				$this->id = mysqli_insert_id($this->_db);
				return true;
			}else{
				return false;
			}
	}

	public function eliminaIncidencias(){
		$query4 = sprintf('UPDATE deducciones SET
		Status= %d
		WHERE id 	= %d',
		mysqli_real_escape_string($this->_db,$this->Status),
		$this->id);
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