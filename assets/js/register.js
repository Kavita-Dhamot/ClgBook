$(document).ready(function(){
    
    //on click signup hide login and show registration form
    $("#signup").click(function(){
        $("#first").slideUp("slow", function(){
            $("#second").slideDown("slow");
        });
    }); 


    //on click signin hide register  and show login form
    $("#signin").click(function(){
        $("#second").slideUp("slow", function(){
            $("#first").slideDown("slow");
        });
    }); 

});