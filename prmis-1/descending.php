<?php
include 'connect.php';
?>

<?php
include 'connect.php';
if(isset($_POST['submit'])){
  $Owner=$_POST['Owner'];
  $Pet=$_POST['Pet'];
  $Type=$_POST['Type'];
  $Breed=$_POST['Breed'];
  $Age=$_POST['Age'];
  $Weight=$_POST['Weight'];
  $AppointmentDate=$_POST['AppointmentDate'];
  $Appointment=$_POST['Appointment'];

  $sql="insert into `records` (Owner, Pet, Type, Age, Weight, AppointmentDate, Appointment)
  values('$Owner', '$Pet', '$Type','$Age', '$Weight', '$AppointmentDate', '$Appointment')";
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
<?php 
$sortOrder = isset($_GET['sort']) && $_GET['sort'] === 'DESC' ? 'DESC' : 'ASC';
if(isset($_POST['search'])) {
  $search = $_POST['search'];
  if(!empty($search)) {
    $sortOrder = isset($_GET['sort']) && $_GET['sort'] === 'DESC' ? 'DESC' : 'ASC';
   $sql="SELECT * FROM `records` WHERE `Owner` LIKE '%$search%' OR `Pet` LIKE '%$search%' OR `Type` LIKE '%$search%'
       OR `Breed` LIKE '%$search%' OR `Appointment` LIKE '%$search%' ORDER BY `AppointmentDate` $sortOrder";
  } else {
      $sql="SELECT * FROM `records` ORDER BY `AppointmentDate` DESC";
  }
} else {
  $sql="SELECT * FROM `records` ORDER BY `AppointmentDate` DESC";
}
?>
<?php
session_start();


if(!isset($_SESSION["username"]))
{
	header("location:login.php");
}
?>

<?

session_start();

    if(!isset($_SESSION['username']))

    {
        header("location:login.php");
    }
	elseif($_SESSION['usertype']=='admin')
	{
		header("location:login.php");

	}

    session_start();
    require 'dbcon.php'; ?>
    <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clinic Records</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="clinic.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

</head>
<body style="zoom:75%;">
  <nav style="zoom:133.35%;">
    <div class="sidebar-top">
     
      <img src="logo.png" class="logo" alt="">
      <h3 class="hide">PawfectCare</h3>
    </div>

   

    <div class="sidebar-links">
      <ul>
        <div class="active-tab"></div>
        <li >
          <a href="display.php" class="active" data-active="0">
            <div class="icon">
            <i class='bx bx-add-to-queue'></i>            </div>
            <span class="link hide">Records</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="clients.php" data-active="1">
            <div class="icon">
            <i class='bx bx-user'></i>
                    </div>
            <span class="link hide">Clients</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
          <a href="patients.php" data-active="2">
            <div class="icon">
            <i class='bx bx-clinic'></i>          </div>
            <span class="link hide">Patients</span>
          </a>
        </li>
        
        <li class="logout" >
          <a href="login.php">
            <div class="icon">
            <i class='bx bx-log-out'></i>            </div>
            <span>Logout</span>
          </a>
        </li> 
      </ul>  
  </nav>


  <main> 
</div>
<div class="container">
    <h1> Clinic Records</h1> 
    <form class="form-inline my-2 my-lg-0 navbar-container" method="POST"">
   
    <input class="form-control mr-sm-2 col" type="search" name="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success my-2 my-sm-0 col" type="submit">Search</button>
      &nbsp;
      <button class="btn btn-primary my-4 col"><a href="addrecord.php" class="text-light">Add New Record</a></button>
      &nbsp;
      <button id="downloadexcel" class="btn btn-outline-dark col">Export xlsx file</button>
      &nbsp;
      <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="sortDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort Order
  </button>
  <div class="dropdown-menu" aria-labelledby="sortDropdown">
    <a class="dropdown-item" href="display.php">Ascending</a>
    <a class="dropdown-item" href="descending.php">Descending</a>
  </div>
</div>
<form class="form-inline my-2 my-lg-0 navbar-container">
  <select class="form-control mr-sm-2 col" id="pet-type">
    <option value="">All</option>
    <option value="dog">Dog</option>
    <option value="cat">Cat</option>
    <option value="bird">Bird</option>
    <option value="hamster">Hamster</option>
    <option value="reptile">Reptile</option>
  </select>
  <button class="btn btn-outline-success my-2 my-sm-0 col" type="button" id="filter-btn">Filter</button>
</form>
    </form>
  </div>
</nav>
<script src="scripts/table2excel.js"></script>
   <table class="table" id="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Owner</th>
      <th scope="col">Pet name</th>
      <th scope="col">Pet type</th>
      <th scope="col">Pet Breed </th>
      <th scope="col">Age</th>
      <th scope="col">Weight</th>
      <th scope="col">Appointment Date</th>
      <th scope="col">Appointment Type</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
  <tbody>
  <?php

$result=mysqli_query($con,$sql);
if($result){
    while($row=mysqli_fetch_assoc($result)){
        $id=$row['id'];
        $Owner=$row['Owner'];
        $Pet=$row['Pet'];
        $Type=$row['Type'];
        $Breed=$row['Breed'];
        $Age=$row['Age'];
        $Weight=$row['Weight'];
        $AppointmentDate=$row['AppointmentDate'];
        $Appointment=$row['Appointment'];
        echo ' <tr>
            <th scope="row"> '.$id.' </th>
            <td>'.$Owner.'</td>
            <td>'.$Pet.'</td>
            <td>'.$Type.'</td>
            <td>'.$Breed.'</td>
            <td>'.$Age.'</td>
            <td>'.$Weight.'</td>
            <td>'.$AppointmentDate.'</td>
            <td>'.$Appointment.'</td>
            <td>
                <button class="btn btn-primary"><a href="view.php?updateid='.$id.'" class="text-light">View</a></button>
                <button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light">Update</a></button>
                <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.getElementById('filter-btn').addEventListener('click', function() {
    var petType = document.getElementById('pet-type').value;
    window.location.href = 'display.php?type=' + petType;
  });
</script>
<script>
  document.getElementById("filter-btn").addEventListener("click", function() {
  var petType = document.getElementById("pet-type").value;
  if (petType === "All") {
    window.location.href = "display.php";
  }
});
</script>
<script>
  document.getElementById("filter-btn").addEventListener("click", function() {
  var petType = document.getElementById("pet-type").value;
  if (petType === "dog") {
    window.location.href = "filter-dog.php";
  }
});
</script>
<script>
  document.getElementById("filter-btn").addEventListener("click", function() {
  var petType = document.getElementById("pet-type").value;
  if (petType === "cat") {
    window.location.href = "filter-cat.php";
  }
});
</script>
<script>
  document.getElementById("filter-btn").addEventListener("click", function() {
  var petType = document.getElementById("pet-type").value;
  if (petType === "bird") {
    window.location.href = "filter-bird.php";
  }
});
</script>
<script>
  document.getElementById("filter-btn").addEventListener("click", function() {
  var petType = document.getElementById("pet-type").value;
  if (petType ==="hamster") {
    window.location.href = "filter-hamster.php";
  }
});
</script>
<script>
  document.getElementById("filter-btn").addEventListener("click", function() {
  var petType = document.getElementById("pet-type").value;
  if (petType === "reptile") {
    window.location.href = "filter-reptile.php";
  }
});
</script>
</body>
</html>