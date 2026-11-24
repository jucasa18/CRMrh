<?php
	include('auth_session.php');
	date_default_timezone_set('UTC');
	date_default_timezone_set("America/Mexico_City");
    //metodo valido
    $numEmpleado = $_POST["numEmpleado"] ;
    $email = $_POST["email"] ;
    //$password_1 = $_POST["password_1"] ;
    $tipo = $_POST["tipo"] ;
    $planta = $_POST["planta"] ;
    $name = $_POST["name"] ;
    $date = date('Y-m-d H:i:s');

    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    if ($password_1 != $password_2) {
        array_push($errors, "La contraseña no coincide");
      }


		//$con = mysqli_connect("localhost:3307", "admin", 'Dr3nC00QQ!!');
		$con = mysqli_connect('localhost:3307', 'root', '', 'rh');

   
    $sql = "SELECT MAX(id) AS id FROM user";
    $id = mysqli_query($con, $sql);
    $respuesta = mysqli_fetch_array($id, MYSQLI_ASSOC);
    $max = (empty($respuesta['id']) ? 1 : $respuesta['id'] += 1);



        $user_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
        $result = mysqli_query($con, $user_check_query);
        $user = mysqli_fetch_assoc($result);

			 /*if ($resultado == FALSE) {
				echo "<script>alert(\"Algo salio mal, volver a intentarlo\");window.location='empleados.php';</script>";
			} else
				echo "<script>alert(\"Registro exitoso\");window.location='empleados.php';</script>";
			  	mysqli_close($con);
			
            $result = mysqli_query($con, $user_check_query);
            $user = mysqli_fetch_assoc($result);
            
            if ($user) { // if user exists
                if ($user['username'] === $username) {
                array_push($errors, "El usuario ya existe");
                }

                if ($user['email'] === $email) {
                array_push($errors, "El correo ya existe");
                }
            }*/

            // Finally, register user if there are no errors in the form
          /*  if (count($errors) == 0) {
                $password = md5($password_1);//encrypt the password before saving in the database
                

                  	$instruccion_SQL="INSERT INTO user VALUES ('', '".$numEmpleado."', '".$email."', '".$password."',  '".$tipo."',  '".$planta."',  '".$name."',  '".$date."')";
                    $resultado = mysqli_query($con, $instruccion_SQL);
        
                    if ($resultado == FALSE) {
                        echo "<script>alert(\"Algo salio mal, volver a intentarlo\");window.location='empleados.php';</script>";
                    } else
                        echo "<script>alert(\"Registro exitoso\");window.location='empleados.php';</script>";
                          mysqli_close($con);
                
               
                }
*/
//}
if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "El correo ya existe");
      echo "<script>alert(\"Registro exitoso. Proceda a logearse\");window.location='users.php';</script>";
    }
  }
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database
    $query = "INSERT INTO user VALUES ('','".$name."', '".$email."','".$password."','1','".$date."', '".$planta."',  '".$tipo."' ,'".$numEmpleado."')";
    $resultado = mysqli_query($con, $query);
   // echo "INSERT INTO user VALUES ('','".$_SESSION['id']."','".$max."','".$name."', '".$email."','".$password."','1','".$date."', '".$planta."',  '".$tipo."' ,'".$numEmpleado."','".$date('Y-m-d H:i:s')."')";
    $query2 = "INSERT INTO histuser VALUES ('','".$_SESSION['id']."','".$max."','".$name."', '".$email."','".$password."','1','".$date."', '".$planta."',  '".$tipo."' ,'".$numEmpleado."','".date('Y-m-d H:i:s')."')";
    $resultado2 = mysqli_query($con, $query2);
  	$_SESSION['username'] = $username;
        $_SESSION['success'] = "ok";

        echo "<script>alert(\"Registro exitoso.\");window.location='users.php';</script>";
    }



				
?>

