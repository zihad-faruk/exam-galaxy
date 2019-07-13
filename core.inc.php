<?php
ob_start();
session_start();

$current_file = $_SERVER['SCRIPT_NAME'];

/****Functions related to admin****/
/*Function for checking if admin is logged in or not*/
function admin_logged_in()
{
    if (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) {
        return true;
    } else {
        return false;
    }
}


function admin_get_field($field)
{
    include "connect.inc.php";
    $ad_id = $_SESSION['admin_id'];

    $query = "SELECT `$field` FROM `admins` WHERE `Admin_id`='$ad_id'";
    if ($query_run = mysqli_query($con, $query)) {
        if ($row = mysqli_fetch_row($query_run)) {
            return $row[0];
        } else {

        }
    } else {
        echo "There was a problem";
    }
}


/****Functions related to teachers****/
/*Function for checking if teacher is logged in or not*/
function teacher_logged_in()
{

    if (isset($_SESSION['SSN']) && !empty($_SESSION['SSN'])) {


        return true;
    } else {

        return false;
    }


}

/*Function for checking if the teacher was approved or not*/
function teacher_approved()
{

    include "connect.inc.php";


    $ssn = $_SESSION['SSN'];

    /*Checking if the user is in Approve phase or not*/
    $query = "SELECT * FROM `teachers_approve` WHERE `SSN`='$ssn'";

    $query_run = mysqli_query($con, $query);

    /*If the teacher is not in approval table*/
    if (mysqli_num_rows($query_run) == 0) {

        return true;


    } /*If the teacher was not approved*/
    else {

        return false;

    }


}

/*Function for getting the desired field output from the teachers table*/
function teacher_get_field($field)
{
    include "connect.inc.php";
    $ssn = $_SESSION['SSN'];

    $query = "SELECT `$field` FROM `teachers` WHERE `SSN`='$ssn'";
    if ($query_run = mysqli_query($con, $query)) {
        if ($row = mysqli_fetch_row($query_run)) {
            return $row[0];
        } else {

        }
    } else {
        echo "There was a problem";
    }
}


/****Functions related to students****/
/*Function for getting student field of the student who is logged in*/
function student_get_field($field)
{
    include "connect.inc.php";
    $student_id = $_SESSION['student_id'];

    $query = "SELECT `$field` FROM `students` WHERE `Student_id`='$student_id'";
    if ($query_run = mysqli_query($con, $query)) {
        if ($row = mysqli_fetch_row($query_run)) {
            return $row[0];
        } else {

        }
    } else {
        echo "There was a problem";
    }
}

/*Function for getting student field who are not logged in or accessing externally*/
function other_student_get_field($field, $stu_id)
{
    include "connect.inc.php";


    $query = "SELECT `$field` FROM `students` WHERE `Student_id`='$stu_id'";
    if ($query_run = mysqli_query($con, $query)) {
        if ($row = mysqli_fetch_row($query_run)) {
            return $row[0];
        } else {

        }
    } else {
        echo "There was a problem";
    }
}

/*Function for checking if the student has participated in the specific exam or not*/
function check_participation($exam_id)
{
    include "connect.inc.php";

    $student_id = student_get_field('Student_id');
    $query = "SELECT * FROM `written_answers` WHERE `Student_id`='$student_id'AND `exam_id`='$exam_id'";

    if ($query_run = mysqli_query($con, $query)) {

        if (mysqli_num_rows($query_run) > 0) {
            return true;
        } else {
            return false;
        }

    } else {
        echo "The query couldn't execute";
    }
}

/*Function for checking if a student is logged in or not*/
function student_logged_in()
{
    if (isset($_SESSION['student_id']) && !empty($_SESSION['student_id'])) {
        return true;
    } else {
        return false;
    }
}


/****Functions related to exams****/
/*Function for checking if the question is set or not */
function written_ques_set($id)
{
    include "connect.inc.php";

    $query = "SELECT `ques_1` FROM `written_questions` WHERE `exam_id`='$id'";

    if ($query_run = mysqli_query($con, $query)) {

        if (mysqli_num_rows($query_run) > 0) {
            return true;
        } else {
            return false;
        }

    } else {
        echo "The query couldn't execute";
    }


}



