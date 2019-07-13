<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>teacher LogIn</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animate.css">
</head>
<body>
<div class="animated fadeIn">

    <div class="teacher_login_intro">
        <h1 style="color: #66BC6D;margin-top:100px;">Hello , Teacher</h1>
        <p style="font-family: Calibri;font-weight: 600">If you are a teacher ,please provide the email and password to login.</p>
    </div>

    <?php

    require 'connect.inc.php';
    require 'core.inc.php';



        if (isset($_POST['teacher_email']) && isset($_POST['teacher_pass'])) {

            $teacher_email = $_POST['teacher_email'];
            $teacher_pass = $_POST['teacher_pass'];
            $teacher_pass_hash = md5($teacher_pass);


            if (!empty($teacher_email) && !empty($teacher_pass)) {

                $query = "SELECT `SSN` FROM `teachers` WHERE `Email`='$teacher_email' AND `Password`='$teacher_pass_hash'";
                if ($query_run = mysqli_query($con, $query)) {
                    $result = mysqli_num_rows($query_run);

                    /*If teacher was approved by the admin ,then he will be found in the teachers table*/

                    if ($result == 1) {

                        $row = mysqli_fetch_row($query_run);
                        $teacher_id = $row[0];

                        $_SESSION['SSN'] = $row[0];
                        header('Location: teachers_profile.php');
                    } /*If the teacher was not found in the teachers table,check in the teachers_approval table*/
                    else if ($result == 0) {

                        $query2 = "SELECT `SSN` FROM `teachers_approve` WHERE `Email`='$teacher_email' AND `Password`='$teacher_pass_hash'";
                        if ($query_run2 = mysqli_query($con, $query2)) {
                            $result2 = mysqli_num_rows($query_run2);
                            if ($result2 == 1) {
                                $row2 = mysqli_fetch_row($query_run2);
                                $_SESSION['SSN'] = $row2[0];
                                header('Location: teachers_profile.php');
                            } /*If the email and password doesn't match any account*/
                            else {
                                echo "Invalid username and password";
                            }

                        } else {
                            echo "There was a problem in executing the second query";
                        }


                    } else {
                        echo 'There was a problem';
                    }
                } else {
                    echo "The query couldn't execute";
                }
            } else {
                echo "Please fill all the fields";
            }
        }

    ?>


    <div class="teacher_login_form">
        <form action="<?php echo $current_file; ?>" method="POST" style="margin-bottom: 20px">
            <input type="email" placeholder="Enter the email" name="teacher_email"><br><br>
            <input type="password" placeholder="Password Please" name="teacher_pass"><br><br>
            <input type="submit" value="Log In" class="btn btn-large btn-success">

        </form>

        <a href="teacher_reg.php">Not a teacher? Please Register .</a><br><br>

    </div>
</div>
</body>
</html>