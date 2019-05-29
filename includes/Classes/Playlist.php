<?php 
class Playlist{
    private $con;
    private $id;
    private $name;
    private $user;
    public function __construct($con,$data)
    {
        if(!is_array($data)){
            $data = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM playlists WHERE id='$data'"));
        }
        $this->con = $con;
        $this->id = $data["id"];
        $this->name = $data["name"];
        $this->user = $data["user"];

    }
    public static function getplaylistOption($con,$userName){
        $options =  "<select name='optionMenu' class='item playlistItem'>
        <option value='' disabled selected>Add to playlist</option>
        ";
        $playlistQuery = mysqli_query($con,"SELECT id , name FROM playlists WHERE user='$userName'");
        while($row = mysqli_fetch_array($playlistQuery)){
            $options = $options . "<option value='".$row['id']."'> ".$row['name']."</option>";
        } 
        return $options ."</select>";    

    }
    public function getName(){
        return $this->name;
    }
    
    public function getUser(){
        return $this->user;
    }
    
    public function getId(){
        return $this->id;
    }
    public function getSongsCount(){
        $query = mysqli_query($this->con,"SELECT songId FROM playlistsongs WHERE playlistId = '$this->id'");
        return mysqli_num_rows($query);
    }
    public function songIds(){
        $songArray = array();
        $result = mysqli_query($this->con,"SELECT songId FROM playlistsongs WHERE playlistId='$this->id' ORDER BY playlistOrder ASC");
        while($row = mysqli_fetch_array($result)){
            array_push($songArray,$row['songId']);
        }
        return $songArray;
    }
}
?>