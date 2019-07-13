<?php



include 'inc/inc.header.php';

student_get_field("Student_id");
@$name = $_FILES["file"]["name"];
@$type = $_FILES["file"]["type"];
@$tmp_name = $_FILES["file"]["tmp_name"];
@$size = $_FILES["file"]["size"];
$n="img";

$max_size = 10000000;
$extension = strtolower(substr($name,stripos($name,'.')+1));
if(isset($_POST['up'])){
    if(!empty($name)){
        if($size<$max_size && $extension=='jpg' || $extension=='jpeg' || $extension=='png' &&  ($type=='image/jpeg'||$type=='image/png')){
            $target = "uploads/".student_get_field("surname")."_".basename($name);
            $con = mysqli_connect("localhost","root","","examination");



            $s = "UPDATE `students` SET `profile_pic` = '".student_get_field("surname")."_$name' WHERE `Student_id` = '".student_get_field('Student_id')."'  ";
            if($q=mysqli_query($con,$s)){

            if(move_uploaded_file($tmp_name,$target)){
                header('Location: students_profile.php');
            }else{
                echo 'Problem';
            }
        }else{
            echo "Couldn't execute query";
        }
        }else{
            echo "Please select a valid file type/ File must be less then 100kb";
        }
    }
    else{
        echo "Please select a file for uploading";
    }
}


?>


<!--If student is logged in-->
<?php
if (student_logged_in()) {
?>
<div class="row">
    <div class="col-lg-12"><div>
            <a href="students_profile.php"><button class="btn btn-large btn-primary" style="float: left;margin-left: 100px;margin-top:20px"><i class="fa fa-arrow-left"></i> Profile</button></a>
            <a href="student_logout.php"><button class="btn btn-large btn-danger" style="float: right;margin-right: 100px;margin-top:20px"><i class="fa fa-power-off"></i>  Log Out</button></a>
        </div></div>
</div>
   <div class="change_profile_pic">

      <div class="row">
          <div class="col-lg-12">
              <h1 style="margin-top:150px"><span class="animated bounceIn" style="font-size:80px;color: #66BC6D;">U</span>pdate <span class="animated bounceIn" style="font-size:80px;color: #66BC6D;">P</span>rofile
                  <span class="animated bounceIn" style="font-size:80px;color: #66BC6D;">P</span>icture</h1>
          </div>
      </div>
       

       <form action="<?php $current_file; ?>" method="POST" enctype="multipart/form-data" style="margin-bottom:150px">
           <div class="form-group">
               <input type="file" name="file" style="margin: 0 auto;margin-top:15px" ><br><br>

               <input type="submit" value="Upload" name="up" class="btn btn-large btn-success">
           </div>
       </form>


   </div>

    <!--*********-->


    <?php


} /*If student is not logged in then redirect to the login page*/
else {
    header("Location: student_login.php");

}


?>

<!--Including the footer files-->
<?php include 'inc/inc.footer.php'?>
