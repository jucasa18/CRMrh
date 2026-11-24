<?php
include '../funciones/vacaciones.php'; 
$op = $_REQUEST['op'];
$ide = $_REQUEST['ide'];
$tv = $_REQUEST['tv'];
switch ($op) {
    case 'DH':
		$fi = $_REQUEST['fi'];
		$ff = $_REQUEST['ff'];
		//Falta la conexion para checar si hay dias feriados y descansos, que no se cuenten, como vacaciones.
		if($tv != 3){
			$diashabiles = getDiasHabiles($fi, $ff, []); //en el array se pueden poner, el dia feriado y dias de descanso. para cuando alla esa couincidencia.
		}else{
			$diashabiles = getDias($fi, $ff);
		}
		//echo $diashabiles;
			echo json_encode(array(
				'diasH'  => $diashabiles,
			//	'id' => $id,
				//'mensaje' => 'Planta Actualizada',
				// 'names' => $names
			));





        break;
    case 'ALM':
		$planta = editaAlm();		
        break;
	case 'RACK':
		$planta = editaRack();		
		break;
	case 'DEP':
		$planta = editaDep();		
		break;	
	case 'DET':
		$planta = editaDet();		
		break;	
 	case 'PRE':
		$planta = editaPre();		
		break;		
	case 'PROVEE':
		$planta = editaProvee();		
		break;		
}
function editaPL(){
	$planta = new Settings_principal();
	$planta->id 		= $_REQUEST['id'];
	$planta->name 		= $_REQUEST['name'];
	$planta->user_id	= $_SESSION['id'];
	$planta->status		= 1;
	$guradra 			= $planta->editaPL();
	if ($guradra) { 
			echo json_encode(array(
			'all'  => $_POST,
		//	'id' => $id,
			'mensaje' => 'Planta Actualizada',
			// 'names' => $names
		));
	}	
}
function editaAlm(){
	$almacen = new Settings_principal();
	$almacen->ids 		= $_REQUEST['ids'];
	$almacen->name 		= $_REQUEST['name'];
	$almacen->description 		= $_REQUEST['description'];
	//$planta->user_id	= $_SESSION['id'];
	//$planta->status		= 1;
	$guradra 			= $almacen->editaAlm();
	if ($guradra) { 
			echo json_encode(array(
			'all'  => $_POST,
		//	'id' => $id,
			'mensaje' => 'Almacén  Actualizado',
			// 'names' => $names
		));
	}	
}
function editaRack(){
	$rack = new Settings_principal();
	$rack->ids 		= $_REQUEST['ids'];
	$rack->plant_id 			= $_REQUEST['plant_id'];
	$rack->department_id 		= $_REQUEST['department_id'];
	$rack->alm_id 				= $_REQUEST['alm_id'];
	$rack->colum 				= $_REQUEST['colum'];
	$rack->linea 				= $_REQUEST['linea'];
	$rack->description 			= $_REQUEST['description'];
	$rack->user_id 				= $_SESSION['id'];
	$guradra 					= $rack->editaRack();
	
	if ($guradra) { 
			echo json_encode(array(
			'all'  => $_POST,
		//	'id' => $id,
			'mensaje' => 'Rack  Actualizado',
			// 'names' => $names
		));
	}	
}

function editaDep(){
	$dep = new Settings_principal();
	$dep->ids 		= $_REQUEST['ids'];
	$dep->name 			= $_REQUEST['name'];
	$dep->planta_id 		= $_REQUEST['planta_id'];
	$guradra 					= $dep->editaDep();
	
	if ($guradra) { 
			echo json_encode(array(
			'all'  => $_POST,
		//	'id' => $id,
			'mensaje' => 'Departamento  Actualizado',
			// 'names' => $names
		));
	}	
}
function editaDet(){
	$dep = new Settings_principal();
	$dep->ids 				= $_REQUEST['ids'];
	$dep->name 				= $_REQUEST['name'];
	$dep->description 		= $_REQUEST['description'];
	$guradra 				= $dep->editaDet();
	
	if ($guradra) { 
			echo json_encode(array(
			'all'  => $_POST,
		//	'id' => $id,
			'mensaje' => 'Detalle  Actualizado',
			// 'names' => $names
		));
	}	
}
function editaPre(){
	$dep = new Settings_principal();
	$dep->ids 				= $_REQUEST['ids'];
	$dep->name 				= $_REQUEST['name'];
	$dep->description 		= $_REQUEST['description'];
	$guradra 				= $dep->editaPre();
	
	if ($guradra) { 
			echo json_encode(array(
			'all'  => $_POST,
		//	'id' => $id,
			'mensaje' => 'Detalle  Actualizado',
			// 'names' => $names
		));
	}	
}

function editaProvee(){
	$prove = new Settings_principal();
	$prove->ids 					= $_REQUEST['ids'];
	$prove->company 				= $_REQUEST['company'];
	$prove->address 				= $_REQUEST['address'];
	$prove->name 					= $_REQUEST['name'];
	$prove->lastname 				= $_REQUEST['lastname'];
	$prove->email 				= $_REQUEST['email'];
	$prove->phone 					= $_REQUEST['phone'];
	$prove->delivery_times 		= $_REQUEST['delivery_times'];
	$guradra 				= $prove->editaProvee();
	
	if ($guradra) { 
			echo json_encode(array(
			'all'  => $_POST,
		//	'id' => $id,
			'mensaje' => 'Detalle  Actualizado',
			// 'names' => $names
		));
	}	
}

?>