<?php
require_once "vendor/autoload.php";
require_once "conexion.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet =new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();
$activeSheet->setCellValue('A1', 'Id');
$activeSheet->setCellValue('B1', 'FI');
$activeSheet->setCellValue('C1', 'FF');
$activeSheet->setCellValue('D1', 'dt');
$activeSheet->setCellValue('E1', 'v');
$activeSheet->setCellValue('F1', 'f');
$activeSheet->setCellValue('G1', 'p');
$activeSheet->setCellValue('H1', 'i');
$activeSheet->setCellValue('I1', 'h');
$activeSheet->setCellValue('J1', 'bqna');
$activeSheet->setCellValue('K1', 'ba');
$activeSheet->setCellValue('L1', 'dn');
$activeSheet->setCellValue('M1', 'td');
$activeSheet->setCellValue('N1', 'vac');
$activeSheet->setCellValue('O1', 'pv');
$activeSheet->setCellValue('P1', 'desp');
$activeSheet->setCellValue('Q1', 'fh');
$activeSheet->setCellValue('R1', 'pd');
$activeSheet->setCellValue('S1', 'df');
$activeSheet->setCellValue('T1', 'he');
$activeSheet->setCellValue('U1', 'g');
$activeSheet->setCellValue('V1', 'd');
$activeSheet->setCellValue('W1', 'tp');
$activeSheet->setCellValue('X1', 'tpd');	
$nq = $_REQUEST['nq']; 
$query = $conexion->query("SELECT * FROM prenomina WHERE NumQuincena = '$nq'");
if($query->num_rows > 0) {
    $i = 2;
    while($row = $query->fetch_assoc()) {
          $activeSheet->setCellValue('A'.$i, $row['IdDRENC']);
		  $activeSheet->setCellValue('B'.$i, $row['FechaInicio']);
		  $activeSheet->setCellValue('C'.$i, $row['FechaFin']);
		  $activeSheet->setCellValue('D'.$i, $row['dt']);
		  $activeSheet->setCellValue('E'.$i, $row['v']);
		  $activeSheet->setCellValue('F'.$i, $row['f']);
		  $activeSheet->setCellValue('G'.$i, $row['p']);
		  $activeSheet->setCellValue('H'.$i, $row['i']);
		  $activeSheet->setCellValue('I'.$i, $row['h']);
		  $activeSheet->setCellValue('J'.$i, $row['bqna']);
		  $activeSheet->setCellValue('K'.$i, $row['ba']);
		  $activeSheet->setCellValue('L'.$i, $row['dn']);
		  $activeSheet->setCellValue('M'.$i, $row['td']);
		  $activeSheet->setCellValue('N'.$i, $row['vac']);
		  $activeSheet->setCellValue('O'.$i, $row['pv']);
		  $activeSheet->setCellValue('P'.$i, $row['desp']);
		  $activeSheet->setCellValue('Q'.$i, $row['fh']);
          $activeSheet->setCellValue('R'.$i, $row['pd']);
		  $activeSheet->setCellValue('S'.$i, $row['df']);
		  $activeSheet->setCellValue('T'.$i, $row['he']);
		  $activeSheet->setCellValue('U'.$i, $row['g']);
		  $activeSheet->setCellValue('V'.$i, $row['d']);
		  $activeSheet->setCellValue('W'.$i, $row['tp']);
		  $activeSheet->setCellValue('X'.$i, $row['tpd']);
        $i++;
    }
} 
$filename = 'PreNominaExcel.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename='. urlencode($filename));
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
exit();
?>
             