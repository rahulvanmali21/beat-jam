<?php
if(isset($_POST['loginButton'])){
$username = $_POST["loginUserName"];
$password = $_POST["loginPassword"];
$verification = $account->login($username,$password);
if($verification){
    $_SESSION["loggedUser"] = $username;
    header("Location:index.php");
}
}
?>