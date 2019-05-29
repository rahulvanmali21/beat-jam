
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/materialize.min.css">
    <link rel="icon" href="../assets/images/icons/admin.ico">

    <script src="../assets/js/materialize.min.js"></script>
    <script src="../assets/js/jquery.js"></script>

    <title>Admin Login</title>
</head>
<body class="teal lighten-2">
<?php 
include("../includes/config.php");
include("../includes/Classes/Constants.php");
include("../includes/Classes/Admin.php");
$admin = new Admin($con);
include("../includes/handlers/adminLogin-handler.php");
?>
    <div id="main">
        <div class="row">
            <div class="col m4 offset-m4 s8 offset-s2">
            <form action="login.php" class="card-panel hoverable form1" method="POST">
                <h4 class="center"> <strong> <span class="red-text">BEAT JAM </span> -ADMIN </strong></h4><br>
                <span class="center red-text" style="display:none" id="errMsg"></span>
                <div class="input-field">
                    <input type="text" name="admin" id="username" required>
                    <label for="username">Username</label>
                </div>
                <div class="input-field">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Password</label>
                </div>
                <button class="waves-effect waves-light btn" type="submit" name="adminLoginBtn">Login</button>
            </form>
            </div>
        </div>
    </div>
        <style>
    #main{
        height:100vh;
  }
  .form1{
      margin-top:30%;
  }
        </style>
</body>
</html>