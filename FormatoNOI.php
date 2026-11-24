<?php
ob_start();
ob_end_clean();
require_once "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
function FormatoNOIExcel($arrayNoi){ //Funcion para generar archivo de Excel desde un array, antes de guardarlo en la DB.
	//print_r($arrayNoi);
	$spreadsheet =new Spreadsheet();
	$Excel_writer = new Xlsx($spreadsheet);
	$spreadsheet->setActiveSheetIndex(0);
	$activeSheet = $spreadsheet->getActiveSheet();
	$activeSheet->setCellValue('A1', 'Clave_Trabajador');
	$activeSheet->setCellValue('B1', 'Per/Ded');
	$activeSheet->setCellValue('C1', 'Num_Per/Ded');
	$activeSheet->setCellValue('D1', 'Num_Credito');
	$activeSheet->setCellValue('E1', 'Aplica_destajo');
	$activeSheet->setCellValue('F1', 'Aplicacion');
	$activeSheet->setCellValue('G1', 'Fecha_Inicio');
	$activeSheet->setCellValue('H1', 'Fecha_Fin');
	$activeSheet->setCellValue('I1', 'Monto_Formula');
	$fila = 2;
	//foreach($arrayNoi as $number => $bike)
		//{			
		foreach($arrayNoi as $num => $value)
		{
			//$col = $num + 1;			
		//	echo  "Index ".$num." indexed array contains " .$value['id']. "-".$value['monto']." fila ".$fila ." columna ".$col."<br>";
					$activeSheet->setCellValue('A'.$fila, $value['id']);
					$activeSheet->setCellValue('B'.$fila, $value['pd']);
					$activeSheet->setCellValue('C'.$fila, $value['npd']);
					$activeSheet->setCellValue('D'.$fila, $value['nc']);
					$activeSheet->setCellValue('E'.$fila, $value['aplicadestajo']);
					$activeSheet->setCellValue('F'.$fila, $value['aplicacion']);
					$activeSheet->setCellValue('G'.$fila, date('d-m-Y',strtotime($value['fi'])));
					$activeSheet->setCellValue('H'.$fila, date('d-m-Y',strtotime($value['ff'])));
					$activeSheet->setCellValue('I'.$fila, $value['monto']);
					$fila++;	
		//}
	}
	//exit();
	$filename = 'FormatoNOI.xlsx';
	ob_end_clean();
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename='. $filename);
	header('Cache-Control: max-age=0');
	//ob_end_clean();
	$Excel_writer->save('php://output');
	header("Location: ".$nombreDelDocumento);
}	
?>

