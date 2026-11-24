<?php
include('auth_session.php');
$con = mysqli_connect('localhost:3307', 'root', '', 'rh');
$dato =$_REQUEST['dato'];
if(isset($dato)){
    $departid = mysqli_real_escape_string($con,$dato); // department id
    $users_arr = array();
       // $sql = "SELECT * FROM paradas WHERE idRuta=".$departid;
       $sql = "SELECT IdDRENC FROM empleados WHERE Nss = '".$departid."' OR  Curp = '".$departid."' OR Rfc= '".$departid."'";
       $results = mysqli_query($con, $sql);
       // echo mysqli_num_rows($results);
      
        if (mysqli_num_rows($results) > 0) {
          echo "inn";            
        }   

        
}
    mysqli_close($con);
?>
