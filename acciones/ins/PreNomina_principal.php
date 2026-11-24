<?php
require_once (realpath($_SERVER["DOCUMENT_ROOT"]) .'/rh/acciones/Modelo.php');
class PreNomina_principal  extends Modelo {
	
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
	           'FechaInicio'  	 	=>'',      
	           'FechaFin'  	 		=>'',      
	           'dt'  				=>'',      
	           'v'  				=>'',      
	           'f'  				=>'',      
	           'p'	 				=>'',
	           'i' 					=>'',
	           'h'					=>'',
	           'bqna' 	 			=>'',  
			   'ba' 	 			=>'',  
	           'dn'       			=>'', 
			   'td' 				=>'',
	           'vac'				=>'',
	           'pv' 	 			=>'',  
			   'desp' 	 			=>'',  
	           'fh'       			=>'', 
			   'pd' 				=>'',
	           'df'					=>'',
	           'he' 	 			=>'',  
			   'g' 	 				=>'',  
	           'd'       			=>'', 
	           'tp'					=>'',
	           'tpd' 	 			=>'',  
			   'salDiario' 			=>'',  
			   'Retardos' 			=>'', 
			   'Hdobles' 			=>'', 
			   'Htriples' 			=>'', 
			   'Septimodia' 		=>'', 
			   'BonoxArea' 			=>'', 
			   'BonoPuntualidad' 	=>'', 
			   'BonoApoyo' 			=>'', 
			   'BonoDiario' 		=>'', 
			   'CuotaS' 			=>'', 
			   'BsenLrge' 			=>'', 
			   'BonoASnti' 			=>'', 
	           'IdUsuario'       	=>'', 
			   'FechaCreacion' 		=>date('Y-m-d H:i:s')
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
		$query = sprintf('INSERT INTO prenomina(Id, TipoNomina, IdDRENC, NumQuincena, FechaInicio, FechaFin, dt, v, f, p, i, h, bqna, ba, dn, td, vac, pv, desp, fh, pd, df, he, g, d, tp, tpd, salDiario, Retardos, Hdobles, Htriples, Septimodia, BonoxArea, BonoPuntualidad, BonoApoyo, BonoDiario, CuotaS, BsenLrge, BonoASnti, IdUsuario, FechaCreacion) 
				VALUES ("",%d,%d,%d,"%s","%s",%d,%d,%d,%d,%d,"%s","%s","%s",%d,"%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s", %d, "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", %d,"%s")',
				 	//mysqli_real_escape_string($this->_db,$this->IdDRENC),
					mysqli_real_escape_string($this->_db,$this->TipoNomina), 
					mysqli_real_escape_string($this->_db,$this->IdDRENC),					
					mysqli_real_escape_string($this->_db,$this->NumQuincena), 
					mysqli_real_escape_string($this->_db,$this->FechaInicio),
				    mysqli_real_escape_string($this->_db,$this->FechaFin), 
				    mysqli_real_escape_string($this->_db,$this->dt), 
				    mysqli_real_escape_string($this->_db,$this->v), 
				    mysqli_real_escape_string($this->_db,$this->f), 
				    mysqli_real_escape_string($this->_db,$this->p), 
				    mysqli_real_escape_string($this->_db,$this->i), 
				    mysqli_real_escape_string($this->_db,$this->h),
				    mysqli_real_escape_string($this->_db,$this->bqna), 
					mysqli_real_escape_string($this->_db,$this->ba), 
					mysqli_real_escape_string($this->_db,$this->dn),
					mysqli_real_escape_string($this->_db,$this->td),
				    mysqli_real_escape_string($this->_db,$this->vac), 
				    mysqli_real_escape_string($this->_db,$this->pv), 
				    mysqli_real_escape_string($this->_db,$this->desp), 
				    mysqli_real_escape_string($this->_db,$this->fh), 
				    mysqli_real_escape_string($this->_db,$this->pd), 
				    mysqli_real_escape_string($this->_db,$this->df), 
				    mysqli_real_escape_string($this->_db,$this->he), 
				    mysqli_real_escape_string($this->_db,$this->g), 
					mysqli_real_escape_string($this->_db,$this->d),
					mysqli_real_escape_string($this->_db,$this->tp),
				    mysqli_real_escape_string($this->_db,$this->tpd), 
				    mysqli_real_escape_string($this->_db,$this->salDiario), 
					mysqli_real_escape_string($this->_db,$this->Retardos), 
					mysqli_real_escape_string($this->_db,$this->Hdobles), 
					mysqli_real_escape_string($this->_db,$this->Htriples), 
					mysqli_real_escape_string($this->_db,$this->Septimodia), 
					mysqli_real_escape_string($this->_db,$this->BonoxArea), 
					mysqli_real_escape_string($this->_db,$this->BonoPuntualidad), 
					mysqli_real_escape_string($this->_db,$this->BonoApoyo), 
					mysqli_real_escape_string($this->_db,$this->BonoDiario), 
					mysqli_real_escape_string($this->_db,$this->CuotaS), 
					mysqli_real_escape_string($this->_db,$this->BsenLrge), 
					mysqli_real_escape_string($this->_db,$this->BonoASnti), 
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