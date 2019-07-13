<?php

include 'inc/inc.header.php';

if (teacher_logged_in() && teacher_approved()) {


    ?>

    <style>
        .op a{
            text-decoration: none;
        }
        .op{
            background-color:#E7FFE9;
            height: 200px;
        }
        .op:hover{
            background-color: #E5F2B1;
        }
    </style>

    <div style="height: 100vh">
        <i class="fa fa-5x fa-book" style="margin-top:250px"></i>
        <h1 style="font-size: 60px;"><span style="color: #66BC6D">SET</span> Exam Page</h1>
        <p style="font-family: Calibri" class="animated bounceInDown">Choose the type you want</p>
    </div>

    <div class="exam_options row">
        <div class="col-lg-1"></div>


        <div class="col-lg-4 op">
            <h1><a href="written_exam.php">Written</a></h1>
        </div>

        <div class="col-lg-2"></div>
        <div class="col-lg-4 op">
            <h1><a href="mcq_exam.php">MCQ</a></h1>
        </div>
        <div class="col-lg-1"></div>

        <a href="teachers_profile.php">
            <button>Go Back to Profile</button>
        </a>
    </div>



    <?php
} else {
    header("Location: teacher_login.php");
}

include "inc/inc.footer.php";
?>

