<?php
include "connect.inc.php";
include "core.inc.php";

/*If teacher is logged in,grant him access to this page directly*/
if (teacher_logged_in() && teacher_approved()&& (teacher_get_field('SSN') == $_SESSION['SSN']) ){
?>
<!DOCTYPE html>
<html>
<head>
    <title>MCQ Exam Questions</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        function confirm_set_ques() {
            if (confirm("Do you want to continue?")) {
                return true;
            }
            else {
                return false;
            }
        }
    </script>
</head>
<body style="text-align: center;background-color: whitesmoke">
<h2>Set Questions For MCQ Exam</h2>
<p>You can not set more then 15 questions</p>

<?php

if (isset($_GET['exam_id'])) {
    $exam_id = $_GET['exam_id'];
    $num_of_ques = exam_get_field('num_of_ques', $exam_id);

    if (isset($_POST['ques_1']) &&
        isset($_POST['right_ans_1']) &&
        isset($_POST['option_1_1']) &&
        isset($_POST['option_2_1']) &&
        isset($_POST['option_3_1'])
    ) {

        /*Mendatory variables*/

        $ques_1 = $_POST['ques_1'];
        $right_ans_1 = $_POST['right_ans_1'];
        $option_1_1 = $_POST['option_1_1'];
        $option_2_1 = $_POST['option_2_1'];
        $option_3_1 = $_POST['option_3_1'];


        /*Optional Variables*/
        $ques_2 = $_POST['ques_2'];
        $right_ans_2 = $_POST['right_ans_2'];
        $option_1_2 = $_POST['option_1_2'];
        $option_2_2 = $_POST['option_2_2'];
        $option_3_2 = $_POST['option_3_2'];


        $ques_3 = $_POST['ques_3'];
        $right_ans_3 = $_POST['right_ans_3'];
        $option_1_3 = $_POST['option_1_3'];
        $option_2_3 = $_POST['option_2_3'];
        $option_3_3 = $_POST['option_3_3'];


        $ques_4 = $_POST['ques_4'];
        $right_ans_4 = $_POST['right_ans_4'];
        $option_1_4 = $_POST['option_1_4'];
        $option_2_4 = $_POST['option_2_4'];
        $option_3_4 = $_POST['option_3_4'];

        $ques_5 = $_POST['ques_5'];
        $right_ans_5 = $_POST['right_ans_5'];
        $option_1_5 = $_POST['option_1_5'];
        $option_2_5 = $_POST['option_2_5'];
        $option_3_5 = $_POST['option_3_5'];

        $ques_6 = $_POST['ques_6'];
        $right_ans_6 = $_POST['right_ans_6'];
        $option_1_6 = $_POST['option_1_6'];
        $option_2_6 = $_POST['option_2_6'];
        $option_3_6 = $_POST['option_3_6'];

        $ques_7 = $_POST['ques_7'];
        $right_ans_7 = $_POST['right_ans_7'];
        $option_1_7 = $_POST['option_1_7'];
        $option_2_7 = $_POST['option_2_7'];
        $option_3_7 = $_POST['option_3_7'];

        $ques_8 = $_POST['ques_8'];
        $right_ans_8 = $_POST['right_ans_8'];
        $option_1_8 = $_POST['option_1_8'];
        $option_2_8 = $_POST['option_2_8'];
        $option_3_8 = $_POST['option_3_8'];

        $ques_9 = $_POST['ques_9'];
        $right_ans_9 = $_POST['right_ans_9'];
        $option_1_9 = $_POST['option_1_9'];
        $option_2_9 = $_POST['option_2_9'];
        $option_3_9 = $_POST['option_3_9'];

        $ques_10 = $_POST['ques_10'];
        $right_ans_10 = $_POST['right_ans_10'];
        $option_1_10 = $_POST['option_1_10'];
        $option_2_10 = $_POST['option_2_10'];
        $option_3_10 = $_POST['option_3_10'];

        $ques_11 = $_POST['ques_11'];
        $right_ans_11 = $_POST['right_ans_11'];
        $option_1_11 = $_POST['option_1_11'];
        $option_2_11 = $_POST['option_2_11'];
        $option_3_11 = $_POST['option_3_11'];

        $ques_12 = $_POST['ques_12'];
        $right_ans_12 = $_POST['right_ans_12'];
        $option_1_12 = $_POST['option_1_12'];
        $option_2_12 = $_POST['option_2_12'];
        $option_3_12 = $_POST['option_3_12'];

        $ques_13 = $_POST['ques_13'];
        $right_ans_13 = $_POST['right_ans_13'];
        $option_1_13 = $_POST['option_1_13'];
        $option_2_13 = $_POST['option_2_13'];
        $option_3_13 = $_POST['option_3_13'];

        $ques_14 = $_POST['ques_14'];
        $right_ans_14 = $_POST['right_ans_14'];
        $option_1_14 = $_POST['option_1_14'];
        $option_2_14 = $_POST['option_2_14'];
        $option_3_14 = $_POST['option_3_14'];

        $ques_15 = $_POST['ques_15'];
        $right_ans_15 = $_POST['right_ans_15'];
        $option_1_15 = $_POST['option_1_15'];
        $option_2_15 = $_POST['option_2_15'];
        $option_3_15 = $_POST['option_3_15'];


        if (!empty($exam_id) && !empty($ques_1)) {


            /*Query for checking if the given Exam if exists */
            $query_check1 = "SELECT `exam_id` FROM `exams` WHERE `exam_id`='$exam_id'";


            if ($query_check1_run = mysqli_query($con, $query_check1)) {

                if (mysqli_num_rows($query_check1_run) > 0) {


                    /*Query for checking if the question is already set or not*/
                    $query_check2 = "SELECT `ques_1` FROM `mcq_questions` WHERE `exam_id`='$exam_id'";

                    if ($query_check2_run = mysqli_query($con, $query_check2)) {

                        if (mysqli_num_rows($query_check2_run) == 0) {


                            /*Query for inserting questions data into mcq_questions table*/
                            $query = "INSERT INTO `mcq_questions` VALUES ('$exam_id','$num_of_ques','$ques_1','$ques_2','$ques_3','$ques_4','$ques_5','$ques_6','$ques_7','$ques_8','$ques_9','$ques_10','$ques_11','$ques_12','$ques_13','$ques_14','$ques_15')";

                            if ($query_run = mysqli_query($con, $query)) {
                                $sum2 = 0;

                                for ($k = 1; $k <= $num_of_ques; $k++) {

                                    $ques_no = 'ques_' . $k;
                                    echo $r = $_POST['right_ans_'.$k];
                                    echo$o1 = $_POST['option_1_'.$k];
                                    $o2 = $_POST['option_2_'.$k];
                                    $o3 = $_POST['option_3_'.$k];



                                    $query2 = "INSERT INTO `mcq_questions_options` VALUES('$exam_id','$ques_no','$r','$o1','$o2','$o3')";
                                    if ($query_run2 = mysqli_query($con, $query2)) {
                                        $sum2 = $sum2 + 1;
                                        if ($sum2 == $num_of_ques) {
                                            header("Location: teachers_profile.php");

                                        }
                                    } else {
                                        echo "Query couldn't execute";
                                    }


                                }



                            } } else {
                                echo "Question is already set";
                            }

                        } else {
                            echo "There was a problem in executing the query";
                        }


                    } else {
                        echo "The given exam doesn't exist";
                    }


                } else {
                    echo "There was a problem";
                }


            } else {
                echo "Please fill the requiredfields";
            }


        }
        ?>

        <!--Form for taking the questions as input-->
        <form action="" method="POST">
            <?php
            $sum = 0;
            for ($i = 1; $i <= $num_of_ques; $i++) {
                $name = 'ques_' . $i;
                $right = 'right_ans_' . $i;
                $option_1 = 'option_1_' . $i;
                $option_2 = 'option_2_' . $i;
                $option_3 = 'option_3_' . $i;


                ?>


                <textarea name="<?php echo $name; ?>" id="" cols="30" rows="10"
                          placeholder="Question Number <?php echo $i; ?>"></textarea>
                <h4>Right Answer of <?php echo $name; ?></h4>
                <input type="text" placeholder="Right Answer" name="<?php echo $right; ?>"><br><br>
                <h4>Options of <?php echo $name; ?></h4>
                <input type="text" name="<?php echo $option_1; ?>" placeholder="Option 1">
                <input type="text" name="<?php echo $option_2; ?>" placeholder="Option 2">
                <input type="text" name="<?php echo $option_3; ?>" placeholder="Option 3">
                <br><br><br>
                <?php

                $sum = $sum + 1;

            }

            $diff = 15 - $sum;
            for ($j = 1; $j <= $diff; $j++) {
                $name2 = 'ques_' . ($sum + $j);
                $right2 = 'right_ans_' . ($sum + $j);
                $option2_1 = 'option_1_' . ($sum + $j);
                $option2_2 = 'option_2_' . ($sum + $j);
                $option2_3 = 'option_3_' . ($sum + $j);


                ?>

                <input type="hidden" name="<?php echo $name2; ?>">
                <input type="hidden" placeholder="Right Answer" name="<?php echo $right2; ?>"><br><br>
                <input type="hidden" name="<?php echo $option2_1; ?>" placeholder="Option 1">
                <input type="hidden" name="<?php echo $option2_2; ?>" placeholder="Option 2">
                <input type="hidden" name="<?php echo $option2_3; ?>" placeholder="Option 3">

                <?php
            }

            ?>
            <input type="submit" value="Set Question" onclick="return (confirm_set_ques())">


        </form>

        <?php
    }


} else {
    header("Location: teacher_login.php");
}

?>


</body>
</html>