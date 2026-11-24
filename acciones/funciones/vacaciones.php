<?php
//include '../ins/Empleados.php'; 
// Calcula si el empleado tiene mas de un año, para saber que tipo de vacacones tiene.
function antiguedad($idempleado){
	$vacaciones  = Empleados::añostrabajados23($idempleado);
	return $vacaciones['antiguedad'];
}

function antiguedadold($idempleado){
	$vacaciones  = Empleados::añostrabajadosold($idempleado);
	return $vacaciones['antiguedadold'];
}




//funcion para calular las vacaciones del año 2023
function vacaciones2023($idempleado){
	$vacaciones  = Empleados::vacaciones2023($idempleado);
	return $vacaciones['diasVacaciones'];
}
//funcion para extraer las vacaciones de los empleados con antiguedad mayor o igual a 1 año
function vacacionesOld($idempleado){
	$vacaciones  = Empleados::vacaciones2023($idempleado);
	return $vacaciones['diasVacaciones'];
}


function calculaDiasold($años){
	$dias = 0;

	switch ($años) {
		case 0:
			$dias = 0;
			break;
		case 1:
			$dias = 8;
			break;
		case 2:
			$dias = 18;
			break;
		case 3:
			$dias = 30;
			break;
		case 4:
			$dias = 42;
			break;
		case 5:
			$dias = 56;
			break;	
		case 6:
			$dias = 70;
			break;
		case 7:
			$dias = 84;
			break;
		case 8:
			$dias = 98;
			break;
		case 9:
			$dias = 112;
			break;
		case 10:
			$dias = 128;
			break;
		case 11:
			$dias = 138;
			break;
		case 12:
			$dias = 154;
			break;
		case 13:
			$dias = 170;
			break;
		case 14:
			$dias = 186;
			break;
		case 15:
			$dias = 204;
			break;
		case 16:
			$dias = 222;
			break;
		case 17:
			$dias = 240;
			break;
		case 18:
			$dias = 258;
			break;
		case 19:
			$dias = 276;
			break;
		case 20:
			$dias = 296;
			break;
		case 21:
			$dias = 316;
			break;
		case 22:
			$dias = 336;
			break;
		case 23:
			$dias = 356;
			break;
		case 24:
			$dias = 376;
			break;
		case 25:
			$dias = 398;
			break;
		
	}

	
	return $dias;
}

function calculaDiasnew($años){
	$dias = 0;
	switch ($años) {
		case 0:
			$dias = 0;
			break;
		case 1:
			$dias = 12;
			break;
		case 2:
			$dias = 14;
			break;
		case 3:
			$dias = 16;
			break;
		case 4:
			$dias = 18;
			break;
		case 5:
			$dias = 20;
			break;	
		case 6:
			$dias = 70;
			break;
		case 7:
			$dias = 22;
			break;
		case 8:
			$dias = 22;
			break;
		case 9:
			$dias = 22;
			break;
		case 10:
			$dias = 22;
			break;
		case 11:
			$dias = 24;
			break;
		case 12:
			$dias = 24;
			break;
		case 13:
			$dias = 24;
			break;
		case 14:
			$dias = 24;
			break;
		case 15:
			$dias = 24;
			break;
		case 16:
			$dias = 26;
			break;
		case 17:
			$dias = 26;
			break;
		case 18:
			$dias = 26;
			break;
		case 19:
			$dias = 26;
			break;
		case 20:
			$dias = 26;
			break;
		case 21:
			$dias = 28;
			break;
		case 22:
			$dias = 28;
			break;
		case 23:
			$dias = 28;
			break;
		case 24:
			$dias = 28;
			break;
		case 25:
			$dias = 28;
			break;
		
	}

	
	return $dias;
}

/*function getDiasHabiles($fechainicio, $fechafin, $diasferiados = array()) { //vacaciones
	// Convirtiendo en timestamp las fechas
	$fechainicio = strtotime($fechainicio);
	$fechafin = strtotime($fechafin);
   
	// Incremento en 1 dia
	$diainc = 24*60*60;
   
	// Arreglo de dias habiles, inicianlizacion
	$diashabiles = array();
   
	// Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
	for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {
			// Si el dia indicado, no es sabado o domingo es habil
			if (!in_array(date('N', $midia), array(6,7))) { // DOC: http://www.php.net/manual/es/function.date.php
					// Si no es un dia feriado entonces es habil
					if (!in_array(date('Y-m-d', $midia), $diasferiados)) {
							array_push($diashabiles, date('Y-m-d', $midia));
					}
			}
	}
	$dh = count($diashabiles);   
	return $dh;
}*/

