<?php
include 'D:\wamp\www\Online Examination System\core.inc.php';
include 'D:\wamp\www\Online Examination System\connect.inc.php';
?>


    <!DOCTYPE html>
    <html>
    <head>
        <title>Results</title>
        <link rel="stylesheet" href="http://localhost/Online%20Examination%20System/css/style.css">
    </head>
<body style="text-align: center">
<?php if (admin_logged_in()) {
    $exam_id = $_GET['exam_id'];
    ?>

    <h2>Result</h2>
    <h3>Subject: <?php echo exam_get_field('Subject', $exam_id) ?></h3>
    <h3>Class: <?php echo exam_get_field('Class', $exam_id) ?></h3>
    <h3>Teacher: <?php echo exam_get_field('set_by', $exam_id) ?></h3>

    <?php
    $query = "SELECT * FROM `written_answers_marks` WHERE `exam_id`='$exam_id' ORDER by `total` DESC ";
    if ($query_run = mysqli_query($con, $query)) {
        ?>
        <table>
            <tr>
                <th>Student Id</th>
                <th>Name</th>
                <th>Total(Out of <?php echo exam_get_field('full_marks',$exam_id)?>)</th>
                <th>Ques1(Out of <?php echo ques_get_marks('ques_1',$exam_id)?>)</th>
                <th>Ques2(Out of <?php echo ques_get_marks('ques_2',$exam_id)?>)</th>
                <th>Ques3(Out of <?php echo ques_get_marks('ques_3',$exam_id)?>)</th>
                <th>Ques4(Out of <?php echo ques_get_marks('ques_4',$exam_id)?>)</th>
                <th>Ques5(Out of <?php echo ques_get_marks('ques_5',$exam_id)?>)</th>
                <th>Ques6(Out of <?php echo ques_get_marks('ques_6',$exam_id)?>)</th>
                <th>Ques7(Out of <?php echo ques_get_marks('ques_7',$exam_id)?>)</th>
                <th>Ques8(Out of <?php echo ques_get_marks('ques_8',$exam_id)?>)</th>
                <th>Ques9(Out of <?php echo ques_get_marks('ques_9',$exam_id)?>)</th>
                <th>Ques10(Out of <?php echo ques_get_marks('ques_10',$exam_id)?>)</th>
                <th>Ques11(Out of <?php echo ques_get_marks('ques_11',$exam_id)?>)</th>
                <th>Ques12(Out of <?php echo ques_get_marks('ques_12',$exam_id)?>)</th>
                <th>Ques13(Out of <?php echo ques_get_marks('ques_13',$exam_id)?>)</th>
                <th>Ques14(Out of <?php echo ques_get_marks('ques_14',$exam_id)?>)</th>
                <th>Ques15(Out of <?php echo ques_get_marks('ques_15',$exam_id)?>)</th>

            </tr>

            <?php
            while ($row2 = mysqli_fetch_assoc($query_run)) {
                $student_id = $row2['Student_id'];
                $student_name = other_student_get_field('Name', $student_id);


                ?>


                <tr>
                    <td><?php echo $student_id;?></td>
                    <td><?php echo $student_name?></td>
                    <td><?php echo get_marks('total',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_1',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_2',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_3',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_4',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_5',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_6',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_7',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_8',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_9',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_10',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_11',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_12',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_13',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_14',$student_id,$exam_id)?></td>
                    <td><?php echo get_marks('ans_15',$student_id,$exam_id)?></td>



                </tr>

                <?php
            }

            ?>


        </table>


        <a href="result_list.php">
            <button>Back</button>
        </a>


        <a href="admin.php">
            <button>Go back to profile</button>
        </a>
        <a href="logout.php">
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