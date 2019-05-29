<?php 
include("includes/config.php");
include("includes/Classes/User.php");
include("includes/Classes/Playlist.php");

include("includes/Classes/Artist.php");
include("includes/Classes/Album.php");
include("includes/Classes/Songs.php");
$userLoggedIn;
if(isset($_SESSION['loggedUser'])){
   $userLoggedIn = new User($con, $_SESSION['loggedUser']);
   $username = $userLoggedIn->getUser();
   echo "<script> loggedInUser = '".$username."'</script>";
}else{
   header("Location:register.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="./assets/images/icons/client.ico">

    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/topContainer.css">
    <link rel="stylesheet" href="./assets/css/mainIndex.css">
    <link rel="stylesheet" href="./assets/css/album.css">
    <link rel="stylesheet" href="./assets/css/animate.css">

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/script.js"></script>

    <title></title>
</head>
<body>
    <div id="wapper">

        <div id="topContainer">
            <?php include("./partials/sideBar.php"); ?>
            <div id="mainWrapper">
                <div id="main">