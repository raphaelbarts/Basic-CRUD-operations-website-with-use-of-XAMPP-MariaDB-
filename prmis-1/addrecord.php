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

  // Get the current date and time
  $AddDate = date('Y-m-d H:i:s');
  
  if(isset($_FILES['Image']) && $_FILES['Image']['error'] == 0) {
    $image = file_get_contents($_FILES['Image']['tmp_name']);
    $escaped_image = mysqli_real_escape_string($con, $image);
  } else {
    $escaped_image = NULL;
  }

  $sql="INSERT INTO `records` (Owner, Pet, Type, Breed, Age, Weight, AppointmentDate, Appointment, Image, AddDate)
        VALUES ('$Owner', '$Pet', '$Type', '$Breed', '$Age', '$Weight', '$AppointmentDate', '$Appointment', '$escaped_image', '$AddDate')";
  
  $result=mysqli_query($con,$sql);
  if($result){
    echo '<script language="javascript">';
    echo 'alert("Information inserted successfully")';
    echo '</script>';
  } else {
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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Record</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="clinic.css">
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

    <title>Add records</title>
  </head>
  <body>
    
  <div class="container my-5">
    <h1>Add Record</h1>
    <form method="POST" autocomplete="off" enctype="multipart/form-data">
  <div class="form-group">
    <label>Pet Owner</label>
    <input type="text" class="form-control" placeholder="Enter Owner's name" name="Owner" required>
  </div>
  <div class="form-group">
    <label>Pet Name</label>
    <input type="text" class="form-control" placeholder="Enter Pet name" name="Pet" required>
  </div>

  <label for="pet-type">Pet Type</label>
<select class="custom-select" id="pet-type" name="Type" onchange="populateBreeds()">
  <option value="">Select a pet type</option>
  <option value="Cat">Cat</option>
  <option value="Dog">Dog</option>
  <option value="Bird">Bird</option>
  <option value="Hamster">Hamster</option>
  <option value="Reptile">Reptile</option>
</select>

<label for="pet-breed">Pet Breed</label>
<select id="pet-breed" name="Breed" class="custom-select">
  <option value="">Select a pet type first</option>
</select>

<script>
  function populateBreeds() {
    var petType = document.getElementById("pet-type").value;
    var breedDropdown = document.getElementById("pet-breed");
    breedDropdown.innerHTML = "";
    
    if (petType === "Cat") {
      breedDropdown.innerHTML += "<option value='Persian'>Persian</option>";
      breedDropdown.innerHTML += "<option value='Siamese'>Siamese</option>";
      breedDropdown.innerHTML += "<option value='British Shorthair'>British Shorthair</option>";
      breedDropdown.innerHTML += "<option value='Maine Coon'>Maine Coon</option>";
      breedDropdown.innerHTML += "<option value='Ragdoll'>Ragdoll</option>";
    } else if (petType === "Dog") {
      breedDropdown.innerHTML += "<option value='Labrador Retriever'>Labrador Retriever</option>";
      breedDropdown.innerHTML += "<option value='Poodle'>Shih Tzu</option>";
      breedDropdown.innerHTML += "<option value='Chihuahua'>Chihuahua</option>";
      breedDropdown.innerHTML += "<option value='Bulldog'>Bulldog</option>";
      breedDropdown.innerHTML += "<option value='Poodle'>Poodle</option>";
    } else if (petType === "Bird") {
      breedDropdown.innerHTML += "<option value='African Love Bird'>African Love Bird</option>";
      breedDropdown.innerHTML += "<option value='Pigeon'>Pigeon</option>";
      breedDropdown.innerHTML += "<option value='Parrot'>Parrot</option>";
      breedDropdown.innerHTML += "<option value='Canary'>Canary</option>";
      breedDropdown.innerHTML += "<option value='Cockatiel'>Cockatiel</option>";
    } else if (petType === "Hamster") {
      breedDropdown.innerHTML += "<option value='Syrian hamster'>Syrian hamster</option>";
      breedDropdown.innerHTML += "<option value='Roborovski hamster'>Roborovski hamster</option>";
      breedDropdown.innerHTML += "<option value='Winter white dwarf hamster'>Winter white dwarf hamster</option>";
      breedDropdown.innerHTML += "<option value='Chinese hamster'>Chinese hamster</option>";
      breedDropdown.innerHTML += "<option value='Campbells dwarf hamster'>Campbells dwarf hamster</option>";
    }
     else if (petType === "Reptile") {
      breedDropdown.innerHTML += "<option value='Turtle'>Turtle</option>";
      breedDropdown.innerHTML += "<option value='Tortoise'>Tortoise</option>";
      breedDropdown.innerHTML += "<option value='Lizard'>Lizard</option>";
      breedDropdown.innerHTML += "<option value='Snake'>Snake</option>";
      breedDropdown.innerHTML += "<option value='Iguanas'>Iguana</option>";
    }
  }
</script>
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

  <label for="inputGroupSelect01">Appointment Type</label> 
  <select class="custom-select" id="inputGroupSelect01" name="Appointment">
    <option selected>Select Appointment Type</option>
    <option value="Checkup">Checkup</option>
    <option value="Surgery">Surgery</option>
    <option value="Vaccine">Vaccine</option>
    <option value="Anti-Rabies Shot">Anti-Rabies Shot</option>
    <option value="Supplement Shot">Supplement Shot</option>
</select>
<div class="form-group">
  <label>Image</label>
    <div>
      <input type="file" class="form-control-file " name="Image" id="imageInput">
      <button type="button" class="btn btn-outline-danger" onclick="clearImage()">Clear</button>
    </div>
  </div>
  <!-- Rest of form fields -->
  <br><br>
  <button type="submit" class="btn btn-primary" name="submit" action="display.php" >Submit</button>
</form>
</div>
<script>
function clearImage() {
  document.getElementById("imageInput").value = "";
}
</script>
  </body>
</html>