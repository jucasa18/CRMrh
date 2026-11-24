<?php
/*require_once "vendor/autoload.php";
require_once "conexion.php";
$IdDRENC = $_REQUEST['IdDRENC'];
$id = $_REQUEST['id'];
//$query = "SELECT * FROM user WHERE email =\"$email\" AND pass = \"$password\";"
$query  = sprintf('SELECT * FROM empleados WHERE IdDRENC =%d',
			$IdDRENC );
 $results = mysqli_query($conexion, $query);
 $row = mysqli_fetch_assoc($results);

 $query2  = sprintf('SELECT *, EXTRACT(DAY FROM FechaCreacion) AS dia, EXTRACT(MONTH FROM FechaCreacion) AS mes, EXTRACT(YEAR FROM FechaCreacion) AS año  FROM  vacaciones WHERE id =%d',
 							$id );
$results2 = mysqli_query($conexion, $query2);
$row2 = mysqli_fetch_assoc($results2);

$Nombre = $row['Nombre'];
$Puesto = $row['Puesto'];
$area = $row['Linea'];
$Nomina = $row['Nomina'];
$TipoV = $row2['TipoVacacion'];
$FormaP = $row2['FormaPago'];
$DActual = $row2['dia'];
$MActual = $row2['mes'];
$AActual = $row2['año'];
$FechaInicio = $row2['FechaInicio'];
$FechaFin = $row2['FechaFin'];
$DiasPedidos = $row2['DiasPedidos'];
$TipoVacacion = TipoVac($TipoV);
$FormaPago = FormaPago($FormaP);
/*
echo $Nombre ."</br>";
echo $Puesto ."</br>";
echo $Nomina ."</br>";
echo $TipoVacacion ." tv </br>";
echo $FormaPago ."</br>";
echo $DActual ."</br>";
echo $MActual ."</br>";
echo $AActual ."</br>";
echo $FechaInicio ."</br>";
echo $FechaFin ."</br>";
echo $IdDRENC ."</br>";
echo $DiasPedidos ."</br>";
exit();
/
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
$spreadsheet = IOFactory::load('C:\xampp\htdocs\rh\formatos\fvacaciones.xlsx');
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
//var_dump($sheetData);
$spreadsheet->setActiveSheetIndex(0)
->setCellValue('G9', $area)
->setCellValue('X9', $Puesto)
->setCellValue('G11', $Nombre)
->setCellValue('X11', $IdDRENC)
->setCellValue('X12', $Nomina)
->setCellValue('G13', $TipoVacacion)
->setCellValue('I15', $FechaInicio)
->setCellValue('Q15', $FechaFin)
->setCellValue('AC15', $DiasPedidos)
->setCellValue('L17', $FormaPago)
->setCellValue('L25', $AActual)
->setCellValue('P25', $MActual)
->setCellValue('T25', $DActual)
->setCellValue('X28', $Nombre)
    ;
$writer = new Xlsx($spreadsheet);
//$writer->save('fvacaciones2.xlsx'); para guardar el archivo
$filename = 'fvacaciones.xlsx';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='. $filename);
header('Cache-Control: max-age=0');
$writer->save('php://output');



function TipoVac($tv){
	
	switch ($tv) {
		case 1:
			$tv = 'VAC. 1Año 연가';
			break;
		case 2:
			$tv = 'VAC. 2Año 2연가';
			break;
		case 3:
			$tv = 'INCAP. 병가';
			break;
		case 4:
			$tv = 'VAC. ESP 경조휴가';
			break;
		case 5:
			$tv = 'VAC.PRE 포상휴가';
			break;
	}
	return $tv;
}
function FormaPago($fp){
	
	switch ($fp) {
		case 1:
			$fp = 'VACACIONES DISFRUTADAS 휴가 사용';
			break;
		case 2:
			$fp = 'VACACIONES PAGADAS 휴가 대체 수당';
			break;
		
	}
	return $fp;
}*/



require_once dirname(__FILE__) . '/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

// Conexión
$con = mysqli_connect('localhost', 'root', '', 'rh');

if (!$con) {
    die('Error de conexión: ' . mysqli_connect_error());
}

