<?php
class Account {
    private $errors;
    private $con;

    public function __construct($con){
    $this->errors = array();
    $this->con =$con;
    }

    public function login($us,$pass){
        $newpass = md5($pass);
        $loginquery = mysqli_query($this->con,"SELECT * FROM users WHERE username='$us' AND password='$newpass'");
        if(mysqli_num_rows($loginquery) == 1){
            return true;
        }
        else {
            array_push($this->errors,Constants::$loginFailed);
            return false;
        }
    }


    public function register($uName,$fName,$lName,$email,$pass,$pass2){
        $this->validateUserName($uName);
        $this->validateFirstName($fName);
        $this->validateLastName($lName);
        $this->validateEmail($email);
        $this->validatePassword($pass,$pass2); 
        if(empty($this->errors) == true){
            return $this->registerNewUser($uName,$fName,$lName,$email,$pass);
            } 
        else{
            return false;  
            }
    }

    private function registerNewUser($userName,$firstName,$lastName,$email,$password){
        $newPassword =md5($password);
        $profilePic = "assets/images/profile_pics/2.png";
        $signUpDate=date("Y-m-d");

        $result = mysqli_query($this->con," INSERT INTO users  VALUES('','$userName','$firstName','$lastName','$email','$newPassword','$signUpDate','$profilePic')");
        return $result;
     }

    public function getAllError($error){
        if(!in_array($error,$this->errors)){
            $error = "";
        }
        return "<span class='alertMessage fadeIn'>$error</span>";
    }

    private function validateUserName($uName){
    if (strlen($uName) > 25 || strlen($uName) < 5){
        array_push($this->errors,Constants::$un_invalid);
        return;
        }
        $checkUserNameQuery = mysqli_query($this->con,"SELECT username FROM  users WHERE username='$uName'");
        if(mysqli_num_rows($checkUserNameQuery)!= 0 ){
            array_push($this->errors,Constants::$UserNameExist);
        }
    }
    private function validateFirstName($fName){
        if (strlen($fName) > 25 || strlen($fName) < 3){
        array_push($this->errors,Constants::$fn_invalid);
        return;
        }
    }
    private function validateLastName($lName){
        if (strlen($lName) > 25 || strlen($lName) < 3){
        array_push($this->errors,Constants::$ln_invalid);
        return;
        }
    }
    private function validateEmail($email){
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            array_push($this->errors,Constants::$em_invalid);
            return;
        }
        $checkEmailQuery = mysqli_query($this->con,"SELECT email FROM  users WHERE email='$email'");
        if(mysqli_num_rows($checkEmailQuery)!= 0 ){
            array_push($this->errors,Constants::$emailNameExist);
        }        
    }
    private function validatePassword($pass ,$pass2){
        if($pass != $pass2){
            array_push($this->errors,Constants::$pass_match);
            return;
        }
        if(preg_match('/[^A-Za-z0-9]/',$pass)){
            array_push($this->errors,Constants::$pass_type);
            return;
        }
        if (strlen($pass) < 6){
            array_push($this->errors,Constants::$pass_len);
            return;
        }  
    }
}
?>