
<?php
ob_start();

error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

require_once dirname(__FILE__) . '/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

// ==========================================
// CONEXIÓN
// ==========================================

$con = mysqli_connect('localhost', 'root', '', 'rh');

if (!$con) {
    die('Error de conexión: ' . mysqli_connect_error());
}

mysqli_set_charset($con, 'utf8mb4');

// ==========================================
// FUNCIONES DE FECHA
// ==========================================

function fechaEsDia($fecha)
{
    return date('d', strtotime($fecha));
}

function fechaEsMes($fecha)
{
    $meses = array(
        1 => 'enero',
        2 => 'febrero',
        3 => 'marzo',
        4 => 'abril',
        5 => 'mayo',
        6 => 'junio',
        7 => 'julio',
        8 => 'agosto',
        9 => 'septiembre',
        10 => 'octubre',
        11 => 'noviembre',
        12 => 'diciembre'
    );

    return $meses[(int)date('n', strtotime($fecha))];
}

function fechaEsAnio($fecha)
{
    return date('Y', strtotime($fecha));
}

// ==========================================
// FUNCIÓN PARA FORMATEAR SUELDO
// ==========================================

function Sueldo($cantidad)
{
    return '$' . number_format((float)$cantidad, 2, '.', ',');
}

// ==========================================
// OBTENER IDENTIFICADORES
// ==========================================

$IdDRENC = isset($_REQUEST['idempleado'])
    ? (int)$_REQUEST['idempleado']
    : 0;

$id = isset($_REQUEST['id'])
    ? (int)$_REQUEST['id']
    : 0;

if ($IdDRENC <= 0 || $id <= 0) {
    die('ID de empleado o incidencia no válido.');
}

// ==========================================
// CONSULTAR EMPLEADO
// ==========================================

$query = "SELECT *
          FROM empleados
          WHERE IdDRENC = ?";

$stmt = mysqli_prepare($con, $query);

