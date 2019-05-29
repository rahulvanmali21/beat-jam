<?php 
include("../includes/config.php");
include("../includes/Classes/Constants.php");
include("../includes/Classes/Admin.php");
$admin = new Admin($con);
$artistQuery = mysqli_query($con,"SELECT * FROM artist");
$genreQuery = mysqli_query($con,"SELECT * FROM genre");
$albumQuery = mysqli_query($con,"SELECT * FROM album");
if(isset($_SESSION['loggedAdmin'])){
   echo "<script> 
   adminLoggedIn = true;
   </script>";
 }else{
    header("Location:login.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="icon" href="../assets/images/icons/admin.ico">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/admin-script.js"></script>

    <script src="../assets/js/materialize.min.js"></script>
    <title>Admin Dashboard</title>
</head>
<body class="teal lighten-2">
<div class="navbar-fixed">
<nav>
    <div class="nav-wrapper white lighten-5">
        <div class="container">
      <a href="dashboard.php" class="brand-logo grey-text center"> <span class="red-text">BEAT JAM</span>  -ADMIN panel</a>
      <a style="cursor:pointer" data-target="slide-out" class="sidenav-trigger show-on-large left blue-text"><img src="../assets/images/icons/menu.png" alt="menu" style="margin-top:12px"></a>  
    </div>
    </div>
  </nav>
  </div>
  <ul id="slide-out" class="sidenav">
        <li><div class="user-view">
        <div class="background">
            <img src="../assets/images/art.jpg">
        </div>
        <a href="settings.php"><img class="circle" src="../assets/images/profile_pics/admin.png"></a>
        <a href="settings.php"><span class="black-text name">Admin</span></a>
        </div></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="song.php">Add Songs</a></li>
        <li><a href="album.php">Add album</a></li>
        <li><a href="artist.php">Add Artist or Genre</a></li>
       
        <li><a href="settings.php">Admin Setting</a></li>
        <li><div class="divider"></div></li>
        <li onclick="adminLogout()" style="cursor:pointer;"><a>Logout</a> </li>
    </ul>   
  <div class="container">
  <br>