<?php 
if(isset($_POST["uploadArtist"])){
    if(isset($_POST["artist"])&& $_POST['artist']!= ""){
        $artistName = mysqli_real_escape_string($con,$_POST['artist']);
        $query = mysqli_query($con,"SELECT name from artist WHERE name='$artistName'");
        if(mysqli_num_rows($query) > 0){
            toast2("Artist Already Exist");
        } else {
            if( $adminArtist->save($artistName)){
                echo "<script>
                M.toast({html: 'New Artist Added'})
                </script>";
            }else{
                echo "<script>
                M.toast({html: 'Failed to Add Artist'})
                </script>";
            }
        }
    } else{
        toast2("Please Fill all the Details");
    }
}
function toast2($msg){
    echo "<script> 
    M.toast({html: '". $msg ."',classes:'red'})
    </script>";

}
?>