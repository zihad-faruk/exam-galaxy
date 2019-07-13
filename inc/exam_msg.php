<?php
include 'D:\wamp\www\Online Examination System\core.inc.php';
include 'D:\wamp\www\Online Examination System\connect.inc.php';
?>



    <!DOCTYPE html>
    <html>
    <head>
        <title>OOPSSS</title>
    </head>
    <body style="text-align: center">
    <?php if (student_logged_in()) {
    ?>

    <h2>Sorry dude,nice try.But you already participated in the exam.This exam won't count</h2>
    <a href="http://localhost/Online%20Examination%20System/students_profile.php">
        <button>Go back to my profile</button>
    </a>
    <a href="http://localhost/Online%20Examination%20System/student_logout.php">
        <button>Log out</button>
    </a>

<?php } else {
    ?>

    <h3>You have to log in dude</h3>
    <a href="http://localhost/Online%20Examination%20System/student_login.php">
        <button>Log In</button>
    </a>
    </body>
    </html>

    <?php
}
?>