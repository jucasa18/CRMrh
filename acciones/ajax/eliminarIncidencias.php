<?php
	include('../../auth_session.php');
	include_once '../ins/Incidencias_principal.php'; 
	$empleado = new Incidencias_principal();
	$empleado->idIncidencia		= $_REQUEST['id'];
	$empleado->Estatus		= 0;
	$empleado->IdUsuario	= $_SESSION['id'];
	$guradar 				= $empleado->eliminaIncidencias();
	$mtt = $_REQUEST['mtt'];
		if($mtt == 'ett'){
		
		$empleado->idEmpleado		= $_REQUEST['idemp'];
		$empleado->FechaIncidencia		= $_REQUEST['fecha'];
		$eliminarest 				= $empleado->eliminaESTarjetaT();


	}
	if ($guradar) { 
		$guradar2 			= $empleado->save2();

		echo json_encode(array(
			//'all'  => $_POST,
			//'idu' => $id,
			'mensaje' => 'Incidencia elimnada correctamente', 
			// 'names' => $names
		));
	}
?>