<?php
include('../../auth_session.php');
include_once '../ins/Deducciones_principal.php'; 
include '../ins/Deducciones.php'; 
$td = $_REQUEST['Tipo'];
$tipo = '';
switch ($td) {
   case 1:
      $tipo = 'listaInfonavit.php';
      break;
  case 2:
      $tipo = 'listaFonacot.php';
      break;
  case 3:
		$tipo =  "listaPA.php";
        break;
  case 4:
		$tipo =  "listaConceptos.php";
		break;
}


$empleado = new Deducciones();
$empleado->idEmpleado 			    = $_REQUEST['IdDRENC'];
$empleado->Tipo 		   			= $_REQUEST['Tipo'];
$empleado->Cantidad 			    = $_REQUEST['Cantidad'];
$empleado->DP 			            = $_REQUEST['DP'];
$empleado->Concepto 			    = $_REQUEST['Concepto'];
$empleado->Motivo 			        = $_REQUEST['Motivo'];
$empleado->Fecha 			        = $_REQUEST['Fecha'];
$empleado->IdUsuario				= $_SESSION['id'];
$guradar 							= $empleado->save();
if ($guradar) { 
	$ida = Deducciones::maxDeducciones();
	$idp = $ida['id'];
	//echo $idr;                           
	$empleado->idDeduccion 			    = $idp;
	$guradar2 			    = $empleado->save2();

	
	echo json_encode(array(
		//'all'  => $_POST,
		'tipo' => $tipo ,
		'mensaje' => 'Deduccion agregada correctamente', 
		// 'names' => $names
	));
}

?>