<?php include 'inc/inc.header.php';
?>

<div class="row" style="margin-top:50px;margin-bottom:50px;height:6vh">
    <div class="col-lg-2"></div>
    <div class="col-lg-3">
        <a href="teachers_profile.php"><button class="btn btn-large btn-success"><i class="fa fa-arrow-left"> Back to Profile</i></button></a></div>
    <div class="col-lg-2"></div>
    <div class="col-lg-3"><a href="teacher_logout.php"><button class="btn btn-large btn-danger"><i class="fa fa-power-off"> Log Out</i></button></a></div>
    <div class="col-lg-2"></div>
</div>

    <div style="height: 94vh">
        <i class="fa fa-5x fa-pencil" style="margin-top:100px"></i>
        <h1 style="font-size: 60px;"><span style="color: #66BC6D">SET</span> Written Exam Page</h1>
        <p style="font-family: Calibri" class="animated bounceInDown">Fill up the details please.</p>
    </div>
<?php
$teacher_name = teacher_get_field("Name");

if (isset($_POST['subject']) && isset($_POST['class']) && isset($_POST['duration']) && isset($_POST['full_marks']) && isset($_POST['num_of_ques'])) {
    $subject = $_POST['subject'];
    $class = $_POST['class'];
    $duration = $_POST['duration'];
    $full_marks = $_POST['full_marks'];
    $num_of_ques= $_POST['num_of_ques'];

    if (!empty($subject) && !empty($class) && !empty($duration) && !empty($full_marks)) {

        /*Query for inserting into exam table*/
        $query = "INSERT INTO `exams`(exam_type,set_by,subject,class,time,full_marks,num_of_ques) VALUES ('Written','$teacher_name','$subject','$class','$duration','$full_marks','$num_of_ques')";

        if ($query_run = mysqli_query($con, $query)) {
            header("Location: teachers_profile.php");
        } else {
            echo "Data was not inserted";
        }
    } else {
        echo "Please fill all the fields";
    }
}


?>


    <form action="written_exam.php" method="POST">
        <input type="text" placeholder="Subject" name="subject"><br><br>
        <input type="number" placeholder="Class" name="class" min="1"><br><br>
        <input type="number" placeholder="Exam Duration in Hours" name="duration" min="1"><br><br>
        <input type="text" placeholder="Full Marks" name="full_marks"><br><br>
        <input type="number" placeholder="Number of Questions" name="num_of_ques" min="1" max="15"><br><br>
        <input type="submit" value="Submit For validation" class="btn btn-large btn-primary">
    </form>
</div>

<!--Including the footer files-->
<?php include 'inc/inc.footer.php'?>