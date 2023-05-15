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
  

  $sql="insert into records (Owner, Pet, Type, Age, Weight, AppointmentDate, Appointment)
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
    $sql="SELECT * FROM records WHERE Owner LIKE '%$search%' OR Pet LIKE '%$search%' OR Type LIKE '%$search%'
       OR Breed LIKE '%$search%' OR Appointment LIKE '%$search%' ORDER BY AppointmentDate $sortOrder";
  } else {
    $sql="SELECT * FROM records ORDER BY AppointmentDate $sortOrder";
    $sort_url = "&sort=$sortOrder";
  }
} else {
  $sql="SELECT * FROM records ORDER BY AppointmentDate $sortOrder";
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
            <section class="home">
<div class="container">
    <h1 class="bastatext"> Clinic Records</h1> 
    <form class="form-inline my-2 my-lg-0 navbar-container" method="POST"">
   
    <input class="form-control mr-sm-2 col" type="search" name="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success my-2 my-sm-0 col" type="submit">Search</button>
      &nbsp;
      <input class="btn btn-primary my-4 col text-light" type=button onClick="location.href='addrecord.php'" value='Add new record'>
      &nbsp;
      <button id="downloadexcel" class="btn btn-outline-dark col">Export xlsx file</button>
      &nbsp;
      <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="sortDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort Order
  </button>
  <div class="dropdown-menu" aria-labelledby="sortDropdown">
    <a class="dropdown-item" href="patients.php">Ascending</a>
    <a class="dropdown-item" href="descending.php">Descending</a>
  </div>
</div>
<form class="form-inline my-2 my-lg-0 navbar-container">
  <select class="form-control mr-sm-2 col" id="pet-type">
    <option value="All">All</option>
    <option value="dog">Dog</option>
    <option value="cat">Cat</option>
    <option value="bird">Bird</option>
    <option value="hamster">Hamster</option>
    <option value="reptile">Reptile</option>
  </select>
  <button class="btn btn-outline-success my-2 my-sm-0 col" type="button" id="filter-btn">Filter</button>
  &nbsp;
<button id="notif-btn" type="button" class="btn btn-secondary position-relative" data-container="body" data-toggle="popover" data-placement="bottom">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
  <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
</svg>
  <span id="notif-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    <span id="notif-number"></span>
  </span>
</button>

<?php 
  $result=mysqli_query($con,$sql);
  $count = 0;
  $content = "";
  if($result){
    while($row=mysqli_fetch_assoc($result)){
      if($AppointmentDate=$row['AppointmentDate'] == date('Y-m-d')){
        $content .= $row['Pet'] . "'s " . $row['Appointment'] . " is scheduled today <br>";
        $count++;
      };
    }
  }
?>
</div>
</form>
    </form>
  </div>
</nav>
<script src="table2excel.js"></script>
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
</section>
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
                <button class="btn btn-primary"><a href="view.php?updateid='.$id.'"><i class="fa-sharp fa-regular fa-eye" style="color:white;"></i></i></a></button>
                <button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light"><i class="bx bxs-edit" style="color:white;"></i></a></button>
                <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'" class="text-light"><i class="bx bxs-trash" style="color:white;"></i></a></button>
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
    window.location.href = "patients.php";
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
<script>
  $(document).ready(function(){
    $('#notif-number').text("<?php echo $count; ?>");
    $('#notif-btn').popover({
      content: "<?php echo $content; ?>",
      html: true
    });
    $('#notif-btn').on('shown.bs.popover', function () {
      setTimeout(function() {
        $('#notif-btn').popover('hide');
      }, 5000);
    });
  });
</script>
</body>
</html>
