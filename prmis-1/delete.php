<?php
include 'connect.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="delete from `records` where id=$id";
    $result=mysqli_query($con,$sql);
    if($result){
        echo '<script language="javascript">';
        echo 'alert("Information deleted successfully")';
        echo '</script>';
        header('location:display.php');
    }else{
        die(mysqli_error($con));
    }
}
?>