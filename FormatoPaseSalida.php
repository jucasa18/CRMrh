<?php
require_once "vendor/autoload.php";
require_once "conexion.php";
$IdDRENC = $_REQUEST['idempleado'];
$id = $_REQUEST['id'];
//$query = "SELECT * FROM user WHERE email =\"$email\" AND pass = \"$password\";"
$query  = sprintf('SELECT * FROM empleados WHERE IdDRENC =%d',
			$IdDRENC );
 $results = mysqli_query($conexion, $query);
 $row = mysqli_fetch_assoc($results);

 $query2  = sprintf('SELECT * FROM  incidencias WHERE id =%d',
 							$id );
$results2 = mysqli_query($conexion, $query2);
$row2 = mysqli_fetch_assoc($results2);


$Dia = fechaEsDia($row2['FechaCreacion']);
$Mes = fechaEsMes($row2['FechaCreacion']);
$Anios = fechaEsAnio($row2['FechaCreacion']);
//$FechaIncidencia = $row2['FechaIncidencia'];
//$Sueldo0 = $row2['Sueldo'];
$Nombre = $row['Nombre'] ." ". $row['ApellidoP']  ." ". $row['ApellidoM']  ;
$Depto = $row['Depto'];
$IdDRENC = $row['IdDRENC'];
$IdPlanta = $row['IdPlanta'];
$Motivo = $row2['Motivo'];
$Nomina = $row['Nomina'];
$Hora = $row2['Hora'];
$HoraR = $row2['HoraR'];
$Regreso = $row2['Regreso'];
//$Sueldo = Sueldo($Sueldo0);
/*
echo $Dia ."</br>";
echo $Mes ."</br>";
echo $Anios ."</br>";
echo $FechaIncidencia ."</br>";
echo $Sueldo ."</br>";
echo $Nombre ."</br>";
echo $Depto ."</br>";
echo $IdDRENC ."</br>";
echo $Motivo ."</br>";
echo $Nomina ."</br>";
exit();*/

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = IOFactory::load('C:\xampp\htdocs\rh\formatos\paseSalida.xlsx');
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//var_dump($sheetData);
$spreadsheet->setActiveSheetIndex(0)
->setCellValue('R9', $Dia)
->setCellValue('W9', $Mes)
->setCellValue('AB9', $Anios)
->setCellValue('J13', $Regreso)
->setCellValue('T13', $Hora)
->setCellValue('AA13', $HoraR)
->setCellValue('J15', $Nombre)
->setCellValue('AA15', $IdDRENC)
->setCellValue('J16', $Depto)
->setCellValue('AA16', $IdPlanta)
->setCellValue('J17', $Motivo)
->setCellValue('AA17', $Nomina)
    ;
$writer = new Xlsx($spreadsheet);
//$writer->save('fvacaciones2.xlsx'); para guardar el archivo
$filename = 'paseSalida.xlsx';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='. $filename);
header('Cache-Control: max-age=0');
$writer->save('php://output');



function Sueldo($s){
	switch ($s) {
		case 1:
			$s = 'Con Goce de Sueldo';
			break;
		case 2:
			$s = 'Sin Goce de Sueldo';
			break;
	}
	return $s;
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
    return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
function fechaEsDia($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    return $numeroDia;
}

function fechaEsMes($fecha) {
    $fecha = substr($fecha, 0, 10);
    $mes = date('F', strtotime($fecha));
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombreMes;
}
function fechaEsAnio($fecha) {
    $anio = date('Y', strtotime($fecha));
    return $anio;
}
?>






