<?php
	require 'conexion.php';
    $id = $_REQUEST['iduser'];
    $sql = "UPDATE user SET is_active= 0 WHERE id  = $id";
 	$resultado = mysqli_query($conexion,$sql);
	if($resultado) {
        echo "ok";
    } else {
        echo "no";
    }

?>