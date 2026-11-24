<?php
require_once "../../html2/vendor/autoload.php";
require_once "acciones/ins/Empleados.php"; 
 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet =new Spreadsheet();
$Excel_writer = new Xlsx($spreadsheet);
 
$spreadsheet->setActiveSheetIndex(0);
$activeSheet = $spreadsheet->getActiveSheet();
 
$activeSheet->setCellValue('A1', 'Id');
$activeSheet->setCellValue('B1', 'Nombre');
$activeSheet->setCellValue('C1', 'Apellido M');
$activeSheet->setCellValue('D1', 'Apellido P');
$activeSheet->setCellValue('E1', 'Curp');
$activeSheet->setCellValue('F1', 'Rfc');
$activeSheet->setCellValue('G1', 'Depto');
$activeSheet->setCellValue('H1', 'Linea');

 
//$query = $conexion->query("SELECT a.id AS clave,a.barcode AS bc,a.name AS nombre,b.name AS cate,TRUNCATE(a.price,2) AS precio, c.abreviatura AS moneda,(SELECT SUM(cuantifity) FROM inventary tb1 INNER JOIN operation AS tb2 ON(tb1.operation_id=tb2.id) WHERE tb1.product_id=a.id AND tb2.planta_id='1')AS suma, e.abreviatura AS unidad,f.name AS planta FROM product AS a INNER JOIN category AS b ON (a.category_id=b.id) INNER JOIN coin AS c ON (a.coin_id=c.id) INNER JOIN unit AS e ON (a.unit_id=e.id) INNER JOIN plant AS f ON(a.plant_id=f.id) ORDER BY `clave` ASC");

$lisEmp  = Empleados::listaEmpleadobyId($id);
 
if($query->num_rows > 0) {
    $i = 2;
    while($row = $query->fetch_assoc()) {
        $activeSheet->setCellValue('A'.$i, $$lisEmp['IdDRENC']);
        $activeSheet->setCellValue('B'.$i, $lisEmp['Nombre']);
        $activeSheet->setCellValue('C'.$i, $lisEmp['ApellidoM']);
        $activeSheet->setCellValue('D'.$i, $lisEmp['ApellidoP']);
        $activeSheet->setCellValue('E'.$i, $lisEmp['Curp']);
        $activeSheet->setCellValue('F'.$i, $lisEmp['Rfc']);
        $activeSheet->setCellValue('G'.$i, $lisEmp['Depto']);
        $activeSheet->setCellValue('H'.$i, $lisEmp['Linea']);
      
        $i++;
    }
}
 
$filename = 'Empleadosp.xlsx';
 
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='. $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
?>