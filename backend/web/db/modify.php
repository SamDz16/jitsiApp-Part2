<?php

if(isset($_POST['old_room_name'])){
    $old_room_name = $_POST['old_room_name'];
    $room_name = $_POST['room_name'];
    $real_room_name = $_POST['real_room_name'];
    $password = $_POST['password'];

    $con = mysqli_connect("localhost","root","","tlb_meet");

    /* Modify id for the system  */
    $sql = "UPDATE `meet` SET `room_name`='$room_name',`real_room_name`='$real_room_name',`password`='$password' WHERE `room_name`='$old_room_name'";
    $result = mysqli_query($con, $sql);
    if($result === true){
        echo('Meet has been modified');
    }else{
        echo('Error while inserting the meet');
    }
}

?>
