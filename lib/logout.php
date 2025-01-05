<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 1/6/2025
 */


session_start();
session_destroy();
header("Location: ../login.php");
exit();