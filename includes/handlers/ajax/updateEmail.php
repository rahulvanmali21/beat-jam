<?php 
include("../../config.php");
if(!isset($_POST['username'])){
 echo "Error : username not set";
 exit();
} 
if(isset($_POST["email"]) && $_POST["email"]!= "" ){
    $username = $_POST['username'];
    $email = $_POST['email'];
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        echo"you must enter an Email";
        exit();
    }
    $emailQuery = mysqli_query($con,"SELECT email FROM users WHERE email='$email' AND username !='$username'");
     if(mysqli_num_rows($emailQuery) > 0){
        echo "Email is already in Use";
        exit();
     }
     $query = mysqli_query($con,"UPDATE users SET email='$email' WHERE username='$username'");
     echo "Email Updated";

}else{
    echo"you must enter an Email";
}
?>