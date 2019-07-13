<?php
include 'connect.inc.php';
include 'core.inc.php';

if (isset($_POST['ans_1']) ) {


    $ans_1= $_POST['ans_1'];
    $ans_2=$_POST['ans_2'];
    $ans_3=$_POST['ans_3'];
    $ans_4=$_POST['ans_4'];
    $ans_5=$_POST['ans_5'];
    $ans_6=$_POST['ans_6'];
    $ans_7=$_POST['ans_7'];
    $ans_8=$_POST['ans_8'];
    $ans_9=$_POST['ans_9'];
    $ans_10=$_POST['ans_10'];
    $ans_11=$_POST['ans_11'];
    $ans_12=$_POST['ans_12'];
    $ans_13=$_POST['ans_13'];
    $ans_14=$_POST['ans_14'];
    $ans_15=$_POST['ans_15'];



    /*The query for sending the answers to the database*/
    $query3="INSERT INTO `written_answers` VALUES ('32211','311','$ans_1','$ans_2','$ans_3','$ans_4','$ans_5','$ans_6','$ans_7','$ans_8','$ans_9','$ans_10','$ans_11','$ans_12','$ans_13','$ans_14','$ans_15')";

    if($query_run3= mysqli_query($con,$query3)){
        header("Location: answer_submit_confirmation_page.php");
    }else{
        echo "There was a problem or you already participated in the exam";
    }
}


?>