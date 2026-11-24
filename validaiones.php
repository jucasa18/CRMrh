<?php
//include('auth_session.php');
echo "entro";
echo $_GET['dato'];

exit();
$con = mysqli_connect('localhost:3307', 'root', '', 'rh');


if(isset($_POST['dato'])){
    $departid = mysqli_real_escape_string($con,$_POST['dato']); // department id
    $users_arr = array();
       // $sql = "SELECT * FROM paradas WHERE idRuta=".$departid;
       $sql = "SELECT IdDRENC FROM empleados WHERE Nss = '".$departid."' OR  Curp = '".$departid."' OR Rfc= '".$departid."'";
        
        $result = mysqli_query($con,$sql);

       
        if (mysqli_num_rows($results) == 1) {
            echo "<script>alert(\"El empleado se encuentra inactivo\");window.location='empleados.php';</script>";
          // header('Location: empleados.php');
            exit();
        }   

        
}
    mysqli_close($con);
?>
