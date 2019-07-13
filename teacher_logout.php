<?php

require 'core.inc.php';
session_start();
session_unset();
header('Location: teacher_login.php');
?>