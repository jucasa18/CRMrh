<?php	
	//session_start();
	/*Inicia validacion del lado del servidor*/
	include('auth_session.php');
	//include('html2/contrato.php');
	//$con = mysqli_connect('localhost:3307', 'root', '', 'rh');
	$con = mysqli_connect('localhost:3307', 'root', '', 'rh');
	$sql = "SELECT MAX(IdDRENC) AS id FROM empleados";
	$dato = mysqli_query($con, $sql);
	$respuesta = mysqli_fetch_array($dato, MYSQLI_ASSOC);
	$max = (empty($respuesta['id']) ? 1 : $respuesta['id'] += 1);





	if (isset($_REQUEST["save"])) {
		if (($_FILES["file"]["type"]));
		$type = $_FILES['file']['type'];
		$tmp_name = $_FILES['file']["tmp_name"];
		$image_size = $_FILES['file']['size'];
		$name_image = $_FILES['file']["name"];

		 //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
		 if (!((strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")) && ($image_size < 50000000))) {
			echo "<script>alert(\"Error:el tamaño o archivo no es valido\");window.location='empleados.php';</script>";
		 }
		 else {
	
		//$nuevo_path = "uploads/" . $name_image;
		$extension = pathinfo($name_image, PATHINFO_EXTENSION);
		$nuevo_path = "uploads/" . $max . "." . $extension;
	  
		move_uploaded_file($tmp_name, $nuevo_path);
		$array = explode('.', $nuevo_path);
		$ext = end($array);
	   }
	}

	

	//metodo valido
	//$target = $_POST["target"] ;


		// escaping, additionally removing everything that could be (html/javascript-) code
		//$IdDRENC = $_REQUEST['IdDRENC'];
		
		$IdPlanta = $_REQUEST['IdPlanta'];
		$FechaIngreso = date('Y-m-d',strtotime($_REQUEST['FechaIngreso']));
		$Depto = $_REQUEST['Depto'];
		$Linea = $_REQUEST['Linea'];
		$Nomina = $_REQUEST['Nomina'];
		$Puesto = $_REQUEST['Puesto'];
		$Turno = $_REQUEST['Turno'];
		$Nombre = $_REQUEST['Nombre'];
		$ApellidoP = $_REQUEST['ApellidoP'];
		$ApellidoM = $_REQUEST['ApellidoM'];
		$Fnacimiento = date('Y-m-d',strtotime($_REQUEST['Fnacimiento']));
		$Nss = $_REQUEST['Nss'];
		$Curp = $_REQUEST['Curp'];
		$Rfc = $_REQUEST['Rfc'];
		$Turno = $_REQUEST['Turno'];
		$EdoNaci = $_REQUEST['EdoNaci'];
		$CiudadNaci = $_REQUEST['CiudadNaci'];
		$Cel = $_REQUEST['Cel'];
		$Email = $_REQUEST['Email'];
		$EdoCivil = $_REQUEST['EdoCivil'];
		$Hijos = $_REQUEST['Hijos'];
		$NumHijos = $_REQUEST['NumHijos'];
		$NivEstudios = $_REQUEST['NivEstudios'];
		$MedioDifusion = $_REQUEST['MedioDifusion'];
		$Beneficiario = $_REQUEST['Beneficiario'];
		$Parentesco = $_REQUEST['Parentesco'];
		$CelBeneficiario = $_REQUEST['CelBeneficiario'];
		$Calle = $_REQUEST['Calle'];
		$Numero = $_REQUEST['Numero'];
		$Colonia = $_REQUEST['Colonia'];
		$Ciudad = $_REQUEST['Ciudad'];
		$Estado = $_REQUEST['Estado'];
		$CP = $_REQUEST['CP'];
		$Pais = $_REQUEST['Pais'];
		$IdRecomendador = $_REQUEST['IdRecomendador'];
		$NombreRecomendador = $_REQUEST['NombreRecomendador'];
		$Ruta = $_REQUEST['Ruta'];
		$Parada = $_REQUEST['Parada'];
		$Estatus = $_REQUEST['Estatus'];
		$Infonavit = $_REQUEST['Infonavit'];
		$CuentaBBVA = $_REQUEST['CuentaBBVA'];
		$SueldoDiario = $_REQUEST['SueldoDiario'];
		$SueldoDiarioText = $_REQUEST['SueldoDiarioText'];
		$SDI = $_REQUEST['SDI'];
		$SueldoMensual = $_REQUEST['SueldoMensual'];
		$Foraneo = $_REQUEST['Foraneo'];
		$Empresa = $_REQUEST['Empresa'];
		$Sexo = $_REQUEST['Sexo'];
		$Nacionalidad = $_REQUEST['Nacionalidad'];
		$FechaCreacion = date('Y-m-d');
		
		//$con = mysqli_connect("localhost:3307", "admin", 'Dr3nC00QQ!!');
		//$con = mysqli_connect('localhost:3307', 'root', '', 'rh');
		
		/*$is_admin=0;
		if(isset($_POST["is_admin"])){$is_admin=1;}*/
		
			//echo 

			$instruccion_SQL="insert into empleados VALUES ('', '".$IdPlanta."', '".$FechaIngreso."', '".$Depto."',  '".$Linea."',  '".$Nomina."',  '".$Puesto."',  '".$Turno."',  '".$Foraneo."',  '".$ApellidoP."',  '".$ApellidoM."',  '".$Nombre."',  '".$Nss."',  '".$Curp."',  '".$Rfc."',  '',  '".$Fnacimiento."',  '".$Sexo."',  '".$EdoNaci."',  '".$CiudadNaci."', '".$Cel."',  '".$Email."',  '".$EdoCivil."',  '".$Hijos."',  '".$NumHijos."',  '".$Beneficiario."', '". $Parentesco."',  '".$CelBeneficiario."',  '".$NivEstudios."',  '".$MedioDifusion."',  '".$Calle."',  '".$Numero."',  '".$Colonia."',  '".$Ciudad."',  '".$Estado."',  '".$CP."',  '',  '".$Empresa."',  '".$IdRecomendador."',  '".$NombreRecomendador."',  '".$Ruta."',  '".$Parada."',  '".$Estatus."',  '".$Infonavit."', '". $CuentaBBVA."',  '".$SueldoMensual."',  '".$SueldoDiario."',  '".$SueldoDiarioText."',  '".$SDI."','".$Nacionalidad."','1','".$nuevo_path."','".$FechaCreacion."')";

			//$sql="insert into production (codebar,updated_at,created_at,defect_id,user_id,model_id,process_id,color_id,status_id,turn_id) value 
			//(\"$codebar\",\"$updated_at\",\"$created_at\",\"$defect_id\",\"$user_id\",\"$model_id\",\"$process_id\",\"$color_id\",\"$status_id\",\"$turn_id\")";
			$resultado = mysqli_query($con, $instruccion_SQL);


			$instruccion_SQL="insert into histempleados VALUES ('', '".$_SESSION['id']."','".$max."','".$IdPlanta."', '".$FechaIngreso."', '".$Depto."',  '".$Linea."',  '".$Nomina."',  '".$Puesto."',  '".$Turno."',  '".$Foraneo."',  '".$ApellidoP."',  '".$ApellidoM."',  '".$Nombre."',  '".$Nss."',  '".$Curp."',  '".$Rfc."',  '',  '".$Fnacimiento."',  '".$Sexo."',  '".$EdoNaci."',  '".$CiudadNaci."', '".$Cel."',  '".$Email."',  '".$EdoCivil."',  '".$Hijos."',  '".$NumHijos."',  '".$Beneficiario."', '". $Parentesco."',  '".$CelBeneficiario."',  '".$NivEstudios."',  '".$MedioDifusion."',  '".$Calle."',  '".$Numero."',  '".$Colonia."',  '".$Ciudad."',  '".$Estado."',  '".$CP."',  '',  '".$Empresa."',  '".$IdRecomendador."',  '".$NombreRecomendador."',  '".$Ruta."',  '".$Parada."',  '".$Estatus."',  '".$Infonavit."', '". $CuentaBBVA."',  '".$SueldoMensual."',  '".$SueldoDiario."',  '".$SueldoDiarioText."',  '".$SDI."','".$Nacionalidad."','1','".$nuevo_path."','','".$FechaCreacion."','".date('Y-m-d H:i:s')."')";
			$resultado2 = mysqli_query($con, $instruccion_SQL);


			if ($resultado and $resultado2== FALSE) {
				echo "<script>alert(\"Algo salio mal, volver a intentarlo\");window.location='empleados.php';</script>";
			} else{
				//echo "<script>alert(\"Registro exitoso\");window.location='../employee.php';</script>";
				$sql = "SELECT MAX(IdDRENC) AS id FROM empleados";
				$dato = mysqli_query($con, $sql);
				$respuesta = mysqli_fetch_array($dato, MYSQLI_ASSOC);
				$max = (empty($respuesta['id']) ? 1 : $respuesta['id']);
				//creaPDF($max);
				echo "<script>alert(\"Registro exitoso\");window.location='empleados.php';</script>";

			}
			
			  	mysqli_close($con);
				
?>

