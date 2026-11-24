<?php
include('../../auth_session.php');
include_once '../ins/Recomendaciones_principal.php'; 
include '../ins/Recomendaciones.php'; 
$empleado = new Recomendaciones_principal();
//empleado->idRecomendacion 			    = $_REQUEST['idruta'];
$empleado->idRecomendador 			    = $_REQUEST['idrenc'];
$empleado->idRecomendado 			    = $_REQUEST['idnuevo'];
$empleado->Estatus			   			= 1;
$empleado->Pagado			   			= 0;
$empleado->FechaIngreso 			    = $_REQUEST['fingreso'];
$empleado->idUsuario			= $_SESSION['id'];
$guradar 					= $empleado->save();
if ($guradar) { 
	$ida = Recomendaciones::maxIdRecomendados();
	$idp = $ida['id'];
	//echo $idr;
	$empleado->idRecomendacion 			    = $idp;
	$guradar2 			    = $empleado->save2();
	echo json_encode(array(
		//'all'  => $_POST,
		//'idu' => $id,
		'mensaje' => 'Recomendacion agregada.', 
		// 'names' => $names
	));
}

 ?>