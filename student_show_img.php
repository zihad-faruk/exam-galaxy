<?php

require "connect.inc.php";
require_once "core.inc.php";

$q = "SELECT `profile_pic` FROM `students` WHERE `Student_id`='".student_get_field('Student_id')."'";
$r= mysqli_query($con,$q);

while($row = mysqli_fetch_assoc($r)){
    echo "<img src='uploads/".$row["profile_pic"]."'>" ;
}



?>


