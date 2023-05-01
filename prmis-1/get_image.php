<?php
include 'connect.php';
$id = $_GET['id'];
$sql="Select * from `records` where id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$imageData = $row['Image'];
header('Content-Type: image/jpeg');
echo $imageData;
?>