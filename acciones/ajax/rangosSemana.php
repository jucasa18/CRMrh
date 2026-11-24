<?php
date_default_timezone_set('America/Mexico_City');
$fecha = $_REQUEST['fecha'];
$fechaSegundos = strtotime($fecha);	
$week = date('W', $fechaSegundos);
$year = date("Y", $fechaSegundos);
$fechas = getFirstDayWeek($week, $year);
$fechainicio = $fechas['start'];
$fechafin = $fechas['end'];
echo json_encode(array(
	//'all'  => $_POST,
	//'idu' => $id,
	//'mensaje' => 'Vacaciones agregadas correctamente', 
	'fi' => $fechainicio, 
	'ff' => $fechafin, 
	// 'names' => $names
));

function getFirstDayWeek($week, $year)
{
    $dt = new DateTime();
    $return['start'] = $dt->setISODate($year, $week)->format('Y-m-d');
    $return['end'] = $dt->modify('+6 days')->format('Y-m-d');
    return $return;
}

?>