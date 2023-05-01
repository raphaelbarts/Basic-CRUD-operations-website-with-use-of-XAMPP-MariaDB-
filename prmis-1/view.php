<?php
include 'connect.php';
$id = $_GET['updateid'];
$sql="Select * from `records` where id=$id";
$result=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($result);
$Owner=$row['Owner'];
$Pet=$row['Pet'];
$Type=$row['Type'];
$Breed=$row['Breed'];
$Age=$row['Age'];
$Weight=$row['Weight'];
$AppointmentDate=$row['AppointmentDate'];
$Appointment=$row['Appointment'];
$Image=$row['Image'];
$AddDate=$row['AddDate'];

// Set default image source
$defaultImageSrc = 'logo1.png';

// Check if $Image is empty, set default image source if true
if(empty($Image)) {
  $Image = $defaultImageSrc;
} else {
  // Get the image ID from the database row
  $imageId = $row['id'];
  // Set the image source to the PHP script that retrieves the image data from the database
  $Image = 'get_image.php?id=' . $imageId;
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

    <title><?php echo $Owner . '    -    ' . $Pet  . '\'s Record'?></title>
  </head>
  <body>
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
  $Image=$_POST['Image'];

  $sql="insert into `records` (Owner, Pet, Type,Age, Weight, AppointmentDate, Appointment, Image)
  values('$Owner', '$Pet', '$Type','$Age', '$Weight', '$AppointmentDate', '$Appointment', '$Image')";
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
    require 'dbcon.php';
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar Menu</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="clinic.css">
  <link rel="stylesheet" href="css/view.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

</head>

<body>
  <nav>
    <div class="sidebar-top">
     
      <img src="logo.png" class="logo" alt="">
      <h3 class="hide">PawfectCare</h3>
    </div>

   

    <div class="sidebar-links">
      <ul>
        <div class="active-tab"></div>
        <li class="tooltip-element" data-tooltip="0">
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
            <i class='bx bx-log-out'></i></div>
            <span>Logout</span>
          </a>
        </li>
      </ul>  
  </nav>


  <main>
  <div class="container-fluid">
    <div class="row">
        <div class="profile-head">
            <div class="profiles col-xs-8 col-xs-push-2  col-sm-10 col-sm-push-1 thumbnail">
                <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="row">
                <img src="<?php echo $Image; ?>" style="max-width: 300px; max-height: 300px;">

</div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <span class="col-sm-12"><h5><?php echo $Pet ?></h5></span>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <ul>
                                <li><span><h5>Pet Owner:</span></h5></li>
                                <li><span><h5>Pet Type:</span></h5></li>
                                <li><span><h5>Pet Breed:</span></h5></li>
                                <li><span><h5>Pet Age:</span></h5></li>
                                <li><span><h5>Pet Weight:</span></h5></li>
                                <li><span><h5>Appointment Date:</span></h5></li>
                                <li><span><h5>Appointment Type:</span></h5></li>
                                <li><span><h5>Date added:</span></h5></li>

                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <ul>
                                <li><span><h5><?php echo $Owner ?></span></h5></li>
                                <li><span><h5><?php echo $Type ?></span></h5></li>
                                <li><span><h5><?php echo $Breed ?></span></h5></li>
                                <li><span><h5><?php echo $Age ?></span></h5></li>
                                <li><span><h5><?php echo $Weight ?></span></h5></li>
                                <li><span><h5><?php echo $AppointmentDate ?></h5></span></li>
                                <li><span><h5><?php echo $Appointment ?></h5></span></li>
                                <li><span><h5><?php echo $AddDate ?></h5></span></li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  </body>
</html>