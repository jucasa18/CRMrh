<?php
include '../ins/Rutas.php'; 
$id =  $_REQUEST['id'];
$Ruta   = Rutas::listaRutabyId($id);
$nombre = $Ruta['nombre'];
$estatus 	=  $Ruta['Estatus'];
echo json_encode(array(
	'idr' => $id,
	'nombre' => $nombre,
	'estatus' => $estatus,
	'mensaje' => 'ok', 
));
	

?>