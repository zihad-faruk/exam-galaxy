<!--Including header files-->
<?php include 'inc/inc.header.php'?>


<!--If student is logged in-->
<?php
if (student_logged_in()) {
    ?>


    <div class="main">
        <header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 profile-pics">
<?php
                        $q = "SELECT `profile_pic` FROM `students` WHERE `Student_id`='".student_get_field('Student_id')."'";
                        $r= mysqli_query($con,$q);

                        while($row = mysqli_fetch_assoc($r)){
                        echo "<img src='uploads/".$row["profile_pic"]."' alt=\"A profile Page\" class=\"img img-responsive animated bounceInDown\">" ;
                        }

                        ?>

                        <a href="student_profile_pic.php" ><button class="btn btn-large btn-success dp" style="margin-top: 20px;">Change Picture</button></a>


                        <div class="picture animated fadeIn">


                        </div>

                    </div>
                    <div class="col-lg-8 about">

                        <h2 class="animated fadeIn"><?php echo student_get_field('name')?></h2>
                        <h1 class="animated slideInDown"><?php echo student_get_field('surname')?></h1>
                        <h4>A Student of class <span class="green_color"><?php echo student_get_field('class')?></span></h4>

                        <hr>

                        <div class="row t animated slideInUp">
                            <div class="container-fluid">
                                <a href="#exams_schedule">
                                    <div class="col-lg-4 about-options"><h3>Exam Schedule</h3>
                                        <p>See your exam activities</p>
                                    </div>
                                </a>
                                <a href="student_written_result_show.php?student_id=<?php echo student_get_field('Student_id')?>">
                                    <div class="col-lg-4 about-options">
                                        <h3>Results</h3>
                                        <p>See your results</p>
                                    </div>
                                </a>
                                <a href="student_logout.php">
                                    <div class="col-lg-4 about-options1">
                                        <h3><i class="fa fa-power-off"></i>  Log Out</h3>
                                        <p>Log out of your account</p>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>
        <contents>

            <div class="container-fluid">
                <div class="row content1">
                    <div class="col-lg-4 content_name">
                        <h3>About</h3>
                        <p>Know about yourself</p>
                    </div>
                    <div class="col-lg-8 content_description">
                        <h5>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
                            totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                            Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit,
                            sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                            Neque porro quisquam est,
                            qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,
                            sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
                            Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi
                            consequatur?
                            Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur,
                            vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?<br>"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."</h5>
                    </div>
                </div>

                <div class="row content2">
                    <div class="col-lg-4 content_name " id="exams_schedule">
                        <h3>Exams Scheduled</h3>
                        <p>Your list of exams are here</p>
                    </div>
                    <div class="col-lg-8 content_description">
                        <div class="exam_schedule">
                            <h2><span class="green_color" style="font-size:40px">E</span>xams scheduled for you</h2>
                            <?php $student_class = student_get_field('Class'); ?>
                            <table>
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

                                $query = "SELECT `exam_id`,`exam_type`,`subject`,`class`,`time`,`full_marks` FROM `exams` WHERE `class`='$student_class'";

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
                                            <td><?php echo $time; ?>hour</td>
                                            <td><?php echo $full_marks; ?></td>

                                            <?php
                                            /*IF the student already participated in the specific exam*/
                                            if (check_participation($exam_id) || participation_in_mcq_exam($exam_id)) {
                                                ?>
                                                <td>Participated</td>
                                                <?php
                                            } /*If the student did not participate in the exam*/
                                            else {

                                                if ($exam_type == "Written") { ?>
                                                    <td><a href="take_written_exam.php?exam_id=<?php echo $exam_id; ?>"
                                                           onclick="return (confirm_taking_exam())">
                                                            <button>Take Exam</button>
                                                        </a></td>

                                                <?php } else {

                                                    ?>
                                                    <td><a href="take_mcq_exam.php?exam_id=<?php echo $exam_id;?>">
                                                            <button>Take Exam</button>
                                                        </a></td>
                                                    <?php

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


                    </div>

                </div>

                </div>

            </div>

        </contents>
        <footer></footer>
    </div>


    <!--*********-->


    <?php


} /*If student is not logged in then redirect to the login page*/
else {
    header("Location: student_login.php");

}


?>

<!--Including the footer files-->
<?php include 'inc/inc.footer.php'?>
