<?php
include 'connect.php';

if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];

    $sql = "DELETE FROM `records` WHERE id=$id";
    $result = mysqli_query($con, $sql);

    if($result){
        header('location:patients.php');
        exit(); 
    }else{
        die(mysqli_error($con));
    }
}

?>
