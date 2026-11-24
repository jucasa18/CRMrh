<?php
require_once (realpath($_SERVER["DOCUMENT_ROOT"]) .'/rh/acciones/Modelo.php');
class Vacaciones_principal  extends Modelo {
	
    private $uid; // id
    private $campos; //campos de registro	
	
	//inicializa un objeto
	public function __construct(){
		parent::__construct(); 
		$this->uid = null;
		$this->campos = array ( 
	         //  'idPaciente' 	 		=>'',
			   'id'  				=>'',   
	           'idEmpleado'  		=>'', 
	           'idVacaciones'  	 	=>'',      
	           'IdUsuario'  	 	=>'',      
	           'TipoVacacion'  		=>'',    
			   'FechaInicio'  		=>'',  
			   'FechaFin'  			=>'', 
	           'FormaPago'  	 	=>'',      
	           'DiasDisfrutados'  	=>'',      
	           'TotalVacaciones'  	=>'',    
			   'DiasDisponibles'  	=>'', 
			   'DiasPedidos'  		=>'', 
	           'SubTotal'  	 		=>'',      
			   'SubTotalxd'  	 	=>'',  
	           'PrimaVacacional'  	=>'',  
			   'PrimaVacacionalxd'  =>'',      
	           'TototalaPagar'  	=>'', 
			   'TototalaPagarxd'  	=>'', 
			   'Riesgo'		  	    =>'',  
			   'DiasIncapacidad'	=>'', 
			   'Estatus'		  	=>'',    
			   'Dia'		  		=>date('Y-m-d'),  
			   'NumQS'		  		=>'',  
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
		
		$query = sprintf('INSERT INTO  vacaciones(id, idEmpleado, TipoVacacion, FechaInicio, FechaFin, FormaPago, DiasDisfrutados, TotalVacaciones, DiasDisponibles, DiasPedidos, SubTotal, PrimaVacacional, TototalaPagar, Riesgo, DiasIncapacidad, Estatus, FechaCreacion) VALUES ("", %d, %d, "%s", "%s", %d, %d, %d, %d, %d, "%s", "%s", "%s", %d, %d, %d,"%s")',
		
		
		//mysqli_real_escape_string($this->_db,$this->IdDRENC),
					mysqli_real_escape_string($this->_db,$this->idEmpleado), 
					mysqli_real_escape_string($this->_db,$this->TipoVacacion), 
				    mysqli_real_escape_string($this->_db,$this->FechaInicio),
					mysqli_real_escape_string($this->_db,$this->FechaFin),
					mysqli_real_escape_string($this->_db,$this->FormaPago), 
					mysqli_real_escape_string($this->_db,$this->DiasDisfrutados), 
				    mysqli_real_escape_string($this->_db,$this->TotalVacaciones),
					mysqli_real_escape_string($this->_db,$this->DiasDisponibles),
					mysqli_real_escape_string($this->_db,$this->DiasPedidos), 
					mysqli_real_escape_string($this->_db,$this->SubTotal), 
					mysqli_real_escape_string($this->_db,$this->PrimaVacacional),
					mysqli_real_escape_string($this->_db,$this->TototalaPagar), 
					mysqli_real_escape_string($this->_db,$this->Riesgo), 
					mysqli_real_escape_string($this->_db,$this->DiasIncapacidad),
					mysqli_real_escape_string($this->_db,$this->Estatus), 
					mysqli_real_escape_string($this->_db,$this->FechaCreacion)
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
		
		$query2 = sprintf('INSERT INTO  histvacaciones(id, idEmpleado, idVacaciones, IdUsuario, TipoVacacion, FechaInicio, FechaFin, FormaPago, DiasDisfrutados, TotalVacaciones, DiasDisponibles, DiasPedidos, SubTotal, PrimaVacacional, TototalaPagar, Riesgo, DiasIncapacidad, Estatus, FechaCreacion, FechaCambio) VALUES ("", %d, %d, %d, %d, "%s", "%s", %d, %d, %d, %d, %d, %d, %d, %d, %d, %d, %d,"%s", "%s")',
				//mysqli_real_escape_string($this->_db,$this->IdDRENC),
				mysqli_real_escape_string($this->_db,$this->idEmpleado), 
				mysqli_real_escape_string($this->_db,$this->idVacaciones), 
				mysqli_real_escape_string($this->_db,$this->IdUsuario), 
				mysqli_real_escape_string($this->_db,$this->TipoVacacion), 
				mysqli_real_escape_string($this->_db,$this->FechaInicio),
				mysqli_real_escape_string($this->_db,$this->FechaFin),
				mysqli_real_escape_string($this->_db,$this->FormaPago), 
				mysqli_real_escape_string($this->_db,$this->DiasDisfrutados), 
				mysqli_real_escape_string($this->_db,$this->TotalVacaciones),
				mysqli_real_escape_string($this->_db,$this->DiasDisponibles),
				mysqli_real_escape_string($this->_db,$this->DiasPedidos), 
				mysqli_real_escape_string($this->_db,$this->SubTotal), 
				mysqli_real_escape_string($this->_db,$this->PrimaVacacional),
				mysqli_real_escape_string($this->_db,$this->TototalaPagar), 
				mysqli_real_escape_string($this->_db,$this->Riesgo),
				mysqli_real_escape_string($this->_db,$this->DiasIncapacidad),
				mysqli_real_escape_string($this->_db,$this->Estatus), 
				mysqli_real_escape_string($this->_db,$this->FechaCreacion), 
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
public function saveDetVac(){
		
	$query = sprintf('INSERT INTO  detvacaciones (id, idEmpleado, idVacaciones, Dia, NumQS, FechaCreacion, SubTotal, PrimaVacacional, TototalaPagar, TipoVacacion)  VALUES ("",%d,%d,"%s",%d,"%s","%s","%s","%s",%d)',
	
	
	//mysqli_real_escape_string($this->_db,$this->IdDRENC),
				mysqli_real_escape_string($this->_db,$this->idEmpleado), 
				mysqli_real_escape_string($this->_db,$this->idVacaciones), 
				mysqli_real_escape_string($this->_db,$this->Dia),
				mysqli_real_escape_string($this->_db,$this->NumQS),
				mysqli_real_escape_string($this->_db,$this->FechaCreacion), 
				mysqli_real_escape_string($this->_db,$this->SubTotalxd), 
				mysqli_real_escape_string($this->_db,$this->PrimaVacacionalxd),
				mysqli_real_escape_string($this->_db,$this->TototalaPagarxd),
				mysqli_real_escape_string($this->_db,$this->TipoVacacion)
				
				);
			//echo $query;
		if ($this->_db->query($query)){
			$this->id = mysqli_insert_id($this->_db);
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
			
			
			false;
		}
}
	


		
}
?>