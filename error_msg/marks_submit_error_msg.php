<?php
include 'D:\wamp\www\Online Examination System\core.inc.php';
include 'D:\wamp\www\Online Examination System\connect.inc.php';

if (teacher_logged_in()) {
    ?>
    <h2>There was a connection problem or you already have submitted the marks</h2>
    <a href="http://localhost/Online%20Examination%20System/teachers_profile.php">
        <button>Go back to profile</button>
    </a>
    <a href="http://localhost/Online%20Examination%20System/teacher_logout.php">
        <button>Log Out</button>
    </a>
    <?php
}
?>