<?php
	include('../../auth_session.php');
	include_once '../ins/Rutas_principal.php'; 
	$empleado = new Rutas_principal();
	$empleado->idRuta 		= $_REQUEST['idruta'];
	$empleado->Eliminar		= 1;
	$empleado->idUsuario	= $_SESSION['id'];
	$guradar 				= $empleado->eliminaRuta();
	if ($guradar) { 
		$guradar2 			= $empleado->save2();
		echo json_encode(array(
			//'all'  => $_POST,
			//'idu' => $id,
			'mensaje' => 'Ruta editada correctamente', 
			// 'names' => $names
		));
	}
?>