<?php
session_start();

$username = htmlspecialchars($_POST['username']);
$date_birth = htmlspecialchars($_POST['Date_birth']);
$direction = htmlspecialchars($_POST['Direction']);
$type_help = htmlspecialchars($_POST['type_help'] ?? '');
$experience = htmlspecialchars($_POST['Опыт']) ?? 'Нет';

$_SESSION['username'] = $username;
$_SESSION['Date_birth'] = $date_birth;
$_SESSION['Direction'] = $direction;
$_SESSION['type_help'] = $type_help;
$_SESSION['experience'] = $experience;

header("Location: index.php");
exit();
