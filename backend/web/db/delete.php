<?php

if(isset($_POST['room_name'])){
    $room_name = $_POST['room_name'];

    $con = mysqli_connect("localhost","root","","tlb_meet");

    /* Modify id for the system  */
    $sql = "DELETE FROM `meet` WHERE `room_name`='$room_name'";
    $result = mysqli_query($con, $sql);
    if($result === true){
        echo('Meet has been deleted');
    }else{
        echo('Error while inserting the meet');
    }
}

?>
