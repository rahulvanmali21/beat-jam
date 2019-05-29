$(document).ready(()=>{
$("#hideLogin").click(()=>{
    $("#loginForm").hide();
    $("#registerForm").show();
    $("#registerForm").addClass("animated");
    });

$("#hideRegister").click(()=>{
    $("#registerForm").hide();
    $("#loginForm").show();
    $("#loginForm").addClass("animated");

    });
});

