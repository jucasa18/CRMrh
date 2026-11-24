<?php
require 'conexion.php';
$buscar = $_REQUEST['codigo'];

$sql = mysqli_query($conexion, "SELECT * FROM product where name like '%" . $buscar . "%' OR description like '%" . $buscar . "%'  OR barcode like '%" . $buscar . "%'");
$valores = array();
while($row= mysqli_fetch_object($sql)){
    
    array_push($valores,$row);
}
if($sql){
    echo json_encode(['data' => 'ok','productos' =>$valores]);
    
}
?>
