<?php
	include('../../auth_session.php');
	include_once '../ins/Recomendaciones_principal.php'; 
	$empleado = new Recomendaciones_principal();
	$empleado->idRecomendacion 	= $_REQUEST['idrec'];
	$empleado->Estatus		= 0;
	$empleado->idUsuario	= $_SESSION['id'];
	$guradar 				= $empleado->eliminaRecomendacion();
	if ($guradar) { 
		$guradar2 			= $empleado->save2();
		echo json_encode(array(
			//'all'  => $_POST,
			//'idu' => $id,
			'mensaje' => 'Recomendacion eliminada.', 
			// 'names' => $names
		));
	}
?>