<?php
ob_start();
include "connect.inc.php";
include "core.inc.php";

if(admin_logged_in()) { ?>

    <form action="delete_teachers_inc.php" method="GET">
        <input type="hidden" name="ssn_del"><br><br>
        <input type="submit" value="Delete"> <a href="admin.php"><input type="button" value="Cancel"></a>
    </form>


    <?php

    if (isset($_GET['ssn_del']) && !empty($_GET['ssn_del'])) {
        $ssn_del = $_GET['ssn_del'];
        $test_query = "SELECT `name` FROM `teachers` WHERE `SSN`='$ssn_del'";
        $del_query = "DELETE FROM  `teachers` WHERE `SSN`='$ssn_del'";

        if (mysqli_num_rows(mysqli_query($con, $test_query)) > 0) {
            if ($del_query_run = mysqli_query($con, $del_query)) {
                header("Location: admin.php");
            }
        } else {
            echo "There is no such teachers in the database";
        }

    } else {
        echo "You must specify the ssn to continue";
    }


}else{
    header("Location: admin.php");

}

?>

