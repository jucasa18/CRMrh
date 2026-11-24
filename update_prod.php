<?php

	require 'conexion.php';
    if (isset($_POST["save"])) {
       
    
	
	$id = $_POST['id'];
    $bc = $_POST['barcode'];
	$name = $_POST['name'];
    $description = $_POST['description'];
    $unit_id = $_POST['unit_id'];
    $price = $_POST['price'];
    $packing_id = $_POST['packing_id'];
    $category_id = $_POST['category_id'];
    $coin_id = $_POST['coin_id'];
    $condi_id = $_POST['condi_id'];
    $plant_id = $_POST['plant_id'];
    $alm_id = $_POST['alm_id'];
    $rack_id = $_POST['rack_id'];
    $supplier_id = $_POST['supplier_id'];
    $tiempoVida = $_POST['tiempoVida'];
    $codigoCompra = $_POST['codigoCompra'];
  
	
	
	
	
	
	
	
	$sql = "UPDATE product SET name='$name',description='$description',barcode='$bc',unit_id='$unit_id',price='$price',
	packing_id='$packing_id',category_id='$category_id',coin_id='$coin_id',condi_id='$condi_id',alm_id='$alm_id',
	plant_id='$plant_id',supplier_id='$supplier_id',rack_id='$rack_id',tiempoVida='$tiempoVida',codigoCompra='$codigoCompra' WHERE id = '$id'";
    
	$resultado = mysqli_query($conexion,$sql);
	if($resultado) {
        echo "<script>alert(\"Registro exitoso\");window.location='products.php';</script>";
    } else {
        echo "<script>alert(\"Error, vuelve a intentarlo\");window.location='products.php';</script>";
    }
}
?>