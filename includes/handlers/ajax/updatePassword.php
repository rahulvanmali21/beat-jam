<?php 
include("../../config.php");
if(!isset($_POST['username'])){
 echo "Error : username not set";
 exit();
} 
if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword1'])  || !isset($_POST['newPassword2'])){
    echo "Not all Passwords are set";
    exit();
}
if($_POST['oldPassword']=="" || $_POST['newPassword1']==""  || $_POST['newPassword2'] ==""){
    echo "please enter all the fields";
    exit();
}
$username = $_POST["username"];
$oldPassword = $_POST["oldPassword"];
$newPassword1 = $_POST["newPassword1"];
$newPassword2 = $_POST["newPassword2"];

$oldMd5 = md5($oldPassword);
$passwordCheck = mysqli_query($con,"SELECT * FROM users WHERE username='$username' AND password='$oldMd5'");
if(mysqli_num_rows($passwordCheck) != 1){
    echo "password is incorrect";
    exit();
}
if($newPassword1 != $newPassword2){
    echo "new passwords are not  matching";
    exit();
}
if(preg_match('/[^A-Za-z0-9]/',$newPassword1)){
echo "your password must only contain Alphanumberic Character";
exit();
}
if(strlen($newPassword1) > 25 || strlen($newPassword1) < 5 ){
    echo "your password must be between 5 to 25 character";
    exit();
}
$newMd5 =  md5($newPassword1);
$query = mysqli_query($con,"UPDATE users SET password='$newMd5' WHERE username='$username'");
echo "password Updated";
?>