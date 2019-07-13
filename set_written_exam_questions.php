<?php
include "connect.inc.php";
include "core.inc.php";

/*If teacher is logged in,grant him access to this page directly*/
if (teacher_logged_in() && teacher_approved()){
?>
<!DOCTYPE html>
<html>
<head>
    <title>Written Exam Questions</title>
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
<h2>Set Questions For Written Exam</h2>
<p>You can not set more then 15 questions </p>

<?php

if (isset($_GET['exam_id'])) {
    $exam_id = $_GET['exam_id'];
    $num_of_ques = exam_get_field('num_of_ques', $exam_id);

if (isset($_POST['ques_1']) && isset($_POST['marks_1']) && isset($_POST['marks_15'])) {

    /*Mendatory variables*/

    $ques_1 = $_POST['ques_1'];
    $marks_1 = $_POST['marks_1'];

    /*Optional Variables*/
    $ques_2 = $_POST['ques_2'];
    $marks_2 = $_POST['marks_2'];
    $ques_3 = $_POST['ques_3'];
    $marks_3 = $_POST['marks_3'];
    $ques_4 = $_POST['ques_4'];
    $marks_4 = $_POST['marks_4'];
    $ques_5 = $_POST['ques_5'];
    $marks_5 = $_POST['marks_5'];
    $ques_6 = $_POST['ques_6'];
    $marks_6 = $_POST['marks_6'];
    $ques_7 = $_POST['ques_7'];
    $marks_7 = $_POST['marks_7'];
    $ques_8 = $_POST['ques_8'];
    $marks_8 = $_POST['marks_8'];
    $ques_9 = $_POST['ques_9'];
    $marks_9 = $_POST['marks_9'];
    $ques_10 = $_POST['ques_10'];
    $marks_10 = $_POST['marks_10'];
    $ques_11 = $_POST['ques_11'];
    $marks_11 = $_POST['marks_11'];
    $ques_12 = $_POST['ques_12'];
    $marks_12 = $_POST['marks_12'];
    $ques_13 = $_POST['ques_13'];
    $marks_13 = $_POST['marks_13'];
    $ques_14 = $_POST['ques_14'];
    $marks_14 = $_POST['marks_14'];
    $ques_15 = $_POST['ques_15'];
    $marks_15 = $_POST['marks_15'];


if (!empty($exam_id) && !empty($num_of_ques) && !empty($ques_1) && !empty($marks_1)) {


    /*Query for checking if the given Exam if exists */
    $query_check1 = "SELECT `exam_id` FROM `exams` WHERE `exam_id`='$exam_id'";


if ($query_check1_run = mysqli_query($con, $query_check1)) {

if (mysqli_num_rows($query_check1_run) > 0) {


    /*Query for checking if the question is already set or not*/
    $query_check2 = "SELECT `ques_1` FROM `written_questions` WHERE `exam_id`='$exam_id'";

if ($query_check2_run = mysqli_query($con, $query_check2)) {

if (mysqli_num_rows($query_check2_run) == 0) {


    /*Query for inserting questions data into written_questions table*/
    $query = "INSERT INTO `written_questions` VALUES ('$exam_id','$num_of_ques','$ques_1','$ques_2','$ques_3','$ques_4','$ques_5','$ques_6','$ques_7','$ques_8','$ques_9','$ques_10','$ques_11','$ques_12','$ques_13','$ques_14','$ques_15')";

if ($query_run = mysqli_query($con, $query)) {

    /*Query for inerting the marks of the questions in the written_questions_full_marks table*/
    $query2 = "INSERT INTO `written_questions_full_marks` VALUES('$exam_id','$marks_1','$marks_2','$marks_3','$marks_4','$marks_5','$marks_6','$marks_7','$marks_8','$marks_9','$marks_10','$marks_11','$marks_12','$marks_13','$marks_14','$marks_15')";
if ($query_run2 = mysqli_query($con, $query2)) {
    ?>
    <script>
        alert("Question has been set");
    </script>

<?php
header("Location: teachers_profile.php");
}
} else {
    echo "Query couldn't execute";
}

} else {
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
            $name_marks = 'marks_' . $i;

            ?>


            <textarea name="<?php echo $name; ?>" id="" cols="30" rows="10"
                      placeholder="Question Number <?php echo $i; ?>"></textarea>
            <input type="number" placeholder="Marks" name="<?php echo $name_marks; ?>" min="10"><br><br>

            <?php

            $sum = $sum + 1;

        }

        $diff = 15 - $sum;
        for ($j = 1; $j <= $diff; $j++) {
            $name2 = 'ques_' . ($sum + $j);
            $name_marks2 = 'marks_' . ($sum + $j);
            ?>

            <input type="hidden" name="<?php echo $name2; ?>">
            <input type="hidden" name="<?php echo $name_marks2; ?>">

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