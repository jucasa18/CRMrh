<?php
	include('../../auth_session.php');
	include_once '../ins/Rutas_principal.php'; 
	$empleado = new Rutas_principal();
	$empleado->idRuta 		= $_REQUEST['id'];
	$empleado->nombre 		= $_REQUEST['nombrer'];
	$empleado->Estatus		= $_REQUEST['Estatus'];
	$empleado->idUsuario	= $_SESSION['id'];
	$guradar 				= $empleado->edita();
	if ($guradar) { 
		$guradar2 			= $empleado->save2();
		echo json_encode(array(
			//'all'  => $_POST,
			//'idu' => $id,
			'mensaje' => 'Ruta eliminada', 
			// 'names' => $names
		));
	}
?>