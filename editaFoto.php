<?php
session_name("autentific");
session_start();

require 'conexion.php';
/*$sql = "SELECT MAX(IdDRENC) AS id FROM empleados";
$dato = mysqli_query($conexion, $sql);
$respuesta = mysqli_fetch_array($dato, MYSQLI_ASSOC);
$max = (empty($respuesta['id']) ? 1 : $respuesta['id'] += 1);*/

	if (($_FILES["file"]["type"]));
	$type = $_FILES['file']['type'];
	$tmp_name = $_FILES['file']["tmp_name"];
	$image_size = $_FILES['file']['size'];
	$name_image = $_FILES['file']["name"];
	/*echo $type;
	echo $tmp_name;
	echo $image_size;
	echo $name_image;*/
	
 //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
	 if (!((strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")) && ($image_size < 50000000))) {
		echo "<script>alert(\"Error:el tamaño o archivo no es valido\");window.location='empleados.php';</script>";
	 }
	 else {

	$idUf = $_REQUEST["IdUf"];
	//echo $idUf;
	//$nuevo_path = "uploads/" . $name_image;
	$extension = pathinfo($name_image, PATHINFO_EXTENSION);
	$nuevo_path = "uploads/" . $idUf . "." . $extension;
	//unset($nuevo_path);
	unlink($nuevo_path);
	move_uploaded_file($tmp_name, $nuevo_path);
	$array = explode('.', $nuevo_path);
	$ext = end($array);
	$sql = "UPDATE empleados SET Foto='$nuevo_path'
	WHERE IdDRENC = '$idUf'";
	$resultado = mysqli_query($conexion,$sql);
	//echo $sql;
	$instruccion_SQL="insert into histempleados VALUES ('', '".$_SESSION['id']."', '".$idUf."', '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '', '',  '',  '',  '',  '',  '', '', 
	 '',  '',  '',  '',  '',  '',  '', '',  '',  '',  '',  '',  '',  '',  '',  '',  '', '',  '',  '',  '',  '','','','','','".$nuevo_path."',1,'','".date('Y-m-d H:i:s')."')";
	$resultado2 = mysqli_query($conexion, $instruccion_SQL);	
	
	//echo $instruccion_SQL;

	if ($resultado and $resultado2== FALSE) {
		echo "<script>alert(\"Algo salio mal, volver a intentarlo\");window.location='edit_employee.php?idempleado=$idUf';</script>";
	} else


		echo $idUf;
		//exit();
		
   }
   mysqli_close($conexion);

  /* echo json_encode(array(
	//'all'  => $_POST,
	'id' => $idUf,
	'mensaje' => 'Datos actualizados correctamente',
	// 'names' => $names
));*/



 ?>