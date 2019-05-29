<?php
    $query = mysqli_query($con,"SELECT id FROM songs ORDER BY RAND() LIMIT 10");
    $songsIdArray = array();
    while($newrow = mysqli_fetch_array($query)){
    array_push($songsIdArray,$newrow['id']);
    }
    $jsonDataArray = json_encode($songsIdArray);
?>
<script>
$(document).ready(()=>{
    var newPlaylist = <?php echo $jsonDataArray; ?>;
    audioElement = new Audio();
    setTrack(newPlaylist[0],newPlaylist,false);
    updateVolume(audioElement.audio);

    $("#musicPlayerContainer").on("mousedown touchstart mousemove touchmove",function(e){
        e.preventDefault();
    });

    $(".bar .progressbar").mousedown(function(){
        mouseDown = true;
    });
    $(".bar .progressbar").mousemove(function(e){
        if(mouseDown ==true){
            getTime(e,this)
        }
    });
    $(".bar .progressbar").mouseup(function(e){
        getTime(e,this)
    });

     $(".volumeControl .progressbar").mousedown(function(){
        mouseDown = true;
    });
    $(".volumeControl .progressbar").mousemove(function(e){
        if(mouseDown ==true){
            var volumePercentage = e.offsetX / $(this).width();
            if( volumePercentage >=0 && volumePercentage <=1){
                audioElement.audio.volume = volumePercentage;
            }}
    });
    $(".volumeControl .progressbar").mouseup(function(e){
        var volumePercentage = e.offsetX / $(this).width();
            if( volumePercentage >=0 && volumePercentage <=1){
                audioElement.audio.volume = volumePercentage;
            }
    });
    $(document).mouseup(function(){
        mouseDown = false;
    });
});

function getTime(mouseEvent,progress){
 var precent = mouseEvent.offsetX / $(progress).width() *100;
 var seconds = audioElement.audio.duration * (precent / 100);
 audioElement.setTime(seconds);
}

let setTrack = (songId,newPlaylist,play)=>{
    if(newPlaylist!= currentPlaylist){
        currentPlaylist = newPlaylist
        shufflePlaylist = currentPlaylist.slice();
        shuffleArray(shufflePlaylist);
    }
    if(shuffle){
        currentSongIndex = shufflePlaylist.indexOf(songId);
        pauseSong();
    } else{
        currentSongIndex =  currentPlaylist.indexOf(songId);
        pauseSong();
    }
    $.post("includes/handlers/ajax/getSong.php",{songId:songId},(data)=>{
        var song = JSON.parse(data);
        $(".songName span").text(song.title);

        $.post("includes/handlers/ajax/getArtist.php",{artistId:song.artist},(data)=>{
            let artist = JSON.parse(data);
            $(".artistName span").text(artist.name);
            $(".artistName span").attr("onclick","openPage('artist.php?id="+ artist.id +"')");
        });
        $.post("includes/handlers/ajax/getAlbum.php",{albumId:song.album},(data)=>{
            let album = JSON.parse(data);
            $(".albumArt img").attr("src",album.albumArt);
            $(".albumArt img").attr("onclick","openPage('album.php?id="+ album.id +"')");
        })
        audioElement.setTrack(song);
        if(play){
                playSong();
                }
    });    
}
let playSong =()=>{
    if(audioElement.audio.currentTime == 0){
        $.post("includes/handlers/ajax/postCounts.php",{songId: audioElement.currentlyPlaying.id})
    }
    $(".controlUnit.play").hide();
    $(".controlUnit.pause").show();
    audioElement.play();
}
let pauseSong =()=>{
    $(".controlUnit.play").show();
    $(".controlUnit.pause").hide();
    audioElement.pause();
}
let toggleRepeat=()=>{
    repeat =! repeat;
    var repeatIcon =   repeat ? "repeat-active.png" : "repeat.png"
    $(".controlUnit.repeat img").attr("src",iconsPath + repeatIcon);
}

