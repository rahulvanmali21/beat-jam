<?php 
if(isset($_POST["albumUpload"])){
if($_POST["title"]!= "" && $_POST["artist"]!=0 && $_POST["genre"]!=0)
{
    $albumTitle = $_POST["title"];
    $artist = $_POST["artist"];
    $genre = $_POST["genre"];
    $query = mysqli_query($con,"SELECT title FROM album WHERE title='$albumTitle'");
    if(mysqli_num_rows($query) > 0){
        toast("Title Already Exist");
        exit();
    }

    
    if($adminAlbum ->save($albumTitle,$artist,$genre)){
        echo"<script>
        M.toast({html: 'new Album Added',classes:'blue'})
        </script>";
    } else{
        echo"<script>M.toast({html: 'Failed', classes:'red'})</script>";
    }
}else{
    toast("Please Fill all the details");
        
    }
  
}
function toast($msg){
    echo "<script> 
    M.toast({html: '". $msg ."',classes:'red'})
    </script>";

}

?>
