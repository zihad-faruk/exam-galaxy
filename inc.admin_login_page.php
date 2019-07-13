

<div class="animated fadeIn">
    <div class="admin_login_intro ">
        <h1 style="color: #66BC6D;margin-top:100px">Hello , Admin</h1>
        <p>If you are an admin ,please provide the email and password to login.</p>
    </div>

    <?php

    require 'connect.inc.php';
    require_once 'core.inc.php';

        /*Login Validation*/

        if (isset($_POST['admin_email']) && isset($_POST['admin_pass'])) {

            $admin_email = $_POST['admin_email'];
            $admin_pass = $_POST['admin_pass'];
            $admin_pass_hash = md5($admin_pass);


            if (!empty($admin_email) && !empty($admin_pass)) {

                $query = "SELECT `Admin_Id` FROM `admins` WHERE `Email`='$admin_email' AND `Password`='$admin_pass_hash'";
                if ($query_run = mysqli_query($con, $query)) {
                    $result = mysqli_num_rows($query_run);

                    if ($result == 1) {

                        $row = mysqli_fetch_row($query_run);
                        $admin_id = $row[0];

                        $_SESSION['admin_id'] = $admin_id;
                        header('Location: admin.php');
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

    <div class="admin_login_form" style="margin: 0 auto">
        <form action="<?php echo $current_file; ?>" method="POST">
            <input type="email" placeholder="Enter the email" name="admin_email" ><br><br>
            <input type="password" placeholder="Password Please" name="admin_pass"><br><br>
            <input type="submit" value="Log In" class="btn btn-large btn-success">

        </form>

    </div>

</div>
