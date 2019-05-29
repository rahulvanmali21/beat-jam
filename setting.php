<?php 
include("./includes/includedFiles.php");
?><br>
<div class="playlistContainer">
    <div class="gridContainer">
        <center>
        <img class="animated fadeInDown" src="<?php echo $userLoggedIn->getProfilePic();?>" width="200" alt="" style="margin: 0 auto;">
        </center>
        <h2><?php echo $userLoggedIn->getFirstAndLastName(); ?></h2>
        <div class="buttonEntity">
            <button class="button redbg animated fadeInUp" onclick='openPage("details.php")'>USER DETAILS</button>
            <button class="button redbg animated fadeInUp delay-1s" onclick="logout()">LOGOUT</button>
        </div>
    </div>
</div>