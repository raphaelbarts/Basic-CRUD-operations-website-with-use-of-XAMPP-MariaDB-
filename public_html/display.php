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
    if(isset($_GET['sort'])) {
      $sortOrder = $_GET['sort'] === 'DESC' ? 'DESC' : 'ASC';
    }
    $sort_url = "&sort=$sortOrder";
    $sql="SELECT * FROM `records` WHERE `Owner` LIKE '%$search%' OR `Pet` LIKE '%$search%' OR `Type` LIKE '%$search%'
       OR `Breed` LIKE '%$search%' OR `Appointment` LIKE '%$search%' ORDER BY `AppointmentDate` $sortOrder";
  } else {
    $sql="SELECT * FROM `records` ORDER BY `AppointmentDate` $sortOrder";
    $sort_url = "&sort=$sortOrder";
  }
} else {
  $sql="SELECT * FROM `records` ORDER BY `AppointmentDate` $sortOrder";
  $sort_url = "&sort=$sortOrder";
}
?>

<!DOCTYPE html>
<html lang="en">
<link rel="icon" type="image/x-icon" href="logo.png">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clinic Records</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://kit.fontawesome.com/585217fd31.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="vet.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

</head>
<body style="zoom:92%;">
<!---SIDEBAR-->
<nav class="sidebar">
            <header>
                <div class="header-image-text">
                    <span class="image">
                        <img src="logo.png">
                    </span>
                    <div class="text header-text">
                        <span class="name">PawfectCare</span>
                        <span class="profession"> vOS</span>
                    </div>
                </div>
            </header>
<!--random space-->
            <div class="menu-bar">
                <div class="menu">
                    <ul class="menu-Links">
<br>
<br>

<!--end of space-->
<h3 style="margin:15px; color:gray; font-weight:600; font-size:large;"> Menu </h3>
                        <li class="nav-links">
                            <a href="display.php" class="active">
                                <i class="bx bx-home-alt"></i>
                                <span class="text1 nav-text">Dashboard</span>
                            </a>
                        </li>

                      
                             
                        <li class="nav-links">
                            <a href="patients.php" class="btn">
                                <i class='bx bx-plus-medical'></i>
                                <span class="text nav-text">Patients</span>
                            </a>
                        </li>
                        <li class="nav-links">
                            <a href="clients.php" class="btn">
                            <i class='bx bxs-face' ></i>
                                <span class="text nav-text">Clients</span>
                            </a>
                        </li>
                        <li class="nav-links">
                            <a href="appointments.php" class="btn">
                                <i class='bx bx-calendar-event' ></i>
                                <span class="text nav-text">Appointments</span>
                            </a>
                        </li>
                      
                        <li class="nav-links">
                            <a href="reports.php" class="btn">
                                <i class='bx bx-chart' ></i>
                                <span class="text nav-text">Reports</span>
                            </a>
                        </li>

                        <h3 style="margin:15px; color:gray; font-weight:600; font-size:large;"> Help </h3>
                        <li class="nav-links">
                            <a href="help.php" class="btn">
                                <i class='bx bx-help-circle'></i>
                                <span class="text nav-text"> FAQs </span>
                            </a>
                        </li>
                        <br> <br><br> <br><br> <br><br> <br> <br> <br> <br><br><!--tangina puro br-->
                        <li class="nav-links">
                            <a href="index.php" class="btn">
                            <i class='bx bx-log-out'></i>
                                <span class="text nav-text"> Log Out </span>
                            </a>
                        </li>

                       

                    </ul>
                </div>

                
            </nav>

            <section class="home">
<div class="container">
    <h1 class="bastatext"> DASHBOARD</h1> 
    
</body>
</html>

