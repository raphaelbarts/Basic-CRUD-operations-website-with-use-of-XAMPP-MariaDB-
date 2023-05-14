<?php
session_start();
include 'connect.php';

$id = isset($_GET['updateid']) ? mysqli_real_escape_string($con, $_GET['updateid']) : '';

if ($id === '') {
  echo "Error: id parameter is missing";
  exit;
}


$sql="SELECT * FROM `records` WHERE id='$id'";


if (!$result = mysqli_query($con, $sql)) {
  echo "Error: " . $sql . "<br>" . mysqli_error($con);
  exit;
}

$row=mysqli_fetch_assoc($result);

$Owner=$row['Owner'];
$Pet=$row['Pet'];
$Type=$row['Type'];
$Breed=$row['Breed'];
$Age=$row['Age'];
$Weight=$row['Weight'];
$AppointmentDate=$row['AppointmentDate'];
$Appointment=$row['Appointment'];
$AddDate=$row['AddDate'];
$Image=$row['Image'];


?>


<!doctype html>
<link rel="icon" type="image/x-icon" href="logo.png">
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



if(!isset($_SESSION["username"]))
{
	header("location:login.php");
}
?>

<?
    if(!isset($_SESSION['username']))

    {
        header("location:login.php");
    }
	elseif($_SESSION['usertype']=='admin')
	{
		header("location:login.php");

	}
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar Menu</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="clinic.css">
  <link rel="stylesheet" href="view.css">
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
                <?php if(!empty($row['Image'])): ?>
    <img src="<?php echo $row['Image']; ?>" alt="Pet Image" style="min-width: 200px; min-height: 200px; max-width:200px; max-height:200px;">
  <?php else: ?>
    <img src="default.png" style="min-width: 200px; min-height: 200px; max-width:200px; max-height:200px;"> 
  <?php endif; ?>

</div>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <span class="col-sm-12"><h5><?php echo $Pet ?></h5></span>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <ul>
                                <li><span>Pet Owner:</span></li>
                                <li><span>Pet Type:</span></li>
                                <li><span>Pet Breed:</span></li>
                                <li><span>Pet Age:</span></li>
                                <li><span>Pet Weight:</span></li>
                                <li><span>Appointment Date:</span></li>
                                <li><span>Appointment Type:</span></li>
                                <li><span>Date added:</span></li>

                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <ul>
                                <li><span><?php echo $Owner ?></span></li>
                                <li><span><?php echo $Type ?></span></li>
                                <li><span><?php echo $Breed ?></span></li>
                                <li><span><?php echo $Age ?></span></li>
                                <li><span><?php echo $Weight ?></span></li>
                                <li><span><?php echo $AppointmentDate ?></span></li>
                                <li><span><?php echo $Appointment ?></span></li>
                                <li><span><?php echo $AddDate ?></span></li>

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