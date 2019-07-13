<?php
ob_start();
include "connect.inc.php";
include "core.inc.php";

if(admin_logged_in()) {

    ?>

    <form action="approve_teachers_inc.php" method="GET">
        <input type="hidden" name="ssn_app"><br><br>
        <input type="submit" value="Approve"> <a href="admin.php"><input type="button" value="Cancel"></a>
    </form>


    <?php

    if (isset($_GET['ssn_app']) && !empty($_GET['ssn_app'])) {
        $ssn_app = $_GET['ssn_app'];

        /*Query for testing if the input value is legit*/
        $test_query = "SELECT `name` FROM `teachers_approve` WHERE `SSN`='$ssn_app'";

        /*Query for selecting the values from approve table*/
        $app_query_1 = "SELECT `ssn`,`name`,`department`,`email`,`password`,`contact_no` FROM `teachers_approve` WHERE `ssn`='$ssn_app'";

        if (mysqli_num_rows(mysqli_query($con, $test_query)) > 0) {
            if ($app_query_1_run = mysqli_query($con, $app_query_1)) {
                while ($row = mysqli_fetch_assoc($app_query_1_run)) {
                    $ssn = $row['ssn'];
                    $name = $row['name'];
                    $surname = $row['surname'];
                    $department = $row['department'];
                    $email = $row['email'];
                    $password = $row['password'];
                    $contact_no = $row['contact_no'];

                    /*Query for inserting data into teachers table*/
                    $app_query_2 = "INSERT INTO `teachers` VALUES ('$ssn','$name','$surname','$department','$email','$password','$contact_no')";
                    if ($app_query_2_run = mysqli_query($con, $app_query_2)) {
                        $app_query_3 = "DELETE FROM `examination`.`teachers_approve` WHERE `teachers_approve`.`SSN` = $ssn ";

                        if ($app_query_3_run = mysqli_query($con, $app_query_3)) {
                            header("Location: admin.php");
                        }

                    } else {
                        echo "Failed to approve";
                    }
                }
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