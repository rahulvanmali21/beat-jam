<?php 
include("./includes/includedFiles.php");
if(isset($_GET["term"])){
    $term =urldecode($_GET["term"]); 
}else{
    $term = "";
}
?>
<div class="searchContainer">
    <h4>Search for Artist songs or Album </h4>
    <input type="text"  name="search"   placeholder="Search......" value="<?php echo $term;?>" class="inputSearch" >
</div>
<script>
$(".inputSearch").focus().val("").val("<?php echo $term;?>");
 
$(()=>{
    
    $(".inputSearch").keyup(()=>{
        clearTimeout(timer);
        timer =  setTimeout(() => {
            var val = $(".inputSearch").val();
            openPage("search.php?term="+val);
        },2000);
    });
});
</script>
<?php
if($term=="") exit();
 ?>
<div class="songListContainer borderBottom">
    <h2>SONGS</h2>
    <ul class="songList">
        <?php
        $songsQuery = mysqli_query($con,"SELECT id FROM songs WHERE title LIKE '$term%' LIMIT 10 ");
        if(mysqli_num_rows($songsQuery) == 0){
            echo "<span class='notFound'>No songs Found</span>";
        }
        $songArray= array();
        $index = 1;
        while($row = mysqli_fetch_array($songsQuery)){
            if($index>15){
                break;  
            }
            array_push($songArray,$row["id"]);
            $albumSong = new Song($con,$row["id"]);
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
<div class="artistContainer borderBottom">
    <h2>Artist</h2>
    <?php 
    $artistQuery = mysqli_query($con,"SELECT id from artist WHERE name LIKE '$term%'LIMIT 10");
    if(mysqli_num_rows($artistQuery) == 0){
        echo "<span class='notFound'>No Artist Found</span>";
    }
    while($row = mysqli_fetch_array($artistQuery)){
        $artistEntity = new Artist($con,$row['id']);
        echo  "
        <div class='searchRow'>
            <div class='ArtName'>
            <span role='link' tabIndex='0' onclick='openPage(\"artist.php?id=".$artistEntity->getartistId() ."\")'>
            ". $artistEntity->getArtistName() . "
            </span>
            </div>
        </div>
        ";
    }
?>
</div>
<div class="gridContainer">
    <h2>Albums</h2>
    <?php 
    $queryAlbum = mysqli_query($con,"SELECT * FROM album WHERE title LIKE '$term%' LIMIT 10");
    if(mysqli_num_rows($queryAlbum) == 0){
        echo "<span class='notFound'>No Albums Found</span>";
    }

    while($row = mysqli_fetch_array($queryAlbum)) {
        echo"<div class='gridItem'>
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