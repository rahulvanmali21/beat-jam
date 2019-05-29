<div id="simpleModel" class="modal">
    <div class="model-content animated fadeInUp">
        <span class="closeBtn" onclick="closeModal()">&times;</span>
        <div class="modalInput">
        <label for="playlistName">Playlist Name</label>
        <p>
            <input type="text" name="" id="playlistName">
        </p>
        <small id="playistError" class="animated infinite flash">please enter the name of your playlist</small>
        <p><button class="button smallBtn redBg" onclick="createPlaylist()">Create</button></p>
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
.modalInput input{
    width:100%;
    border:0;
    border-bottom:1px solid #fff;
    background-color:transparent;
    outline: none;
    color: #fff;
    height:30px;
    font-size:18px;
    margin-bottom:10px;
    
}
#playistError{
color:#f21a1e;
display:none;
}
.modalInput input:focus{
    border-bottom:1.2px solid #f21a1e;
}
@keyframes modalopen{
    from{opacity:0}
    to{opacity:1}
}
</style>