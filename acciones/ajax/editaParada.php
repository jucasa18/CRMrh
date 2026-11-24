<?php
	include('../../auth_session.php');
	include_once '../ins/Paradas_principal.php'; 
	$empleado = new Paradas_principal();
	$empleado->idParada		= $_REQUEST['id'];
	$empleado->idRuta 		= $_REQUEST['idruta'];
	//$empleado->idRuta 		= $_REQUEST['idruta'];
	$empleado->nombre 		= $_REQUEST['nombrer'];
	$empleado->Estatus		= $_REQUEST['Estatus'];
	$empleado->idUsuario	= $_SESSION['id'];
	$guradar 				= $empleado->edita();
	if ($guradar) { //guarda el historico
		$guradar2 			= $empleado->save2();
		echo json_encode(array(
			//'all'  => $_POST,
			//'idu' => $id,
			'mensaje' => 'Parada actualizada.', 
			// 'names' => $names
		));
	}
?>