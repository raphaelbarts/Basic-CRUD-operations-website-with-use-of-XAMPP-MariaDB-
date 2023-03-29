<?php
include 'connect.php';
if(isset($_POST['submit'])){
  $Owner=$_POST['Owner'];
  $Pet=$_POST['Pet'];
  $Type=$_POST['Type'];
  $Age=$_POST['Age'];
  $Weight=$_POST['Weight'];
  $AppointmentDate=$_POST['AppointmentDate'];
  $Appointment=$_POST['Appointment'];

  $sql="insert into `records` (Owner, Pet, Type, Age, Weight, AppointmentDate, Appointment)
  values('$Owner', '$Pet', '$Type', '$Age', '$Weight', '$AppointmentDate', '$Appointment')";
  $result=mysqli_query($con,$sql);
  if($result){
    echo '<script language="javascript">';
    echo 'alert("Information inserted successfully")';
    echo '</script>';
  }else{
    die(mysqli_error($con));
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
body {
  background-image: url('images/backgroundimg.avif');
}
</style>

    <title>Dashboard</title>
  </head>
  <body>
    
  <div class="container my-5">
    <h1>Add Record</h1>
    <button class="btn btn-primary my-5"><a href="display.php" class="text-light">Records</a></button>


    <form method="POST">
  <div class="form-group">
    <label>Pet Owner</label>
    <input type="text" class="form-control" placeholder="Enter Owner's name" name="Owner" required>
  </div>
  <div class="form-group">
    <label>Pet Name</label>
    <input type="text" class="form-control" placeholder="Enter Pet name" name="Pet" required>
  </div>

  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Pet type</label>
  </div>
  <select class="custom-select" id="inputGroupSelect01" name="Type">
    <option selected>---</option>
    <option value="Dog">Dog</option>
    <option value="Cat">Cat</option>
    <option value="Hamster">Hamster</option>
    <option value="Rabbit">Rabbit</option>
    <option value="Bird">Bird</option>
</select>
</div>
  <div class="form-group">
    <label>Pet Age</label>
    <input type="text" class="form-control" placeholder="Enter Pet age" name="Age" required>
  </div>
  <div class="form-group">
    <label>Pet Weight</label>
    <input type="text" class="form-control" placeholder="Enter Pet weight" name="Weight" required>
  </div>
  <div class="form-group">
    <label>Appointment Date</label>
    <input type="date" class="form-control" placeholder="Enter Appointment date" name="AppointmentDate" required>
  </div>
  <div class="form-group">
    <label>Appointment Type</label>
    <input type="text" class="form-control" placeholder="Enter Appointment Type" name="Appointment" required>
  </div>
  <button type="submit" class="btn btn-primary" name="submit" action="/display" >Submit</button>
</form>
</div>
  
  </body>
</html>