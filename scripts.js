
$(document).ready(function () {
    $("#student").click(function () {
        $("#loading_div").load("inc.student_login_page.php");



    });
    $("#teacher").click(function () {

        $("#loading_div").load("inc.teacher_login_page.php");

    });

    $("#admin").click(function () {
        $("#loading_div").load("inc.admin_login_page.php");

    });
});



$(document).ready(function(){
    // Add smooth scrolling to all links
    $(".option-choosing-buttons a").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } // End if
    });
});


/*Ajax user match functions*/

function user_match() {

    if(window.XMLHttpRequest){
        var xmlhttp = new XMLHttpRequest();

    }

    else{

    }

    xmlhttp.onreadystatechange= function () {
        if(xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("user_name_match_div").innerHTML = this.responseText;
        }
    }


    xmlhttp.open('GET','username_match.php?user_name='+document.getElementById('user_name').value,true);

    xmlhttp.send();


}

/*Form validation functions*/

function f_name_function() {

    var l_fname= document.getElementById('f_name').value ;

    if(l_fname.length==0){
        document.getElementById('f_name_div').innerHTML="";
    }else if(l_fname.length>32){
        document.getElementById('f_name_div').innerHTML="Names can't be more then 32 characters";
    }


}

function l_name_function() {

    var l_lname= document.getElementById('l_name').value ;

    if(l_lname.length==0){
        document.getElementById('l_name_div').innerHTML="";
    }else if(l_fname.length>32){
        document.getElementById('l_name_div').innerHTML="Names can't be more then 32 characters";
    }


}

function user_name_function() {

    var l_user_name= document.getElementById('user_name').value ;

    if(l_user_name.length==0){
        document.getElementById('user_name_div').innerHTML="";
    }else if(l_user_name.length>0 && l_user_name.length<4){
        document.getElementById('user_name_div').innerHTML="Username must be at least 4 characters. ";
    }else if(l_user_name.length>32){
        document.getElementById('user_name_div').innerHTML="Username can't be more then 32 characters";
    }else{
        document.getElementById('user_name_div').innerHTML="Valid Length";
    }


}

function pass_function() {

    var l_pass= document.getElementById('pass').value ;

    if(l_pass.length==0){
        document.getElementById('pass_div').innerHTML="";
    }else if(l_pass.length<6){
        document.getElementById('pass_div').innerHTML="Passwords must be at least 6 characters ";
    }
    else if(l_pass.length>32){
        document.getElementById('pass_div').innerHTML="Passwords can't be more then 32 characters. ";
    }else{
        document.getElementById('pass_div').innerHTML="Valid";
    }


}

function pass_again_function() {

    var l_pass_again= document.getElementById('pass_again').value ;
    var l_pass= document.getElementById('pass').value ;

    if(l_pass_again.length==0){
        document.getElementById('pass_again_div').innerHTML="";
    }else if(l_pass_again!=l_pass){
        document.getElementById('pass_again_div').innerHTML="Passwords do not match";

    }else if(l_pass_again.length!=0 &&  l_pass_again==l_pass){

        document.getElementById('pass_again_div').innerHTML="Matched.";

    }


}
