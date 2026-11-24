<?php
require_once (realpath($_SERVER["DOCUMENT_ROOT"]) .'/rh/acciones/Modelo.php');
class Select extends Modelo {
		
	//inicializa un objeto Usuario
	public function __construct(){   
		parent::__construct();
	}
	
	public static function SelectRutas(){
		$_Modul   = new Select();
		$query  = sprintf('SELECT *  FROM rutas');
		echo $query;
		$result = $_Modul->_db->query($query);
		$return =[];
		if ($result->num_rows){
			while( $row = $result->fetch_assoc() ){
				$return []= $row;
			}
			mysqli_free_result($result);
		}

		$_Modul->desconectar();
		return $return;
	}
	public static function SelectParadas($departid){
		$_Modul   = new Select();
		$query  = sprintf('SELECT * FROM paradas WHERE idRuta= %d',    
		$departid );
		echo $query;
		$result = $_Modul->_db->query($query);
		$return =0;
		if ($result->num_rows){
			while( $row = $result->fetch_assoc() ){
				$return = $row;
			}
			mysqli_free_result($result);
		}
		
		$_Modul->desconectar();
		return $return;
	}

}
?>