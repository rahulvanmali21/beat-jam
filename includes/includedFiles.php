<?php 
if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
include("includes/config.php");
include("includes/Classes/User.php");
include("includes/Classes/Playlist.php");

include("includes/Classes/Artist.php");
include("includes/Classes/Album.php");
include("includes/Classes/Songs.php");
if(isset($_GET["loggedInUser"])){
    $userLoggedIn = new User($con,$_GET["loggedInUser"]);
} else{
    echo "Username  wasnt login";
}
     
} else{
    include("includes/layouts/header.php");
    include("includes/layouts/footer.php");
    $url = $_SERVER["REQUEST_URI"];
    echo "<script>openPage('$url')</script>";
    exit();
}
?>