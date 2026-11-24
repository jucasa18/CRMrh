<?php
	
	require 'conexion.php';
	
	$id = $_POST['id'];
	$company = $_POST['company'];
    $address = $_POST['address'];
    $name= $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone= $_POST['phone'];
    $delivery_times= $_POST['delivery_times'];
    
  
	
	
	
	
	
	
	
	$sql = "UPDATE supplier SET name='$name',company='$company',address='$address',name='$name',delivery_times='$delivery_times',
	lastname='$lastname',email='$email',phone='$phone' WHERE id = '$id'";
	$resultado = mysqli_query($conexion,$sql);
	if($resultado) {
        echo "<script>alert(\"Registro exitoso\");window.location='../supplier.php';</script>";
    } else {
        echo "<script>alert(\"Error, vuelve a intentarlo\");window.location='../supplier.php';</script>";
    }
?>
 
