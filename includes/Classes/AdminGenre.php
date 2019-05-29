<?php 
class AdminGenre{
    private $con;
public function __construct($con){
    $this->con = $con;
}
public function save($genre){
if($this->insert($genre)){
    return true;
} else{
    return false;
}
}
public function insert($genre){
return $query = mysqli_query($this->con,"INSERT INTO genre VALUES('','$genre')");
}
private function checkArtist($genre){
    $query = mysqli_query($this->con,"SELECT name FROM genre WHERE name='$genre'");
    if(mysqli_num_rows($query)!= 0 ){
    return false;
    }
}
}
?>