mysqli_set_charset($con, 'utf8mb4');

// Obtener ID del empleado
$IdDRENC = $_REQUEST['IdDRENC'];
$id = isset($_REQUEST['IdDRENC']) ? (int) $_REQUEST['IdDRENC'] : 0;

if ($id <= 0) {
    die('ID de empleado no válido');
}

// Consultar empleado
$sql = "SELECT IdDRENC, Nombre, ApellidoP, ApellidoM,
               FechaIngreso, Puesto
        FROM empleados
        WHERE IdDRENC = ? AND Estatus = 1";

$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($resultado);

if (!$row) {
    die('No se encontró el empleado');
}

// Datos del empleado
$nombre = htmlspecialchars(
    trim($row['Nombre'] . ' ' .
    $row['ApellidoP'] . ' ' .
    $row['ApellidoM']),
    ENT_QUOTES,
    'UTF-8'
);

$puesto = htmlspecialchars(
    $row['Puesto'] ?? '',
    ENT_QUOTES,
    'UTF-8'
);

$fechaIngreso = date(
    'd/m/Y',
    strtotime($row['FechaIngreso'])
);

$fechaSolicitud = date('d/m/Y');

$html = '
<style>
    body {
        font-family: helvetica;
        font-size: 11px;
    }

    .titulo {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }

    .subtitulo {
        text-align: center;
        font-size: 12px;
    }

    .seccion {
        background-color: #eeeeee;
        font-weight: bold;
        padding: 7px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        padding: 9px;
        border: 1px solid #999999;
    }

    .firma {
        text-align: center;
        padding-top: 45px;
    }
</style>

<page backtop="15mm" backbottom="15mm"
      backleft="12mm" backright="12mm">

    <p class="titulo">DR ENC, S.A. DE C.V.</p>
    <p class="subtitulo">
        SOLICITUD Y AUTORIZACIÓN DE VACACIONES
    </p>
    <p class="subtitulo">RECURSOS HUMANOS</p>

    <br>

    <table>
        <tr>
            <td class="seccion" colspan="2">
                DATOS DEL TRABAJADOR
            </td>
        </tr>
        <tr>
            <td><b>Nombre:</b><br>'.$nombre.'</td>
            <td><b>Número de empleado:</b><br>'.
                $row['IdDRENC'].'</td>
        </tr>
        <tr>
            <td><b>Puesto:</b><br>'.$puesto.'</td>
            <td><b>Fecha de ingreso:</b><br>'.
                $fechaIngreso.'</td>
        </tr>

        <tr>
            <td class="seccion" colspan="2">
                PERIODO VACACIONAL
            </td>
        </tr>
        <tr>
            <td><b>Fecha de solicitud:</b><br>'.
                $fechaSolicitud.'</td>
            <td><b>Días solicitados:</b><br>__________</td>
        </tr>
        <tr>
            <td><b>Fecha de inicio:</b><br>__________</td>
            <td><b>Fecha de término:</b><br>__________</td>
        </tr>
        <tr>
            <td><b>Reincorporación:</b><br>__________</td>
            <td><b>Días disponibles:</b><br>__________</td>
        </tr>
    </table>

    <br><br>

    <table>
        <tr>
            <td class="seccion" colspan="2">
                AUTORIZACIÓN
            </td>
        </tr>
        <tr>
            <td class="firma">
                ___________________________<br>
                FIRMA DEL TRABAJADOR
            </td>
            <td class="firma">
                ___________________________<br>
                AUTORIZÓ RECURSOS HUMANOS
            </td>
        </tr>
        <tr>
            <td class="firma" colspan="2">
                ___________________________<br>
                JEFE INMEDIATO
            </td>
        </tr>
    </table>

</page>
';

try {
    $pdf = new Html2Pdf('P', 'A4', 'es');
    $pdf->writeHTML($html);
    $pdf->output('Formato_Vacaciones_'.$id.'.pdf');

} catch (Html2PdfException $e) {
    if (isset($pdf)) {
        $pdf->clean();
    }

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}

mysqli_close($con);
?>

?>






