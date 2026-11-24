<?php
include '../ins/Empleados.php'; 
$tipo = $_REQUEST['tipo'];

if($tipo == 1 ){
   // echo "entro";
    $fInicio = $_REQUEST['FechaInicio'];
    $fFin = $_REQUEST['FechaFin'];
    $altas = AltasSua($fInicio,$fFin);
    exit();
}elseif($tipo == 2){
    $idempleado = $_REQUEST['idempleado'];
    $altas = ModificacionSua($idempleado);
    exit();
}elseif($tipo == 3){
    $idempleado = $_REQUEST['idempleado'];
    $altas = bajaSua($idempleado);
    exit();
}

/*$fechaInicio = '2021-08-28';
$fechaFin = '2023-08-28';*/

function AltasSua($fechaInicio,$fechaFin){
    $lisEmplAct  = Empleados::empleadosAltaSuaxRango($fechaInicio,$fechaFin);
    $regPat = 'E2387167109';
    $tipoTrabajador = '1';
    $jornada = '0' ;
    $espaciosBlanco27 ='                           '; 
    $espaciosBlanco1 = ' ';
    $ceros8 = '00000000';   
   	$espaciosBlanco6 = '      ';
	$tipoSalario = '2';	
	$nombreArchivo = "AltasSUA.txt";
	$archivo = fopen($nombreArchivo, "w");
    foreach ($lisEmplAct as $a_ => $infoRec) {
		
		$nombre = nombre($infoRec['ApellidoP'],$infoRec['ApellidoM'],$infoRec['Nombre']);
        $suerdoDiario = str_replace('.', '', $infoRec['SueldoDiario']);
/*echo $regPat;
echo $infoRec['Nss'];
echo trim($infoRec['Rfc']);
echo trim($infoRec['Curp']);
echo $nombre;
echo $tipoTrabajador;
echo $jornada;
echo date("dmY", strtotime($infoRec['FechaIngreso']));
echo $infoRec['SueldoDiario'];
echo $espaciosBlanco27;
echo strtotime($infoRec['FechaIngreso']);
echo $espaciosBlanco1;
echo $ceros8;
 
echo '</br>';*/
      // echo $regPat . trim($infoRec['Nss']) . trim($infoRec['Rfc']) . trim($infoRec['Curp']) . str_pad($nombre, 50) .  $tipoTrabajador . $jornada . date("dmY", strtotime($infoRec['FechaIngreso'])) . str_pad($suerdoDiario, 7, '0', STR_PAD_LEFT)  . $espaciosBlanco27 . strtotime($infoRec['FechaIngreso']) . $espaciosBlanco1 . $ceros8 .' temina</br>';
	   
	   $escribe = $regPat . str_pad(trim($infoRec['Nss']), 11,' ') . str_pad(trim($infoRec['Rfc']), 13,' ') . str_pad(trim($infoRec['Curp']), 18,' ') . str_pad($nombre, 50) .  $tipoTrabajador . $jornada . date("dmY", strtotime($infoRec['FechaIngreso'])) . str_pad($suerdoDiario, 7, '0', STR_PAD_LEFT)  . $espaciosBlanco27 . date("dmY", strtotime($infoRec['FechaIngreso'])) . $espaciosBlanco1 . $ceros8;

   
	
	fwrite($archivo, $escribe . PHP_EOL);

    }
fclose($archivo);

$nombreArchivo2 = basename($nombreArchivo);

# Algunos encabezados que son justamente los que fuerzan la descarga
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=$nombreArchivo2");
ob_clean();
flush();
# Leer el archivo y sacarlo al navegador
readfile($nombreArchivo);
# No recomiendo imprimir más cosas después de esto
exit();
}

