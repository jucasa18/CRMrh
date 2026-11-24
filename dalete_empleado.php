<?php

	require 'conexion.php';
    $id = $_REQUEST['idempleado'];
    $sql = "UPDATE empleados SET Estatus= 0 WHERE IdDRENC  = '$id'";
 	$resultado = mysqli_query($conexion,$sql);
	if($resultado) {
        echo "ok";
    } else {
        echo "no";
    }

?>