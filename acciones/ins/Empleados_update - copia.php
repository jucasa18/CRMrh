<?php
require_once (realpath($_SERVER["DOCUMENT_ROOT"]) .'/rh/acciones/Modelo.php');

class Empleados_update extends Modelo {
	
    //private $uid; // id
    private $campos; //campos de registro	
	
	//inicializa un objeto
	public function __construct(){
		parent::__construct(); 
		
		$this->uid = null;
		$this->campos = array ( 
	         //  'idPaciente' 	 		=>'',
	           'Id'  						=>'', 
	           'IdUsuario'  				=>'',      
	           'IdDRENC'  	 				=>'',      
	           'IdPlanta'  	 				=>'',      
	           'Depto'  					=>'',      
	           'FechaIngreso'  				=>'',      
	           'Linea'  					=>'',      
	           'Nomina'	 					=>'',
	           'Puesto' 					=>'',
	           'Turno'						=>'',
	           'Foraneo' 	 				=>'',  
			   'ApellidoP' 	 				=>'',  
	           'ApellidoM'       			=>'', 
			   'Nombre' 					=>'',
	           'Nss'						=>'',
	           'Curp' 	 					=>'',  
			   'Rfc' 	 					=>'',  
	           'CPF'       					=>'', 
			   'Fnacimiento' 				=>'',
	           'Sexo'						=>'',
	           'EdoNaci' 	 				=>'',  
			   'CiudadNaci' 	 			=>'',  
	           'Cel'       					=>'', 
			   'Email' 						=>'',
	           'EdoCivil'					=>'',
	           'Hijos' 	 					=>'',  
			   'NumHijos' 				 	=>'',  
	           'Beneficiario'       		=>'', 
			   'Parentesco' 				=>'',
	           'CelBeneficiario'			=>'',
	           'NivEstudios' 	 			=>'',  
			   'MedioDifusion' 	 			=>'',  
	           'Calle'       				=>'', 
			   'Numero' 					=>'',
	           'Colonia'					=>'',
	           'Ciudad' 					=>'',  
			   'Estado' 	 		        =>'',  
	           'CP'       					=>'',
			   'Pais'       				=>'',  
			   'Empresa' 					=>'',
	           'IdRecomendador'				=>'',
	           'NombreRecomendador' 	 	=>'',  
			   'Ruta' 	 					=>'',  
	           'Parada'     				=>'', 
			   'Estatus' 					=>'',
	           'Infonavit'					=>'',
	           'CuentaBBVA' 	 			=>'',  
			   'SueldoMensual'     			=>'', 
			   'SueldoDiario' 				=>'',
			   'SueldoDiarioText' 			=>'',
			   'SDI' 						=>'',
			   'Nacionalidad' 				=>'',
			   'Activo' 					=>'',
			   'Foto' 						=>'',
			   'FotoMov'					=>'',
			   'FechaCreacion'				=>date('Y-m-d'),
			   'ContactoEme' 				=>'',
			   'CelEme' 					=>'',
			   'Banco' 						=>'',
			   'Clabe' 						=>'',
	           'NumTajeta'					=>'',
			   'FechaCambio'				=>date('Y-m-d H:i:s')
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
	

	public function edita(){
		
		
					$query = sprintf('UPDATE empleados SET
						IdPlanta= %d,
						FechaIngreso="%s",
						Depto="%s",
						Linea="%s",
						Nomina="%s",
						Puesto="%s",
						Turno=%d,
						Nombre="%s",
						ApellidoP="%s",
						ApellidoM= "%s",
						Fnacimiento="%s",
						Nss="%s",
						Curp="%s",
						Rfc="%s",
						EdoNaci="%s",
						CiudadNaci="%s",
						Cel=%d,
						Email="%s",
						EdoCivil="%s",
						Hijos="%s",
						NumHijos=%d,
						NivEstudios="%s",
						MedioDifusion="%s",
						Beneficiario="%s",
						Parentesco="%s",
						CelBeneficiario=%d,
						Calle="%s",
						Numero="%s",
						Colonia="%s",
						Ciudad="%s",
						Estado="%s",
						CP=%d,
						IdRecomendador="%s",
						NombreRecomendador="%s",
						Ruta="%s",
						Parada="%s",
						Estatus=%d,
						Infonavit="%s",
						CuentaBBVA="%s",
						SueldoDiario=%d,
						SueldoDiarioText="%s",
						SDI=%d,
						SueldoMensual="%s",
						Foraneo="%s",
						Empresa="%s",
						Sexo="%s",
						Nacionalidad="%s",
						ContactoEme="%s",
						CelEme= %d,
						Banco= "%s",
						Clabe= %d,
						NumTajeta= %d,
						Estatus=%d
						WHERE IdDRENC 	= %d ',
							
						
							mysqli_real_escape_string($this->_db,$this->IdPlanta), 
							mysqli_real_escape_string($this->_db,$this->FechaIngreso), 
							mysqli_real_escape_string($this->_db,$this->Depto),
							mysqli_real_escape_string($this->_db,$this->Linea), 
							mysqli_real_escape_string($this->_db,$this->Nomina), 
							mysqli_real_escape_string($this->_db,$this->Puesto), 
							mysqli_real_escape_string($this->_db,$this->Turno), 
							mysqli_real_escape_string($this->_db,$this->Nombre),
							mysqli_real_escape_string($this->_db,$this->ApellidoP), 
							mysqli_real_escape_string($this->_db,$this->ApellidoM),
							mysqli_real_escape_string($this->_db,$this->Fnacimiento), 
							mysqli_real_escape_string($this->_db,$this->Nss), 
							mysqli_real_escape_string($this->_db,$this->Curp),
							mysqli_real_escape_string($this->_db,$this->Rfc),
							mysqli_real_escape_string($this->_db,$this->EdoNaci), 
							mysqli_real_escape_string($this->_db,$this->CiudadNaci), 
							mysqli_real_escape_string($this->_db,$this->Cel), 
							mysqli_real_escape_string($this->_db,$this->Email), 
							mysqli_real_escape_string($this->_db,$this->EdoCivil), 
							mysqli_real_escape_string($this->_db,$this->Hijos),
							mysqli_real_escape_string($this->_db,$this->NumHijos),
							mysqli_real_escape_string($this->_db,$this->NivEstudios), 
							mysqli_real_escape_string($this->_db,$this->MedioDifusion), 
							mysqli_real_escape_string($this->_db,$this->Beneficiario), 
							mysqli_real_escape_string($this->_db,$this->Parentesco), 
							mysqli_real_escape_string($this->_db,$this->CelBeneficiario), 
							mysqli_real_escape_string($this->_db,$this->Calle), 
							mysqli_real_escape_string($this->_db,$this->Numero), 
							mysqli_real_escape_string($this->_db,$this->Colonia), 
							mysqli_real_escape_string($this->_db,$this->Ciudad),
							mysqli_real_escape_string($this->_db,$this->Estado),
							mysqli_real_escape_string($this->_db,$this->CP), 
							mysqli_real_escape_string($this->_db,$this->IdRecomendador), 
							mysqli_real_escape_string($this->_db,$this->NombreRecomendador), 
							mysqli_real_escape_string($this->_db,$this->Ruta), 
							mysqli_real_escape_string($this->_db,$this->Parada), 
							mysqli_real_escape_string($this->_db,$this->Estatus), 
							mysqli_real_escape_string($this->_db,$this->Infonavit),
							mysqli_real_escape_string($this->_db,$this->CuentaBBVA),
							mysqli_real_escape_string($this->_db,$this->SueldoDiario),
							mysqli_real_escape_string($this->_db,$this->SueldoDiarioText), 
							mysqli_real_escape_string($this->_db,$this->SDI), 
							mysqli_real_escape_string($this->_db,$this->SueldoMensual), 
							mysqli_real_escape_string($this->_db,$this->Foraneo), 
							mysqli_real_escape_string($this->_db,$this->Empresa),	  
							mysqli_real_escape_string($this->_db,$this->Sexo), 
							mysqli_real_escape_string($this->_db,$this->Nacionalidad), 
							mysqli_real_escape_string($this->_db,$this->ContactoEme), 
							mysqli_real_escape_string($this->_db,$this->CelEme), 
							mysqli_real_escape_string($this->_db,$this->Banco), 
							mysqli_real_escape_string($this->_db,$this->Clabe), 
							mysqli_real_escape_string($this->_db,$this->NumTajeta), 
							mysqli_real_escape_string($this->_db,$this->Estatus),
							$this->IdDRENC);
							
			echo $query;		
			exit();
							return $this->_db->query($query);





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
	public function save3(){
			$query2 = sprintf('INSERT INTO histempleados (Id, IdUsuario, IdDRENC, IdPlanta, FechaIngreso, Depto, Linea, Nomina, Puesto, Turno, Foraneo, ApellidoP, ApellidoM, Nombre, Nss, Curp, Rfc, CPF, Fnacimiento, Sexo, EdoNaci, CiudadNaci, Cel, Email, EdoCivil, Hijos, NumHijos, Beneficiario, Parentesco, CelBeneficiario, NivEstudios, MedioDifusion, Calle, Numero, Colonia, Ciudad, Estado, CP, Pais, Empresa, IdRecomendador, NombreRecomendador, Ruta, Parada, Estatus, Infonavit, CuentaBBVA, SueldoMensual, SueldoDiario, SueldoDiarioText, SDI, Nacionalidad, Activo, Foto, FotoMov, FechaCreacion, ContactoEme, CelEme, Banco, Clabe, NumTajeta, FechaCambio)
				VALUES ("",%d, %d,%d,"%s","%s","%s","%s","%s", %d, "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", %d, "%s", "%s", "%s",%d, "%s", "%s",%d, "%s","%s", "%s","%s","%s","%s", "%s",%d, "%s", "%s","%s", "%s", "%s", "%s", %d, "%s", "%s",%d, %d, "%s", %d, "%s",%d, "%s",%d, "%s","%s",%d,"%s",%d,%d,"%s")',
				 		 	 // mysqli_real_escape_string($this->_db,$this->Id),
							  mysqli_real_escape_string($this->_db,$this->IdUsuario),					         
							  mysqli_real_escape_string($this->_db,$this->IdDRENC),
							  mysqli_real_escape_string($this->_db,$this->IdPlanta),
							  mysqli_real_escape_string($this->_db,$this->FechaIngreso), 
							  mysqli_real_escape_string($this->_db,$this->Depto),
							  mysqli_real_escape_string($this->_db,$this->Linea), 
							  mysqli_real_escape_string($this->_db,$this->Nomina), 
							  mysqli_real_escape_string($this->_db,$this->Puesto), 
							  mysqli_real_escape_string($this->_db,$this->Turno), 
							  mysqli_real_escape_string($this->_db,$this->Foraneo), 
							  mysqli_real_escape_string($this->_db,$this->ApellidoP), 
							  mysqli_real_escape_string($this->_db,$this->ApellidoM),
							  mysqli_real_escape_string($this->_db,$this->Nombre), 
							  mysqli_real_escape_string($this->_db,$this->Nss), 
							  mysqli_real_escape_string($this->_db,$this->Curp),
							  mysqli_real_escape_string($this->_db,$this->Rfc),
							  mysqli_real_escape_string($this->_db,$this->CPF), 
							  mysqli_real_escape_string($this->_db,$this->Fnacimiento), 
							  mysqli_real_escape_string($this->_db,$this->Sexo), 
							  mysqli_real_escape_string($this->_db,$this->EdoNaci), 
							  mysqli_real_escape_string($this->_db,$this->CiudadNaci), 
							  mysqli_real_escape_string($this->_db,$this->Cel), 
							  mysqli_real_escape_string($this->_db,$this->Email), 
							  mysqli_real_escape_string($this->_db,$this->EdoCivil), 
							  mysqli_real_escape_string($this->_db,$this->Hijos),
							  mysqli_real_escape_string($this->_db,$this->NumHijos),
							  mysqli_real_escape_string($this->_db,$this->Beneficiario), 
							  mysqli_real_escape_string($this->_db,$this->Parentesco), 
							  mysqli_real_escape_string($this->_db,$this->CelBeneficiario), 
							  mysqli_real_escape_string($this->_db,$this->NivEstudios), 
							  mysqli_real_escape_string($this->_db,$this->MedioDifusion), 
							  mysqli_real_escape_string($this->_db,$this->Calle), 
							  mysqli_real_escape_string($this->_db,$this->Numero), 
							  mysqli_real_escape_string($this->_db,$this->Colonia), 
							  mysqli_real_escape_string($this->_db,$this->Ciudad),
							  mysqli_real_escape_string($this->_db,$this->Estado),
							  mysqli_real_escape_string($this->_db,$this->CP), 
							  mysqli_real_escape_string($this->_db,$this->Pais), 
							  mysqli_real_escape_string($this->_db,$this->Empresa), 
							  mysqli_real_escape_string($this->_db,$this->IdRecomendador), 
							  mysqli_real_escape_string($this->_db,$this->NombreRecomendador), 
							  mysqli_real_escape_string($this->_db,$this->Ruta), 
							  mysqli_real_escape_string($this->_db,$this->Parada), 
							  mysqli_real_escape_string($this->_db,$this->Estatus), 
							  mysqli_real_escape_string($this->_db,$this->Infonavit),
							  mysqli_real_escape_string($this->_db,$this->CuentaBBVA),
							  mysqli_real_escape_string($this->_db,$this->Sexo), 
							  mysqli_real_escape_string($this->_db,$this->SueldoMensual), 
							  mysqli_real_escape_string($this->_db,$this->SueldoDiario),		
							  mysqli_real_escape_string($this->_db,$this->SueldoDiarioText), 
							  mysqli_real_escape_string($this->_db,$this->SDI), 
							  mysqli_real_escape_string($this->_db,$this->Nacionalidad),	  
							  mysqli_real_escape_string($this->_db,$this->Activo), 
							  mysqli_real_escape_string($this->_db,$this->Foto), 
							  mysqli_real_escape_string($this->_db,$this->FotoMov),
							  mysqli_real_escape_string($this->_db,$this->FechaCreacion),
							  mysqli_real_escape_string($this->_db,$this->ContactoEme), 
							  mysqli_real_escape_string($this->_db,$this->CelEme), 
							  mysqli_real_escape_string($this->_db,$this->Banco),	  
							  mysqli_real_escape_string($this->_db,$this->Clabe), 
							  mysqli_real_escape_string($this->_db,$this->NumTajeta), 
							  mysqli_real_escape_string($this->_db,$this->FechaCambio)
							   
					);
					echo $query2;
					
			if ($this->_db->query($query2)){
				$this->id = mysqli_insert_id($this->_db);
				return true;
			}else{
				return false;
			}
		
	}

	public function editaFoto(){
		
		
		$query3 = sprintf('UPDATE empleados SET
			Foto= "%s",
			WHERE IdDRENC 	= %d ',
			 mysqli_real_escape_string($this->_db,$this->Foto), 
			 $this->IdDRENC);


			 echo $query3();
			 exit();
			 return $this->_db->query($query3);




	}
	

		
}
?>