<!--Including header files-->
<?php include 'inc/inc.header.php';

if (isset($_GET['std_id'])) {
    $student_id_del = $_GET['std_id'];


    $test_query = "SELECT `name` FROM `students` WHERE `Student_Id`='$student_id_del'";
    $del_query = "DELETE FROM  `students` WHERE `Student_Id`='$student_id_del'";

    if (mysqli_num_rows(mysqli_query($con, $test_query)) > 0) {
        if ($del_query_run = mysqli_query($con, $del_query)) {
            header("Location: admin.php");
        }

    } else {
        echo "There is no such student in the database";
    }


} else {
    echo "You must specify the student id for security purposes";
}


?>


<form action="test_delete_student.php">
    <input type="hidden" name="std_id">
</form>
    <!--Including the footer files-->
<?php include 'inc/inc.footer.php'?>