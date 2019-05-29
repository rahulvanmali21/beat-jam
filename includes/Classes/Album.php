<?php
class Album{
    private $id;
    private $con;
    private $title="hello";
    private $artistID;
    private $genre;
    private $albumArt;

    public function __construct($con,$albumId){
        $this->id = $albumId;
        $this->con = $con;
        $query = mysqli_query($this->con, "SELECT * FROM album WHERE id='$this->id'");
        $album = mysqli_fetch_array($query);
        $this->title = $album['title'];
        $this->artistID = $album['artist'];
        $this->genre = $album['genre'];
        $this->albumArt = $album['albumArt'];
   

    }
    public function songIds(){
        $songArray = array();
        $result = mysqli_query($this->con,"SELECT id FROM songs WHERE album='$this->id' ORDER BY albumOrder ASC");
        while($row = mysqli_fetch_array($result)){
            array_push($songArray,$row['id']);
        }
        return $songArray;
    }

    public function getTitle(){
        return $this->title;
    }
    
    public function getArtist(){
        return new Artist($this->con,$this->artistID);
    }
    
    public function getGenre(){
        return $this->genre;
    }
    public function getAlbumArt(){
        return $this->albumArt;
    }
    public function getCount(){
        $query = mysqli_query($this->con,"SELECT id FROM songs WHERE album='$this->id'");
        return  mysqli_num_rows($query) ." songs";
    }
}
?>
