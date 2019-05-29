<?php 
class Song{
    private $con;
    private $id;
    private $Data;
    private $title;
    private $artistId;
    private $albumId;
    private $genre;
    private $duration;
    private $path;

    public function __construct($con,$id){
        $this->con =$con;
        $this->id =$id;

        $query = mysqli_query($this->con,"SELECT * FROM  songs WHERE id='$this->id'");
        $this->Data = mysqli_fetch_array($query);
        $this->title = $this->Data['title'];
        $this->artistId = $this->Data['artist'];
        $this->albumId = $this->Data['album'];
        $this->genre = $this->Data['genre'];
        $this->duration = $this->Data['duration'];
        $this->path = $this->Data['path'];

    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getId(){
        return $this->id;
    }
    public function getArtist(){
        return new Artist($this->con,$this->artistId);
    }
    public function getAlbum(){
        return new Album($this->con,$this->albumId);
    }
    public function getGenre(){
        return $this->genre;
    }
    public function getDuration(){
        return $this->duration;
    }
    public function getPath(){
        return $this->path;
    }
    public function getData(){
        return $this->Data;
    }
}
?>