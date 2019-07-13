<!--Including header files-->
<?php include 'inc/inc.header.php' ?>


<script type="text/javascript">


    //Function for checking if the student really want to submit the answert script
    function confirm_submit() {
        if (confirm("Do you really want to submit the answers?You can't do anything later about this exam")) {
            return true;
        }
        else {
            return false;
        }
    }

</script>


<script type="text/javascript">

    /**$(function() {
        $(this).bind("contextmenu", function(e) {
            e.preventDefault();
        });
    });**/

    var fn = function (e)
    {

        if (!e)
            var e = window.event;

        var keycode = e.keyCode;
        if (e.which)
            keycode = e.which;

        var src = e.srcElement;
        if (e.target)
            src = e.target;

        // 119 = F8
        if (123 == keycode || 116==keycode || 17==keycode)
        {
            alert('No cheating!!')
            // Firefox and other non IE browsers
            if (e.preventDefault)
            {
                e.preventDefault();
                e.stopPropagation();
            }
            // Internet Explorer
            else if (e.keyCode)
            {
                e.keyCode = 0;
                e.returnValue = false;
                e.cancelBubble = true;
            }

            return false;
        }
    }
    document.onkeypress=document.onkeydown=document.onkeyup=fn
</script>

<?php
/*If student is logged in then offer the features else take him to the login page*/
if (student_logged_in()) {

    ?>


    <!--Answer script starts--->
<!--Clock div starts-->
<div class="row">
    <div class="col-lg-7"></div>
    <div class="col-lg-4" style="position: fixed;">
        <img src="images/kcKo6eM5i.gif" alt="" style="width: 75px;height: 75px;">  <div class="clock_div"><h4>Time Remaining:</h4><div id="show"></div></div>
    </div>

    <div class="answer_script">
        <?php

        if (isset($_GET['exam_id'])) {



            $student_class = student_get_field('class');
            $stu_id = student_get_field('Student_id');

            $exam_id = $_GET['exam_id'];
            $num_of_ques = exam_get_field('num_of_ques',$exam_id);
            /*Exam duration converting to seconds*/
            $duration = exam_get_field('time', $exam_id) * (1000 * 60 * 60);
            ?>

            <!--Script For the Counter-->
            <script>
                // Set the date we're counting down to
                var countDownDate = new Date().getTime() +<?php echo $duration; ?>;

                // Update the count down every 1 second
                var x = setInterval(function () {

                    // Get todays date and time
                    var now = new Date().getTime();

                    // Find the distance between now an the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Output the result in an element with id="demo"
                    document.getElementById("show").innerHTML =  hours + "h "
                        + minutes + "m " + seconds + "s ";

                    // If the count down is over, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("show").innerHTML = "EXPIRED";
                    }
                }, 1000);
            </script>


            <!--Script FOR submitting the form when the time is over-->
            <script>
                $(document).ready(function () {
                    setTimeout(function () {
                        alert("Your time is up dude");
                        $('form').submit();
                    }, <?php echo $duration; ?>);
                });
            </script>




            <?php
            /*Query for getting the data of the desired exam*/
            $query = "SELECT * FROM  `exams` WHERE `exam_id`='$exam_id'";
            if ($query_run = mysqli_query($con, $query)) {

                while ($row = mysqli_fetch_assoc($query_run)) {

                    /*Preventing students related to this exam from accessing other exams */
                    if ($student_class == $row['class']) {

                        ?>

        <div class="exam_intro">
            <h1>Answer Script of Written Exam</h1>
            <hr>
            <div class="sub_class container">

                <div class="row exam_det">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3 exam_det_ind"><span style="color:#66BC6D;font-size:40px">S</span>ubject: <span style="font-weight: 300;"><?php echo $row['subject']; ?></span></div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3 exam_det_ind"><span style="color:#66BC6D;font-size:40px">F</span>or Class: <span style="font-weight: 300;"><?php echo $row['class']; ?></span></div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3 exam_det_ind"><span style="color:#66BC6D;font-size:40px">Q</span>uestions: <span style="font-weight: 300;"><?php echo $row['num_of_ques']; ?></span></div>

                </div>

                <div class="row exam_det">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3 exam_det_ind"><span style="color:#66BC6D;font-size:40px">D</span>uration: <span style="font-weight: 300;"><?php echo $row['time']; ?></span> hours</div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3 exam_det_ind"><span style="color:#66BC6D;font-size:40px">S</span>et By: <span style="font-weight: 300;"><?php echo $row['set_by']; ?></span></div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3 exam_det_ind"><span style="color:#66BC6D;font-size:40px">F</span>ull Marks: <span style="font-weight: 300;"><?php echo $row['full_marks']; ?></span></div>
                </div>


            </div>

                        <?php

                        /*Query for getting the data from the questions table and getting the questions*/
                        $query2 = "SELECT * FROM `mcq_questions` WHERE `exam_id`='$exam_id'";

                        if ($query_run2 = mysqli_query($con, $query2)) {

                            while ($row2 = mysqli_fetch_assoc($query_run2)) {
                                $num_of_ques = $row2['num_of_questions'];

                                ?>
                                <!--Form for collecting the answers-->

                                <form action="" method="POST" style="margin-top:70px">

                                    <?php

                                    $sum = 0;

                                    for ($i = 1; $i <= $num_of_ques; $i++) {
                                        $ques_no = 'ques_' . $i;
                                       $name = 'ans_' . $i;
                                        ?>

                                        <h2 style="margin-top: 100px"><span style="font-weight:600;color:#66BC6D;font-size:40px">Question No <?php echo $i; ?>: </span> <?php echo $row2[$ques_no]; ?></h2>

                                        <?php
                                        $query_ques = "SELECT * FROM  `mcq_questions_options` WHERE `exam_id`= '$exam_id' AND `ques_no`='$ques_no'";

                                        if ($query_ques_run = mysqli_query($con, $query_ques)) {
                                            $row_options = mysqli_fetch_row($query_ques_run);



                                          $arr= rand_option(2,5,4);



                                            ?>


                                            <div class="container" style="height: 100vh;">
                                                <div class="row exam_det">
                                                   <div class="col-lg-2"></div>
                                                   <div class="col-lg-3">
                                                       <input type="radio" name="<?php echo $name;?>" value="<?php echo $row_options[$arr[0]]?>" checked>  <?php echo $row_options[$arr[0]]?>
                                                   </div>
                                                   <div class="col-lg-2"></div>
                                                   <div class="col-lg-3">
                                                       <input type="radio" name="<?php echo $name;?>" value="<?php echo $row_options[$arr[0]]?>">  <?php echo $row_options[$arr[1]]?>
                                                   </div>
                                                   <div class="col-lg-2"></div>
                                                </div>

                                                <div class="row exam_det">
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-3">
                                                        <input type="radio" name="<?php echo $name;?>" value="<?php echo $row_options[$arr[0]]?>">  <?php echo $row_options[$arr[2]]?>

                                                    </div>
                                                    <div class="col-lg-2"></div>
                                                    <div class="col-lg-3">

                                                        <input type="radio" name="<?php echo $name;?>" value="<?php echo $row_options[$arr[0]]?>">  <?php echo $row_options[$arr[3]]?>

                                                    </div>
                                                    <div class="col-lg-2"></div>
                                                </div>
                                            </div>
                                            <hr>



                                            <?php
                                        } else {
                                            echo "There was a problem in executing options query";
                                        }


                                        $sum = $sum + 1;
                                    }

                                    /*Some needed calculation*/
                                    $remaining = 15 - $sum;

                                    for ($j = 1; $j <= $remaining; $j++) {
                                        $name2 = 'ans_' . ($j + $sum);
                                        ?>
                                        <input type="hidden" name="<?php echo $name2; ?>" id="<?php echo $name2; ?>"
                                               value="Not participated">

                                        <?php
                                    }

                                    ?>

                                    <input type="submit" value="Submit answer" onclick="return (confirm_submit())" class="btn btn-large btn-success">
                                    <!--FORM Ends-->
                                </form>


                                <?php


                            }

                        } else {
                            echo "There was a problem parsing the questions";
                        }


                    } else {
                        echo "You are not allowed to participate in this exam";
                    }
                }

            } else {
                echo "There was a problem or the exam has been removed by the teacher";
            }

            /*Sending the answers to the database*/
            if (isset($_POST['ans_1'])) {


                $ans_1 = $_POST['ans_1'];
                $ans_2 = $_POST['ans_2'];
                $ans_3 = $_POST['ans_3'];
                $ans_4 = $_POST['ans_4'];
                $ans_5 = $_POST['ans_5'];
                $ans_6 = $_POST['ans_6'];
                $ans_7 = $_POST['ans_7'];
                $ans_8 = $_POST['ans_8'];
                $ans_9 = $_POST['ans_9'];
                $ans_10 = $_POST['ans_10'];
                $ans_11 = $_POST['ans_11'];
                $ans_12 = $_POST['ans_12'];
                $ans_13 = $_POST['ans_13'];
                $ans_14 = $_POST['ans_14'];
                $ans_15 = $_POST['ans_15'];

                $student_id = student_get_field('Student_id');
                $total =0;

            for($k=1;$k<=$num_of_ques;$k++){
                $ques_no='ques_'.$k;
                $ans= $_POST['ans_'.$k];

                /*Checking if the answer is right*/

                if($ans==get_mcq_answer($exam_id,$ques_no,'right_ans')){
                    $total= $total+1;
                }
            }
            $mcq_ans= "INSERT INTO `mcq_marks` VALUES('$student_id','$exam_id',$total)";

                if(mysqli_query($con,$mcq_ans)){

                    header("Location: mcq_submission_confirm.php");

                }else{

                    header("Location: mcq_submission_failure.php");

                }
            }

        }

        ?>
    </div>


    <?php
} else {
    ?>

    <div style="text-align: center;margin-top:200px">
        <h2>You must be logged in to continue to the exam</h2>

        <a href="student_login.php">
            <button class="btn btn-large btn-success">Log In</button>
        </a>
    </div>

    <?php

}


include 'inc/inc.footer.php';
?>