function ModificacionSua($id){
    $infoRec  = Empleados::listaEmpleadobyId($id);
    $regPat = 'E2387167109';
    $tipoMovimiento = '07';
    $ceros8 = '00000000';  
    $espaciosBlanco8 = '        ';
    $espaciosBlanco3 = '   ';
    $ceros3 = '000'; 
	$nombreArchivo = "ModificacionSUA.txt";
	$archivo = fopen($nombreArchivo, "w");
   // foreach ($lisEmplAct as $a_ => $infoRec) {
	   $suerdoDiario = str_replace('.', '', $infoRec['SueldoDiario']);
	   $escribe = $regPat . str_pad(trim($infoRec['Nss']), 11,' ') . $tipoMovimiento  . date("dmY", strtotime($infoRec['FechaIngreso'])) . $espaciosBlanco8  . $ceros3 . str_pad($suerdoDiario, 6, '0', STR_PAD_LEFT);
	fwrite($archivo, $escribe . PHP_EOL);

   // }
fclose($archivo);

$nombreArchivo2 = basename($nombreArchivo);

# Algunos encabezados que son justamente los que fuerzan la descarga
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=$nombreArchivo2");
ob_clean();
flush();
# Leer el archivo y sacarlo al navegador
readfile($nombreArchivo);
# No recomiendo imprimir más cosas después de esto
exit();
}

function bajaSua($id){
    $infoRec  = Empleados::listaEmpleadobyId($id);
    $regPat = 'E2387167109';
    $tipoMovimiento = '02';
    $ceros9 = '00000000';  
    $espaciosBlanco8 = '        ';
    $ceros9 = '000000000'; 
	$nombreArchivo = "BajaSUA.txt";
	$archivo = fopen($nombreArchivo, "w");
   // foreach ($lisEmplAct as $a_ => $infoRec) {
	   $escribe = $regPat . str_pad(trim($infoRec['Nss']), 11,' ') . $tipoMovimiento  . date("dmY", strtotime($infoRec['FechaIngreso'])) . $espaciosBlanco8  . $ceros9;
	   fwrite($archivo, $escribe . PHP_EOL);

   // }
fclose($archivo);

$nombreArchivo2 = basename($nombreArchivo);

# Algunos encabezados que son justamente los que fuerzan la descarga
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=$nombreArchivo2");
ob_clean();
flush();
# Leer el archivo y sacarlo al navegador
readfile($nombreArchivo);
# No recomiendo imprimir más cosas después de esto
exit();
}
function nombre($apellidoP, $apellidoM, $nombre ){
    $nombre = $apellidoP . "$" . $apellidoM . "$" . $nombre;
    //$nombre =str_replace(' ', '', $nombre);
   /* $caracteres = strlen($nombre);
    if($caracteres < 50){
        $rellena = 50 - $caracteres;
        $rellena2  = " ";
        $rellena3  = "";
      for($i = 1; $i < $rellena; $i++){
            $rellena3 = $rellena3 . $rellena2;
      }
        $nombre =  $nombre . $rellena3 ;
       // $nombre =str_replace('', ' ', $nombre);
        //echo $nombre;
    }else{
        $nombre =  substr($nombre, 0, 50);
    }*/
    $nombre = eliminar_acentos($nombre);
   // $nombre = strtoupper($nombre); 
    return $nombre;
}
function eliminar_acentos($cadena){
		
    //Reemplazamos la A y a
    $cadena = str_replace(
    array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
    array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
    $cadena
    );

    //Reemplazamos la E y e
    $cadena = str_replace(
    array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
    array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
    $cadena );

    //Reemplazamos la I y i
    $cadena = str_replace(
    array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
    array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
    $cadena );

    //Reemplazamos la O y o
    $cadena = str_replace(
    array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
    array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
    $cadena );

    //Reemplazamos la U y u
    $cadena = str_replace(
    array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
    array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
    $cadena );

    //Reemplazamos la N, n, C y c
    $cadena = str_replace(
    array('Ñ', 'ñ', 'Ç', 'ç'),
    array('N', 'n', 'C', 'c'),
    $cadena
    );
    
    return $cadena;
}


/*$juana = nombre('castillo','sánchez','juana');
echo $juana;*/
 /*$juana = AltasSua('2021-08-28','2023-08-28');
 echo $juana;*/
?>
 
