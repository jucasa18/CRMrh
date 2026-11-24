<?php
ob_start();
ob_end_clean();
require_once "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
function FormatoNOIExcel($arrayPNE){ //Funcion para generar archivo de Excel desde un array, antes de guardarlo en la DB.
	//print_r($arrayPNE);
	$spreadsheet =new Spreadsheet();
	$Excel_writer = new Xlsx($spreadsheet);
	$spreadsheet->setActiveSheetIndex(0);
	$activeSheet = $spreadsheet->getActiveSheet();
	$activeSheet->setCellValue('A1', 'Id - DRE-NC');
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
	$fila = 2;
	foreach($arrayPNE as $num => $value)
		{
			//	echo  "Index ".$num." indexed array contains " .$value['id']. "-".$value['monto']." fila ".$fila ." columna ".$col."<br>";
					$activeSheet->setCellValue('A'.$fila, $value['IdDRENC']);
					$activeSheet->setCellValue('B'.$fila, $value['FechaInicio']);
					$activeSheet->setCellValue('C'.$fila, $value['FechaFin']);
					$activeSheet->setCellValue('D'.$fila, $value['dt']);
					$activeSheet->setCellValue('E'.$fila, $value['v']);
					$activeSheet->setCellValue('F'.$fila, $value['f']);
					$activeSheet->setCellValue('G'.$fila, $value['p']);
					$activeSheet->setCellValue('H'.$fila, $value['i']);
					$activeSheet->setCellValue('I'.$fila, $value['h']);
					$activeSheet->setCellValue('J'.$fila, $value['bqna']);
					$activeSheet->setCellValue('K'.$fila, $value['ba']);
					$activeSheet->setCellValue('L'.$fila, $value['dn']);
					$activeSheet->setCellValue('M'.$fila, $value['td']);
					$activeSheet->setCellValue('N'.$fila, $value['vac']);
					$activeSheet->setCellValue('O'.$fila, $value['pv']);
					$activeSheet->setCellValue('P'.$fila, $value['desp']);
					$activeSheet->setCellValue('Q'.$fila, $value['fh']);
					$activeSheet->setCellValue('R'.$fila, $value['pd']);
					$activeSheet->setCellValue('S'.$fila, $value['df']);
					$activeSheet->setCellValue('T'.$fila, $value['he']);
					$activeSheet->setCellValue('U'.$fila, $value['g']);
					$activeSheet->setCellValue('V'.$fila, $value['d']);
					$activeSheet->setCellValue('W'.$fila, $value['tp']);
					$activeSheet->setCellValue('X'.$fila, $value['tpd']);
					$fila++;	
	}
	$filename = 'PreNominaExcel.xlsx';
	ob_end_clean();
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename='. $filename);
	header('Cache-Control: max-age=0');
	//ob_end_clean();
	$Excel_writer->save('php://output');
}	
?>

