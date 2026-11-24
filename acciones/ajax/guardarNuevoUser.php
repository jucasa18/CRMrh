<?php
include('../../auth_session.php');
include_once '../ins/Users_principal.php'; 
include '../ins/Users.php'; 
$email = $_REQUEST['email'];
$ide = $_REQUEST['numEmpleado'];
$user = Users::validaUser($ide,$email);
if ($user) { // if user exists
    if ($user['email'] === $email OR $user['numEmpleado'] === $ide) {
		echo json_encode(array(
			'mensaje' => 'El usuario ya existe',
		));
       
    }
	exit();
  }
    
$pass = $_REQUEST['password_1'];
$password = password_hash($pass, PASSWORD_DEFAULT);//nueva validación para guardar las comtraseñas de los usuarios
$empleado = new Users_principal();
$empleado->name 			    = $_REQUEST['name'];
$empleado->numEmpleado				= $ide;
$empleado->email			= $email;
$empleado->pass			= $password;
$empleado->is_active			= 1;
$empleado->tipo			= $_REQUEST['tipo'];
$empleado->planta			= $_REQUEST['planta'];
$empleado->IdUsuario			= $_SESSION['id'];
$guradar 					= $empleado->save();
if ($guradar) { 
	$ida = users::maxIdEmpleados();
	$idr = $ida['id'];
	$empleado->IdNusuario 			    = $idr;
	$guradar2 			    = $empleado->save2();
	echo json_encode(array(
		'mensaje' => 'Usuario agregado correctamente',
	));
}

 ?>