if (!$stmt) {
    die('Error en consulta de empleado: ' . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "i", $IdDRENC);
mysqli_stmt_execute($stmt);

$results = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($results);

mysqli_stmt_close($stmt);

if (!$row) {
    die('No se encontró el empleado.');
}

// ==========================================
// CONSULTAR INCIDENCIA
// ==========================================

$query2 = "SELECT *
           FROM incidencias
           WHERE id = ?";

$stmt2 = mysqli_prepare($con, $query2);

if (!$stmt2) {
    die('Error en consulta de incidencia: ' . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt2, "i", $id);
mysqli_stmt_execute($stmt2);

$results2 = mysqli_stmt_get_result($stmt2);
$row2 = mysqli_fetch_assoc($results2);

mysqli_stmt_close($stmt2);

if (!$row2) {
    die('No se encontró la incidencia.');
}

// ==========================================
// OBTENER DATOS
// ==========================================

$Dia = fechaEsDia($row2['FechaCreacion']);
$Mes = fechaEsMes($row2['FechaCreacion']);
$Anios = fechaEsAnio($row2['FechaCreacion']);

$FechaIncidencia = $row2['FechaIncidencia'];
$Sueldo0 = $row2['SueldoMensual'];

$Nombre = $row['Nombre'];
$Puesto = $row['Puesto'];
$IdDRENC = $row['IdDRENC'];
$IdPlanta = $row['IdPlanta'];
$Motivo = $row2['Motivo'];
$Nomina = $row['Nomina'];

$Sueldo = Sueldo($Sueldo0);

// ==========================================
// PROTEGER DATOS PARA HTML
// ==========================================

function limpiar($dato)
{
    return htmlspecialchars(
        (string)($dato ?? ''),
        ENT_QUOTES,
        'UTF-8'
    );
}

$Nombre = limpiar($Nombre).' '. limpiar($ApellidoP);
$Puesto = limpiar($Puesto);
$IdDRENC = limpiar($IdDRENC);
$IdPlanta = 'PL'.limpiar($IdPlanta);
$Motivo = limpiar($Motivo);
$Nomina = limpiar($Nomina);
$FechaIncidencia = !empty($FechaIncidencia)
    ? date('d/m/Y', strtotime($FechaIncidencia))
    : '';

$fechaDocumento = $Dia . ' de ' . $Mes . ' de ' . $Anios;

// ==========================================
// CONSTRUCCIÓN DEL DOCUMENTO
// ==========================================

$html = '
<style>

    body {
        font-family: helvetica;
        font-size: 11px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        border-spacing: 0;
        margin: 0;
    }

    td {
        width: 50%;
        padding: 10px;
        border: 1px solid #777777;
        vertical-align: middle;
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
        background-color: #dddddd;
        font-weight: bold;
        padding: 9px;
        text-align: left;
    }

    .firma {
        text-align: center;
        padding-top: 45px;
        padding-bottom: 15px;
    }

    .texto {
        text-align: justify;
        line-height: 1.5;
    }

</style>

<page backtop="15mm" backbottom="15mm"
      backleft="8mm" backright="8mm">

    <p class="titulo">DR ENC, S.A. DE C.V.</p>

    <p class="subtitulo">
        SOLICITUD Y AUTORIZACIÓN DE PERMISO
    </p>

    <p class="subtitulo">RECURSOS HUMANOS</p>

    <br>

    <!-- DATOS DEL TRABAJADOR -->

    <table>
        <tr>
            <td class="seccion" colspan="2">
                DATOS DEL TRABAJADOR
            </td>
        </tr>

        <tr>
            <td>
                <b>Nombre:</b><br>'.$Nombre.'
            </td>

            <td>
                <b>Número de empleado:</b><br>'.$IdDRENC.'
            </td>
        </tr>

        <tr>
            <td>
                <b>Puesto:</b><br>'.$Puesto.'
            </td>

            <td>
                <b>Planta:</b><br>'.$IdPlanta.'
            </td>
        </tr>

        <tr>
            <td>
                <b>Nómina:</b><br>'.$Nomina.'
            </td>

            <td>
                <b>Sueldo:</b><br>'.$Sueldo.'
            </td>
        </tr>
    </table>

    <br>

    <!-- DATOS DEL PERMISO -->

    <table>
        <tr>
            <td class="seccion" colspan="2">
                DATOS DEL PERMISO
            </td>
        </tr>

        <tr>
            <td>
                <b>Fecha de solicitud:</b><br>'.$fechaDocumento.'
            </td>

            <td>
                <b>Fecha de incidencia:</b><br>'.$FechaIncidencia.'
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <b>Motivo del permiso:</b><br>'.$Motivo.'
            </td>
        </tr>
    </table>

    <br>

    <!-- AUTORIZACIÓN -->

    <table>
        <tr>
            <td class="seccion" colspan="2">
                AUTORIZACIÓN
            </td>
        </tr>

        <tr>
            <td class="firma">
                ______________________________<br>
                FIRMA DEL TRABAJADOR
            </td>

            <td class="firma">
                ______________________________<br>
                AUTORIZÓ RECURSOS HUMANOS
            </td>
        </tr>

        <tr>
            <td class="firma" colspan="2">
                ______________________________<br>
                JEFE INMEDIATO
            </td>
        </tr>
    </table>

</page>
';

// ==========================================
// GENERAR PDF
// ==========================================

try {

    $pdf = new Html2Pdf('P', 'A4', 'es');

    $pdf->writeHTML($html);

    mysqli_close($con);

    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    $pdf->output('Formato_Permiso_'.$id.'.pdf');

} catch (Html2PdfException $e) {

    if (isset($pdf)) {
        $pdf->clean();
    }

    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    echo (new ExceptionFormatter($e))->getHtmlMessage();

} catch (Throwable $e) {

    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    echo 'Error al generar PDF: ' . htmlspecialchars(
        $e->getMessage(),
        ENT_QUOTES,
        'UTF-8'
    );
}
?>
