<?php
	include('../../auth_session.php');
	include_once '../ins/Paradas_principal.php'; 
	$empleado = new Paradas_principal();
	$empleado->idParada 	= $_REQUEST['idParada'];
	$empleado->Eliminar		= 1;
	$empleado->idUsuario	= $_SESSION['id'];
	$guradar 				= $empleado->eliminaParada();
	if ($guradar) { 
		$guradar2 			= $empleado->save2();
		echo json_encode(array(
			//'all'  => $_POST,
			//'idu' => $id,
			'mensaje' => 'Parada eliminada.', 
			// 'names' => $names
		));
	}
?>