<?php
session_start();
$_SESSION['score'] = 0;
$_SESSION['answered'] = [];
header("Location: index.php");
exit();
