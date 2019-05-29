<?php
class Admin{
private $con;
private $errors = array();
public function __construct($con){
$this->con = $con;
}

public function login($admin,$unS_pass){
$pass = md5($unS_pass);
$query = mysqli_query($this->con,"SELECT * FROM admins WHERE username='$admin' AND password ='$unS_pass'");
if(mysqli_num_rows($query) ==  1){
    return true;
} else{
    echo "
    <script src='../assets/js/jquery.js'></script>
    
    <script> 
   $('#errMsg').val('invalid username and password');
   $('#errMsg').show();
    </script>";
    return false;
    }
}

public function getUsername(){
    $query = mysqli_query($this->con,"SELECT username FROM admins");
    $row = mysqli_fetch_array($query);
    return $row["username"];
}

}
?>