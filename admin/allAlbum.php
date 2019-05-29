<?php include("./layout/admin-header.php"); 
function getdata($type,$id,$con){
if($type=="artist"){
$data = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM artist where id='$id'"));
return $data['name'];
}else{
    $data = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM genre where id='$id'"));
    return $data['name'];
}
}
?>
<h4 class="center white-text">Albums</h4>
<div class="white hoverable">
<table class="">
        <thead>
          <tr>
              <th>Name</th>
              <th>Artist</th>
              <th>Genre</th>
          </tr>
        </thead>

        <tbody>
          
          
            <?php 
            while($row = mysqli_fetch_array($albumQuery)){
                echo "<tr>
                <td>".$row["title"]."</td>
                <td>".getdata("artist",$row['artist'],$con)."</td>
                <td>".getdata("genre",$row['genre'],$con)."</td>                
              </tr>";
            }
            ?>

        </tbody>
      </table>
</div>
<?php include("./layout/admin-footer.php"); ?>
