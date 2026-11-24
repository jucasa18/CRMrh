<?php
	include('../../auth_session.php');
	include_once '../ins/Empleados_principal.php'; 
	$empleado = new Empleados_principal();
	$empleado->IdDRENC		= $_REQUEST['idd'];
	$empleado->FechaCambioNom		= $_REQUEST['fcnom'];
	$guradar 				= $empleado->editaNomina();
	if ($guradar) { 
		echo json_encode(array(
			//'all'  => $_POST,
			'idd' => $_REQUEST['idd'],
			'mensaje' => 'Cambio realizado', 
			// 'names' => $names
		));
	}
?>