let toggleVolume=()=>{
    audioElement.audio.muted =! audioElement.audio.muted;
    var volumeIcon = audioElement.audio.muted ? "mutee.png" : "speaker.png";
    $(".controlUnit.volume img").attr("src",iconsPath + volumeIcon);
}

let toggleShuffle=()=>{
 shuffle =! shuffle;
 var shuffleIcon = shuffle ? "shuffle_active.png" : "shuffle.png"
 $(".controlUnit.shuffle img").attr("src",iconsPath + shuffleIcon);
 if(shuffle){
    shuffleArray(shufflePlaylist);
    currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);

 } else{
    currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);   
 }
}

let playNext =() =>{
    if(repeat){
        audioElement.setTime(0);
        playSong();
        return; 
    }
    if(currentSongIndex == currentPlaylist.length - 1 ){
        currentSongIndex = 0;
    } else{
        currentSongIndex++;
    }
    var nextId = shuffle ? shufflePlaylist[currentSongIndex] : currentPlaylist[currentSongIndex];
    console.log(nextId);
    setTrack(nextId,currentPlaylist,true);
}

let playPrevious=()=>{
    if(audioElement.audio.currentTime >=3 || currentSongIndex ==0){
        audioElement.setTime(0);
    } else{
        currentSongIndex--;
        setTrack(currentPlaylist[currentSongIndex],currentPlaylist,true)
    }
}

let shuffleArray = (a) =>{
var j,x,i;
for (i = a.length; i; i--) {
        j = Math.floor(Math.random() * i);
        x = a[i - 1];
        a[i - 1] = a[j];
        a[j] = x;
    }
}

</script>
<div id="musicPlayerContainer">
        <div id="musicPlayer">
                <div id="musicPlayerLeft">
                    <div class="content">
                        <span class="albumArt"><img role="link" tabIndex="0" class="art"  width="60"></span>
                        <div class="songDetails">
                            <span class="songName"><span></span></span>
                            <span role="link" tabIndex="0" class="artistName"><span></span></span>
                        </div>
                    </div>
                </div>
                <div id="musicPlayerCenter">
                    <div class="content playerButtons">
                        <div class="controls">
                            <button class="controlUnit shuffle"><img src="./assets/images/icons/shuffle.png" alt="Shuffle" onclick="toggleShuffle()" title="Shuffle Button"></button>
                            <button class="controlUnit previous"><img src="./assets/images/icons/previous.png" alt="Previous" onclick="playPrevious()" title="Shuffle Button"></button>
                            <button class="controlUnit play"><img src="./assets/images/icons/play.png" alt="Play" onclick="playSong()" title="Play Button"></button>
                            <button class="controlUnit pause"><img src="./assets/images/icons/pause.png" alt="Pause" onclick="pauseSong()" title="Pause Button"></button>
                            <button class="controlUnit next"><img src="./assets/images/icons/next.png" alt="Next" onclick="playNext()" title="Next Button"></button>
                            <button class="controlUnit repeat"><img src="./assets/images/icons/repeat.png" alt="Repeat" onclick="toggleRepeat()" title="Repeat Button"></button>
                        </div>    
                        <div class="bar">
                            <span class="time current">0:00</span>
                            <div class="progressbar">
                                <div class="progressEmpty">
                                    <div class="progressActive"></div>
                                </div>
                            </div>
                            <span class="time remaining">0:00</span> 
                        </div>
                    </div>
                </div>
                <div id="musicPlayerRight">
                    <div class="volumeControl">

                        <button class="controlUnit volume" title="volume control">
                            <img src="./assets/images/icons/speaker.png" onclick="toggleVolume()" alt="volume">
                        </button>
                        <div class="progressbar">
                                <div class="progressEmpty">
                                    <div class="progressActive"></div>
                                </div>
                        </div>
                    </div>
                </div>
        </div>
</div>