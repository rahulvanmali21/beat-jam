<?php 
 if(isset($_POST["uploadGenre"])){
     if(isset($_POST["genre"]) && $_POST["genre"]!=""){

         $genre = mysqli_real_escape_string($con,$_POST['genre']);
         $query =mysqli_query($con,"SELECT name FROM genre WHERE name='$genre'");
         if(mysqli_num_rows($query)> 0){
            toast("Genre Already Exist");
         } else{
            if( $adminGenre->save($genre)){
                echo "<script>
                M.toast({html: 'New Genre Added'})
                </script>";
            }else{
                echo "<script>
                M.toast({html: 'Failed to Add Genre'})
                </script>";
            }
         }

     } else{
        toast("Please enter all details");
     }
     
}
function toast($msg){
    echo "<script> 
    M.toast({html: '". $msg ."',classes:'blue'})
    </script>";

}


?>