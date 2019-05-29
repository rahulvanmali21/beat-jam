<?php 
function purifyPassword($inputData){
    $inputText = strip_tags($inputData);
    return $inputData;
}
function purifyFormInput($inputData){
    $inputData = strip_tags($inputData);
    $inputData = str_replace(" ","",$inputData);
    return $inputData;
}

function purifyFormString($inputData){
    $inputData = strip_tags($inputData);
    $inputData = str_replace(" ","",$inputData);
    $inputData = ucfirst(strtolower($inputData));
    return $inputData;
}
 if(isset($_POST['RegisterButton'])){
     $userName  = purifyFormInput($_POST['UserName']);
     $firstName = purifyFormString($_POST['FirstName']);
     $lastName  = purifyFormString($_POST['LastName']);
     $email     = purifyFormString($_POST['email']);
     $password  = purifyFormString($_POST['Password']);
     $password2  = purifyFormString($_POST['Password2']);
     
     $wasSuccessfull = $account->register($userName,$firstName,$lastName,$email,$password,$password2);
     if($wasSuccessfull){
         $_SESSION['loggedUser'] = $userName;
         header("Location:index.php");
     }     
 }

?>