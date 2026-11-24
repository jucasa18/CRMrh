<?php
include('../../auth_session.php');
include_once '../ins/Vacaciones_principal.php'; 
include '../ins/vacaciones.php'; 
include '../funciones/vacaciones.php'; 
if ($_REQUEST['TipoVacacion'] == 3 ){
	$total = 0;
	$TototalaPagarxd = 0;
	$PrimaVacacionalxd =0;
	$diashabiles = getDiasxrango($_REQUEST['FechaInicio'], $_REQUEST['FechaFin'], []); //se ponen descansos y/o días festivos (dias feriados)
}else{
	$total = $_REQUEST['TipoVacacion'] ;
	$TototalaPagarxd = $_REQUEST['TototalaPagarxd'];
	$PrimaVacacionalxd 		  			= $_REQUEST['PrimaVacacionalxd'];
	$diashabiles = getDiasHabilesxrango($_REQUEST['FechaInicio'], $_REQUEST['FechaFin'], []); //se ponen descansos y/o días festivos (dias feriados)
}

$empleado = new Vacaciones_principal();
$empleado->idEmpleado 			    = $_REQUEST['IdDRENC'];
$empleado->TipoVacacion 		    = $_REQUEST['TipoVacacion'];
$empleado->FechaInicio 			    = $_REQUEST['FechaInicio'];
$empleado->FechaFin 			    = $_REQUEST['FechaFin'];
$empleado->FormaPago 			    = $_REQUEST['FormaPago'];
$empleado->DiasDisfrutados 			= $_REQUEST['DiasDisfrutados'];
$empleado->TotalVacaciones 			= $_REQUEST['TotalVacaciones'];
$empleado->DiasDisponibles 			= $_REQUEST['DiasDisponibles'];
$empleado->DiasPedidos 			    = $_REQUEST['DiasPedidos'];
$empleado->SubTotal 			    = $_REQUEST['SubTotal'];
$empleado->PrimaVacacional 			= $_REQUEST['PrimaVacacional'];
$empleado->Riesgo 		  			= $_REQUEST['Riesgo'];
$empleado->DiasIncapacidad 			= $_REQUEST['DiasIncapacidad'];
$empleado->TototalaPagar 			= $_REQUEST['TototalaPagar'];
$empleado->Estatus			= 1;
$empleado->IdUsuario			= $_SESSION['id'];
$guradar 					= $empleado->save();

if ($guradar) { 
	$ida = Vacaciones::maxIdVacaciones();
	$idp = $ida['id'];
	//echo $idr;
	$empleado->idVacaciones 			    = $idp;
	$guradar2 			    = $empleado->save2();
	//$diashabiles = getDiasHabilesxrango($_REQUEST['FechaInicio'], $_REQUEST['FechaFin'], []); //se ponen descansos y/o días festivos (dias feriados)
	$numDias = count($diashabiles);
	for($i = 0; $i < $numDias; $i++) {
		$quincena = getSemana($diashabiles[$i]);
		$empleado->Dia 		  		= $diashabiles[$i];
		$empleado->NumQS 		  		= $quincena;		
		$empleado->SubTotalxd 			= $_REQUEST['SubTotalxd'];
		$empleado->PrimaVacacionalxd 		  			= $PrimaVacacionalxd;
		$empleado->TototalaPagarxd 			= $TototalaPagarxd;
		//echo $diashabiles[$i] ." - ".$quincena."</br>";    
		$guradar3 			    = $empleado->saveDetVac();
	}
	echo json_encode(array(
		//'all'  => $_POST,
		//'idu' => $id,
		'mensaje' => 'Vacaciones agregadas correctamente', 
	));
}
 ?>