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

  $sql="insert into `records` (Owner, Pet, Type,Age, Weight, AppointmentDate, Appointment)
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
                            <a href="index.php" class="btn">
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
                           <a href="patients.php" class="btn">
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
                            <a href="help.php" class="btn">
                            <i class='bx bx-log-out'></i>
                                <span class="text nav-text"> Log Out </span>
                            </a>
                        </li>

                       

                    </ul>
                </div>

                
            </nav>

            <section class="home">
<div class="container">
    <h1> Clinic Records</h1> 
    <form class="form-inline my-2 my-lg-0 navbar-container">
   
    <input class="form-control mr-sm-2 col" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 col" type="submit">Search</button>
      &nbsp;
      <input class="btn btn-primary my-4 col text-light" type=button onClick="location.href='addrecord.php'" value='Add new record'>
      &nbsp;
      <style>
  .modal-fullscreen {
    width: 95%;
    height: 95%;
    max-width: none;
  }
</style>

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fullscreenModal">
  Export to excel
</button>


<div class="modal fade" id="fullscreenModal" tabindex="-1" role="dialog" aria-labelledby="fullscreenModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fullscreenModalLabel">Export to excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">  
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
    </tr>
  </thead>
  <tbody>
  <?php
  $sortOrder = 'ASC';
if (isset($_GET['sort']) && $_GET['sort'] === 'DESC') {
  $sortOrder = 'DESC';
}
$sql="SELECT * FROM `records` WHERE `Type`='Reptile' ORDER BY `AppointmentDate` $sortOrder";
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
          </tr> ';
    }
}
?>
  </tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="downloadexcel" class="btn btn-outline-dark col">Export xlsx file</button>
      </div>
    </div>
  </div>
</div>
      <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="sortDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Sort Order
  </button>
  <div class="dropdown-menu" aria-labelledby="sortDropdown">
    <a class="dropdown-item" href="?sort=ASC">Ascending</a>
    <a class="dropdown-item" href="?sort=DESC">Descending</a>
  </div>
</div>

<form class="form-inline my-2 my-lg-0 navbar-container">
  <select class="form-control mr-sm-2 col" id="pet-type">
    <option value="All">All</option>
    <option value="dog">Dog</option>
    <option value="cat">Cat</option>
    <option value="bird">Bird</option>
    <option value="hamster">Hamster</option>
    <option value="reptile" selected>Reptile</option>
  </select>
  <button class="btn btn-outline-success my-2 my-sm-0 col" type="button" id="filter-btn">Filter</button>
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
  <tbody>
  <script>
  var sortOrder = '<?php echo isset($_GET['sort']) && $_GET['sort'] === 'DESC' ? 'DESC' : 'ASC'; ?>';
  function toggleSortOrder() {
    if (sortOrder === 'ASC') {
      sortOrder = 'DESC';
    } else {
      sortOrder = 'ASC';
    }
    // reload the page with the new sort order
    window.location.href = '?sort=' + sortOrder;
  }
</script>


<?php
  $sortOrder = 'ASC';
  if (isset($_GET['sort']) && $_GET['sort'] === 'DESC') {
    $sortOrder = 'DESC';
  }
  $sql="SELECT * FROM `records` WHERE `Type`='Reptile' ORDER BY `AppointmentDate` $sortOrder";
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
</body>
</html>