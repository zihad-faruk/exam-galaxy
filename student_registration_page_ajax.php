<?php
include "connect.php";


if(    isset($_POST['f_name'])
    && isset($_POST['l_name'])
    && isset($_POST['user_name'])
    && isset($_POST['email'])
    && isset($_POST['pass'])
    && isset($_POST['pass_again'])

) {

    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $pass_again = $_POST['pass_again'];
    $pass_hash = md5($pass);


    if (!empty($f_name) &&
        !empty($l_name) &&
        !empty($user_name) &&
        !empty($email) &&
        !empty($pass) &&
        !empty($pass_again)
    ) {


        /*Check if checkbox is ticked*/

        if (isset($_POST['terms'])=='checked'&& !empty($_POST['terms'])) {


            /*Check if password matches */

            if ($pass == $pass_again) {


                /*Validating the lengths of Names*/

                if (strlen($f_name) > 32 || strlen($l_name > 32) || strlen($user_name) > 32 || strlen($user_name) < 6) {

                    echo "Please see the maximum and minimum of names";

                } else {

                    /*Validating Password Lengths*/

                    if (strlen($pass) < 6) {

                        echo "Passwords must be atleast 6 characters.";
                    } else {

                        $query = "INSERT INTO `users` VALUES ('','$f_na','$l_name','$user_name','$email','$pass_hash')";

                        if ($qurey_run = mysqli_query($connect, $query)) {
                           echo 'Data inserted';
                        } else {
                            echo 'Something went wrong';
                        }

                    }
                }


            }else{
                echo "Passwords doesn't match";
            }


        } else {
            echo "Please agree to the terms & conditions";
        }

    } else {
        echo "Fill all the fields";

    }

}




?>

