<?php 
if(isset($_POST['adminLoginBtn'])){
$name = $_POST['admin'];
$password = $_POST['password'];
$verification = $admin->login($name,$password);
if($verification){
    $_SESSION["loggedAdmin"] = $name;
    header("Location:dashboard.php");
} else{
    echo "
   
    <script> 
    M.toast({html:'Invalid username and password ',classes:'red white-text'})
    </script>";
}
}
?>