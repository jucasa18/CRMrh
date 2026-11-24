<?php

$fecha = $_REQUEST['fecha'];

list($fechainicio, $fechafin) = quincenas($_REQUEST['fecha']);
/*echo $fechainicio;
echo '<br/>';
echo $fechafin;*/

echo json_encode(array(
	//'all'  => $_POST,
	//'idu' => $id,
	//'mensaje' => 'Vacaciones agregadas correctamente', 
	'fi' => $fechainicio, 
	'ff' => $fechafin, 
	// 'names' => $names
));


function quincenas($fecha){  
    /*$number = cal_days_in_month(CAL_GREGORIAN, 12, 2023); // 31
    echo $number;*/
    $dia = date('d', strtotime($fecha));
    $mes = date('n', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    /*$anioActual = date("Y");
    $mesActual = date("n");*/
    $ultimoDia = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);

    if($dia <= 15){
        $diai = '01';
        $diaf = 15;
    }elseif($dia > 15){
        $diai = 16;
        $diaf = $ultimoDia;
    }

   /* echo $dia; 
    echo $ultimoDia;*/

    $fechainicio =  $anio .'-'. $mes .'-'. $diai;
    $fechafin =  $anio .'-'. $mes .'-'. $diaf;

    

    return [$fechainicio, $fechafin];
}

?>