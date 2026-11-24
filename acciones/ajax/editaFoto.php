<?php
require '../../conexion.php';
	if (($_FILES["file"]["type"]));
	$type = $_FILES['file']['type'];
	$tmp_name = $_FILES['file']["tmp_name"];
	$image_size = $_FILES['file']['size'];
	$name_image = $_FILES['file']["name"];
	echo $type;
	echo $tmp_name;
	echo $image_size;
	echo $name_image;
	 //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
	 if (!((strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")) && ($image_size < 50000000))) {
		echo "<script>alert(\"Error:el tamaño o archivo no es valido\");window.location='empleados.php';</script>";
	 }
	 else {
	$idUf = $_REQUEST["IdUf"];
	//$nuevo_path = "uploads/" . $name_image;
	$extension = pathinfo($name_image, PATHINFO_EXTENSION);
	$nuevo_path = "uploads/" . $$id. "." . $extension;
	move_uploaded_file($tmp_name, $nuevo_path);
	$array = explode('.', $nuevo_path);
	$ext = end($array);
	$sql = "UPDATE empleados SET Foto='$nuevo_path'
	WHERE IdDRENC = '$idUf'";
	$resultado = mysqli_query($conexion,$sql);
	
	$instruccion_SQL="insert into histempleados VALUES ('', '".$_SESSION['id']."', '".$id."', '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '', '',  '',  '',  '',  '',  '', '', 
	 '',  '',  '',  '',  '',  '',  '', '',  '',  '',  '',  '',  '',  '',  '',  '',  '', '',  '',  '',  '',  '','','','','','".$nuevo_path."',1,'','".date('Y-m-d H:i:s')."')";
	$resultado2 = mysqli_query($conexion, $instruccion_SQL);

	if ($resultado and $resultado2== FALSE) {
		echo json_encode(array(
			'all'  => $_POST,
			'id' => $id,
			'mensaje' => 'Datos actualizados correctamente',
			// 'names' => $names
		));
		
	} else
		echo "<script>alert(\"Imagen Actualizada\");window.location='edit_employee.php?idempleado=$idUf';</script>";
		mysqli_close($connexion);

		
   }
   
}






 ?>