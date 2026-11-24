<?php
include('auth_session.php');
date_default_timezone_set('UTC');
date_default_timezone_set("America/Mexico_City");
//metodo valido
$target = $_POST["target"] ;
$name = $_POST["name"] ;
$posit = $_POST["posit"] ;
$planta = $_POST["planta"] ;
$date = date('Y-m-d');



$connexion = mysqli_connect("localhost:3307", "admin", 'Dr3nC00QQ!!');

if (mysqli_connect_errno()) {

    echo "Hubo un problema con la base de datos error al conectar";

    exit();
}

mysqli_select_db($connexion, "almacen") or die("No se encuentra la Base de 
 datos");

mysqli_set_charset($connexion, "utf8");


$instruccion_SQL = "INSERT INTO employee (target,name,posit,created_at,user_id,planta_id)
  VALUES ('$target','$name','$posit','$date','".$_SESSION['id']."','$planta')";



$resultado = mysqli_query($connexion, $instruccion_SQL);

if ($resultado == FALSE) {
    echo "<script>alert(\"Algo salio mal, volver a intentarlo\");window.location='../employee.php';</script>";
} else
    echo "<script>alert(\"Registro exitoso\");window.location='../employee.php';</script>";
  
    



    mysqli_close($connexion);
?>
