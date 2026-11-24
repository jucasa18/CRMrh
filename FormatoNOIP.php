<?php
include_once 'acciones/ajax/guardarRepo.php'; 
require_once "vendor/autoload.php";
require_once "conexion.php";
 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet =new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);
 
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();
 
$activeSheet->setCellValue('A1', 'Id');
$activeSheet->setCellValue('B1', 'TipoNomina');
$activeSheet->setCellValue('C1', 'IdDRENC');
$activeSheet->setCellValue('D1', 'NumQuincena');
$activeSheet->setCellValue('E1', 'IdCorto');
$activeSheet->setCellValue('F1', 'pd');
$activeSheet->setCellValue('H1', 'npd');
$nq = 9;

 
//$query = $conexion->query("SELECT a.id AS c0,a.barcode AS c1,a.name as c3,a.description as c4,b.name as c5,a.dateday as c6,c.company AS prov,d.name as planta FROM product AS a INNER JOIN category as b ON(a.category_id=b.id) INNER JOIN supplier AS c ON(a.supplier_id=c.id) INNER JOIN plant AS d ON(a.plant_id=d.id) ORDER BY `c1` ASC");

$query = $conexion->query("SELECT * FROM fnoi WHERE NumQuincena = '$nq'");
 
if($query->num_rows > 0) {
    $i = 2;
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('A'.$i, $row['Id']);
        $activeSheet->setCellValue('B'.$i, $row['TipoNomina']);
        $activeSheet->setCellValue('C'.$i, $row['IdDRENC']);
        $activeSheet->setCellValue('D'.$i, $row['NumQuincena']);
        $activeSheet->setCellValue('E'.$i, $row['IdCorto']);
        $activeSheet->setCellValue('F'.$i, $row['pd']);
        $activeSheet->setCellValue('H'.$i, $row['npd']);
      
        $i++;
    }
}
 
$filename = 'FormatoNOI.xlsx';
 
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');












function insertNOIExcel($arraynoi, $arrayexcel){ 
	$NumQuincena = 7;

	foreach($arraynoi as $number => $bike)
			{			
			foreach($bike as $num => $value)
			{
				//echo  "Index n ".$num." of  n".$number." indexed array contains n" .$value['iddrenc']. "-".$value['monto']."<br>";
				$inserta =  guardaNoi($value['iddrenc'], $NumQuincena, $value['id'], $value['pd'], $value['npd'], $value['nc'], $value['aplicadestajo'], $value['aplicacion'], $value['fi'], $value['ff'], $value['monto'], $value['IdUsuario'], $value['FechaCreacion']);
			}
		}
	
			
			foreach($arrayexcel as $num => $value)
			{
			//	echo  "Index ".$num." indexed array contains " .$value['IdDRENC']. "-".$NumQuincena."<br>";
				$inserta =  guardaPN(  $value['IdDRENC'], $NumQuincena, $value['FechaInicio'], $value['FechaFin'], $value['dt'], $value['v'], $value['f'], $value['p'], $value['i'], $value['h'], $value['bqna'], $value['ba'], $value['dn'], $value['td'], $value['vac'], $value['pv'], $value['desp'], $value['fh'], $value['pd'], $value['df'], $value['he'], $value['g'], $value['d'], $value['tp'], $value['tpd'], $value['salDiario'], $value['IdUsuario'], $value['FechaCreacion']);
			}
		
	
		

		return $inserta;
	
}	
?>

