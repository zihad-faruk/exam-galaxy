<?php
include "core.inc.php";
include "connect.inc.php";

?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Evaluation Page</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
<body style="text-align: center;">

    <!--If teacher is logged in then offer him the page-->
<?php
if (teacher_logged_in() && teacher_approved()) {
    ?>
    <h2>Hello <?php echo $teacher_name = teacher_get_field("Name"); ?> ,Welcome to the evaluation page</h2>
    <p>Here you will get answer scripts of every students participated in your exam</p>
    <!--List of exams the teacher is able to evaluate-->
    <div class="teacher_notice_board">
        <h2>Exams Scheduled for evaluation</h2>
        <table>
            <tr>
                <th>Exam Id</th>
                <th>Subject</th>
                <th>Class</th>
                <th>Full Marks</th>
                <th>Actions</th>
            </tr>


            <!--Code for showing exams set by this teacher and their data-->
            <?php


            $query = "SELECT `exam_id`,`exam_type`,`subject`,`class`,`time`,`full_marks` FROM `exams` WHERE `set_by`='$teacher_name'";

            if ($query_run = mysqli_query($con, $query)) {

                while ($row = mysqli_fetch_assoc($query_run)) {
                    $exam_id = $row["exam_id"];
                    $exam_type = $row["exam_type"];
                    $subject = $row["subject"];
                    $class = $row["class"];
                    $time = $row["time"];
                    $full_marks = $row["full_marks"];

                    ?>
                    <tr>
                        <td><?php echo $exam_id; ?></td>
                        <td><?php echo $subject; ?></td>
                        <td><?php echo $class; ?></td>
                        <td><?php echo $full_marks; ?></td>

                        <?php
                        /*If the teacher has set the question*/
                        if (written_ques_set($exam_id)) {
                            ?>
                            <td><a href="http://localhost/Online%20Examination%20System/inc/student_participated_in_the_exam_inc.php?exam_id=<?php echo $exam_id;?>">
                                    <button>Evaluate</button>
                                </a></td>
                            <?php
                        } /*If the question is not set by the teacher*/

                        else {
                            ?>
                            <!--Take him to the page where he can set the questions-->
                            <td><a href="set_written_exam_questions.php?exam_id=<?php echo $exam_id; ?>">
                                    <button>Set Questions</button>
                                </a></td>

                            <?php
                        } ?>
                    </tr>


                    <?php

                }
            } else {
                echo "The query couldn't execute";
            }


            ?>

        </table>
    </div>


    </body>
    </html>

    <?php
} else {
    echo "You must be logged in to have access to these contents";
    header("Location: teacher_login.php");
}
?>