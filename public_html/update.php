<?php
include 'connect.php';

$id = isset($_GET['updateid']) ? mysqli_real_escape_string($con, $_GET['updateid']) : '';

if ($id === '') {
  echo "Error: updateid parameter is missing";
  exit;
}

$sql="SELECT * FROM `records` WHERE id=$id";

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
$Image=$row['Image'];

if(isset($_POST['submit'])){
  $Owner=$_POST['Owner'];
  $Pet=$_POST['Pet'];
  $Type=$_POST['Type'];
  $Breed=$_POST['Breed'];
  $Age=$_POST['Age'];
  $Weight=$_POST['Weight'];
  $AppointmentDate=$_POST['AppointmentDate'];
  $Appointment=implode(", ", $_POST['Appointment']);


  if(isset($_FILES['Image']) && $_FILES['Image']['error'] == 0) {

    $image = $_FILES['Image']['name'];
    $temp = $_FILES['Image']['tmp_name'];
    $folder = "uploads/".$image;

    if(move_uploaded_file($temp, $folder)) {

      if(!empty($row['Image'])) {
        unlink($row['Image']); 
      }
      $Image = $folder;

      $sql="UPDATE `records` SET Owner='$Owner', Pet='$Pet', Type='$Type', Breed='$Breed', Age='$Age', Weight='$Weight', AppointmentDate='$AppointmentDate', Appointment='$Appointment', Image='$Image' WHERE id=$id";
      if(!$result=mysqli_query($con,$sql)){
        echo "Error updating record: " . mysqli_error($con);
        exit;
      }
    } else {
      echo "Error uploading image: " . $_FILES['Image']['error'];
      exit;
    }
  } else {

    $sql="UPDATE `records` SET Owner='$Owner', Pet='$Pet', Type='$Type', Breed='$Breed', Age='$Age', Weight='$Weight', AppointmentDate='$AppointmentDate', Appointment='$Appointment' WHERE id=$id";
    if(!$result=mysqli_query($con,$sql)){
      echo "Error updating record: " . mysqli_error($con);
      exit;
    }
  }


  $sql="SELECT * FROM `records` WHERE id=$id";
  if($result=mysqli_query($con,$sql)){
    $row=mysqli_fetch_assoc($result);
    $Image=$row['Image'];
    header('location:display.php');
    exit;
  } else {
    echo "Error fetching updated record: " . mysqli_error($con);
    exit;
  }
}

function clearImage() {

  global $con, $id, $row;
  if(!empty($row['Image'])) {
    unlink($row['Image']); 
    $sql="UPDATE `records` SET Image='' WHERE id=$id"; 
    $result=mysqli_query($con,$sql);
    if($result){
      header('location:update.php?id='.$id);
    } else {
      die(mysqli_error($con));
    }
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
  <div class="container my-5">
    <h1>Updating <?php echo $Pet . "'s"?> Record</h1>
    <form method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <label>Pet Owner</label>
    <input type="text" class="form-control"  value="<?php echo $Owner ?>" name="Owner" required>
  </div>
  <div class="form-group">
    <label>Pet Name</label>
    <input type="text" class="form-control" value="<?php echo $Pet ?>" name="Pet" required>
  </div>
  <label for="pet-type">Pet Type</label>
<select class="custom-select" id="pet-type" name="Type" onchange="populateBreeds()">
  <option value="">Select Type</option>
  <option value="Cat"<?php if ($Type == "Cat") echo "selected"; ?>>Cat</option>
  <option value="Dog"<?php if ($Type == "Dog") echo "selected"; ?>>Dog</option>
  <option value="Bird"<?php if ($Type == "Bird") echo "selected"; ?>>Bird</option>
  <option value="Hamster"<?php if ($Type == "Hamster") echo "selected"; ?>>Hamster</option>
  <option value="Reptile"<?php if ($Type == "Reptile") echo "selected"; ?>>Reptile</option>
</select>

<label for="pet-breed">Pet Breed</label>
<select id="pet-breed" name="Breed" class="custom-select">
<?php echo $Breed; ?>
  <option value="">Select Breed</option>
</select>
  
<script>
  var breedDropdown = document.getElementById("pet-breed");
  breedDropdown.value = "<?php echo $Breed; ?>";

  populateBreeds();

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
    var savedBreed = "<?php echo $Breed; ?>";

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
    <input type="text" class="form-control" value="<?php echo $Age ?>" name="Age" required>
  </div>
  <div class="form-group">
    <label>Pet Weight</label>
    <input type="text" class="form-control" value="<?php echo $Weight ?>" name="Weight" required>
  </div>
  <div class="form-group">
    <label>Appointment Date</label>
    <input type="date" class="form-control" value="<?php echo $AppointmentDate ?>" name="AppointmentDate" required>
  </div>
  <label for="appointmentTypes">Appointment Type</label>
<div id="appointmentTypes">
  <div>
    <input type="checkbox" id="checkup" name="Appointment[]" value="Checkup" <?php if (strpos($Appointment, "Checkup") !== false) echo "checked"; ?>>
    <label for="checkup">Checkup</label>
  </div>
  <div>
    <input type="checkbox" id="surgery" name="Appointment[]" value="Surgery" <?php if (strpos($Appointment, "Surgery") !== false) echo "checked"; ?>>
    <label for="surgery">Surgery</label>
  </div>
  <div>
    <input type="checkbox" id="vaccine" name="Appointment[]" value="Vaccine" <?php if (strpos($Appointment, "Vaccine") !== false) echo "checked"; ?>>
    <label for="vaccine">Vaccine</label>
  </div>
  <div>
    <input type="checkbox" id="antiRabiesShot" name="Appointment[]" value="Anti-Rabies Shot" <?php if (strpos($Appointment, "Anti-Rabies Shot") !== false) echo "checked"; ?>>
    <label for="antiRabiesShot">Anti-Rabies Shot</label>
  </div>
  <div>
    <input type="checkbox" id="supplementShot" name="Appointment[]" value="Supplement Shot" <?php if (strpos($Appointment, "Supplement Shot") !== false) echo "checked"; ?>>
    <label for="supplementShot">Supplement Shot</label>
  </div>
</div>


<label for="Image">Pet Image</label>
<?php if(!empty($row['Image'])): ?>
  <div>
    <img src="<?php echo $row['Image']; ?>" height="100">
    <br>
    <button type="button" class="btn btn-danger" onclick="clearImage()">Delete Image</button>
  </div>
<?php endif; ?>
<input type="file" class="form-control" id="Image" name="Image">

<input type="hidden" name="id" value="<?php echo $id; ?>">
  <button type="submit" class="btn btn-primary" name="submit" action="/display" value="Update">Update</button>
</form>
</div>
<script>
function clearImage() {

  <?php if(!empty($row['Image'])): ?>
    var confirmDelete = confirm("Are you sure you want to delete this image?");
    if(confirmDelete) {
      console.log("Deleting image...");
      <?php
      unlink($row['Image']);
      $sql="UPDATE `records` SET Image='' WHERE id=$id";
      $result=mysqli_query($con,$sql);
      if(!$result) {
        die(mysqli_error($con));
      } else {
        console.log("Image deleted successfully.");
      }
      ?>
      window.location.reload();
    }
  <?php endif; ?>
}

</script>
  </body>
</html>