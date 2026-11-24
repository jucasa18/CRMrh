<?php
include_once 'acciones/ajax/guardarRepo.php'; 
include 'acciones/ins/Empleados.php'; 
$NumQuincena=$_REQUEST["numq"];
$fin=$_REQUEST["fin"];
$ffn=$_REQUEST["ffn"];
$sem = $_REQUEST["sem"];
$arrayEx=$_REQUEST["arrayEx"];
$arrayNo=$_REQUEST["arrayNo"];
$arrayRe=$_REQUEST["rec"];
$nquin=$_REQUEST["nquin"];
$arrayexcel= json_decode($arrayEx, true);        
$arraynoi= json_decode($arrayNo, true);      
$arrayRec= json_decode($arrayRe, true); 
$arrayNquin= json_decode($nquin, true);
/*echo $sem;
print_r($arrayNquin);*/
$inserta = insertNOIExcel($arrayNquin,$arrayRec, $arraynoi, $arrayexcel, $NumQuincena,$fin, $ffn, $sem);
echo json_encode(array(
	/*'all'  => $_POST,
	'idu' => $NumQuincena,
	'ex' => $arrayEx,
	'no' => $arrayNo,*/
	//'no' => $arrayNquin,
	'mensaje' => 'Nómina  Aprobada', 
	// 'names' => $names
));


function insertNOIExcel($arrayNquin, $arrayrec, $arraynoi, $arrayexcel,$NumQuincena,$fin, $ffn, $sem){ 
	foreach($arraynoi as $number => $bike)			{			
			foreach($bike as $num => $value)
			{
				//echo  "Index n ".$num." of  n".$number." indexed array contains n" .$value['iddrenc']. "-".$value['monto']."<br>";
				$inserta =  guardaNoi($value['iddrenc'], $NumQuincena, $value['id'], $value['pd'], $value['npd'], $value['nc'], $value['aplicadestajo'], $value['aplicacion'], $fin, $ffn, $value['monto'],$value['tipoNomina']);
			}
	}
	
			
	foreach($arrayexcel as $num => $value)			{
			//	echo  "Index ".$num." indexed array contains " .$value['IdDRENC']. "-".$NumQuincena."<br>";
			if($sem == 0){
				$inserta =  guardaPN(  $value['IdDRENC'], $NumQuincena, $value['FechaInicio'], $value['FechaFin'], $value['dt'], $value['v'], $value['f'], $value['p'], $value['i'], $value['h'], $value['bqna'], $value['ba'], $value['dn'], $value['td'], $value['vac'], $value['pv'], $value['desp'], $value['fh'], $value['pd'], $value['df'], $value['he'], $value['g'], $value['d'], $value['tp'], $value['tpd'], $value['salDiario'], $value['IdUsuario'],$value['tipoNomina']);
			}elseif($sem == 8){
				$inserta =  guardaPNS( $value['IdDRENC'], $NumQuincena, $value['FechaInicio'], $value['FechaFin'], $value['dt'], $value['faltas'], $value['permisos'], $value['incapacidades'], $value['horas'], $value['vacaciones'], $value['primavac'], $value['fondodeahorro'], $value['pridom'], $value['diafestivo'], $value['deducciones'], $value['tp'], $value['tpd'], $value['sueldoxdia'], $value['IdUsuario'], $value['tipoNomina'], $value['retardos'], $value['hdobles'], $value['htriples'], $value['septimodia'],$value['bonoxarea']  ,$value['bonopuntualidad'],$value['bonoapoyo'],$value['bonodiario'],$value['cuotas'],$value['bsenlrge'],$value['bonoanti']);
			}
	}

	if(isset($arrayrec)){
		foreach($arrayrec as $num => $value){			
			if(isset($value['idRecomendador'])){
						$recomendados = Empleados::buacaRecomendados($value['idRecomendador']);
						foreach ($recomendados as $a_ => $infoRec) {       
							$inserta =  pagoRecomendacion($infoRec['id']);
						}
				}
		}
	}	

	if(isset($arrayNquin)){
		foreach($arrayNquin as $num => $value){			
			$inserta =  quitaNquincenal($value['idDrenc']);
		}
		return $inserta;
	}





		return $inserta;
	
}	



?>

