var adminLoggedIn;
$(document).ready(()=>{
  $("#addGenre").click(()=>{
      $("#artistFrom").hide();
      $("#genreForm").show();
      });
  
  $("#addArtist").click(()=>{
      $("#genreForm").hide();
      $("#artistFrom").show();
      });

    $.post("../includes/handlers/ajax/counter.php",{songs:"getsongs"}).done(res=>{
        $("#songCounts").text(res);
    });
    $.post("../includes/handlers/ajax/counter.php",{albums:"getalbums"}).done(res=>{
        $("#albumCounts").text(res);
    });
    $.post("../includes/handlers/ajax/counter.php",{artists:"getartist"}).done(res=>{
        $("#artistCounts").text(res);
    });
    $.post("../includes/handlers/ajax/counter.php",{users:"getusers"}).done(res=>{
        $("#userCounts").text(res);
    });
  });
  
let adminLogout=()=>{
    $.post("../includes/handlers/ajax/admin-logout.php")
        .done(()=>{
            location.reload();
    });
}
  let changeUsername = (usernameClass) =>{
    let username = $("." + usernameClass).val();
    console.log(username);
    $.post("../includes/handlers/ajax/admin-usernameUpdate.php",{username})
    .done((res)=>{
        console.log(res);
        $("#userUpdateMsg").text(res);
    });
  }

  let changePassword = (pass1,pass2,pass3) =>{
    let oldPassword = $("." + pass1).val();
    let newPassword1 = $("." + pass2).val();
    let newPassword2 = $("." + pass3).val();

    $.post("../includes/handlers/ajax/admin-passwordUpdate.php",{oldPassword,newPassword1,newPassword2})
    .done((res)=>{
        $("#passwordUpdateMsg").text(res);
        if(res =="password Updated"){
            setTimeout(() => {
                location.reload();
            },2000);
        }
    });
  }