function getDiasHabilesxrango($fechainicio, $fechafin) {//funcion para guardar las vacaciones en el detalle las vacaciones
/*	// Convirtiendo en timestamp las fechas
	$fechainicio = strtotime($fechainicio);
	$fechafin = strtotime($fechafin);
   
	// Incremento en 1 dia
	$diainc = 24*60*60;
   
	// Arreglo de dias habiles, inicianlizacion
	$diashabiles = array();
   
	// Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
	for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {
			// Si el dia indicado, no es sabado o domingo es habil
			if (!in_array(date('N', $midia), array(6,7))) { // DOC: http://www.php.net/manual/es/function.date.php
					// Si no es un dia feriado entonces es habil
					if (!in_array(date('Y-m-d', $midia), $diasferiados)) {
							array_push($diashabiles, date('Y-m-d', $midia));
					}
			}
	}*/
	//$dh = count($diashabiles);   
	$fecha_inicial = new DateTime($fechainicio);
	$fecha_final = new DateTime($fechafin);
	$diashabiles = array();
	$dh= 0;
	for($i = $fecha_inicial; $i <= $fecha_final; $i->modify('+1 day')){
		if ($i->format("N") === '6' OR $i->format("N") === '7') {
			continue;
		} 
		array_push($diashabiles, $i->format("Y-m-d"));

		$dh++;
	}
	return $diashabiles;
}


function getSemana($fecha) {
	$nroDia = date("W", strtotime($fecha)); 
	return $nroDia;
}


/*function getDias($fechainicio, $fechafin, $diasferiados = array()) {
	// Convirtiendo en timestamp las fechas
	$fechainicio = strtotime($fechainicio);
	$fechafin = strtotime($fechafin);
   
	// Incremento en 1 dia
	$diainc = 24*60*60;
	
   
	// Arreglo de dias habiles, inicianlizacion
	$diashabiles = array();
   
	// Se recorre desde la fecha de inicio a la fecha fin, incrementando en 1 dia
	for ($midia = $fechainicio; $midia <= $fechafin; $midia += $diainc) {
			
		
			if (!in_array(date('N', $midia), array())) { // DOC: http://www.php.net/manual/es/function.date.php
					
					if (!in_array(date('Y-m-d', $midia), $diasferiados)) {
						echo date('Y-m-d', $midia).'</br>';
							array_push($diashabiles, date('Y-m-d', $midia));
					}
			}
	}
	$dh = count($diashabiles);   
	return $dh;
}*/

/*function getDias($fechainicio, $fechafin) {
	$fechainicio = new DateTime('01-04-2024');
	$fechafin = new DateTime('15-04-2024');
	$j=0;

	for($i = $fechainicio; $i <= $fechafin; $i->modify('+1 day')){
		echo $i->format("Y-m-d"). '</br>';
		$j++;
	}
	echo $j;
	return $j;
	
}*/


function getDiasHabiles($fechainicio, $fechafin, $diasferiados = array()) { //vacaciones
	$fecha_inicial = new DateTime($fechainicio);
	$fecha_final = new DateTime($fechafin);
	$dh= 0;
	for($i = $fecha_inicial; $i <= $fecha_final; $i->modify('+1 day')){
		if ($i->format("N") === '6' OR $i->format("N") === '7') {
			continue;
		} 
		$dh++;
	}
	return $dh;

}

function getDias($fechainicio, $fechafin) { //Función para las incapacidades calculo de días
	$fecha_inicial = new DateTime($fechainicio);
	$fecha_final = new DateTime($fechafin);
	$dh= 0;
	for($i = $fecha_inicial; $i <= $fecha_final; $i->modify('+1 day')){
		//echo $i->format("Y-m-d").'</br>';
		$dh++;
	}
	return $dh;
}



function getDiasxrango($fechainicio, $fechafin) { //Función para las incapacidades en el detalla
	$fecha_inicial = new DateTime($fechainicio);
	$fecha_final = new DateTime($fechafin);
		// Arreglo de dias habiles, inicianlizacion
		$diashabiles = array();
	$dh= 0;
	for($i = $fecha_inicial; $i <= $fecha_final; $i->modify('+1 day')){
		array_push($diashabiles, $i->format("Y-m-d"));
		$dh++;
	}

	return $diashabiles;
}

/*$prueba = getDiasHabilesxrango("2024-04-01", "2024-04-12");

print_r($prueba);*/


/*
$diashabiles = getDiasHabiles('2023-10-25', '2023-11-07', [ '2023-11-02', '2023-11-03']); //en el array se pueden poner, el dia feriado y dias de descanso. para cuando alla esa couincidencia.
echo $diashabiles;*/



?>