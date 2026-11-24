<?php
	include('../../auth_session.php');
	include_once '../ins/Rutas_principal.php'; 
	include_once '../ins/Deducciones_principal.php'; 
	$td = $_REQUEST['Tipo'];
		$tipo = '';
		switch ($td) {
		case 1:
			$tipo = 'listaInfonavit.php';
			break;
		case 2:
			$tipo = 'listaFonacot.php';
			break;
		case 3:
				$tipo =  "listaPA.php";
				break;
		}

	$empleado = new Deducciones_principal();
	$empleado->idEmpleado 			    = $_REQUEST['IdDRENC'];
	$empleado->Tipo 		   			= $_REQUEST['Tipo'];
	$empleado->Cantidad 			    = $_REQUEST['Cantidad'];
	$empleado->id				= $_REQUEST['id'];
	$empleado->IdUsuario				= $_SESSION['id'];
	$guradar 				= $empleado->editaDeduccion();
	if ($guradar) { 
		$guradar2 			= $empleado->save2();
		echo json_encode(array(
			//'all'  => $_POST,
			//'idu' => $id,
			'tipo' => $tipo ,
			'mensaje' => 'Deduccion editada correctamente', 
			// 'names' => $names
		));
	}


	


?>