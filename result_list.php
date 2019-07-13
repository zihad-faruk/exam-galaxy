<?php
include "inc/inc.header.php";


if (admin_logged_in()) {
    ?>


    <!--admin profile intro-->
    <div class="admin_result_show">


       <h1><span class="text_style">Admin Profile Page</span></h1>
        <p>The list of exams are given below</p>
        <br><br>
    </div>

    <table>
        <tr>
            <th>Exam Id</th>
            <th>Exam Type</th>
            <th>Teacher</th>
            <th>Subject</th>
            <th>Class</th>
            <th>Duration</th>
            <th>Full Marks</th>
            <th>Actions</th>
        </tr>


        <!--Code for showing exams and their data-->
        <?php

        $query = "SELECT `exam_id`,`exam_type`,`set_by`,`subject`,`class`,`time`,`full_marks` FROM `exams`";

        if ($query_run = mysqli_query($con, $query)) {

            while ($row = mysqli_fetch_assoc($query_run)) {
                $exam_id = $row["exam_id"];
                $exam_type = $row["exam_type"];
                $set_by=$row['set_by'];
                $subject = $row["subject"];
                $class = $row["class"];
                $time = $row["time"];
                $full_marks = $row["full_marks"];

                ?>
                <tr>
                    <td><?php echo $exam_id; ?></td>
                    <td><?php echo $exam_type; ?></td>
                    <td><?php echo $set_by;?></td>
                    <td><?php echo $subject; ?></td>
                    <td><?php echo $class; ?></td>
                    <td><?php echo $time; ?></td>
                    <td><?php echo $full_marks; ?></td>
                    <?php
                if ($exam_type == "Written") { ?>
                    <td><a href="written_results.php?exam_id=<?php echo $exam_id;?>">
                            <button>See Written Results</button>
                        </a></td>

                <?php } else {
                    ?>
                    <td><a href="set_mcq_exam_questions.php">
                            <button>See MCQ Results</button>
                        </a></td>
                    <?php
                }

                    ?>


                </tr>


                <?php

            }
        } else {
            echo "The query couldn't execute";
        }


        ?>

    </table>

    <div style="margin-top:50px;margin-bottom:30px">
        <a href="admin.php"><button class="btn btn-large btn-primary"><i class="fa fa-arrow-left"></i> Back to profile</button></a>
        <a href="logout.php">
            <button class="btn btn-large btn-danger"><i class="fa fa-power-off"></i> Log Out</button>
        </a>

    </div>

    <?php
} else {
    header("Location: admin_login.php");
}

include "inc/inc.footer.php";
?>


