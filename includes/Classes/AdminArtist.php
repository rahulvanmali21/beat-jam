<?php 
class AdminArtist{
    private $con;
public function __construct($con){
    $this->con = $con;
}
public function save($artistName){
if($this->insert($artistName)){
    return true;
} else{
    return false;
}
}
public function insert($artistName){
return $query = mysqli_query($this->con,"INSERT INTO artist VALUES('','$artistName')");
}
private function checkArtist($artistName){
    $query = mysqli_query($this->con,"SELECT name FROM artist WHERE name='$artistName'");
    if(mysqli_num_rows($query)!= 0 ){
    return false;
    }
}
}
?>