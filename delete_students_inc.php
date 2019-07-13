<?php
ob_start();
include "connect.inc.php";
include "core.inc.php";

if (admin_logged_in()) {

    ?>

    <form action="delete_students_inc.php" method="GET">
        <input type="hidden" name="student_id_del"><br><br>
        <input type="submit" value="Delete"> <a href="admin.php"><input type="button" value="Cancel"></a>
    </form>


    <?php

    if (isset($_GET['student_id_del']) && !empty($_GET['student_id_del'])) {
        $student_id_del = $_GET['student_id_del'];
        $test_query = "SELECT `name` FROM `students` WHERE `Student_Id`='$student_id_del'";
        $del_query = "DELETE FROM  `students` WHERE `Student_Id`='$student_id_del'";

        if (mysqli_num_rows(mysqli_query($con, $test_query)) > 0) {
            if ($del_query_run = mysqli_query($con, $del_query)) {
                header("Location: admin.php");
            }

        } else {
            echo "There is no such student in the database";
        }


    } else {
        echo "You must specify the student id for security purposes";
    }


} else {
    header("Location: admin.php");
}


?>