<?php
session_start();
$username = trim($_POST['username'] ?? '');
$date_birth = $_POST['date_birth'] ?? '';
$direction = $_POST['direction'] ?? '';
$type_help = $_POST['type_help'] ?? '';
$experience = isset($_POST['experience']) ? 'Есть' : 'Нет';

$errors = [];
if (empty($username)) $errors[] = "Имя не должно быть пустым.";
if (empty($direction)) $errors[] = "Направление не выбрано.";
if (empty($type_help)) $errors[] = "Вид помощи не выбран.";

if (!empty($errors)) {
    $_SESSION['error_message'] = implode(" ", $errors);
    header("Location: index.php");
    exit();
}

unset($_SESSION['error_message']);
$_SESSION['success_message'] = "Данные успешно сохранены!";

$username = htmlspecialchars($username);
$date_birth = htmlspecialchars($date_birth);
$direction = htmlspecialchars($direction);
$type_help = htmlspecialchars($type_help);
$experience = htmlspecialchars($experience);

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