<?php
class Artist{
    private $con;
    private $id;
    public  function __construct($con,$id){
        $this->con = $con;
        $this->id =$id;
    }
    public function getArtistName(){
        $artistQ = mysqli_query($this->con,"SELECT * from artist WHERE id='$this->id'");
        $artistDetail = mysqli_fetch_array($artistQ);
        return $artistDetail["name"];
    }
    public function getsongId(){
        $songArray = array();
        $result = mysqli_query($this->con,"SELECT id FROM songs WHERE artist='$this->id' ORDER BY plays DESC");
        while($row = mysqli_fetch_array($result)){
            array_push($songArray,$row['id']);
        }
        return $songArray;
    }
    public function getartistId(){
        return $this->id;
    }
}

?>