<?php include("./layout/admin-header.php"); ?>

<h4 class="white-text center">Account Settings</h4>

   <center>
    <img src="../assets/images/profile_pics/admin.png" class="responsive-img" width="200">
   <h4 class="white-text">
<strong><?php echo $admin->getUsername() ;?></strong>    
   </h4>
        </center>


<div class="card">
    <div class="card-content">
        <span class="card-title">Change Username</span>
      

        <div class="input-field">
            <input type="text" name="username" class="username" value="<?php echo $admin->getUsername() ;?>">
            <label>Username</label>
        </div>
        <button onclick="changeUsername('username')" class="waves-effect waves-light btn">SAVE</button>
        <span class="red-text" id="userUpdateMsg"></span>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <span class="card-title">Change Password</span>
        <div class="input-field">
            <input type="password" name="oldPassword" class="oldpPassword">
            <label>Current Password</label>
        </div>
        <div class="input-field">
            <input type="password" name="newPassword1" class="newPassword1">
            <label>New Password</label>
        </div>
        <div class="input-field">
            <input type="password" name="newPassword2" class="newPassword2">
            <label>Confirm Password</label>
        </div>
        <button onclick="changePassword('oldpPassword','newPassword1','newPassword2')" class="waves-effect waves-light btn">SAVE</button>
        <span class="red-text" id="passwordUpdateMsg"></span>
    </div>
</div>


<?php include("./layout/admin-footer.php"); ?>