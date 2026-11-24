<?php
require 'conexion.php';
    if (isset($_POST['buscar'])) {
        $buscar = $_POST['clave'];

        $sql = mysqli_query($conexion, "SELECT * FROM product where name like '%" . $buscar . "%' OR description like '%" . $buscar . "%'");
        $registro = array();
        $datos = ($row=mysqli_fetch_array($sql));
        $registro[0]= $row['id'];
        $registro[1]= $row['name'];
        $registro[2]= $row['existence'];
                      
    }
    else{
        echo "No se encontraron productos";
                    
                
    }
?>
