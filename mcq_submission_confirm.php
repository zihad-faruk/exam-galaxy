<?php include "inc/inc.header.php";?>


<?php if (student_logged_in()) {
    ?>

    <h1 style="margin-top: 200px;font-weight:600">Your answer has been submitted.Wait for the result to publish</h1>

    <div class="row" style="margin-top: 100px;margin-bottom:100px">
        <div class="col-lg-4"></div>
        <div class="col-lg-2"><a href="students_profile.php"><button class="btn btn-large btn-success"><i class="fa fa-arrow-left"></i> Take me to my profile</button></a></div>
        <div class="col-lg-2"><a href="student_logout.php"><button class="btn btn-large btn-danger"><i class="fa fa-power-off"></i> Log Out</button></a></div>
        <div class="col-lg-4"></div>
    </div>

<?php } else {
    ?>


    <h3>You have to log in dude</h3>
    <a href="http://localhost/Online%20Examination%20System/student_login.php">
        <button class="btn btn-large btn-success">Log In</button>
    </a>


    <?php
}

include "inc/inc.footer.php";
?>