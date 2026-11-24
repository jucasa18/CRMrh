<?php
include('auth_session.php');
$con = mysqli_connect('localhost:3307', 'root', '', 'rh');
if(isset($_POST['depart'])){
    $departid = mysqli_real_escape_string($con,$_POST['depart']); // department id
    $users_arr = array();
        $sql = "SELECT * FROM paradas WHERE idRuta=".$departid;
        $result = mysqli_query($con,$sql);
        while( $row = mysqli_fetch_array($result) ){
        $userid = $row['id'];
        $name = $row['nombre'];
        $users_arr[] = array("id" => $userid, "name" => $name);
        }
        //}
        // encoding array to json format
       echo json_encode($users_arr);
}else{
        $users_arr = array();       
        $sql = "SELECT *  FROM rutas";
        $result = mysqli_query($con,$sql);
        while( $row = mysqli_fetch_array($result) ){
        $userid = $row['id'];
        $name = $row['nombre'];
        $users_arr[] = array("id" => $userid, "name" => $name);
    }
//}
// encoding array to json format
echo json_encode($users_arr);
}

    mysqli_close($con);
?>
