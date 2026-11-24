<?php
include('auth_session.php');
//metodo valido
$name = $_POST["name"] ;
$description = $_POST["description"] ;



;
$connexion = mysqli_connect("localhost:3307", "admin", 'Dr3nC00QQ!!');

if (mysqli_connect_errno()) {

    echo "Hubo un problema con la base de datos error al conectar";

    exit();
}

mysqli_select_db($connexion, "almacen") or die("No se encuentra la Base de 
 datos");

mysqli_set_charset($connexion, "utf8");


$instruccion_SQL = "INSERT INTO detail_operation (name,description,user_id)
  VALUES ('$name','$description','".$_SESSION['id']."')";



$resultado = mysqli_query($connexion, $instruccion_SQL);

if ($resultado == FALSE) {
    echo "<script>alert(\"Algo salio mal,volver a intentar\");window.location='../extras.php';</script>";
} else
    
    echo "<script>alert(\"Registro exitoso\");window.location='../extras.php';</script>";



    mysqli_close($connexion);
?>
