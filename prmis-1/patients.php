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
?><!DOCTYPE html>
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
  <body> 
    <div class="container">
    <h1> Patient Lists</h1> 
    <form class="form-inline my-2 my-lg-0 navbar-container">
   
    <input class="form-control mr-sm-2 col" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 col" type="submit">Search</button>
      &nbsp;
      <button class="btn btn-primary my-4 col"><a href="addrecord.php" class="text-light">Add New Record</a></button>
      &nbsp;
      <button id="downloadexcel" class="btn btn-outline-dark col">Export xlsx file</button>
      <div class="dropdown">
  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    Sort by date
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="display.php">Ascending</a>
    <a class="dropdown-item" href="descending.php">Descending</a>
  </div>
</div>
<?php ?>
<form class="form-inline my-2 my-lg-0 navbar-container">
  <select class="form-control mr-sm-2 col" id="pet-type">
    <option value="">All</option>
    <option value="dog">Dog</option>
    <option value="cat">Cat</option>
    <option value="bird">Bird</option>
  </select>
  <button class="btn btn-outline-success my-2 my-sm-0 col" type="button" id="filter-btn">Filter</button>
</form>
    </form>
  </div>
</nav>
   <table class="table" id="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Owner</th>
      <th scope="col">Pet name</th>
      <th scope="col">Pet type</th>
      <th scope="col">Age</th>
      <th scope="col">Weight</th>
      <th scope="col">Appointment Date</th>
      <th scope="col">Appointment Type</th>
      <th scope="col">Operations</th> 
    </tr>
  </thead>
  <tbody>
    
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
</body>
</html>
  </main>

  <script src="app.js"></script>
</body>

</html>