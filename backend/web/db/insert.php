<?php

if(isset($_POST['room_name'])){
    $room_name = $_POST['room_name'];
    $real_room_name = $_POST['real_room_name'];
    $password = $_POST['password'];

    $con = mysqli_connect("localhost","root","","tlb_meet");

    /* Modify id for the system  */
    $sql = "INSERT INTO `meet` (`room_name`, `real_room_name`, `password`) VALUES ('$room_name', '$real_room_name', '$password')";
    $result = mysqli_query($con, $sql);
    if($result === true){
        echo('Meet has been saved');
    }else{
        echo('Error while inserting the meet');
    }
}

?>
