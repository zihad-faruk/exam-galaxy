<?php
include 'D:\wamp\www\Online Examination System\core.inc.php';
include 'D:\wamp\www\Online Examination System\connect.inc.php';
?>


    <!DOCTYPE html>
    <html>
    <head>
        <title>Answer Script</title>
        <link rel="stylesheet" href="http://localhost/Online%20Examination%20System/css/style.css">
        <script>
            function confirm_sub() {
                if (confirm("Do you wan to proceed?") {
                    return true;
                } else {
                    return false;
                }
            }
        </script>

        <script>
            function form_sub() {
                var ans_1= document.getElementById('ans_1').val();
                var ans_2= document.getElementById('ans_2').val();
                var ans_3= document.getElementById('ans_3').val();
                var ans_4= document.getElementById('ans_4').val();
                var ans_5= document.getElementById('ans_5').val();
                if(ans1=='' || ans2==''  || ans3=='' || ans4=='' || ans5==''){
                    alert("All fields must be filled");
                }else{
                   $(document).ready(function () {
                       $('form').submit();
                   });
                }
            }
        </script>
    </head>
<body style="text-align: center">
<?php if (teacher_logged_in()) {
    $exam_id = $_GET['exam_id'];
    $student_id = $_GET['student_id'];
    ?>

    <h2>Answer script of <span
                style="color: blue;font-weight: 900"><?php echo other_student_get_field('name', $student_id) ?></span>
    </h2>
    <h3>Subject: <?php echo exam_get_field('Subject', $exam_id) ?></h3>
    <h3>Class: <?php echo exam_get_field('Class', $exam_id) ?></h3>

    <!--Variables needed for query-->

    <?php

    $num_of_ques= exam_get_field('num_of_ques',$exam_id);



    ?>


    <!--Div for showing the answer scripts-->
    <div class="ans_scripts">

        <!--Form for giving the numbers to answer scripts-->
        <form action="" method="POST">
        <?php

        for($i=1;$i<=$num_of_ques;$i++){
            $ques_name = 'Ques no '.$i;
            $ans_name = 'ans_'.$i;
            ?>
            <h3 style="color: red">Answer of <?php echo $ques_name;?></h3>
            <p style="font-size:20px;padding:10px;border:1px solid black"><?php echo ans_get_field($ans_name,$student_id,$exam_id)?></p>
            <input type="number" name="<?php echo $ans_name?>" placeholder="Mark of <?php echo $ans_name;?>" min="1" id="<?php echo $ans_name;?>">
            <br><br>
            <?php
        }

        $difference= 15-$num_of_ques;

        for($j=1;$j<=$difference;$j++){
            $ans_name2= 'ans_'.($j+$num_of_ques);
            ?>
            <input type="hidden" name="<?php echo $ans_name2;?>" value="0">

       <?php }


        ?>

            <input type="submit" value="Submit Marks" onclick="form_sub();">
            <br><br>
        </form>

        <!--Query and validation for the form-->
        <?php
        if(isset($_POST['ans_1']) &&
            isset($_POST['ans_2']) &&
            isset($_POST['ans_3']) &&
            isset($_POST['ans_4']) &&
            isset($_POST['ans_5']) &&
            isset($_POST['ans_6']) &&
            isset($_POST['ans_7']) &&
            isset($_POST['ans_8']) &&
            isset($_POST['ans_9']) &&
            isset($_POST['ans_10']) &&
            isset($_POST['ans_11']) &&
            isset($_POST['ans_12']) &&
            isset($_POST['ans_13']) &&
            isset($_POST['ans_14']) &&
            isset($_POST['ans_15'])
        ){
            $ans_1= $_POST['ans_1'];
            $ans_2= $_POST['ans_2'];
            $ans_3= $_POST['ans_3'];
            $ans_4= $_POST['ans_4'];
            $ans_5= $_POST['ans_5'];
            $ans_6= $_POST['ans_6'];
            $ans_7= $_POST['ans_7'];
            $ans_8= $_POST['ans_8'];
            $ans_9= $_POST['ans_9'];
            $ans_10= $_POST['ans_10'];
            $ans_11= $_POST['ans_11'];
            $ans_12= $_POST['ans_12'];
            $ans_13= $_POST['ans_13'];
            $ans_14= $_POST['ans_14'];
            $ans_15= $_POST['ans_15'];

            $total=$ans_1+$ans_2+$ans_3+$ans_4+$ans_5+$ans_6+$ans_7+$ans_8+$ans_9+$ans_10+$ans_11+$ans_12+$ans_13+$ans_14+$ans_15;


            $query= "INSERT INTO `written_answers_marks` VALUES('$student_id',
  '$exam_id','$ans_1','$ans_2','$ans_3','$ans_4','$ans_5','$ans_6','$ans_7','$ans_8','$ans_9','$ans_10','$ans_11',
  '$ans_12','$ans_13','$ans_14','$ans_15','$total')";

            if($query_run= mysqli_query($con,$query)){
                header("Location: http://localhost/Online%20Examination%20System/inc/student_participated_in_the_exam_inc.php?exam_id=$exam_id");
            }else{
                header("Location: http://localhost/Online%20Examination%20System/error_msg/marks_submit_error_msg.php");
            }



            }




        ?>

    </div>
    <a href="http://localhost/Online%20Examination%20System/inc/student_participated_in_the_exam_inc.php?exam_id=<?php echo $exam_id;?>">
        <button>Back</button>
    </a>

    <a href="http://localhost/Online%20Examination%20System/teachers_profile.php">
        <button>Go back to profile</button>
    </a>
    <a href="http://localhost/Online%20Examination%20System/teacher_logout.php">
        <button>Log Out</button>
    </a>

    <?php
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