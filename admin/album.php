<?php include("./layout/admin-header.php"); 
include("../includes/Classes/AdminAlbum.php");
$adminAlbum = new AdminAlbum ($con);
include("../includes/handlers/album-handler.php");
?>

<div class="row">
    <div class="col s12 m6 offset-m3">
        <div class="card">
            <div class="card-content">
                <h4 class="header center">Albums</h4>
                <form action="album.php" method="POST" enctype="multipart/form-data" onsubmit="return Validate();">
                    <div class="input-field">
                        <input type="text" name="title" id="title">
                        <label for="title">Album Name</label>
                    </div>
                    <div class="input-field">
                        <select name="artist">
                        <option value="0"  selected>Choose your Artist</option>
                         <?php 
                         while($row = mysqli_fetch_array($artistQuery)){
                            echo "<option value='".$row['id']."'>". $row['name'] ."</option>";
                         }
                         ?>
                        </select>
                        <label>Arist</label>
                    </div>
                    <div class="input-field">
                        <select name="genre">
                        <option value="0"  selected>Choose your Genre</option>
                         <?php 
                         while($row = mysqli_fetch_array($genreQuery)){
                             echo "<option value='".$row['id']."'>".$row['name'] ."</option>";
                         }
                         ?>
                        </select>
                        <label>Genre</label>
                    </div>
                    <div class="input-field file-field">
                    <div class="btn">
                            <span>Browse</span>
                            <input type="file" id="albumfile" name="albumArt" accept="images/*">
                    </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="upload Album Art">
                        </div>
                    </div>
                    <button type="submit" class="btn blue" name="albumUpload">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
function Validate() {
    var arrInputs = $("#albumfile")
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
                    M.toast({html:'only jpeg or png files ',classes:'red white-text'})
                    return false;
                }
            }
        }
    }
  
    return true;
}

</script>
<?php include("./layout/admin-footer.php"); ?>
