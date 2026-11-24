<?php
/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */
require_once dirname(__FILE__).'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
$id= $_GET['idempleado'];
creaPDF($id);
function creaPDF($id){ 

    $Dia = fechaEsDia(date("Y-m-d"));
    $Mes = fechaEsMes(date("Y-m-d"));
    $Anios = fechaEsAnio(date("Y-m-d"));

    $con = mysqli_connect('localhost:3307', 'root', '', 'rh');
    $SQL = "SELECT * FROM empleados WHERE IdDRENC='$id'";
    $resultado = mysqli_query($con, $SQL);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);
                $content='
                <style type="text/css">

                .txt {
                    font-family: helvetica;
                    font-size: 16px; 
                    margin: 40px;
                    font-stretch: condensed;
                    text-align: justify;
                    line-height: 1.3;
                }

                .titulos{
                    text-align: center;  
                    font-weight: bold; 
                    margin-top: 10px;
                }

                .titulos2{
                    font-weight: bold; 
                    margin-left: -20px;
                }
                </style>

                    
                <page style="font-size: 10pt">
                <div class="txt">
                    <p style="text-align: right;">
                        FARH-25-00
                    </p>
                    <p style="text-align: right;">
                              QUERETARO,QRO.  A <b>'.$Dia.'</b>  DE  <b>'.$Mes.'</b>   DEL <b>'.$Anios.'</b>
                    </p>
                    <p class="titulos">
                        <u>CARTA DE RENUNCIA</u>
                        </p>

                    <p>
                    <b>PRESENTE.</b> <br>
                    Estimados señores:<br>
                    
                    </p>    

                       <p>                        
                                 Por este medio y por así convenir a mis necesidades, yo <b>'.$row['ApellidoP'].'</b> <b>'.$row['ApellidoM'].'</b> <b>'.$row['Nombre'].'</b> manifiesto a ustedes mi deseo y decisión de terminar voluntariamente el Contrato Individual de Trabajo que tengo celebrado con esta empresa, de la que he decidido separarme laboralmente de una manera definitiva.
                       </p>
                       <p>                        
                          Hago constar que mi renuncia obedece exclusivamente a mi libre y espontánea voluntad y por así convenir a mis particulares intereses.  Lo anterior, basado en los términos de los Arts. 22, 53 Fracción I, 76, 79, 80, 87, 162 Fracciones I, II y III, 123, 939 y 987 en su Párrafo Segundo de la Ley Federal del Trabajo.
                       </p>
                       <p>                        
                             Aprovecho la oportunidad para hacerles constar que al momento de mi separación y hasta la fecha, tengo cubiertos todos y cada uno de los derechos laborales que me corresponden, no adeudándoseme en consecuencia ninguna cantidad por concepto de horas extraordinarias, séptimos días, días festivos, vacaciones devengadas ni proporcionales, primas por vacaciones devengadas y proporcionales, aguinaldos devengados y proporcionales, primas de antigüedad y dominicales, ni ningún otro concepto laboral o contractual generado a mi favor con motivo de mi relación laboral.
                       </p>
                       <p>                        
                       Así mismo, hago constar que al momento de mi separación voluntaria al empleo que hasta el día de hoy venía desempeñando, no padezco enfermedad profesional alguna ni he sufrido ningún accidente de trabajo, durante el tiempo que perduró la prestación de mis servicios, no reservándome en consecuencia ningún derecho presente ni futuro que ejercer en su contra.
                       </p>
                       <p>                        
                       Agradezco todas y cada una de las atenciones brindadas a mi persona para el buen desempeño de las labores a mi, encomendadas en el tiempo que laboré para ustedes.
                       </p>
                       <p class="titulos">
                       A T E N T A M E N T E
                       </p>
                       <p style="text-align: center;">             
                       
                       ________________________________________          &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;                          __________<br>
                       &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;    &nbsp;&nbsp;  &nbsp;&nbsp;     NOMBRE Y FIRMA  &nbsp;&nbsp;    &nbsp;&nbsp; &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp;  &nbsp;&nbsp; Huella<br>
                                      

                      
                       </p>

                      
        </div>
        </page>   
                 ';


                try {
                    ob_start();
                    /// include 'contratotxt.php';
                    //$content = ob_get_clean();

                    $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(15, 5, 15, 5));
                    $html2pdf->pdf->SetDisplayMode('fullpage');
                    $html2pdf->writeHTML($content);
                    //$html2pdf->output(dirname(__FILE__).'/contratos/'.$id.'.pdf','f'); //ponerlo si queremos guardar el documento PDF
                    $html2pdf->output('contrato'.$id.'.pdf');
                   
                } catch (Html2PdfException $e) {
                    $html2pdf->clean();
                    $formatter = new ExceptionFormatter($e);
                    echo $formatter->getHtmlMessage();
    }

}

function fechaEs($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    $dia = date('l', strtotime($fecha));
    $mes = date('F', strtotime($fecha));
    $anio = date('Y', strtotime($fecha));
    $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
    $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $nombredia = str_replace($dias_EN, $dias_ES, $dia);
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}


function fechaEsDia($fecha) {
    $fecha = substr($fecha, 0, 10);
    $numeroDia = date('d', strtotime($fecha));
    return $numeroDia;
}

function fechaEsMes($fecha) {
    $fecha = substr($fecha, 0, 10);
    $mes = date('F', strtotime($fecha));
    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
    return $nombreMes;
}
function fechaEsAnio($fecha) {
    $anio = date('Y', strtotime($fecha));
    return $anio;
}