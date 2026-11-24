<?php
	include('../../auth_session.php');
	include_once '../ins/Deducciones_principal.php'; 
	$empleado = new Deducciones_principal();
	$empleado->id		= $_REQUEST['id'];
	$empleado->Status		= 0;
	$guradar 				= $empleado->eliminaIncidencias();
	if ($guradar) { 
		echo json_encode(array(
			//'all'  => $_POST,
			//'idu' => $id,
			'mensaje' => 'Deducción Eliminada', 
			// 'names' => $names
		));
	}
?>