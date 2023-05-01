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
            <span class="link hide">Manage Users</span>
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
    <h1> Manage Users</h1> 
    <form class="form-inline my-2 my-lg-0 navbar-container">
   
    
      <button class="btn btn-primary my-4 col"><a href="addrecord.php" class="text-light">Add New User</a></button>
      &nbsp;

     
  </button>
  
</div>
<?php ?>

  
<div class="table-wrapper">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>UserType</th>
        <th>Username</th>
        <th>Email Address</th>
        <th>Password</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>VetStaff</td>
        <td>Dr.JohnCena</td>
        <td>npnp@gmail.com</td>
        <td>12345678</td>
        <td>
          <a href="#" class="edit"><i class='bx bx-edit'></i></a>
          <a href="#" class="delete"><i class='bx bx-trash'></i></a>
        </td>
      </tr>
      <tr>
        <td>2</td>
        <td>Admin</td>
        <td>AdminBingChilling</td>
        <td>icecream@gmail.com</td>
        <td>12345678</td>
        <td>
          <a href="#" class="edit"><i class='bx bx-edit'></i></a>
          <a href="#" class="delete"><i class='bx bx-trash'></i></a>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</body>

</html>