<?php
	include('../../auth_session.php');
	include_once '../ins/Vacaciones_principal.php'; 
	$empleado = new Vacaciones_principal();
	$empleado->idVacaciones		= $_REQUEST['id'];
	$empleado->Estatus		= 0;
	$empleado->IdUsuario	= $_SESSION['id'];
	$guradar 				= $empleado->eliminaVacaciones();
	if ($guradar) { 
		$guradar2 			= $empleado->save2();
		echo json_encode(array(
			//'all'  => $_POST,
			//'idu' => $id,
			'mensaje' => 'Vacacion elimnada correctamente', 
			// 'names' => $names
		));
	}
?>