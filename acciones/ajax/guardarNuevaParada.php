<?php
include('../../auth_session.php');
include_once '../ins/Paradas_principal.php'; 
include '../ins/Paradas.php'; 
$empleado = new Paradas_principal();
$empleado->idRuta 			    = $_REQUEST['idruta'];
//$empleado->idParada 			    = $_REQUEST['idParada'];
$empleado->nombre 			    = $_REQUEST['nombre'];
$empleado->Estatus			= 1;
$empleado->idUsuario			= $_SESSION['id'];
$guradar 					= $empleado->save();
/*$guradar2 			    = $empleado->save2();
exit();*/
if ($guradar) { 
	$ida = Paradas::maxIdParadas();
	$idp = $ida['id'];
	//echo $idr;
	$empleado->idParada 			    = $idp;
	$guradar2 			    = $empleado->save2();
	echo json_encode(array(
		//'all'  => $_POST,
		//'idu' => $id,
		'mensaje' => 'Parada agregada correctamente', 
		// 'names' => $names
	));
}

 ?>