<?php
include('auth_session.php');
$con = mysqli_connect('localhost:3307', 'root', '', 'rh');
if(isset($_POST['depart'])){
    $departid = mysqli_real_escape_string($con,$_POST['depart']); // department id
    $users_arr = array();
        $sql = "SELECT * FROM lineas WHERE idArea=".$departid;
        $result = mysqli_query($con,$sql);
        while( $row = mysqli_fetch_array($result) ){
        $userid = $row['Id'];
        $name = $row['Nombre'];
        $users_arr[] = array("id" => $userid, "name" => $name);
        }
        //}
        // encoding array to json format
       echo json_encode($users_arr);
}else{
        $users_arr = array();       
        $sql = "SELECT *  FROM areas";
        $result = mysqli_query($con,$sql);
        while( $row = mysqli_fetch_array($result) ){
        $userid = $row['Id'];
        $name = $row['Nombre'];
        $users_arr[] = array("id" => $userid, "name" => $name);
    }
//}
// encoding array to json format
echo json_encode($users_arr);
}

    mysqli_close($con);
?>
