<?php 
include("includes/config.php");
include("includes/Classes/Account.php");
include("includes/Classes/Constants.php");

$account = new Account($con);



include("includes/handlers/register-handlers.php");
include("includes/handlers/login-handlers.php");

function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome To Beat Jam</title>
    <link rel="stylesheet" href="assets/css/register.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="icon" href="assets/images/icons/client.ico">

    <link rel="stylesheet" href="assets/css/content.css">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/register.js"></script>

</head>
<body>
<script>
<?php
if(isset($_POST["RegisterButton"])){
    echo '$(document).ready(()=>{
        $("#loginForm").hide();
        $("#registerForm").show(); 
        $("#registerForm").removeClass("animated");

        $("#headingtext h1").removeClass("animated");
        $("#headingtext h2").removeClass("animated");
        $("#headingtext ul").removeClass("animated");
        $(".alertMessage").addClass("animated");


    });';
}

elseif(isset($_POST["loginButton"])){
    echo'$(document).ready(()=>{
        $("#loginForm").show();
        $("#registerForm").hide();
        $("#loginForm").removeClass("animated");

        $("#headingtext h1").removeClass("animated");
        $("#headingtext h2").removeClass("animated");
        $("#headingtext ul").removeClass("animated");
        $(".alertMessage").addClass("animated");


    });';
} else{
    echo'$(document).ready(()=>{
        $("#loginForm").show();
        $("#registerForm").hide();
        $("#registerForm").addClass("animated");
        $("#loginForm").addClass("animated"); 
    });';
}
?>

</script>
    <div id="mainBackground">
    
        <div id="formContainer">
            <div id="inputContainer">
                <form action="register.php" method="POST" id="loginForm" style="display:None" class="animated fadeInLeft">
                    <h2>Login to your account</h2>
                <p> <label for="loginUserName">Username</label><input type="text" name="loginUserName" value="<?php getInputValue('loginUserName') ?>" require id="loginUserName"></p>
                
                <?php echo $account->getAllError(Constants::$loginFailed); ?>
                <p> <label for="loginPassword">Password</label> <input type="password" name="loginPassword"  require id="loginPassword"></p>
                
                    <button type="submit" name="loginButton">Login</button>
                    <div class="formToggle">
                    <span id="hideLogin">Don't have a Account yet? Register here!</span>
                    </div>
                </form>


                <form action="register.php" method="POST" id="registerForm" style="display:None" class="animated fadeInLeft">
                    <h2>Create your Free account</h2>
                <p> <label for="UserName">Username</label><input type="text" name="UserName" value="<?php getInputValue('UserName') ?>"  require id="UserName"></p>
                <?php echo $account->getAllError(Constants::$un_invalid); ?>
                <?php echo $account->getAllError(Constants::$UserNameExist); ?>

                
                <p> <label for="FirstName">First Name</label><input type="text" name="FirstName" value="<?php getInputValue('FirstName') ?>"  require id="FirstName"></p>
                
                <?php echo $account->getAllError(Constants::$fn_invalid); ?>
                
                <p> <label for="LastName">Last Name</label><input type="text" name="LastName" value="<?php getInputValue('LastName') ?>"  require id="LastName"></p>
                
               
                <?php echo $account->getAllError(Constants::$ln_invalid); ?>
                
                <p> <label for="email">EMAIL</label><input type="email" name="email" value="<?php getInputValue('email') ?>"  require id="email"></p>
                
                <?php echo $account->getAllError(Constants::$em_invalid); ?>
                <?php echo $account->getAllError(Constants::$emailNameExist); ?>

                
                <p> <label for="Password">Password</label> <input type="password" name="Password" value="<?php getInputValue('Password') ?>"   require id="Password"></p>
                
                <?php echo $account->getAllError(Constants::$pass_type) ?>
                <?php echo $account->getAllError(Constants::$pass_len); ?>
                
                <p> <label for="Password2">Confirm Password</label> <input type="password" name="Password2" value="<?php getInputValue('Password2') ?>"  require id="Password2"></p>
                
                <?php echo $account->getAllError(Constants::$pass_match); ?>
                    <button type="submit" name="RegisterButton">Create Account</button>
                    <div class="formToggle">
                        <span id="hideRegister">already have an account? login here!</span>
                    </div>
                </form>
            </div>

        <div id="headingtext" >
            <h1 class="animated fadeIn delay-1s">WHEN WORDS FAIL MUSIC SPEAKS</h1>
            <h2 class="animated fadeIn delay-1s">Platform for streaming music for free</h2>
                <ul class="animated rollIn delay-2s">
                    <li><img src="./assets/images/icons/heart.png" width=25> Total Overdose of music</li>
                    <li><img src="./assets/images/icons/star.png" width=25> Listen and create your own playlist</li>
                    <li><img src="./assets/images/icons/check.png" width=25> Stay up to date with the latest albums</li>
                </ul>
        </div>
        </div>
    </div>
</body>
</html>