<?php include 'inc/inc.header.php';?>
    <script type="text/javascript">
        function confirm_delete() {
            if (window.confirm('Do your really want to remove?')) {

                return true;
            }
            else
                return false;
        }

        function confirm_approve() {
            if (window.confirm('Do your really want to approve?')) {
                return true;
            }
            else
                return false;
        }
        ;
    </script>
    <script>
        $(document).ready(function () {
            $("#student_table_show").click(function () {
                $(".teachers_option").hide(500);
                $("#students_option").show(500);

            });


            $("#teacher_table_show").click(function () {
                $(".teachers_option").show(500);
                $("#students_option").hide(500);

            });
        });
    </script>

<!--If admin is logged in-->
<?php
if (admin_logged_in()) {
    ?>

    <div style="text-align: center">

        <!--Admin Intro-->
        <div class="admin_profile_intro" style="margin-top: 0px">

            <div >


                <div class="row " style="height: 2vh;margin-top: 0px">
                    <div class="col-lg-6"></div>
                    <div class="col-lg-5" style="text-align: right"><h4 style="font-family: Calibri;font-weight: 600;"><img src="images/pro.png" alt="" style="width: 50px;height: 50px;">
                            <?php echo $admin_name = admin_get_field("Admin_name");?>
                            <span style="color: #6cb670;font-size:30px">|</span> <span>ADMIN</span>
                    </div>

                    <div class="col-lg-1"></div>
                </div>



                <!--Teacher profile intro-->
                <div class="teacher_profile_intro animated fadeIn" style=" height: 96vh;margin-top:200px">

                    <h1 style="font-size: 60px;"><span style="color: #66BC6D">Admin </span>Profile Page</h1>
                    <p style="font-family: Calibri" class="animated bounceInUp">Choose,whom you want to monitor</p>
                    <br><br>
                </div>


                <div class="row">
                    <a href="#studentsss"><div class="admin_choosing_options col-lg-6" id="student_table_show">Student</div></a>
                    <a href="#teachersss"><div class="admin_choosing_options col-lg-6" id="teacher_table_show">Teacher</div></a>
                </div>
            </div>


        </div>


        <!--Admin Features-->
        <div class="admin_features">



            <!--Managing Teachers-->
            <div class="teachers_option">

                <div id="teachersss"><h2>Teachers</h2></div>
                <!--List of active teachers-->
                <div class="list">
                    <h3>The List of the teachers</h3>

                    <?php

                    $query = "SELECT * FROM  `teachers`";


                    /*If the above query runs*/
                    if ($query_run = mysqli_query($con, $query)) {

                        ?>

                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>SSN</th>
                                <th>Action</th>

                            </tr>

                            <?php

                            /*Showing the data from the table*/
                            while ($query_row = mysqli_fetch_assoc($query_run)) {

                                $name = $query_row['Name'];
                                $dep = $query_row['Department'];
                                $ssn = $query_row['SSN'];


                                ?>


                                <tr>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $dep; ?></td>
                                    <td><?php echo $ssn; ?></td>
                                    <td>
                                        <a href="delete_teachers_inc.php?ssn_del=<?php echo $ssn; ?>"
                                           onclick="return(confirm_delete());">
                                            <button>Remove</button>
                                        </a>
                                    </td>
                                </tr>


                                <?php
                            }

                            ?>

                        </table>


                        <?php


                    } else {
                        echo "Query could'nt execute!";
                    }
                    ?>
                </div>

                <!--List of teachers waiting for approval-->
                <div class="approve">

                    <h3>The List of the teachers Waiting to be Approved</h3>

                    <?php

                    $query = "SELECT * FROM  `teachers_approve`";

                    if ($query_run = mysqli_query($con, $query)) {

                        ?>

                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>SSN</th>
                                <th>Action</th>

                            </tr>

                            <?php
                            while ($query_row = mysqli_fetch_assoc($query_run)) {

                                $name = $query_row['Name'];
                                $dep = $query_row['Department'];
                                $ssn = $query_row['SSN'];


                                ?>


                                <tr>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $dep; ?></td>
                                    <td><?php echo $ssn; ?></td>
                                    <td>
                                        <a href="approve_teachers_inc.php?ssn_app=<?php echo $ssn; ?>"
                                           onclick="return (confirm_approve());">
                                            <button>Approve</button>
                                        </a>
                                    </td>
                                </tr>


                                <?php
                            }

                            ?>

                        </table>


                        <?php


                    } else {
                        echo "Query couldn't execute";
                    }
                    ?>

                </div>

            </div>


            <!--Managing Students-->


            <div class="students_option" id="students_option">

                <div id="studentsss"><h2>Students</h2></div>

               <div class="container t">
                   <div class="row">
                       <div class="col-lg-12 ">

                               <a href="result_list.php"><button>See Results</button></a>


                       </div>

                   </div>
               </div>


                <!--List of active students-->

                <div class="list">
                    <h3>The List of the students</h3>

                    <?php

                    $query = "SELECT * FROM  `students`";

                    if ($query_run = mysqli_query($con, $query)) {

                        ?>

                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Student_Id</th>
                                <th>Action</th>
                            </tr>

                            <?php
                            while ($query_row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                <tr>
                                    <td><?php echo $name = $query_row['Name']; ?></td>
                                    <td><?php echo $dep = $query_row['Class'] ?></td>
                                    <td><?php echo $ssn = $query_row['Student_id'] ?></td>
                                    <td>
                                        <a href="delete_students_inc.php?student_id_del=<?php echo $ssn; ?>"
                                           onclick="return (confirm_delete());">
                                            <button>Remove</button>
                                        </a>
                                    </td>
                                </tr>


                                <?php
                            }

                            ?>

                        </table>


                        <?php


                    } else {
                        echo " Problem Man";
                    }
                    ?>
                </div>

                <!--List of students waiting for approval-->
                <div class="approve">

                    <h3>The List of the students Waiting to be Approved</h3>

                    <?php

                    $query = "SELECT * FROM  `students_approve`";

                    if ($query_run = mysqli_query($con, $query)) {

                        ?>

                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Student Id</th>
                                <th>Action</th>

                            </tr>

                            <?php
                            while ($query_row = mysqli_fetch_assoc($query_run)) {

                                $name = $query_row['Name'];
                                $class = $query_row['Class'];
                                $student_id = $query_row['Student_id'];


                                ?>


                                <tr>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $class; ?></td>
                                    <td><?php echo $student_id; ?></td>
                                    <td>
                                        <a href="approve_students_inc.php?student_id_app=<?php echo $student_id; ?>"
                                           onclick="return (confirm_approve());">
                                            <button>Approve</button>
                                        </a>
                                    </td>
                                </tr>


                                <?php
                            }

                            ?>

                        </table>


                        <?php


                    } else {
                        echo " Problem Man";
                    }
                    ?>

                </div>

            </div>

        </div>


        <a href="logout.php"><button class="btn btn-large btn-danger" style="margin-bottom:50px"><i class="fa fa-power-off"></i> Log Out</button></a>



    </div>



    <?php
} /*If admin is not logged in then redirect to the login page*/
else {
    header("Location: admin_login.php");
}


?>

<script src="js/bootstrap.min.js"></script>
<?php include 'inc/inc.footer.php';?>
