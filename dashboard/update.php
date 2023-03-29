<?php
include 'connect.php';
$id = $_GET['updateid'];
$sql="Select * from `records` where id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$Owner=$row['Owner'];
  $Pet=$row['Pet'];
  $Type=$row['Type'];
  $Age=$row['Age'];
  $Weight=$row['Weight'];
  $AppointmentDate=$row['AppointmentDate'];
  $Appointment=$row['Appointment'];

if(isset($_POST['submit'])){
  $Owner=$_POST['Owner'];
  $Pet=$_POST['Pet'];
  $Type=$_POST['Type'];
  $Weight=$_POST['Weight'];
  $AppointmentDate=$_POST['AppointmentDate'];
  $Appointment=$_POST['Appointment'];

  $sql="update `records` set id=$id,Owner='$Owner',Pet='$Pet',Type='$Type',Age='$Age',AppointmentDate='$AppointmentDate',Appointment='$Appointment' where id=$id";
  $result=mysqli_query($con,$sql);
  if($result){
    header('location:display.php');
  }else{
    die(mysqli_error($con));
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>Dashboard</title>
  </head>
  <body>
  <button class="btn btn-primary my-5"><a href="display.php" class="text-light">Records</a></button>
  <div class="container my-5  ">
    <h1>Update Record</h1>
    <form method="POST">
  <div class="form-group">
    <label>Pet Owner</label>
    <input type="text" class="form-control" placeholder="Enter Owner's name" name="Owner" required>
  </div>
  <div class="form-group">
    <label>Pet Name</label>
    <input type="text" class="form-control" placeholder="Enter Pet name" name="Pet" required>
  </div>
  <div class="form-group">
    <label>Pet type</label>
    <input type="text" class="form-control" placeholder="Enter Pet type" name="Type" required>
  </div>
  <div class="form-group">
    <label>Pet Age</label>
    <input type="text" class="form-control" placeholder="Enter Pet age" name="Age" required>
  </div>
  <div class="form-group">
    <label>Pet Weight</label>
    <input type="text" class="form-control" placeholder="Enter Pet Weight" name="Weight" required>
  </div>
  <div class="form-group">
    <label>Appointment Date</label>
    <input type="date" class="form-control" placeholder="Enter Appointment date" name="AppointmentDate" required>
  </div>
  <div class="form-group">
    <label>Appointment Type</label>
    <input type="text" class="form-control" placeholder="Enter Appointment Type" name="Appointment" required>
  </div>
  <button type="submit" class="btn btn-primary" name="submit" action="/display">Update</button>
</form>
</div>
  
  </body>
</html>