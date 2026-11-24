<?php
require_once (realpath($_SERVER["DOCUMENT_ROOT"]) .'/rh/acciones/Modelo.php');
class FNoi_principal  extends Modelo {
	
    private $uid; // id
    private $campos; //campos de registro	
	
	//inicializa un objeto
	public function __construct(){
		parent::__construct(); 
		
		$this->uid = null;
		$this->campos = array ( 
	         //  'idPaciente' 	 		=>'',
	           'Id'  				=>'', 
			   'TipoNomina'  		=>'', 
	           'IdDRENC'  			=>'',  
			   'NumQuincena'		=>'',    
	           'IdCorto'  	 		=>'',      
	           'pd'  	 			=>'',      
	           'npd'  				=>'',      
	           'nc'  				=>'',      
	           'AplicaDestajo'  	=>'',      
	           'Aplicacion'	 		=>'',
	           'fi' 				=>'',
	           'ff'					=>'',
	           'Monto' 	 			=>'',  
			   'IdUsuario' 	 		=>'',  
	           'FechaCreacion'  	=>date('Y-m-d H:i:s')
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
		$query = sprintf('INSERT INTO fnoi(Id, TipoNomina, IdDRENC, NumQuincena, IdCorto, pd, npd, nc, AplicaDestajo, Aplicacion, fi, ff, Monto, IdUsuario, FechaCreacion)
				VALUES ("",%d,%d,%d,%d,"%s",%d,%d,"%s",%d,"%s","%s","%s",%d,"%s")',
				 	//mysqli_real_escape_string($this->_db,$this->IdDRENC),
					 mysqli_real_escape_string($this->_db,$this->TipoNomina),
					mysqli_real_escape_string($this->_db,$this->IdDRENC),
					mysqli_real_escape_string($this->_db,$this->NumQuincena), 
					mysqli_real_escape_string($this->_db,$this->IdCorto),
				    mysqli_real_escape_string($this->_db,$this->pd), 
				    mysqli_real_escape_string($this->_db,$this->npd), 
				    mysqli_real_escape_string($this->_db,$this->nc), 
				    mysqli_real_escape_string($this->_db,$this->AplicaDestajo), 
				    mysqli_real_escape_string($this->_db,$this->Aplicacion), 
				    mysqli_real_escape_string($this->_db,$this->fi), 
				    mysqli_real_escape_string($this->_db,$this->ff),
				    mysqli_real_escape_string($this->_db,$this->Monto), 
					mysqli_real_escape_string($this->_db,$this->IdUsuario), 
					mysqli_real_escape_string($this->_db,$this->FechaCreacion)
					);
				//echo $query;
			if ($this->_db->query($query)){
				$this->id = mysqli_insert_id($this->_db);
				$idr = $this->id;
				return $idr;
			}else{
				return false;
			}
	}
}
?>