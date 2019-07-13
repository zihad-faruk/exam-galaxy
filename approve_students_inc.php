<?php
ob_start();
include "inc/inc.header.php";

/*If admin is logged in,he can directly access this page*/
if(admin_logged_in()) {
    ?>

    <form action="approve_students_inc.php" method="GET">

        <!--This input field is to use the submit button and validation-->
        <input type="hidden" name="student_id_app"><br><br>
        <input type="submit" value="Approve"> <a href="admin.php"><input type="button" value="Cancel"></a>
    </form>


    <?php

    /*Validation and checking if the submit button is pressed*/

    if (isset($_GET['student_id_app']) && !empty($_GET['student_id_app'])) {
       echo  $student_id_app = $_GET['student_id_app'];

        /*Query for testing if the input value is legit*/
        $test_query = "SELECT `name` FROM `students_approve` WHERE `student_id`='$student_id_app'";

        /*Query for selecting the values from approve table*/
        $app_query_1 = "SELECT `student_id`,`name`,`class`,`email`,`password` FROM `students_approve` WHERE `student_id`='$student_id_app'";

        if (mysqli_num_rows(mysqli_query($con, $test_query)) > 0) {
            if ($app_query_1_run = mysqli_query($con, $app_query_1)) {
                while ($row = mysqli_fetch_assoc($app_query_1_run)) {
                    echo $student_id = $row['student_id'];
                    echo $name = $row['name'];
                    echo $surname = $row['surname'];
                    echo $class = $row['class'];
                    echo $email = $row['email'];
                    echo $password = $row['password'];


                    /*Query for inserting data into students table*/
                    $app_query_2 = "INSERT INTO `examination`.`students` VALUES ('$student_id','$name','$surname','$class','$email','$password',' ')";
                    if ($app_query_2_run = mysqli_query($con, $app_query_2)) {
                        $app_query_3 = "DELETE FROM `examination`.`students_approve` WHERE `students_approve`.`student_id` = $student_id ";

                        if ($app_query_3_run = mysqli_query($con, $app_query_3)) {
                            header("Location: admin.php");
                        }

                    } else {
                        echo "Failed to approve";
                    }
                }
            } else {
                echo "Error testing";
            }
        } else {
            echo "There is no such students in the database";
        }

    } else {
        echo "You must specify the student_id to continue";
    }


}else{
    header("Location: admin.php?confo=It has been updated");
}

?>