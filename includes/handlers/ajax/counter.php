<?php 
include("../../config.php");
function getData($query){
    
    return mysqli_num_rows(mysqli_query($query));

}
if(isset($_POST['songs'])){

    $query = mysqli_query($con,"SELECT * FROM songs");
    $rows = mysqli_num_rows($query); 
    echo json_encode($rows);
} 
elseif (isset($_POST['albums']))
{
    $query = mysqli_query($con,"SELECT * FROM album");
    $rows = mysqli_num_rows($query); 
    echo json_encode($rows);
}
elseif (isset($_POST['artists']))
{
    $query = mysqli_query($con,"SELECT * FROM artist");
    $rows = mysqli_num_rows($query); 
    echo json_encode($rows);
}
elseif (isset($_POST['users']))
{
    $query = mysqli_query($con,"SELECT * FROM users");
    $rows = mysqli_num_rows($query); 
    echo json_encode($rows);
}
?>
