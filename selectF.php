<?php
include 'acciones/ins/Select.php'; 
if(isset($_REQUEST['depart'])){
    $departid = $_REQUEST['depart']; // department id
    $users_arr = array();
        $resultpa   = Select::SelectParadas($departid);
       // while( $row = mysqli_fetch_array($result) ){
        foreach ($resultpa as $a_ => $infoRec) {
        $userid = $infoRec['id'];
        $name = $infoRec['nombre'];
        $users_arr[] = array("id" => $userid, "name" => $name);
       }
        //}
        // encoding array to json format
       echo json_encode($users_arr);
}else{
        $users_arr = array();       
        $resultru   = Select::SelectRutas();
       // while( $row = mysqli_fetch_array($result) ){
        foreach ($resultru as $a_ => $infoRec) {
        $userid = $infoRec['id'];
        $name = $infoRec['nombre'];
        $users_arr[] = array("id" => $userid, "name" => $name);
    }
//}
// encoding array to json format
echo json_encode($users_arr);
}

 
?>
