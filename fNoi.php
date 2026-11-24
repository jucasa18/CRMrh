<?php
require_once "vendor/autoload.php";
require_once "conexion.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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
$nq = $_REQUEST['nq'];
$query = $conexion->query("SELECT * FROM fnoi WHERE NumQuincena = '$nq'"); 
if($query->num_rows > 0) {
    $i = 2;
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('A'.$i, $row['IdCorto']);
        $activeSheet->setCellValue('B'.$i, $row['pd']);
        $activeSheet->setCellValue('C'.$i, $row['npd']);
        $activeSheet->setCellValue('D'.$i, $row['nc']);
        $activeSheet->setCellValue('E'.$i, $row['AplicaDestajo']);
        $activeSheet->setCellValue('F'.$i, $row['Aplicacion']);
        $activeSheet->setCellValue('G'.$i, date('d-m-Y',strtotime($row['fi'])));
        $activeSheet->setCellValue('H'.$i, date('d-m-Y',strtotime($row['ff'])));
        $activeSheet->setCellValue('I'.$i, $row['Monto']);      
        $i++;
    }
} 
$filename = 'Formato.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename='. urlencode($filename));
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
exit();
?>



  
                                                                        