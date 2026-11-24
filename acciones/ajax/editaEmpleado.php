<?php
include('../../auth_session.php');
include_once '../ins/Empleados_update.php'; 
//Edita los datos del empleado
$empleado = new Empleados_update();
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
//$empleado->MedioDifusion 		= $_REQUEST['MedioDifusion'];
$empleado->Beneficiario			= $_REQUEST['Beneficiario'];
$empleado->Parentesco   		= $_REQUEST['Parentesco'];
$empleado->CelBeneficiario   	= $_REQUEST['CelBeneficiario'];
$empleado->Calle     			= $_REQUEST['Calle'];
$empleado->Numero 				= $_REQUEST['Numero'];
$empleado->Colonia  			= $_REQUEST['Colonia'];
$empleado->Ciudad 				= $_REQUEST['Ciudad'];
$empleado->Estado 				= $_REQUEST['Estado'];
$empleado->CP					= $_REQUEST['CP'];
//$empleado->IdRecomendador		= $_REQUEST['IdRecomendador'];
//$empleado->NombreRecomendador  	= $_REQUEST['NombreRecomendador'];
$empleado->Ruta   				= $_REQUEST['Ruta'];
$empleado->Parada    		 	= $_REQUEST['Parada'];
//$empleado->Estatus 				= $_REQUEST['Estatus'];
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
$empleado->ContactoEme			= $_REQUEST['ContactoEme'];
$empleado->CelEme				= $_REQUEST['CelEme'];
$empleado->Banco				= $_REQUEST['Banco'];
$empleado->Clabe				= $_REQUEST['Clabe'];
$empleado->NumTajeta			= $_REQUEST['NumTajeta'];
$empleado->SueldoEsp			= $_REQUEST['SueldoEsp'];
//$empleado->FechaCambio			=  date('Y-m-d');
$empleado->IdUsuario			= $_SESSION['id'];
$guradra 					= $empleado-> edita();
$id							= $empleado->IdDRENC;
if ($guradra) { //si guarda bien los datos, guarda el historico
	$guradra2 			    = $empleado->save3();
	}
	//envia la respuesta por json
echo json_encode(array(
	'all'  => $_POST,
	'id' => $id,
	'mensaje' => 'Datos actualizados correctamente',
	// 'names' => $names
));

 ?>