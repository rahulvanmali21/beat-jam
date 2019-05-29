<?php 
class AdminAlbum{
    private $con;
    private $path = "../assets/images/albumArt/";
    public function __construct($con)
    {
        $this->con = $con;
    }
    public function save($title,$artist,$genre){
    $title = ucwords($title);
    $albumArt = "assets/images/albumArt" . basename($_FILES["albumArt"]["name"]) ;
    return $this->insert($title,$artist,$genre,$albumArt);
    }
    private function insert($title,$artist,$genre,$albumArt){
        if($this->uploadFile()){
            return $query = mysqli_query($this->con,"INSERT INTO album VALUES('','$title','$artist','$genre','$albumArt')");
        }
        else return false;

    }
    private function uploadFile(){
        $newPath = $this->path . basename( $_FILES["albumArt"]["name"]) ;
        if(move_uploaded_file($_FILES["albumArt"]["tmp_name"],$newPath)){
            return true;
        }
        else{
            return false;
        }
    }
}
?>