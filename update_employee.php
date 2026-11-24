<?php
session_name("autentific");
session_start();

require 'conexion.php';
/*$sql = "SELECT MAX(IdDRENC) AS id FROM empleados";
$dato = mysqli_query($conexion, $sql);
$respuesta = mysqli_fetch_array($dato, MYSQLI_ASSOC);
$max = (empty($respuesta['id']) ? 1 : $respuesta['id'] += 1);*/
if (isset($_REQUEST["save"]) =='actFt') {
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
	$nuevo_path = "uploads/" . $idUf . "." . $extension;
	move_uploaded_file($tmp_name, $nuevo_path);
	$array = explode('.', $nuevo_path);
	$ext = end($array);
	$sql = "UPDATE empleados SET Foto='$nuevo_path'
	WHERE IdDRENC = '$idUf'";
	$resultado = mysqli_query($conexion,$sql);
	
	$instruccion_SQL="insert into histempleados VALUES ('', '".$_SESSION['id']."', '".$idUf."', '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '',  '', '',  '',  '',  '',  '',  '', '', 
	 '',  '',  '',  '',  '',  '',  '', '',  '',  '',  '',  '',  '',  '',  '',  '',  '', '',  '',  '',  '',  '','','','','','".$nuevo_path."',1,'','".date('Y-m-d H:i:s')."')";
	$resultado2 = mysqli_query($conexion, $instruccion_SQL);	
	
	

	if ($resultado and $resultado2== FALSE) {
		echo "<script>alert(\"Algo salio mal, volver a intentarlo\");window.location='edit_employee.php?idempleado=$idUf';</script>";
	} else
		echo "<script>alert(\"Imagen Actualizada\");window.location='edit_employee.php?idempleado=$idUf';</script>";
		mysqli_close($connexion);

		
   }
   exit();
}

	
        //$id = $_REQUEST['IdDRENC'];

		$id = $_REQUEST['IdDRENC'];
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
		//$Pais = $_REQUEST['Pais'];
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
		$Sexo = $_REQUEST['Empresa'];   
		$Nacionalidad = $_REQUEST['Nacionalidad'];   
		$Estatus = $_REQUEST['Estatus']; 
  	
	/*	echo "insert into histempleados VALUES ('', '".$_SESSION['id']."','".$IdPlanta."', '".$FechaIngreso."', '".$Depto."',  '".$Linea."',  '".$Nomina."',  '".$Puesto."',  '".$Turno."',  '".$Foraneo."',  '".$ApellidoP."',  '".$ApellidoM."',  '".$Nombre."',  '".$Nss."',  '".$Curp."',  '".$Rfc."',  '',  '".$Fnacimiento."',  '".$Sexo."',  '".$EdoNaci."',  '".$CiudadNaci."', '".$Cel."',  '".$Email."',  '".$EdoCivil."',  '".$Hijos."',  '".$NumHijos."',  '".$Beneficiario."', '". $Parentesco."',  '".$CelBeneficiario."',  '".$NivEstudios."',  '".$MedioDifusion."',  '".$Calle."',  '".$Numero."',  '".$Colonia."',  '".$Ciudad."',  '".$Estado."',  '".$CP."',  '',  '".$Empresa."',  '".$IdRecomendador."',  '".$NombreRecomendador."',  '".$Ruta."',  '".$Parada."',  '".$Estatus."',  '".$Infonavit."', '". $CuentaBBVA."',  '".$SueldoMensual."',  '".$SueldoDiario."',  '".$SueldoDiarioText."',  '".$SDI."','".$Nacionalidad."','1','','','".date('Y-m-d H:i:s')."')";
		exit();
	*/
        $sql = "UPDATE empleados SET IdPlanta='$IdPlanta',FechaIngreso='$FechaIngreso',Depto='$Depto',Linea='$Linea',
        Nomina='$Nomina',Puesto='$Puesto',Turno='$Turno',Nombre='$Nombre',ApellidoP='$ApellidoP',
        ApellidoM='$ApellidoM',Fnacimiento='$Fnacimiento',Nss='$Nss',Curp='$Curp',Rfc='$Rfc',
        Turno='$Turno',EdoNaci='$EdoNaci',CiudadNaci='$CiudadNaci',Cel='$Cel',Email='$Email',
        EdoCivil='$EdoCivil',Hijos='$Hijos',NumHijos='$NumHijos',NivEstudios='$NivEstudios',MedioDifusion='$MedioDifusion',
        Beneficiario='$Beneficiario',Parentesco='$Parentesco',CelBeneficiario='$CelBeneficiario',Calle='$Calle',Numero='$Numero',
        Colonia='$Colonia',Ciudad='$Ciudad',Estado='$Estado',CP='$CP',Pais='',
        IdRecomendador='$IdRecomendador',NombreRecomendador='$NombreRecomendador',Ruta='$Ruta',Parada='$Parada',Estatus='$Estatus',
        Infonavit='$Infonavit',CuentaBBVA='$CuentaBBVA',SueldoDiario='$SueldoDiario',SueldoDiarioText='$SueldoDiarioText',SDI='$SDI',
        SueldoMensual='$SueldoMensual',Foraneo='$Foraneo',Empresa='$Empresa',Sexo='$Sexo',Nacionalidad='$Nacionalidad',Estatus='$Estatus'
        WHERE IdDRENC = '$id'";

       // echo  $sql;
        $resultado = mysqli_query($conexion,$sql);
		

		$instruccion_SQL="insert into histempleados VALUES ('', '".$_SESSION['id']."','".$id."','".$IdPlanta."', '".$FechaIngreso."', '".$Depto."',  '".$Linea."',  '".$Nomina."',  '".$Puesto."',  '".$Turno."',  '".$Foraneo."',  '".$ApellidoP."',  '".$ApellidoM."',  '".$Nombre."',  '".$Nss."',  '".$Curp."',  '".$Rfc."',  '',  '".$Fnacimiento."',  '".$Sexo."',  '".$EdoNaci."',  '".$CiudadNaci."', '".$Cel."',  '".$Email."',  '".$EdoCivil."',  '".$Hijos."',  '".$NumHijos."',  '".$Beneficiario."', '". $Parentesco."',  '".$CelBeneficiario."',  '".$NivEstudios."',  '".$MedioDifusion."',  '".$Calle."',  '".$Numero."',  '".$Colonia."',  '".$Ciudad."',  '".$Estado."',  '".$CP."',  '',  '".$Empresa."',  '".$IdRecomendador."',  '".$NombreRecomendador."',  '".$Ruta."',  '".$Parada."',  '".$Estatus."',  '".$Infonavit."', '". $CuentaBBVA."',  '".$SueldoMensual."',  '".$SueldoDiario."',  '".$SueldoDiarioText."',  '".$SDI."','".$Nacionalidad."','1','','','','".date('Y-m-d H:i:s')."')";
		$resultado2 = mysqli_query($conexion, $instruccion_SQL);


		
		if ($resultado and $resultado2== FALSE) {
			echo "<script>alert(\"Algo salio mal, volver a intentarlo\");window.location='edit_employee.php?idempleado=$id';</script>";
		} else
			echo "<script>alert(\"Datos Actualizados\");window.location='edit_employee.php?idempleado=$id';</script>";
			mysqli_close($connexion);
			
	   
		
?>
 
