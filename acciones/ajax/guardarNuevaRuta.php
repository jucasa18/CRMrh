<?php
include('../../auth_session.php');
include_once '../ins/Rutas_principal.php'; 
include '../ins/Rutas.php'; 

$empleado = new Rutas_principal();
$empleado->nombre 			    = $_REQUEST['nombre'];
$empleado->Estatus			= 1;
$empleado->idUsuario			= $_SESSION['id'];
$guradar 					= $empleado->save();
/*$guradar2 			    = $empleado->save2();
exit();*/
if ($guradar) { 
	$ida = Rutas::maxIdRutas();
	$idr = $ida['id'];
	//echo $idr;
	$empleado->idRuta 			    = $idr;
	$guradar2 			    = $empleado->save2();
	echo json_encode(array(
		//'all'  => $_POST,
		//'idu' => $id,
		'mensaje' => 'Ruta agregada correctamente', 
		// 'names' => $names
	));
}

 ?>