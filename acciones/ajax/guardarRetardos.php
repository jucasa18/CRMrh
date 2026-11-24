<?php
include('../../auth_session.php');
include_once '../ins/Rutas_principal.php'; 
//include '../ins/Rutas.php'; 
$empleado = new Rutas_principal();
//el 3 es que llego tarde el camion

	//$empleado->Retardo 			    = 3;
	


if(!empty($_REQUEST['check_lista'])){
	// Bucle para almacenar y mostrar los valores de la casilla de verificación comprobación individual.
	foreach($_REQUEST['check_lista'] as $selected){
//	echo $selected."</br>";
	$empleado->idRuta 			    = $selected;
	$empleado->Retardo 			    = 3;
	$guradar 					= $empleado->editaRetardos();
	//echo $guradar 	;
	}
	}





	echo json_encode(array(
		//'all'  => $_POST,
		//'idu' => $id,
		'mensaje' => 'Vacaciones agregadas correctamente', 
		// 'names' => $names
	));



 ?>