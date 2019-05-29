<?php
$query = mysqli_query($con,"SELECT * FROM users ORDER BY UNIX_TIMESTAMP(signUpDate) DESC LIMIT 5");
?>
<h3 class="white-text">Recently Joined</h3>
<div class="card hoverable">
    <div class="card-content">
<table class="highlight centered">
        <thead>
          <tr>
              <th>Username</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
          </tr>
        </thead>

        <tbody>
            <?php 
            while($row  = mysqli_fetch_array($query)){
                echo "<tr> 
                    <td>".$row['username']."</td>
                    <td>".$row['firstName'] ."</td>
                    <td>".$row['lastName'] ."</td>
                    <td>".$row['email'] ."</td>
                    </tr>
                    ";
            }
            ?>
        </tbody>
</table>  
    </div>
</div>