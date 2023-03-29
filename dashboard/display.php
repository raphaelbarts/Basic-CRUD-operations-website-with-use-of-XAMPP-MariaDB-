<?php
include 'connect.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
body {
  background-image: url('images/backgroundimg.');
}
</style>  
</head>
<script src="table2excel.js"></script>
<body> 
    <div class="container">
   <nav class="navbar navbar-expand-lg navbar-light bg-light searchnavbar">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <div class="col-8">
      <a class="navbar-brand" href="#">Pawfect</a>
    </div>
    <form class="form-inline my-2 my-lg-0 navbar-container">
      <input class="form-control mr-sm-2 col" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 col" type="submit">Search</button>
      &nbsp;
      <button class="btn btn-primary my-5 col"><a href="addrecord.php" class="text-light">Add New Record</a></button>
      &nbsp;
      <button id="downloadexcel" class="btn btn-outline-dark col">Export xlsx file</button>
    </form>
  </div>
</nav>
   <table class="table" id="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Owner</th>
      <th scope="col">Pet name</th>
      <th scope="col">Pet type</th>
      <th scope="col">Age</th>
      <th scope="col">Weight</th>
      <th scope="col">Appointment Date</th>
      <th scope="col">Appointment Type</th>
      <th scope="col">Operations</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
        $sql="Select * from `records`";
        $result=mysqli_query($con,$sql);
        if($result){
           while($row=mysqli_fetch_assoc($result)){
            $id=$row['id'];
            $Owner=$row['Owner'];
            $Pet=$row['Pet'];
            $Type=$row['Type'];
            $Age=$row['Age'];
            $Weight=$row['Weight'];
            $AppointmentDate=$row['AppointmentDate'];
            $Appointment=$row['Appointment'];
            echo ' <tr>
            <th scope="row"> '.$id.' </th>
            <td>'.$Owner.'</td>
            <td>'.$Pet.'</td>
            <td>'.$Type.'</td>
            <td>'.$Age.'</td>
            <td>'.$Weight.'</td>
            <td>'.$AppointmentDate.'</td>
            <td>'.$Appointment.'</td>
            <td>
            
        <button class="btn btn-primary"><a href="update.php? updateid='.$id.'" class="text-light">Update</a></button>
        <button class="btn btn-danger"><a href="delete.php? deleteid='.$id.'" class="text-light">Delete</a></button>
        </td>
          </tr> ';
           }
        }
    ?>
  </tbody>
</table>
<script>
  document.getElementById('downloadexcel').addEventListener('click', function(){
    var table2excel = new Table2Excel();
    table2excel.export(document.querySelectorAll("table"));
  });
</script>
</body>
</html>