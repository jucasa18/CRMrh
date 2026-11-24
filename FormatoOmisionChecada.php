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
$Nombre = $row['Nombre'];
$IdDRENC = $row['IdDRENC'];
$Nomina = $row['Nomina'];
$Depto = $row['Depto'];
$FechaIncidencia = $row2['FechaIncidencia'];
$horario = horario($row2['Horario']);
$motivo = motivo($row2['Motivo']);

/*
echo $Nombre ."</br>";
echo $IdDRENC ."</br>";
echo $Depto ."</br>";
echo $FechaIncidencia ."</br>";
echo $horario ."</br>";
echo $motivo ."</br>";

exit();*/

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = IOFactory::load('C:\xampp\htdocs\rh\formatos\fomisionChecada.xlsx');
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//var_dump($sheetData);
$spreadsheet->setActiveSheetIndex(0)
->setCellValue('E6', $Nombre)
->setCellValue('E7', $IdDRENC)
->setCellValue('J7', $Depto)
->setCellValue('E8', $FechaIncidencia)
->setCellValue('B10', $motivo)
->setCellValue('G10', $Nomina)
->setCellValue('D14', $horario)
    ;
$writer = new Xlsx($spreadsheet);
//$writer->save('fvacaciones2.xlsx'); para guardar el archivo
$filename = 'fomisionChecada.xlsx';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='. $filename);
header('Cache-Control: max-age=0');
$writer->save('php://output');



function horario($h){
    switch ($h) {
        case 1:
            $h = 'Entrada';
            break;
        case 2:
            $h = 'Salida';
            break;
    }
    return $h;
}

function motivo($m){
    switch ($m) {
        case 1:
            $m = 'Omisión de Entrada';
            break;
        case 2:
            $m = 'Omisión de Salida';
            break;
        case 3:
            $m = 'Error en Tarjeta de Acceso';
            break;
    }
    return $m;
}
?>






