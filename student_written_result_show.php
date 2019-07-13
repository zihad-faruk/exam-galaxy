<?php include 'inc/inc.header.php'?>

<?php if (student_logged_in()) {
    $student_id = $_GET['student_id'];
    if ($_SESSION['student_id'] == $student_id) {
        ?>




        <div style="height: 100vh   ;">
            <div class="row" style="margin-top:30px">
                <div class="col-lg-1"></div>
                <div class="col-lg-2"><a href="students_profile.php">
                        <button class="btn btn-large btn-success"><i class="fa fa-arrow-left"></i> Back to profile</button>
                    </a></div>
                <div class="col-lg-6"></div>
                <div class="col-lg-2">  <a href="student_logout.php">
                        <button class="btn btn-large btn-danger"><i class="fa fa-power-off"></i> Log Out</button>
                    </a></div>
                <div class="col-lg-1"></div>
            </div>


            <div><i class="fa fa-5x fa-graduation-cap" style="margin-top:250px"></i>
                <h2 style="font-size:50px;font-weight:600;margin-top:20px"><span style="color:#66BC6D;animation-delay: 500ms" class="animated lightSpeedIn">Result</span> Board</h2></div>

        </div>
      <div class="row" style="margin-bottom:30px">
          <div class="col-lg-1"></div>
          <div class="col-lg-10">

              <table>
                  <tr>
                      <th>Exam Id</th>
                      <th>Exam Type</th>
                      <th>Subject</th>
                      <th>Teacher</th>
                      <th>Full Marks</th>
                  </tr>

                  <!--If exam field is written-->
                  <?php

                  $query = "SELECT * FROM `written_answers_marks` WHERE `Student_id`='$student_id'";
                  if ($query_run = mysqli_query($con, $query)) {
                      while ($row = mysqli_fetch_assoc($query_run)) {
                          $exam_id = $row['exam_id'];
                          ?>
                          <tr>
                              <td><?php echo $exam_id; ?></td>
                              <td><?php echo exam_get_field('exam_type',$exam_id)?></td>
                              <td><?php echo exam_get_field('Subject', $exam_id); ?></td>
                              <td><?php echo exam_get_field('set_by', $exam_id); ?></td>
                              <?php
                              if(exam_get_field('exam_type',$exam_id)){
                                  ?>
                                  <td><?php echo get_marks('total', $student_id, $exam_id); ?></td>

                                  <?php
                              }else{
                                  ?>
                                  <td><?php echo get_mcq_marks($student_id,$exam_id);?></td>
                                  <?php
                              }

                              ?>



                          </tr>


                          <?php
                      }

                  }

                  /*If exam type is mcq*/

                  $query2 = "SELECT * FROM `mcq_marks` WHERE `Student_id`='$student_id'";
                  if ($query_run2 = mysqli_query($con, $query2)) {
                      while ($row2 = mysqli_fetch_assoc($query_run2)) {
                          $exam_id = $row2['exam_id'];
                          ?>
                          <tr>
                              <td><?php echo $exam_id; ?></td>
                              <td><?php echo exam_get_field('exam_type',$exam_id)?></td>
                              <td><?php echo exam_get_field('Subject', $exam_id); ?></td>
                              <td><?php echo exam_get_field('set_by', $exam_id); ?></td>
                              <td><?php echo get_mcq_marks($student_id,$exam_id);?></td>

                          </tr>


                          <?php
                      }

                  }




                  ?>




                  <?php

                  ?>

              </table>




          </div>
          <div class="col-lg-1"></div>
      </div>


        <?php

    }else{
        ?>
        <h2>Nice try dude,Peeping into other student's result is bad.</h2>
        <a href="students_profile.php"><button>Go to my profile</button></a>
        <a href="student_logout.php"><button>Log Out</button></a>
        <?php
    }

}else {
    ?>

    <h3>You have to log in dude</h3>
    <a href="http://localhost/Online%20Examination%20System/teacher_login.php">
        <button>Log In</button>
    </a>

    <?php
}

include 'inc/inc.footer.php'
?>