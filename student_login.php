<?php include 'inc/inc.header.php'?>

    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-3"><a href="home.php"><i class="fa fa-5x fa-home" style="margin-bottom: -100px;margin-top: 30px"></i></a></div>
        <div class="col-lg-7"></div>
        <div class="col-lg-1"></div>
    </div>


<div class="animated fadeIn">

    <div class="login_intro">
        <h1>Student LogIn Page</h1>
        <p>If you are an student ,please provide the email and password to login.</p>
    </div>

    <?php


    if(student_logged_in()){
        header("Location: students_profile.php");
    }

    else {
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
    }
    ?>


    <!--Log In Page-->



    <div class="login_form">
        <form action="<?php echo $current_file; ?>" method="POST">
            <input type="email" placeholder="Enter the email" name="email"><br><br>
            <input type="password" placeholder="Password Please" name="pass"><br><br>

            <input type="submit" value="Log In" class="btn btn-large btn-success" style="margin-bottom:20px">

        </form>
        <a href="student_reg.php">Not a student? Please Register .</a><br><br>
    </div>
</div>

<?php include "inc/inc.footer.php";?>