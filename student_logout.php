<?php

require 'core.inc.php';
session_start();
session_unset();
header('Location: students_profile.php');
?>