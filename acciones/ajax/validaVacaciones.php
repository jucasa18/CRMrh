<?php
include('../../auth_session.php');
include '../ins/Empleados.php'; 
$fecha =$_REQUEST['dato'];
$idEmpleado =$_REQUEST['id'];
$lisValidacion = Empleados::validaVacaciones($idEmpleado, $fecha);
if(is_array($lisValidacion)){
	$id= 1;
}else{

	$id= 0;
}

echo json_encode(array(
	//'all'  => $_POST,
	'id' => $id,
	///'mensaje' => 'Datos actualizados correctamente',
	// 'names' => $names
));

 ?>