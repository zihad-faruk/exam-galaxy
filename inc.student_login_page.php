<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student</title>

    <link rel="stylesheet" href="css/animate.css">
</head>
<body >
<div class="animated fadeIn">

    <div class="login_intro">
        <h1>Hello , Student</h1>
        <p style="font-family: Calibri;font-weight: 500">If you are an student ,please provide the email and password to login.</p>
    </div>

    <?php

    require 'connect.inc.php';
    require_once 'core.inc.php';


        /*Login Validation*/

        if (isset($_POST['email']) && isset($_POST['pass'])) {

            $email = $_POST['email'];
            $pass = $_POST['pass'];
            $pass_hash = md5($pass);


            if (!empty($email) && !empty($pass)) {

                $query = "SELECT `Student_id` FROM `students` WHERE `Email`='$email' AND `Password`='$pass_hash'";
                if ($query_run = mysqli_query($con, $query)) {
                    $result = mysqli_num_rows($query_run);

                    if ($result == 1) {

                        $row = mysqli_fetch_row($query_run);
                        $id = $row[0];

                        $_SESSION['student_id'] = $id;
                        header('Location: students_profile.php');
                    } else if ($result == 0) {
                        echo 'Invalid username or password';
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


    <!--Log In Page-->

    <div class="login_form" >
        <form style="margin-bottom: 20px" action="<?php echo $current_file; ?>" method="POST">
            <input type="email" placeholder="Enter the email" name="email"><br><br>
            <input type="password" placeholder="Password Please" name="pass"><br><br>
            <input type="submit" value="Log In" class="btn btn-large btn-success" >

        </form>

        <a href="student_reg.php">Not a student? Please Register .</a><br><br>

    </div>
</div>
</body>
</html>