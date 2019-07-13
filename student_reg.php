<?php include "inc/inc.header.php"?>


<script type="text/javascript">
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
            document.getElementById('pass_div').innerHTML="<p style='color:red;font-family: Calibri;font-weight: 500'>Password must be atleast 6 characters long</p>";
        }
        else if(l_pass.length>32){
            document.getElementById('pass_div').innerHTML="<p style='color:red;font-family: Calibri;font-weight: 500'>Passwords can not be more than 32 characters.</p>";
        }else{
            document.getElementById('pass_div').innerHTML="<p style='color:green;font-family: Calibri;font-weight: 500'>Valid Password</p>";
        }


    }

    function pass_again_function() {

        var l_pass_again= document.getElementById('pass_again').value ;
        var l_pass= document.getElementById('pass').value ;

        if(l_pass_again.length==0){
            document.getElementById('pass_again_div').innerHTML="";
        }else if(l_pass_again!=l_pass){
            document.getElementById('pass_again_div').innerHTML="<p style='color:red;font-family: Calibri;font-weight: 500'>Passwords do not match</p>";

        }else if(l_pass_again.length!=0 &&  l_pass_again==l_pass){

            document.getElementById('pass_again_div').innerHTML="<p style='color:green;font-family: Calibri;font-weight: 500'>Password Mathced !</p>";

        }


    }

</script>

<div class="row" style="margin-top:30px">
    <div class="col-lg-1"></div>
    <div class="col-lg-2"><a href="home.php"><button class="btn btn-large btn-primary"> <i class="fa fa-home"></i> HOME</button></a></div>
    <div class="col-lg-6"></div>
    <div class="col-lg-2"><a href="student_login.php"><button class="btn btn-large btn-success"><i class="fa fa-user"></i> Log In</button></a></div>
    <div class="col-lg-1"></div>
</div>

<!--Registration Page Intro-->
<div class="reg_intro container">
    <div class="row">
        <i class="fa fa-5x fa-edit" style="margin-top:250px"></i>
        <h2><span style="color:#66BC6D;animation-delay: 400ms" class="animated bounceInDown">Student</span> Registration</h2>
    </div>
</div>

<!--Registration Form-->
<div id="registration_div">
    <form action="" method="POST" name="fr" id="fr" style="margin-bottom:30px">
        <input type="text" name="f_name" id="f_name" required onkeyup="f_name_function();" placeholder="Your Full Name"><br><br>
        <div id="f_name_div"></div>
        <input type="text" name="l_name" id="l_name" required onkeyup="l_name_function();" placeholder="Your Surname"><br><br>
        <div id="l_name_div"></div>
        <input type="number" name="user_name" id="user_name" required placeholder="Your Student ID"><br><br>
        <div id="user_name_div"></div>
        <input type="email" name="email" id="email" required placeholder="Your Email Address"><br><br>
        <div id="email_div"></div>
        <input type="password" name="pass" id="pass" required onkeyup="pass_function();" placeholder="Choose your Password"><br><br>
        <div id="pass_div" style="font-size: 15px ; font-weight: 500;color: red;"></div>
        <input type="password" name="pass_again" id="pass_again" required onkeyup="pass_again_function();" placeholder="Password Again"><br><br>
        <div id="pass_again_div"></div>
        <hr>
        <h5 style="font-size: 25px;font-weight: 600;margin-top: 30px;margin-bottom:30px">Additional <span style="color:blue">INFO</span></h5>
        <input type="number" name="class" required min="1" placeholder="The class you study in"><br><br>

        <input type="checkbox" name="terms" id="terms" value="checked" required >  <span style="font-size: 20px;font-family: Calibri;font-weight: 500"> Accept the <a href="terms%20&%20condition.txt">terms & condition</a></span><br><br>
        <input type="submit" value="Register" id="rt" class="btn btn-large btn-success">
    </form>
</div>


<!--PHP validation for forms and submission-->
<?php


if(    isset($_POST['f_name'])
    && isset($_POST['l_name'])
    && isset($_POST['user_name'])
    && isset($_POST['email'])
    && isset($_POST['pass'])
    && isset($_POST['pass_again'])
    && isset($_POST['class'])


) {

    $name = $_POST['f_name'];
    $surname = $_POST['l_name'];
    $student_id = $_POST['user_name'];
    $email = $_POST['email'];
    $class= $_POST['class'];
    $pass = $_POST['pass'];
    $pass_again = $_POST['pass_again'];
    $pass_hash = md5($pass);



    if (!empty($name) &&
        !empty($surname) &&
        !empty($student_id) &&
        !empty($email) &&
        !empty($pass) &&
        !empty($pass_again) &&
        !empty($class)
    ) {


        /*Check if checkbox is ticked*/

        if (isset($_POST['terms'])=='checked'&& !empty($_POST['terms'])) {


            /*Check if password matches */

            if ($pass == $pass_again) {


                /*Validating the lengths of Names*/

                if (strlen($name) > 32 || strlen($surname > 32)) {

                    echo "Please see the maximum and minimum of names";

                } else {

                    /*Validating Password Lengths*/

                    if (strlen($pass) < 6) {

                        echo "Passwords must be atleast 6 characters.";
                    } else {

                        $query = "INSERT INTO `students_approve` VALUES ('$student_id','$name','$surname','$class','$email','$pass_hash')";

                        if ($qurey_run = mysqli_query($con, $query)) {
                            header("Location: student_login.php");
                        } else {
                            header("Location: student_reg_failure.php");
                        }

                    }
                }


            }else{
                echo "Passwords doesn't match";
            }


        } else {
            echo "Please agree to the terms & conditions";
        }

    } else {
        echo "Fill all the fields";

    }

}




?>




<?php include "inc/inc.footer.php"?>
