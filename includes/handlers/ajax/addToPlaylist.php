<?php 
include("../../config.php");
if(isset($_POST['playlistId']) && isset($_POST['songId'])){
    $playlistId = $_POST['playlistId'];
    $songId = $_POST['songId'];
    $orderQuery = mysqli_query($con,"SELECT MAX(playlistOrder) + 1 as playlistOrder  FROM playlistsongs WHERE playlistId='$playlistId'");
    $row = mysqli_fetch_array($orderQuery);
    $order = $row['playlistOrder'];
    $query = mysqli_query($con,"INSERT INTO playlistsongs VALUES('','$songId','$playlistId','$order')");
} else{
    echo "something is missing";
}

?>