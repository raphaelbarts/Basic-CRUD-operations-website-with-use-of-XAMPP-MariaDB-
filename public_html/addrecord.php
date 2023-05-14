<?php
session_start();

include 'connect.php';

if(!isset($_SESSION["username"]))
{
	header("location:login.php");
	exit();
}

if(!isset($_SESSION['username']))
{
    header("location:login.php");
	exit();
}
elseif($_SESSION['usertype']=='admin')
{
	header("location:login.php");
	exit();
}

if(isset($_POST['submit'])){
  $Owner=$_POST['Owner'];
  $Pet=$_POST['Pet'];
  $Type=$_POST['Type'];
  $Breed=$_POST['Breed'];
  $Age=$_POST['Age'];
  $Weight=$_POST['Weight'];
  $AppointmentDate=$_POST['AppointmentDate'];
  $Appointment=implode(", ", $_POST['Appointment']);

  date_default_timezone_set('Asia/Manila');
  $AddDate = date('Y-m-d H:i:s');

  $target_file = "";
  if (!empty($_FILES["image"]["name"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      echo '<script language="javascript">';
      echo 'alert("File is not an image.")';
      echo '</script>';
      $uploadOk = 0;
    }
    if (file_exists($target_file)) {
      echo '<script language="javascript">';
      echo 'alert("Sorry, file already exists.")';
      echo '</script>';
      $uploadOk = 0;
    }
    if ($_FILES["image"]["size"] > 50000000) {
      echo '<script language="javascript">';
      echo 'alert("Sorry, your file is too large.")';
      echo '</script>';
      $uploadOk = 0;
    }
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo '<script language="javascript">';
      echo 'alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")';
      echo '</script>';
      $uploadOk = 0;
    }
    if ($uploadOk == 0) {
      echo '<script language="javascript">';
      echo 'alert("Sorry, your file was not uploaded.")';
      echo '</script>';
    } else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo '<script language="javascript">';
        echo 'alert("The file '. htmlspecialchars( basename( $_FILES["image"]["name"])). ' has been uploaded.")';
        echo '</script>';
      } else {
        echo '<script language="javascript">';
        echo 'alert("Sorry, there was an error uploading your file.")';
        echo '</script>';
      }
    }
  }

  $sql="INSERT INTO `records` (Owner, Pet, Type, Breed, Age, Weight, AppointmentDate, Appointment, AddDate, Image)
        VALUES ('$Owner', '$Pet', '$Type', '$Breed', '$Age', '$Weight', '$AppointmentDate', '$Appointment', '$AddDate', '$target_file')";
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
                            <a href="display.php" class="btn">
                                <i class="bx bx-home-alt"></i>
                                <span class="text nav-text">Dashboard</span>
                            </a>
                        </li>

                      
                             
                        <li class="nav-links">
                            <a href="patients.php" class="active">
                                <i class='bx bx-plus-medical'></i>
                                <span class="text1 nav-text">Patients</span>
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


  <main>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>Add records</title>
  </head>
  <body>
    
  <div class="container my-5">
    <h1>Add Record</h1>
    <form method="POST" autocomplete="off" enctype="multipart/form-data" onsubmit="return validateForm();">
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
<select id="pet-breed" name="Breed" class="custom-select" data-pet-breed="<?php echo $petBreed; ?>">
  <option value="">Select Breed</option>
</select>

<script>
  var breedDropdown = document.getElementById("pet-breed");
  breedDropdown.value = "";

  function populateBreeds() {
    var petType = document.getElementById("pet-type").value;
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
    } else if (petType === "Reptile") {
      breedDropdown.innerHTML += "<option value='Turtle'>Turtle</option>";
      breedDropdown.innerHTML += "<option value='Tortoise'>Tortoise</option>";
      breedDropdown.innerHTML += "<option value='Lizard'>Lizard</option>";
      breedDropdown.innerHTML += "<option value='Snake'>Snake</option>";
      breedDropdown.innerHTML += "<option value='Iguanas'>Iguana</option>";
    }

var savedBreed = breedDropdown.getAttribute("data-pet-breed");

for (var i = 0; i < breedDropdown.options.length; i++) {
  var option = breedDropdown.options[i];

  if (option.value === savedBreed) {
    option.selected = true;
    break;
  }
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

  <label for="appointmentTypes">Appointment Type</label>
<div id="appointmentTypes">
  <div>
    <input type="checkbox" id="checkup" name="Appointment[]" value="Checkup">
    <label for="checkup">Checkup</label>
  </div>
  <div>
    <input type="checkbox" id="surgery" name="Appointment[]" value="Surgery">
    <label for="surgery">Surgery</label>
  </div>
  <div>
    <input type="checkbox" id="vaccine" name="Appointment[]" value="Vaccine">
    <label for="vaccine">Vaccine</label>
  </div>
  <div>
    <input type="checkbox" id="antiRabiesShot" name="Appointment[]" value="Anti-Rabies Shot">
    <label for="antiRabiesShot">Anti-Rabies Shot</label>
  </div>
  <div>
    <input type="checkbox" id="supplementShot" name="Appointment[]" value="Supplement Shot">
    <label for="supplementShot">Supplement Shot</label>
  </div>
  <input type="hidden" id="appointmentTypesSelected" name="AppointmentSelected" value="">
</div>
<div class="form-group">
      <label>Upload Pet Image</label>
      <input type="file" class="form-control-file" name="image">
    </div>
<script>
  function validateForm() {
    var checkboxes = document.getElementsByName("Appointment[]");
    var checkedValues = [];
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        checkedValues.push(checkboxes[i].value);
      }
    }
    if (checkedValues.length === 0) {
      document.getElementById("appointmentTypesError").innerHTML = "Please select at least one appointment type.";
      return false;
    } else {
      document.getElementById("appointmentTypesSelected").value = checkedValues.join(",");
      return true;
    }
  }
</script>
  <br><br>
  <button type="submit" class="btn btn-primary" name="submit" action="display.php" >Submit</button>
</form>
</div>

  </body>
</html>