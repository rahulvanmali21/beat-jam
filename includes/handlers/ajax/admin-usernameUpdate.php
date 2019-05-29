<?php 
include("../../config.php");
if(!isset($_POST['username'])){
 echo "Error : username not set";
 exit();
} 
if(isset($_POST["username"]) && $_POST["username"]!= "" ){
    $username = $_POST['username'];
   
    if(strlen($username) > 25 && strlen($username) < 5){
        echo"username should have character between 5 - 25";
        exit();
    }
    $usernameQuery = mysqli_query($con,"SELECT username FROM admins WHERE username='$username'");
     if(mysqli_num_rows($usernameQuery) > 0){
        echo "Email is already in Use";
        exit();
     }
     $query = mysqli_query($con,"UPDATE admins SET username='$username'");
     echo "Username Updated";

}else{
    echo"you must enter an Valid Username";
}
?>