<?php include("./includes/includedFiles.php");; 
if(isset($_GET['id'])){
$albumId =$_GET['id'];
} else{
    header("Location:index.php");
}
$album = new Album($con,$albumId);
$artist = $album->getArtist();
?>
<div class="albumInfo">
    <div class="leftPart animated  fadeInRight delay-1s">
        <img src="<?php echo $album->getAlbumArt();?>" alt="">
    </div>
    <div class="rightPart animated fadeIn">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By <?php echo $artist->getArtistName();?></p>
        <span><?php echo $album->getCount(); ?></span>
    </div>
</div>
<div class="songListContainer animated fadeInDown delay-2s">
    <ul class="songList">
        
        <?php
        $songArray= $album->songIds(); 
        $index = 1;
        foreach($songArray as $songId){
            $albumSong = new Song($con,$songId);
            $albumArtist = $albumSong->getArtist();
            echo "<li class='listItem'>
                <div class='songsCount '>
                <img  src='./assets/images/icons/play_album.png' onclick='setTrack(\"". $albumSong->getId() ."\",tempPlaylist,true)'>
                    <span class='songIndex'>".$index .".<span>
                </div>
                <div class='songDetails'>
                    <span class='songtitle'>".$albumSong->getTitle(). " </span>
                    <span class='artistName'>  ".$albumArtist->getArtistName()."</span>
                </div>
                <div class='songOptions'>
                    <input type='hidden' class='songId' value='". $albumSong->getId() ."' >
                    <img src='assets/images/icons/more.png'  class='songOptionButton' onclick='showMenu(this)'>
                </div>
                <div class='songDuration'>
                    <span class='duration'>". $albumSong->getDuration() ."</span>
                </div>
            </li>
            ";
            $index ++;
        }
        ?>
        <script>
        var AlbumsongsId = '<?php echo json_encode($songArray); ?>';
        tempPlaylist = JSON.parse(AlbumsongsId);
        </script>

    </ul>
</div>

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getplaylistOption($con,$userLoggedIn->getUser()); ?>
    <div class="item">copy url</div>
</nav>