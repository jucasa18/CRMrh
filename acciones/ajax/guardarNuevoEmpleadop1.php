<?php
include('../../auth_session.php');
include_once '../ins/Empleados_principal.php'; 

$empleado = new Empleados_principal();
$empleado->IdDRENC 			    = $_REQUEST['IdDRENC'];
$empleado->IdPlanta 			= $_REQUEST['IdPlanta'];
$empleado->FechaIngreso 	 	= date('Y-m-d',strtotime($_REQUEST['FechaIngreso']));
$empleado->Depto   				= $_REQUEST['Depto'];
$empleado->Linea   				= $_REQUEST['Linea'];
$empleado->Nomina    		 	= $_REQUEST['Nomina'];
$empleado->Puesto 				= $_REQUEST['Puesto'];
$empleado->Turno  				= $_REQUEST['Turno'];
$empleado->Nombre 				= $_REQUEST['Nombre'];
$empleado->ApellidoP 			= $_REQUEST['ApellidoP'];
$empleado->ApellidoM			= $_REQUEST['ApellidoM'];
$empleado->Fnacimiento 			= date('Y-m-d',strtotime($_REQUEST['Fnacimiento']));
$empleado->Nss					= $_REQUEST['Nss'];
$empleado->Curp   				= $_REQUEST['Curp'];
$empleado->Rfc   				= $_REQUEST['Rfc'];
$empleado->Turno    		 	= $_REQUEST['Turno'];
$empleado->EdoNaci			 	= $_REQUEST['EdoNaci'];
$empleado->CiudadNaci  			= $_REQUEST['CiudadNaci'];
$empleado->Cel 					= $_REQUEST['Cel'];
$empleado->Email 				= $_REQUEST['Email'];
$empleado->EdoCivil   			= $_REQUEST['EdoCivil'];
$empleado->Hijos 				= $_REQUEST['Hijos'];
$empleado->NumHijos 			= $_REQUEST['NumHijos'];
$empleado->NivEstudios			= $_REQUEST['NivEstudios'];
$empleado->MedioDifusion 		= '';
$empleado->Beneficiario			= $_REQUEST['Beneficiario'];
$empleado->Parentesco   		= $_REQUEST['Parentesco'];
$empleado->CelBeneficiario   	= $_REQUEST['CelBeneficiario'];
$empleado->Calle     			= $_REQUEST['Calle'];
$empleado->Numero 				= $_REQUEST['Numero'];
$empleado->Colonia  			= $_REQUEST['Colonia'];
$empleado->Ciudad 				= $_REQUEST['Ciudad'];
$empleado->Estado 				= $_REQUEST['Estado'];
$empleado->CP					= $_REQUEST['CP'];
$empleado->IdRecomendador		= '';
$empleado->NombreRecomendador  	= '';
$empleado->Ruta   				= $_REQUEST['Ruta'];
$empleado->Parada    		 	= $_REQUEST['Parada'];
$empleado->Infonavit 			= $_REQUEST['Infonavit'];
$empleado->CuentaBBVA 			= $_REQUEST['CuentaBBVA'];
$empleado->SueldoDiario			= $_REQUEST['SueldoDiario'];
$empleado->SueldoDiarioText 	= $_REQUEST['SueldoDiarioText'];
$empleado->SDI					= $_REQUEST['SDI'];
$empleado->SueldoMensual 		= $_REQUEST['SueldoMensual'];
$empleado->Foraneo 				= $_REQUEST['Foraneo'];
$empleado->Empresa				= $_REQUEST['Empresa'];
$empleado->Sexo 				= $_REQUEST['Sexo'];
$empleado->Nacionalidad			= $_REQUEST['Nacionalidad'];
$empleado->CPF					= $_REQUEST['CPF'];
$empleado->ContactoEme			= $_REQUEST['ContactoEme'];
$empleado->CelEme				= $_REQUEST['CelEme'];
$empleado->Banco				= $_REQUEST['Banco'];
$empleado->Clabe				= $_REQUEST['Clabe'];
$empleado->NumTajeta			= $_REQUEST['NumTajeta'];
//$empleado->Foto			       = $Foto;
//$empleado->FechaCambio			=  date('Y-m-d');
$empleado->IdUsuario			= $_SESSION['id'];
//echo $_SESSION['id'].'</br>';

$guradra 					= $empleado->save();
/*echo $guradra;
exit();*/

$id							= $guradra;
//$id							= 210032802;
$empleado->IdDRENC 			    = $id;
$empleado->IdCorto              = $id;
$idCorto 					= $empleado->editaIdCorto();
if($_FILES['file']['type'] != ""){
	$Foto = imagen($id);
	$empleado->Foto			       = $Foto;
	$fotodir  = $empleado->editaFoto();
	//$guradra2 			   	= $empleado->save2();

}
if ($guradra != "false") { 
	$guradra2 			   	= $empleado->save2();
}

echo json_encode(array(
	'all'  => $_POST,
	'id' => $id,
	//'Foto' => $Foto,
	'mensaje' => 'Empleado agregado correctamente',
	// 'names' => $names
));
//exit();


function imagen($id){

	if (($_FILES["file"]["type"]));
			$type = $_FILES['file']['type'];
			$tmp_name = $_FILES['file']["tmp_name"];
			$image_size = $_FILES['file']['size'];
			$name_image = $_FILES['file']["name"];

			//Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
			if (!((strpos($type, "gif") || strpos($type, "jpeg") || strpos($type, "jpg") || strpos($type, "png")) && ($image_size < 50000000))) {
				//echo "<script>alert(\"Error:el tamaño o archivo no es valido\");window.location='../../empleados.php';</script>";

				echo "Error:el tamaño o archivo no es valido";
				//exit();
			}

			else {
			$extension = pathinfo($name_image, PATHINFO_EXTENSION);
			$nuevo_path = "../../uploads/" . $id . "." . $extension;
			move_uploaded_file($tmp_name, $nuevo_path);
			
		}
		return "uploads/". $id . "." . $extension;
		$array = explode('.', $nuevo_path);
		$ext = end($array);
}

 ?>