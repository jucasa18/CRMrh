<?php
//include '../ins/Empleados.php'; 
//funcion para calcular el sueldo por hora
function sxh($sxd){
	$res = $sxd / 8;
	return $res;
}
//trabajando
function NominaQuincenal($fechaInicio,$fechaFin){
    $lisEmplAct  = Empleados::listaQuincenales($fechaInicio,$fechaFin);
}


?>