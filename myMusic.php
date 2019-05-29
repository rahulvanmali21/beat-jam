<?php 
include("./includes/includedFiles.php");
include("./partials/addPlaylistModal.php");
?>
<br>
<div class="playlistContainer">
    <div class="gridContainer">
        <h2>PLAYLISTS</h2>
        <div class="buttonEntity  animated fadeInUp">
            <button class="button redbg" onclick="openModal()" >NEW PLAYLIST</button>
        </div>
    </div>
</div>
<script>

</script>
   <?php 
   $username = $userLoggedIn->getUser();
    $playlistsQuery = mysqli_query($con,"SELECT * FROM playlists WHERE user='$username'");
    if(mysqli_num_rows($playlistsQuery) == 0){
        echo "<span class='notFound'>you dont Have any Playlist Yet </span>";
    }

    while($row = mysqli_fetch_array($playlistsQuery)) {
        $playlist = new Playlist($con,$row);
        echo"<div class='gridItem animated fadeIn delay-1s' role='link' tabindex='0' onclick='openPage(\"playlist.php?id=".$playlist->getId() ."\")'>
            <div class='playlistImage'>
                <img src='assets/images/icons/playlist.png'>
            </div>
            <div class='gridInfo'>
            " . $playlist->getName() ."
            </div>
        </span>
        </div>";

        }
    ?>