/*Function for checking if the question for MCQ exam is set or not */
function mcq_ques_set($id)
{
    include "connect.inc.php";

    $query = "SELECT `ques_1` FROM `mcq_questions` WHERE `exam_id`='$id'";

    if ($query_run = mysqli_query($con, $query)) {

        if (mysqli_num_rows($query_run) > 0) {
            return true;
        } else {
            return false;
        }

    } else {
        echo "The query couldn't execute";
    }

}


/*Functions for getting exams field */
function exam_get_field($field, $exam)
{
    include "connect.inc.php";

    $query = "SELECT `$field` FROM `exams` WHERE `exam_id`='$exam'";
    if ($query_run = mysqli_query($con, $query)) {
        if ($row = mysqli_fetch_row($query_run)) {
            return $row[0];
        } else {

        }
    } else {
        echo "There was a problem";
    }

}


/*Function for getting marks of the related question*/
function ques_get_marks($field, $exam_id)
{
    include "connect.inc.php";

    $query = "SELECT `$field` FROM `written_questions_full_marks` WHERE `exam_id`='$exam_id'";
    if ($query_run = mysqli_query($con, $query)) {
        if ($row = mysqli_fetch_row($query_run)) {
            return $row[0];
        } else {

        }
    } else {
        echo "There was a problem";
    }
}


/*Function for getting the marks of the answers of the student*/
function get_marks($field, $student_id, $exam_id)
{
    include "connect.inc.php";

    $query = "SELECT `$field` FROM `written_answers_marks` WHERE `Student_id`='$student_id' AND `exam_id`='$exam_id'";
    if ($query_run = mysqli_query($con, $query)) {
        if ($row = mysqli_fetch_row($query_run)) {
            return $row[0];
        } else {

        }
    } else {
        echo "There was a problem";
    }
}


/*Function for getting answer fields*/
function ans_get_field($field, $student_id, $exam_id)
{
    include 'connect.inc.php';
    $query = "SELECT `$field` FROM `written_answers` WHERE `Student_id`='$student_id' AND `exam_id`='$exam_id'";
    if ($query_run = mysqli_query($con, $query)) {
        if ($row = mysqli_fetch_row($query_run)) {
            return $row[0];
        } else {

        }
    } else {
        echo "Nice try dude,But you won't get any result";
    }

}


/*Function for checking if the script of a specific student is checked or not*/
function if_checked_script($student_id, $exam_id)
{
    include "connect.inc.php";


    $query = "SELECT * FROM `written_answers_marks` WHERE `Student_id`='$student_id'AND `exam_id`='$exam_id'";

    if ($query_run = mysqli_query($con, $query)) {

        if (mysqli_num_rows($query_run) > 0) {
            return true;
        } else {
            return false;
        }

    } else {
        echo "The query couldn't execute";
    }
}

/*Function for getting the right answer*/
function get_mcq_answer($exam_id,$ques_no,$field){
    include 'connect.inc.php';
    $query = "SELECT `$field` FROM `mcq_questions_options` WHERE `exam_id`='$exam_id' AND `ques_no`='$ques_no'";
    if ($query_run = mysqli_query($con, $query)) {
        if ($row = mysqli_fetch_row($query_run)) {
            return $row[0];
        } else {

        }
    } else {
        echo "Nice try dude,But you won't get any result";
    }
}

/*Function for getting marks of mcq exam*/
function get_mcq_marks($student_id,$exam_id){
    include 'connect.inc.php';
    $query = "SELECT `marks` FROM `mcq_marks` WHERE  `student_id`='$student_id' AND`exam_id`='$exam_id'";
    if ($query_run = mysqli_query($con, $query)) {
        if ($row = mysqli_fetch_row($query_run)) {
            return $row[0];
        } else {

        }
    } else {
        echo "Nice try dude,But you won't get any result";
    }
}

/*Function for checking if the student had participated in the mcq exam or not*/
function participation_in_mcq_exam($exam_id){
    include "connect.inc.php";

    $student_id = student_get_field('Student_id');
    $query = "SELECT * FROM `mcq_marks` WHERE `Student_id`='$student_id'AND `exam_id`='$exam_id'";

    if ($query_run = mysqli_query($con, $query)) {

        if (mysqli_num_rows($query_run) > 0) {
            return true;
        } else {
            return false;
        }

    } else {
        echo "The query couldn't execute";
    }

}


/***Utilities Function***/
/*Creation of random variable for showing options in random order*/
function rand_option($min,$max,$amount){

    $num = range($min,$max);
    shuffle($num);
    return array_slice($num,0,$amount);

}

?>




