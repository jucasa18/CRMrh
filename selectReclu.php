<?php
include('auth_session.php');
$con = mysqli_connect('localhost:3307', 'root', '', 'rh');
        $users_arr = array();       
        $sql = "SELECT *  FROM agencias";
        $result = mysqli_query($con,$sql);
        while( $row = mysqli_fetch_array($result) ){
        $userid = $row['Id'];
        $name = $row['Nombre'];
        $users_arr[] = array("id" => $userid, "name" => $name);

}
echo json_encode($users_arr);
    mysqli_close($con);
?>
