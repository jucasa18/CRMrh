<?php
include('../../auth_session.php');
include_once '../ins/Empleados_principal.php'; 
	$id = 12354;
	if (($_FILES["file"]["type"]));
			$type = $_FILES['file']['type'];
			$tmp_name = $_FILES['file']["tmp_name"];
			$image_size = $_FILES['file']['size'];
			$name_image = $_FILES['file']["name"];

			//Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
			if (!((strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")) && ($image_size < 50000000))) {
				echo "<script>alert(\"Error:el tamaño o archivo no es valido\");window.location='empleados.php';</script>";
				//exit();
			}
			else {
			$extension = pathinfo($name_image, PATHINFO_EXTENSION);
			$nuevo_path = "../../uploads/" . $id . "." . $extension;
			move_uploaded_file($tmp_name, $nuevo_path);
			$array = explode('.', $nuevo_path);
			$ext = end($array);
		}
	//}
	
echo json_encode(array(
	'all'  => $_POST,
	'id' => $id,
	'mensaje' => 'Empleado agregado correctamente',
	// 'names' => $names
));

 ?>