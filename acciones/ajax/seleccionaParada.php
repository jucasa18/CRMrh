<?php
include '../ins/Paradas.php'; 
$id =  $_REQUEST['id'];
$Ruta   = Paradas::listaParadabyId($id);
$nombre = $Ruta['nombre'];
$estatus 	=  $Ruta['Estatus'];
echo json_encode(array(
	'idr' => $id,
	'nombre' => $nombre,
	'Estatus' => $estatus,
	'mensaje' => 'ok', 
));
	

?>