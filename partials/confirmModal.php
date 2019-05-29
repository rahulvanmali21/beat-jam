<div id="simpleModel" class="modal">
    <div class="model-content animated flipInX">
        <span class="closeBtn" onclick="closeModal()">&times;</span>
        <div class="modalInput">
        <h3 class="confirmation">Are you Sure ? You want to delete this Playlist</h3 >
        <br>
        <center>
        <button class="button redBg" onclick="deletePlaylist('<?php echo $playlistId ; ?>')">Yes</button>
        </center>

        </div>    
    </div>
</div>
<style>
.modal{
    display: none;
    position: fixed;
    z-index: 1;
    left:0; top:0;
    height: 100%;
    width: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);     
}

.model-content{
    background-color: #f4f4f4;
    margin: 5% auto;
    width:30%;
    padding:20px;
    box-shadow: 0 5px 8px 0 rgba(0,0,0,0.2),0 7px 20px 0 rgba(0,0,0,0.2);
    background-color: #282828;
    color: #fff;
}

.closeBtn{
color: #ccc;
float:right;
font-size: 30px;

}
.closeBtn:hover, .closeBtn:focus{
cursor: pointer;
text-decoration: none;
color:red;
}
.modalInput{
    width:100%;
    margin-top:20px;
}
.no{
    float:right;
}

</style>