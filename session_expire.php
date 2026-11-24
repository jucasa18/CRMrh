<?php

//Comprobamos si esta definida la sesión 'tiempo'.
if(isset($_SESSION['tiempo']) ) {

 //Tiempo en segundos para dar vida a la sesión.
 $inactivo = 1000; //20min en este caso.
 $inicial = $_SESSION["tiempo"];
 $ahora = time();

 //Calculamos tiempo de vida inactivo.
 $vida_session = time() - $_SESSION['tiempo'];

 //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
 if ($vida_session > $inactivo) {
     //Removemos sesión.
     session_unset();
     //Destruimos sesión.
     session_destroy();
     //Redirigimos pagina.
     header("Location: index.php");

     exit();
 }

 $_SESSION['tiempo'] = $ahora;
}
?>