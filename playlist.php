<?php include("./includes/includedFiles.php");
if(isset($_GET['id'])){
    $playlistId =$_GET['id'];
} else{
    header("Location:index.php");
}
$playlist = new Playlist($con,$playlistId);
$user =  new User($con,$playlist->getUser());
include("./partials/confirmModal.php");
?>
<div class="albumInfo">
    <div class="leftPart animated  fadeInRight delay-1s">
        <img src="assets/images/icons/playlist.png" alt="">
    </div>
    <div class="rightPart animated fadeIn">
        <h2><?php echo $playlist->getName(); ?></h2>
        <p>By <?php echo $playlist->getUser();?></p>
        <span><?php echo $playlist->getSongsCount(); ?> Songs</span>
        <br><br>
        <button class="button redbg" onclick="openModal()">DELETE PLAYLIST</button>
    </div>
</div>
<div class="songListContainer animated fadeInDown delay-2s">
    <ul class="songList">
        
        <?php
        $songArray= $playlist->songIds() ; 
        $index = 1;
        foreach($songArray as $songId){
            $playlistSong = new Song($con,$songId);
            $trackArtist = $playlistSong->getArtist();
            echo "<li class='listItem'>
                <div class='songsCount '>
                <img  src='./assets/images/icons/play_album.png' onclick='setTrack(\"". $playlistSong->getId() ."\",tempPlaylist,true)'>
                    <span class='songIndex'>".$index .".<span>
                </div>
                <div class='songDetails'>
                    <span class='songtitle'>".$playlistSong->getTitle(). " </span>
                    <span class='artistName'>  ".$trackArtist->getArtistName()."</span>
                </div>
                <div class='songOptions'>
                <input type='hidden' class='songId' value='". $playlistSong->getId() ."' >
                    <img src='assets/images/icons/more.png'  class='songOptionButton' onclick='showMenu(this)'>
                </div>
                <div class='songDuration'>
                    <span class='duration'>". $playlistSong->getDuration() ."</span>
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
    <div class="item" onclick='deleteFromPlaylist(this,"<?php echo $playlistId ?>")'>Delete from Playlist</div>
</nav>

