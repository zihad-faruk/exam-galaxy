<?php
include 'D:\wamp\www\Online Examination System\core.inc.php';
include 'D:\wamp\www\Online Examination System\connect.inc.php';
?>


    <!DOCTYPE html>
    <html>
    <head>
        <title>Evalute</title>
        <link rel="stylesheet" href="http://localhost/Online%20Examination%20System/css/style.css">
    </head>
<body style="text-align: center">
<?php if (teacher_logged_in()) {
    $exam_id = $_GET['exam_id'];
    ?>

    <h2>Evaluation</h2>
    <h3>Subject: <?php echo exam_get_field('Subject', $exam_id) ?></h3>
    <h3>Class: <?php echo exam_get_field('Class', $exam_id) ?></h3>

    <?php
    $query = "SELECT * FROM `written_answers` WHERE `exam_id`='$exam_id'";
    if ($query_run = mysqli_query($con, $query)) {
        ?>
        <table>
            <tr>
                <th>Student Id</th>
                <th>Name</th>
                <th>Action</th>
            </tr>

            <?php
            while ($row2 = mysqli_fetch_assoc($query_run)) {
                $student_id = $row2['Student_id'];
                $student_name = other_student_get_field('Name', $student_id);


                ?>


                <tr>
                    <td><?php echo $student_id; ?></td>
                    <td><?php echo $student_name; ?></td>
                    <?php
                    if(if_checked_script($student_id,$exam_id)){

                        ?>
                        <td>Script is checked</td>
                   <?php }else {
                        ?>

                        <td>
                            <a href="http://localhost/Online%20Examination%20System/see_scripts.php?exam_id=<?php echo $exam_id ?>&&student_id=<?php echo $student_id; ?>">
                                <button>See Script</button>
                            </a></td>

                        <?php
                    }
                        ?>
                </tr>

                <?php
            }

            ?>


        </table>


        <a href="http://localhost/Online%20Examination%20System/teachers_profile.php">
            <button>Go back to profile</button>
        </a>
        <a href="http://localhost/Online%20Examination%20System/teacher_logout.php">
            <button>Log Out</button>
        </a>
        <?php
    } else {
        echo "There was a problem while executing query";
    }


} else {
    ?>

    <h3>You have to log in dude</h3>
    <a href="http://localhost/Online%20Examination%20System/teacher_login.php">
        <button>Log In</button>
    </a>
    </body>
    </html>

    <?php
}
?>