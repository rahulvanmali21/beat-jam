const iconsPath = "./assets/images/icons/";
var currentPlaylist =[];
var shufflePlaylist = [];
var tempPlaylist = [];
var audioElement;
var mouseDown= false;
var currentSongIndex = 0;
var repeat =false
var shuffle = false;
var loggedInUser;
var timer;

document.title = loggedInUser + " | BEAT JAM";
$(document).click(function(click){
var target = $(click.target);
if(!target.hasClass("item") && !target.hasClass("songOptionButton")){
    hideMenu();
}
});

let openPage = (url) =>{
    $("title").val(loggedInUser);
    if(timer != null){
        clearTimeout(timer);
    }
    if(url.indexOf("?")==-1){
        url+="?";
    }
    var encodedURL = encodeURI(url + "&loggedInUser=" + loggedInUser);   
    $("#main").load(encodedURL);
    $("body").scrollTop(0);
    history.pushState(null,null,url);
}
$(document).on("change","select.playlistItem",function(){
    var selectElement = $(this)
    var playlistId = selectElement.val();
    var songId = selectElement.prev(".songId").val();
        $.post("includes/handlers/ajax/addToPlaylist.php",{playlistId:playlistId,songId:songId})
        .done(function(err){
            if(err!=""){
                alert(err);
                return;
            }
            hideMenu();
            selectElement.val("");
        });
});
function deleteFromPlaylist(target,playlistId){
    var songId = $(target).prevAll(".songId").val();
    $.post("includes/handlers/ajax/deleteFromPlaylist.php",{playlistId:playlistId,songId:songId})
    .done(function(err){
        if(err!=""){
            alert(err);
            return;
        }
        openPage("playlist.php?id=" + playlistId);
    });
}

let playFirstSong=()=>{
    setTrack(tempPlaylist[0],tempPlaylist,true);
}

function Audio(){

    this.currentlyPlaying;
    this.audio =document.createElement('audio');

    this.audio.addEventListener("canplay",function(){
        $(".time.remaining").text(timeFormatting(this.duration));
    });
    this.audio.addEventListener("ended",function(){
        playNext();
    });

    this.audio.addEventListener("timeupdate",function(){
        if(this.duration){
            updateTime(this);
        }
    });

    this.audio.addEventListener("volumechange",function(){
        updateVolume(this);
    })

    this.setTrack = function(song){
        this.audio.src =song.path;
        this.currentlyPlaying=song;
    }
    this.play = ()=>{
        this.audio.play();
    }
    this.pause =() =>{
        this.audio.pause();
    }
    this.setTime= function(sec){
        this.audio.currentTime = sec;
    }
}
let updateEmail=(emailClass)=>{
    var emailValue = $("." + emailClass).val();
    $.post("includes/handlers/ajax/updateEmail.php",{email:emailValue,username:loggedInUser})
    .done(function(res){
        $("." + emailClass).nextAll(".msg").text(res);
    });
}
let updatePassword=(oldPasswordClass,NewPasswordClass1, NewPasswordClass2)=>{
    var oldPassword = $("." + oldPasswordClass).val();
    var newPassword1 = $("." + NewPasswordClass1).val();
    var newPassword2 = $("." + NewPasswordClass2).val();
    $.post("includes/handlers/ajax/updatePassword.php",
            { oldPassword:oldPassword ,newPassword1:newPassword2, newPassword2:newPassword1,username:loggedInUser}
        )
    .done(function(res){
        $("." + oldPasswordClass).nextAll(".msg").text(res);
    });
}
let timeFormatting=(seconds)=>{
    let time = Math.round(seconds);
    let minutes = Math.floor(time / 60);
    let second  = time - (minutes * 60);
    var zero = (second < 10) ? "0" :"" ;
    return minutes + ":" + zero + second;
}
function updateTime(audio){
    $(".time.current").text(timeFormatting(audio.currentTime));
    var progressPercentage = audio.currentTime / audio.duration * 100;
    $(".bar .progressActive").css("width",progressPercentage + "%");
}
function updateVolume(audio){
var volume = audio.volume * 100;
$(".volumeControl .progressActive").css("width",volume +"%");
}
function createPlaylist(){
    var popup = $("#playlistName").val();
    if(popup === ""){
        $("#playistError").show();
    } else{
        $.post("includes/handlers/ajax/createPlaylist.php",{name:popup,username:loggedInUser})
        .done(function(){
            openPage("myMusic.php");
        });
    }
}
function deletePlaylist(playlistId){
    $.post("includes/handlers/ajax/deletePlaylist.php",{playlistId:playlistId})
    .done(function(){
        openPage("myMusic.php");
    });
}
function openModal(){
    $(".modal").show();
}
function closeModal(){
    $(".modal").hide();
}
function showMenu(target){
    var menu = $(".optionsMenu");
    var songId = $(target).prevAll(".songId").val();
    menu.find(".songId").val(songId);
    var scrollTop = $(window).scrollTop();
    var elementOffset = $(target).offset().top;
    var top  = elementOffset - scrollTop;
    var left = $(target).position().left;
    menu.css({
        "top":top+"px",
        "left":(left+57) + "px",
        "display":"inline"
    });
}
function hideMenu(){
    var menu = $(".optionsMenu");
    if(menu.css("display")!="none"){
        menu.css("display","none");
    }
}
$(window).scroll(()=>{
    hideMenu();
});
let logout=()=>{
    $.post("includes/handlers/ajax/logout.php",()=>{
        location.reload();
    })
}
