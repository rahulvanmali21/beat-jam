<?php 
include("./includes/includedFiles.php");
?>

<h1 class="heading animated fadeInUp">Albums RecommendatedFor You</h1>

<div class="gridContainer">
    <?php 
    $query_album = mysqli_query($con,"SELECT * FROM album ORDER BY RAND() LIMIT 10");
    while($row = mysqli_fetch_array($query_album)) {
        
        echo"<div class='gridItem animated fadeIn delay-1s'>
        <span style='cursor:pointer;' tabindex='0' role='link' onclick='openPage(\"album.php?id=".$row['id']."\")'>
            <img src='". $row['albumArt'] ."'>
            <div class='gridInfo animated fadeIn delay-2s'>
            " .$row['title']  ."
            </div>
        </span>
        </div>";

        }
    ?>
</div>

