<?php include("./layout/admin-header.php");
include("../includes/Classes/AdminSong.php");
$adminSong= new AdminSong($con);
include("../includes/handlers/song-handler.php");
?>
<div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card hoverable">
            <div class="card-content">
                <h4 class="header center">Add Song</h4>
                <p id="songAlert" class="red-text center"></p>

            <form action="song.php" method="POST" enctype="multipart/form-data" onsubmit="return Validate();">
            
                <div class="input-field">
                    <input type="text" name="title" id="title" class="validate" require>
                    <label for="title">Song Title</label>
                </div>
                <label>Duration</label>
                <div class="row">
                    <div class="input-field col s3">
                        <input type="number" name="minutes" id="DurationMin" require min="00" max="10">
                        <label for="DurationMin">Minutes</label>
                    </div>
                    <div class="input-field col s3">
                        <input type="number" name="seconds" id="DurationSec" require min="00" max="59">
                        <label for="DurationSec">Seconds</label>
                    </div>
                </div>
                <div class="input-field">
                    <select name="artist" require>
                    <option value="0" selected>Choose your Artist</option>
                         <?php 
                         while($row = mysqli_fetch_array($artistQuery)){
                            echo "<option value='".$row['id']."'>". $row['name'] ."</option>";
                         }
                         ?>
                    </select>
                    <label>Artist</label>
                 </div>
                 <div class="input-field">
                     <select name="genre">
                     <option value="0" selected require>Choose your Genre</option>
                         <?php 
                         while($row = mysqli_fetch_array($genreQuery)){
                             echo "<option value='".$row['id']."'>".$row['name'] ."</option>";
                         }
                         ?>
                     </select>
                     <label>Genre</label>
                 </div>
                 <div class="input-field">
                     <select name="album" require>
                     <option value="0" selected>Choose your Album</option>
                     <?php 
                     while($row = mysqli_fetch_array($albumQuery)){
                        echo "<option value='".$row['id']."'>".$row['title'] ."</option>";
                     }
                     ?>
                     </select>
                     <label>Album</label>
                 </div>
                 <div class="file-field input-field">
                    <div class="btn">
                        <span>Browse</span>
                        <input type="file" name="song" accept=".mp3" id="songFile" required>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload Song File">
                    </div>
                </div>
                <button type="submit" name="SongUpload" class="btn blue">Save</button>
            </form>
            <br>
            <a href="dashboard.php">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
<script>
var _validFileExtensions = [".mp3", ".MP3", ".wav"];    
function Validate() {
    var arrInputs = $("#songFile")
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    M.toast({html:'only audio files ',classes:'red white-text'})
                    return false;
                }
            }
        }
    }
  
    return true;
}

</script>
<?php include("./layout/admin-footer.php"); ?>
