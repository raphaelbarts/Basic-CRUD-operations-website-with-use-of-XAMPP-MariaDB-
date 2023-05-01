<?php
include 'connect.php';
$id = $_GET['updateid'];
$sql="SELECT * FROM `records` WHERE id=$id";
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

if(isset($_POST['submit'])){
  $Owner=$_POST['Owner'];
  $Pet=$_POST['Pet'];
  $Type=$_POST['Type'];
  $Breed=$_POST['Breed'];
  $Age=$_POST['Age'];
  $Weight=$_POST['Weight'];
  $AppointmentDate=$_POST['AppointmentDate'];
  $Appointment=$_POST['Appointment'];
  
  // check if a new image file was uploaded
  if(isset($_FILES['Image']) && $_FILES['Image']['error'] == 0) {
    // get the image file
    $image = $_FILES['Image']['name'];
    $temp = $_FILES['Image']['tmp_name'];
    $folder = "images/".$image;
    // move the image file to the server
    move_uploaded_file($temp, $folder);
    $Image = $folder;
  }

  $sql="UPDATE `records` SET Owner='$Owner', Pet='$Pet', Type='$Type', Breed='$Breed', Age='$Age', Weight='$Weight', AppointmentDate='$AppointmentDate', Appointment='$Appointment', Image='$Image' WHERE id=$id";

  $result=mysqli_query($con,$sql);
  if($result){
    header('location:display.php');
  } else {
    die(mysqli_error($con));
  }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar Menu</title>
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
            <i class='bx bx-log-out'></i>            </div>
            <span>Logout</span>
          </a>
        </li>
      </ul>  
  </nav>
  <div class="container my-5  ">
    <h1>Update Record</h1>
    <h4>Re-setting of type and breed is required.</h4>
    <form method="POST">
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
  <option selected value="<?php $Type ?>"><?php echo $Type ?></option>
  <option value="Cat">Cat</option>
  <option value="Dog">Dog</option>
  <option value="Bird">Bird</option>
  <option value="Hamster">Hamster</option>
  <option value="Reptile">Reptile</option>
</select>

<label for="pet-breed">Pet Breed</label>
<select id="pet-breed" name="Breed" class="custom-select">
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
  <label for="inputGroupSelect01">Appointment Type</label> 
  <select class="custom-select" id="inputGroupSelect01" name="Appointment">
    <option selected><?php echo $Appointment ?></option>
    <option value="Checkup">Checkup</option>
    <option value="Surgery">Surgery</option>
    <option value="Vaccine">Vaccine</option>
    <option value="Anti-Rabies Shot">Anti-Rabies Shot</option>
    <option value="Supplement Shot">Supplement Shot</option>
</select>
<div class="form-group">
  <label>Image</label>
  <div>
    <?php if(!empty($row['Image'])) { ?>
      <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Image']); ?>" alt="Current Image" height="200" width="200">
      <input type="hidden" name="current_image" value="<?php echo base64_encode($row['Image']); ?>">
    <?php } ?>
    <input type="file" class="form-control-file" name="Image" id="imageInput" <?php if(empty($row['Image'])) { echo ''; } ?>>
    <button type="button" class="btn btn-outline-danger" onclick="clearImage()">Clear</button>
  </div>
</div>
  
  <button type="submit" class="btn btn-primary" name="submit" action="/display">Update</button>
</form>
</div>
<a href="editor/imageeditor.php">sdad</a>
  
  </body>
</html>