<?php
date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");



$logFile = fopen("php_error.log", 'a') or die("Error creando archivo");
fwrite($logFile, "\n".date("d/m/Y H:i:s")." Mensaje que se quiera grabar") or die("Error escribiendo en el archivo");fclose($logFile);
?>