<?php include 'inc/inc.header.php'?>


<?php


if (teacher_logged_in()) {
    ?>


    <div class="row " style="height: 2vh;margin-top: 30px">
        <div class="col-lg-7"></div>
        <div class="col-lg-4"><h4 style="font-family: Calibri;font-weight: 600;"><img src="images/pro.png" alt="" style="width: 50px;height: 50px;"> 
                <?php echo $teacher_name = teacher_get_field("Name");?>
                <span style="color: #6cb670;font-size:30px">|</span> <span>TEACHER</span></div>

        <div class="col-lg-1"></div>
    </div>



    <!--Teacher profile intro-->
    <div class="teacher_profile_intro animated fadeIn" style="height: 96vh">

        <i class="fa fa-5x fa-user"style="margin-top:200px;margin-left: 41px;"></i>
        <h1 style="font-size: 60px;"><span style="color: #66BC6D">Teacher </span>Profile Page</h1>
        <p style="font-family: Calibri" class="animated bounceInUp">This is the teacher profile page.Do as you wish.Good Luck!</p>
        <br><br>
    </div>


    <!--Features of teacher profile page-->
    <?php
    $ssn = $_SESSION['SSN'];




    /*Checking if the user is in Approve phase or not*/
    $query = "SELECT * FROM `teachers_approve` WHERE `SSN`='$ssn'";

    if ($query_run = mysqli_query($con, $query)) {

        /*If the teacher is not in approval table*/
        if (mysqli_num_rows($query_run) == 0) {

            /*Offer all the features to the teacher*/

            ?>

            <!--Feature of teachers-->


            <style>
                .hp{

                }

                .hp: hover{
                    background-color:red;
                }
                .t{

                }

                .t a{

                }

                .t a:hover{
                    background-color:red;
                }
            </style>
            <div class="row t animated slideInUp">
                <div class="container">
                    <a href="set_exam.php">
                        <div class="col-lg-4 about-options" style="background-color:#66BC6D;border:1px solid grey" ><h3>Set Exam</h3>
                            <p>See your exam activities</p>
                        </div>
                    </a>
                    <a href="evaluate_written_answers.php" style="background-color:#66BC6D" >
                        <div class="col-lg-4 about-options" style="background-color:#66BC6D;border:3px solid grey" >
                            <h3>Evaluate Scripts</h3>
                            <p>See your results</p>
                        </div>
                    </a>
                    <a href="teacher_logout.php" class="hp" >
                        <div class="col-lg-4 hp" style="background-color:#66BC6D ;border:1px solid grey" >
                            <h3><i class="fa fa-power-off"></i>  Log Out</h3>
                            <p>Log out of your account</p>
                        </div>
                    </a>
                </div>
            </div>


            <div class="teacher_notice_board">
                <h2 style="margin-top:150px;margin-bottom:30px;font-size:40px;font-weight: 600;margin-left:220px"><span style="font-size:50px;color:#66BC6D">E</span>xams set By <span style="font-size:50px;color:#66BC6D">T</span>his teacher</h2>
                <table style="margin-bottom: 30px">
                    <tr>
                        <th>Exam Id</th>
                        <th>Exam Type</th>
                        <th>Subject</th>
                        <th>Class</th>
                        <th>Duration</th>
                        <th>Full Marks</th>
                        <th>Actions</th>
                    </tr>


                    <!--Code for showing exams set by this teacher and their data-->
                    <?php

                    $teacher_name = teacher_get_field("Name");
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
                                <td><?php echo $exam_type; ?></td>
                                <td><?php echo $subject; ?></td>
                                <td><?php echo $class; ?></td>
                                <td><?php echo $time; ?></td>
                                <td><?php echo $full_marks; ?></td>

                                <?php
                                /*If the teacher has set the question*/
                                if (written_ques_set($exam_id)) {
                                    ?>
                                    <td>Question is set</td>
                                    <?php
                                } /*If the question is not set by the teacher*/
                                else {


                                    if ($exam_type == "Written") { ?>
                                        <td><a href="set_written_exam_questions.php?exam_id=<?php echo $exam_id;?>">
                                                <button>Set Questions</button>
                                            </a></td>

                                    <?php } else {

                                        if(mcq_ques_set($exam_id)){
                                            ?>
                                            <td>Question is set</td>
                                            <?php
                                        }else {
                                            ?>
                                            <td><a href="set_mcq_exam_questions.php?exam_id=<?php echo $exam_id; ?>">
                                                    <button>Set Questions</button>
                                                </a></td>
                                            <?php
                                        }
                                    }
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


            <?php

        } /*If the teacher was not approved*/
        else {

            /*Teacher will have to wait for approval*/
            ?>

            <div class="not_approval_msg">
                <p>You are not approved by the admin.You will have to wait for approval</p>
            </div>

            <?php
        }
    } else {
        echo "Query couldn't execute";
    }


    ?>

    <a href="teacher_logout.php">
        <button class="btn btn-large btn-danger" style="margin-bottom:30px">Log Out</button>
    </a>

    <?php
} else {
    header("Location: teacher_login.php");
}
?>


<!--Including the footer files-->
<?php include 'inc/inc.footer.php'?>