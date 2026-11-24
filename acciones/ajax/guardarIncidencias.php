<?php
include('../../auth_session.php');
include_once '../ins/Incidencias_principal.php'; 
include '../ins/Incidencias.php'; 
/*$empleado = new Incidencias_principal();
$empleado->idEmpleado 			    = $_REQUEST['IdDRENC'];
$empleado->FechaIncidencia 		    = $_REQUEST['FechaIncidencia'];
$empleado->Motivo 			    = $_REQUEST['Motivo'];
$empleado->TipoIncidencia 			    = $_REQUEST['TipoIncidencia'];
$empleado->Horario 			    = '';
$empleado->Otro 			= '';
$empleado->Origen 			= '';
$empleado->Destino 			= '';
$empleado->Contacto 			    = '';
$empleado->Sueldo 			    = $_REQUEST['Sueldo'];
$empleado->Estatus			= 1;
$empleado->IdUsuario			= $_SESSION['id'];*/

/*$hora = $_REQUEST['Hora'];
echo  $hora;
exit();*/
$empleado = new Incidencias_principal();
$empleado->idEmpleado 			    = $_REQUEST['IdDRENC'];
$empleado->FechaIncidencia 		    = $_REQUEST['FechaIncidencia'];
$empleado->Motivo 			        = $_REQUEST['Motivo'];
$empleado->TipoIncidencia 			= $_REQUEST['TipoIncidencia'];
$empleado->Horario 			    	= $_REQUEST['Horario'];
$empleado->Otro 					= $_REQUEST['Otro'];
$empleado->Origen 					= $_REQUEST['Origen'];
$empleado->Destino 					= $_REQUEST['Destino'];
$empleado->Contacto 			    = $_REQUEST['Contacto'];
$empleado->Sueldo 			 		= $_REQUEST['Sueldo'];
$empleado->Hora 			 		= $_REQUEST['Hora'];
$empleado->HoraR 			 		= $_REQUEST['HoraR'];
$empleado->Regreso 			 		= $_REQUEST['Regreso'];
$empleado->Cantidad 			 	= $_REQUEST['Cantidad'];
$empleado->Estatus					= 1;
$empleado->IdUsuario				= $_SESSION['id'];
$guradar 							= $empleado->save();
if ($guradar) { 
	$ida = Incidencias::maxIncidencias();
	$idp = $ida['id'];
	//echo $idr;                           
	$empleado->idIncidencia 			    = $idp;
	$guradar2 			    = $empleado->save2();

	if ($_REQUEST['TipoIncidencia'] == 7){
		$tarjetat = new Incidencias_principal();
		$tarjetat->idEmpleado 	   	  = $_REQUEST['IdDRENC'];
		$tarjetat->Fecha 		  	  = $_REQUEST['FechaIncidencia'];
		$tarjetat->Dia 			      = fechaEs($_REQUEST['FechaIncidencia']);
		$tarjetat->Entrada 			  = $_REQUEST['Hora'];
		$tarjetat->Salida 			  = $_REQUEST['HoraR'];
		$tarjetat->Turno 			  = $_REQUEST['Turno'];
		$tarjetat->Tiempo 			  = 0;
		$tarjetat->Retardo 			  = 1; //cuando  el tipo de retardo es 1, es por que fue una incidencia de tipo 7 Tarjeta Temporal
		$guradarTt 			          = $tarjetat->saveTt();

	}
	if ($_REQUEST['TipoIncidencia'] == 2 AND $_REQUEST['Motivo'] == 1 ){ //ENTRADA
		$tarjetat = new Incidencias_principal();
		$tarjetat->idEmpleado 	   	  = $_REQUEST['IdDRENC'];
		$tarjetat->Fecha 		  	  = $_REQUEST['FechaIncidencia'];
		$tarjetat->Entrada 			  = $_REQUEST['Hora'];
		$tarjetat->Retardo 			  = 15; //15 cuando es omision de checadas, entradas o salidas
		$guradarOcE 			          = $tarjetat->editaes2E();

	}
	if ($_REQUEST['TipoIncidencia'] == 2 AND $_REQUEST['Motivo'] == 2 ){ //salida
		$tarjetat = new Incidencias_principal();
		$tarjetat->idEmpleado 	   	  = $_REQUEST['IdDRENC'];
		$tarjetat->Fecha 		  	  = $_REQUEST['FechaIncidencia'];
		$tarjetat->Salida 			  = $_REQUEST['Hora'];
		$tarjetat->Retardo 			  = 15; //15 cuando es omision de checadas, entradas o salidas
		$guradarOcS 			          = $tarjetat->editaes2S();

	}
	if ($_REQUEST['TipoIncidencia'] == 2 AND $_REQUEST['Motivo'] == 2 ){ //salida
		$tarjetat = new Incidencias_principal();
		$tarjetat->idEmpleado 	   	  = $_REQUEST['IdDRENC'];
		$tarjetat->Fecha 		  	  = $_REQUEST['FechaIncidencia'];
		$tarjetat->Salida 			  = $_REQUEST['Hora'];
		$tarjetat->Retardo 			  = 15; //15 cuando es omision de checadas, entradas o salidas
		$guradarOcS 			          = $tarjetat->editaes2S();

	}

	echo json_encode(array(
		//'all'  => $_POST,
		//'idu' => $id,
		'mensaje' => 'Datos agregados correctamente', 
		// 'names' => $names
	));
}

function fechaEs($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia;
}

 ?>