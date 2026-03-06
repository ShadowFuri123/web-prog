<?php
require 'db.php';
require 'Student.php';

$student = new Student($pdo);
$all = $student->getAll();
?>
<h2>Сохранённые данные:</h2>
<ul>
<?php foreach($all as $row): ?>
    <li>Имя: <?= $row['username'] ?>, Возраст: <?= $row['age'] ?>, Направление: <?= $row['direction'] ?>, Вид помощи: <?= $row['type_help'] ?>, Наличие опыта: <?= $row['experience'] ? 'Да' : 'Нет' ?></li>
<?php endforeach; ?>
</ul>

<a href="form.html">Заполнить форму</a>
