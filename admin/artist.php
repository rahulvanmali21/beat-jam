<?php include("./layout/admin-header.php");
  include("../includes/Classes/AdminArtist.php");
  $adminArtist = new AdminArtist($con);
  include("../includes/handlers/artist-handler.php");

  include("../includes/Classes/AdminGenre.php");
  $adminGenre = new AdminGenre($con);
  include("../includes/handlers/genre-handler.php");
?>
<script>
<?php 
if(isset($_POST["uploadGenre"])){
echo "
$(document).ready(()=>{
$('#genreForm').show();
     $('#artistFrom').hide();       
    });";
} else{
    echo 
    "$(document).ready(()=>{
    $('#artistFrom').show();       
    $('#genreForm').hide();
});";
}
?>
</script>
<div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card">
            <div class="card-content hoverable">
            <div id="artistFrom" style="display:None">
                <h4 class="header center">Artist</h4>
                <form action="artist.php" method="post">
                    <div class="input-field">
                        <input type="text" name="artist" id="artist">
                        <label for="artist">Artist Name</label>
                    </div>
                    <button type="submit" class="btn blue" name="uploadArtist">Save</button>
                   <br><br>
                    <span id="addGenre" class="blue-text" style="cursor:pointer;">Add Genre</span>
                   
                </form>
            </div>
            <div id="genreForm" style="display:None">
            <h4 class="header center">Genre</h4>
            <form action="artist.php" method="post">
                <div class="input-field">
                    <input type="text" name="genre" id="genre">
                    <label for="genre">Genre</label>
                </div>
                <button type="submit" class="btn blue" name="uploadGenre">Save</button>
               <br><br>
                <span id="addArtist" class="blue-text" style="cursor:pointer;">Add Artist</span>
                
            </form>
            </div>
            </div>
        </div>
    </div>
</div>

<?php include("./layout/admin-footer.php"); ?>
