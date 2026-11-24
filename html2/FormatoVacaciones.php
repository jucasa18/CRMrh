
<?php
// Evitar errores de salida antes de generar el PDF
ob_start();

error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

require_once dirname(__FILE__) . '/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

// ==========================================
// CONEXIÓN A BASE DE DATOS
// ==========================================

$con = mysqli_connect('localhost', 'root', '', 'rh');

if (!$con) {
    die('Error de conexión: ' . mysqli_connect_error());
}

mysqli_set_charset($con, 'utf8mb4');

// ==========================================
// OBTENER IDENTIFICADORES
// ==========================================

$IdDRENC = isset($_GET['IdDRENC']) ? (int)$_GET['IdDRENC'] : 0;
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($IdDRENC <= 0 || $id <= 0) {
    die('ID de empleado o solicitud no válido.');
}

// ==========================================
// CONSULTAR EMPLEADO
// ==========================================

$sql = "SELECT IdDRENC, Nombre, ApellidoP, ApellidoM,
               FechaIngreso, Puesto
        FROM empleados
        WHERE IdDRENC = ? AND Estatus = 1";

$stmt = mysqli_prepare($con, $sql);

if (!$stmt) {
    die('Error al preparar consulta de empleado: ' . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "i", $IdDRENC);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);

if (!$row) {
    die('No se encontró el empleado.');
}

// ==========================================
// CONSULTAR SOLICITUD DE VACACIONES
// ==========================================

$sql2 = "SELECT *,
                EXTRACT(DAY FROM FechaCreacion) AS dia,
                EXTRACT(MONTH FROM FechaCreacion) AS mes,
                EXTRACT(YEAR FROM FechaCreacion) AS anio
         FROM vacaciones
         WHERE id = ?";

$stmt2 = mysqli_prepare($con, $sql2);

if (!$stmt2) {
    die('Error en consulta de vacaciones: ' . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt2, "i", $id);
mysqli_stmt_execute($stmt2);

$resultado2 = mysqli_stmt_get_result($stmt2);
$row2 = mysqli_fetch_assoc($resultado2);

mysqli_stmt_close($stmt2);

if (!$row2) {
    die('No se encontró la solicitud de vacaciones.');
}

// ==========================================
// DATOS DEL EMPLEADO
// ==========================================

$nombre = htmlspecialchars(
    trim(
        $row['Nombre'] . ' ' .
        $row['ApellidoP'] . ' ' .
        $row['ApellidoM']
    ),
    ENT_QUOTES,
    'UTF-8'
);

$puesto = htmlspecialchars(
    $row['Puesto'] ?? '',
    ENT_QUOTES,
    'UTF-8'
);

$numeroEmpleado = htmlspecialchars(
    (string)$row['IdDRENC'],
    ENT_QUOTES,
    'UTF-8'
);

$fechaIngreso = !empty($row['FechaIngreso'])
    ? date('d/m/Y', strtotime($row['FechaIngreso']))
    : '';

// ==========================================
// DATOS DE LA SOLICITUD
// ==========================================

$fechaSolicitud = !empty($row2['FechaCreacion'])
    ? date('d/m/Y', strtotime($row2['FechaCreacion']))
    : '';

$dia = $row2['dia'] ?? '';
$mes = $row2['mes'] ?? '';
$anio = $row2['anio'] ?? '';

$diasSolicitados = htmlspecialchars(
    (string)($row2['DiasPedidos'] ?? ''),
    ENT_QUOTES,
    'UTF-8'
);

$fechaInicio = !empty($row2['FechaInicio'])
    ? date('d/m/Y', strtotime($row2['FechaInicio']))
    : '';

$fechaFin = !empty($row2['FechaFin'])
    ? date('d/m/Y', strtotime($row2['FechaFin']))
    : '';

$estatus = htmlspecialchars(
    (string)($row2['Estatus'] ?? ''),
    ENT_QUOTES,
    'UTF-8'
);

// ==========================================
// CONSTRUCCIÓN DEL HTML
// ==========================================

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

    /* TODAS LAS TABLAS A TODO EL ANCHO */
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

    /* ENCABEZADOS DE SECCIÓN */
    .seccion {
        width: 100%;
        background-color: #dddddd;
        font-weight: bold;
        padding: 9px;
        text-align: left;
    }

    /* TÍTULOS */
    .titulo {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }

    .subtitulo {
        text-align: center;
        font-size: 12px;
    }

    /* FIRMAS */
    .firma {
        text-align: center;
        padding-top: 45px;
        padding-bottom: 15px;
    }
</style>



<page backtop="15mm" backbottom="15mm"
      backleft="8mm" backright="8mm">

    <p class="titulo">DR ENC, S.A. DE C.V.</p>

    <p class="subtitulo">
        SOLICITUD Y AUTORIZACIÓN DE VACACIONES
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
                <b>Nombre:</b><br>'.$nombre.'
            </td>

            <td>
                <b>Número de empleado:</b><br>'.$numeroEmpleado.'
            </td>
        </tr>

        <tr>
            <td>
                <b>Puesto:</b><br>'.$puesto.'
            </td>

            <td>
                <b>Fecha de ingreso:</b><br>'.$fechaIngreso.'
            </td>
        </tr>
    </table>

    <br>

    <!-- PERIODO VACACIONAL -->

    <table>
        <tr>
            <td class="seccion" colspan="2">
                PERIODO VACACIONAL
            </td>
        </tr>

        <tr>
            <td>
                <b>Fecha de solicitud:</b><br>'.$fechaSolicitud.'
            </td>

            <td>
                <b>Días solicitados:</b><br>'.$diasSolicitados.'
            </td>
        </tr>

        <tr>
            <td>
                <b>Fecha de inicio:</b><br>'.$fechaInicio.'
            </td>

            <td>
                <b>Fecha de término:</b><br>'.$fechaFin.'
            </td>
        </tr>

       
    </table>

    <br><br>

    <!-- AUTORIZACIÓN -->

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

// ==========================================
// GENERAR PDF
// ==========================================

try {

    $pdf = new Html2Pdf('P', 'A4', 'es');

    $pdf->writeHTML($html);

    mysqli_close($con);

    // Limpiar cualquier salida antes de enviar el PDF
    while (ob_get_level() > 0) {
        ob_end_clean();
    }

    $pdf->output('Formato_Vacaciones_'.$id.'.pdf');

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
