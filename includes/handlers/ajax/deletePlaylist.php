<?php 
include("../../config.php");
if(isset($_POST['playlistId'])){
        $playlistId = $_POST["playlistId"];
      

        $playlistQuery = mysqli_query($con,"DELETE FROM playlists WHERE id='$playlistId'");
        $songsQuery = mysqli_query($con,"DELETE FROM playlistsongs WHERE playlistId='$playlistId'");
}

?>