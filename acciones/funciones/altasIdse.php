<?php
include '../ins/Empleados.php'; 
$tipo = $_REQUEST['tipo'];

if($tipo == 1 ){
   // echo "entro";
    $fInicio = $_REQUEST['FechaInicio'];
    $fFin = $_REQUEST['FechaFin'];
    $altas = AltasIdse($fInicio,$fFin);
    exit();
}elseif($tipo == 2){
    $idempleado = $_REQUEST['idempleado'];
    $altas = ModificacionIDSE($idempleado);
    exit();
}elseif($tipo == 3){
    $idempleado = $_REQUEST['idempleado'];
    $causa = $_REQUEST['causa']; 
    $altas = bajaIDSE($idempleado,$causa);
   
    exit();
}

/*$fechaInicio = '2021-08-28';
$fechaFin = '2023-08-28';*/

function AltasIdse($fechaInicio,$fechaFin){
    $lisEmplAct  = Empleados::empleadosAltaSuaxRango($fechaInicio,$fechaFin);
    $regPat = 'E2387167109';
    $espaciosBlanco6 = '      ';
    $tipoTrabajador = '1';
    $tipoSalario = '0';
    $jornada = '0' ;
    $umf = '000';
    $espaciosBlanco2 = '  ';
    $tipoMovimiento = '08';
    $guia = '00000';
    $espaciosBlanco1 = ' ';
    $iFormato = '9';
	$nombreArchivo = "AltasIdse.txt";
	$archivo = fopen($nombreArchivo, "w");
    foreach ($lisEmplAct as $a_ => $infoRec) {
		//$nombre = nombre($infoRec['ApellidoP'],$infoRec['ApellidoM'],$infoRec['Nombre']);
        $suerdoDiario = str_replace('.', '', $infoRec['SueldoDiario']);

        $escribe = $regPat . str_pad(trim($infoRec['Nss']), 11,' ') . str_pad(trim($infoRec['ApellidoP']), 27,' ') . str_pad(trim($infoRec['ApellidoM']), 27,' ') . str_pad(trim($infoRec['Nombre']), 27,' ') .  str_pad($suerdoDiario, 6, '0', STR_PAD_LEFT) . $espaciosBlanco6 . $tipoTrabajador .  $tipoSalario . $jornada . date("dmY", strtotime($infoRec['FechaIngreso'])) . $umf . $espaciosBlanco2 .  $tipoMovimiento . $guia . str_pad(trim($infoRec['IdDRENC']), 10, '0', STR_PAD_LEFT) . $espaciosBlanco1 . str_pad(trim($infoRec['Curp']), 18,' ') . $iFormato;
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

function ModificacionIDSE($id){
    $infoRec  = Empleados::listaEmpleadobyId($id);
    $regPat = 'E2387167109';
    $espaciosBlanco6 = '      ';
    $tipoTrabajador = '1';
    $tipoSalario = '0';
    $jornada = '0' ;
    $umf = '000';
    $espaciosBlanco2 = '  ';
    $tipoMovimiento = '07';
    $guia = '00000';
    $espaciosBlanco1 = ' ';
    $iFormato = '9';
    $espaciosBlanco5 = '     ';
	$nombreArchivo = "ModificacionIDSE.txt";
	$archivo = fopen($nombreArchivo, "w");
   // foreach ($lisEmplAct as $a_ => $infoRec) {
	   $suerdoDiario = str_replace('.', '', $infoRec['SueldoDiario']);
	   $escribe = $regPat . str_pad(trim($infoRec['Nss']), 11,' ') . str_pad(trim($infoRec['ApellidoP']), 27,' ') . str_pad(trim($infoRec['ApellidoM']), 27,' ') . str_pad(trim($infoRec['Nombre']), 27,' ') .  str_pad($suerdoDiario, 6, '0', STR_PAD_LEFT) . $espaciosBlanco6 .  $espaciosBlanco1 . $tipoSalario . $jornada . date("dmY", strtotime($infoRec['FechaIngreso'])) .  $espaciosBlanco5 .  $tipoMovimiento . $guia . str_pad(trim($infoRec['IdDRENC']), 10, '0', STR_PAD_LEFT) .  $espaciosBlanco1 . str_pad(trim($infoRec['Curp']), 18,' ') . $iFormato;
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

function bajaIDSE($id,$causa){
    $infoRec  = Empleados::listaEmpleadobyId($id);
    $regPat = 'E2387167109';
    $espaciosBlanco6 = '      ';
    $tipoTrabajador = '1';
    $tipoSalario = '0';
    $jornada = '0' ;
    $umf = '000';
    $espaciosBlanco2 = '  ';
    $tipoMovimiento = '02';
    $guia = '00000';
    $espaciosBlanco1 = ' ';
    $iFormato = '9';
    $espaciosBlanco5 = '     ';
    $espaciosBlanco15 = '               ';
	$nombreArchivo = "BajaIDSE.txt";
	$archivo = fopen($nombreArchivo, "w");
   // $causa = '2';
    $espaciosBlanco18 = '                  ';
   // foreach ($lisEmplAct as $a_ => $infoRec) {
    $suerdoDiario = str_replace('.', '', $infoRec['SueldoDiario']);
    $escribe = $regPat . str_pad(trim($infoRec['Nss']), 11,' ') . str_pad(trim($infoRec['ApellidoP']), 27,' ') . str_pad(trim($infoRec['ApellidoM']), 27,' ') . str_pad(trim($infoRec['Nombre']), 27,' ') .  $espaciosBlanco15 . date("dmY", strtotime($infoRec['FechaIngreso'])) . $espaciosBlanco5 . $tipoMovimiento .  $guia  . str_pad(trim($infoRec['IdDRENC']), 10, '0', STR_PAD_LEFT) .  $causa . $espaciosBlanco18 . $iFormato;
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
 
