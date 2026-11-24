<?php
include('../../auth_session.php');
include_once '../ins/Empleados_principal.php'; 
//include '../ins/Rutas.php'; 
$empleado = new Empleados_principal();
//el 3 es que llego tarde el camion
	//$empleado->Retardo 			    = 3;
	$idcom = $_REQUEST['idcomp'] ;
if(!empty($_REQUEST['check_lista'])){
	// Bucle para almacenar y mostrar los valores de la casilla de verificación comprobación individual.
	foreach($_REQUEST['check_lista'] as $selected){
//	echo $selected."</br>";
	$empleado->IdDRENC  			    = $selected;
	$empleado->Complemento 			    = $idcom;
	$guradar 					= $empleado->editaComplementos();
	}
}
	echo json_encode(array(
		//'all'  => $_POST,
		//'idu' => $id,
		'mensaje' => 'Complementos Guardados', 
		// 'names' => $names
	));



 ?>