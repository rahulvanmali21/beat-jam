<?php
$query = mysqli_query($con,"SELECT * FROM songs ORDER BY plays DESC LIMIT 5");

function getArtist($artistId,$con){
    $artistQuery = mysqli_query($con,"SELECT name FROM artist WHERE id='$artistId' LIMIT 1");
    $artist =mysqli_fetch_array($artistQuery);
    return $artist['name'];
}
function getAlbum($albumId,$con){
    $albumQuery = mysqli_query($con,"SELECT title FROM album WHERE id='$albumId' LIMIT 1 ");
    $album = mysqli_fetch_array($albumQuery);
    return $album['title'];

}
function getGenre($genreId,$con){
    $genreQuery = mysqli_query($con,"SELECT name FROM genre WHERE id='$genreId' LIMIT 1 ");
    $genre= mysqli_fetch_array($genreQuery);
    return $genre["name"];
}

?>
<h3 class="white-text">Top 5 Songs</h3>
<div class="card">
    <div class="card-content">
        <table class="highlight ">
        <thead>
          <tr>
              <th>Name</th>
              <th>Artist</th>
              <th>Album</th>
              <th>Genre</th>
              <th>Duration</th>
              <th>Plays</th>
          </tr>
        </thead>
        <tbody>
            <?php 
            while($row  = mysqli_fetch_array($query)){
                echo "<tr> 
                    <td>".$row['title']."</td>
                    <td>".getArtist($row['artist'],$con)."</td>
                    <td>".getAlbum($row['album'],$con)."</td>
                    <td>".getGenre($row['genre'],$con)."</td>
                    <td>".$row['duration']."</td>
                    <td>".$row['plays'] ."</td>
                    </tr>
                    ";
            }
            ?>
        </tbody>
        </table>
        <br>
    </div>
</div>

