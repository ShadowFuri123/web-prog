<?php
require 'db.php';
require 'Student.php';

$student = new Student($pdo);

$username = htmlspecialchars($_POST['username']);
$date_birth = htmlspecialchars($_POST['date_birth']);
$direction = htmlspecialchars($_POST['direction'] ?? '');
$experience = isset($_POST['experience']) ? 1 : 0;
$type_help = htmlspecialchars($_POST['type_help'] ?? '');;

$student->add($username, $date_birth, $direction, $experience, $type_help);

header("Location: index.php");
exit();
;