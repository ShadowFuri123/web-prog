<?php
session_start();

// Получаем данные с маленькими ключами (как в form.html)
$username = htmlspecialchars($_POST['username'] ?? '');
$date_birth = htmlspecialchars($_POST['date_birth'] ?? '');
$direction = htmlspecialchars($_POST['direction'] ?? '');
$type_help = htmlspecialchars($_POST['type_help'] ?? '');
$experience = isset($_POST['experience']) ? 'Есть' : 'Нет';

$_SESSION['username'] = $username;
$_SESSION['date_birth'] = $date_birth;
$_SESSION['direction'] = $direction;
$_SESSION['type_help'] = $type_help;
$_SESSION['experience'] = $experience;

$line = $username . "," . $date_birth . "," . $direction . "," . $type_help . "," . $experience . "\n";
file_put_contents("data.txt", $line, FILE_APPEND);

header("Location: index.php");
exit();
?>