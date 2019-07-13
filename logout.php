<?php

require 'core.inc.php';
session_start();
session_unset();
header('Location: admin.php');
?>