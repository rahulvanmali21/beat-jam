<?php 
include("./includes/includedFiles.php");
if(isset($_GET['id'])){
    $artistId =$_GET['id'];
    } else{
        header("Location:index.php");
    }
$artist = new Artist($con,$artistId);
?>
<div class="albumInfo borderBottom">
    <div class="centerSection">
        <div class="artistInfo">
         <h1 class="artist Name animated fadeIn"><?php echo$artist->getArtistName() ?></h1>
         <div class="headerButtons ">
            <button class="button redbg animated fadeInUp delay-1s" onclick="playFirstSong()">Play</button>
         </div>
        </div>
    </div>
</div>
<div class="songListContainer  borderBottom">
    <h2>SONGS</h2>
    <ul class="songList animated fadeInDown delay-2s">
        
        <?php
        $songArray= $artist->getsongId(); 
        $index = 1;
        foreach($songArray as $songId){
            if($index>5){
                break;  
            }
            $albumSong = new Song($con,$songId);
            $albumArtist = $albumSong->getArtist();
            echo "<li class='listItem'>
                <div class='songsCount'>
                <img src='./assets/images/icons/play_album.png' onclick='setTrack(\"". $albumSong->getId() ."\",tempPlaylist,true)'>
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

<div class="gridContainer">
    <h2>ALBUMS</h2>
    <?php 
    $query_album = mysqli_query($con,"SELECT * FROM album WHERE artist='$artistId'");
    while($row = mysqli_fetch_array($query_album)) {
        
        echo"<div class='gridItem animated fadeIn delay-2s'>
        <span style='cursor:pointer;' tabindex='0' role='link' onclick='openPage(\"album.php?id=".$row['id']."\")'>
            <img src='". $row['albumArt'] ."'>
            <div class='gridInfo'>
            " .$row['title']  ."
            </div>
        </span>
        </div>";

        }
    ?>
</div>
<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getplaylistOption($con,$userLoggedIn->getUser()); ?>
    <div class="item">copy url</div>
</nav>
