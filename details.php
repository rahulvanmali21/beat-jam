<?php 
include("./includes/includedFiles.php");
?>
<div class="userDetails">
    <div class="container borderBottom">
    <h2>Email</h2>
    <input type="text" name="email" class="email" placeholder="Email address" value="<?php echo $userLoggedIn->getEmail(); ?>">
    <span class="msg"></span>
    <button class="button redbg" onclick="updateEmail('email')">SAVE</button><br>
    </div>
    <div class="container">
        <h2>Password</h2>
        <input type="password" name="oldpassword" class="oldPassword" placeholder="current password">
        <input type="password" name="newPassword1" class="newPassword1" placeholder="new password">
        <input type="password" name="newPassword2" class="newPassword2" placeholder="confirm password">

        <span class="msg"></span>
        <button class="button redbg" onclick="updatePassword('oldPassword','newPassword1','newPassword2')">SAVE</button>
    </div>
</div>