<?php
require 'db.php';
require 'Student.php';

$student = new Student($pdo);
$all = $student->getAll();
?>
<h2>Сохранённые данные:</h2>
<ul>
<?php foreach($all as $row): ?>
    <li><?= $row['name'] ?>, <?= $row['age'] ?> лет, <?= $row['faculty'] ?>, <?= $row['study_form'] ?>, Согласие: <?= $row['agree_rules'] ? 'Да' : 'Нет' ?></li>
<?php endforeach; ?>
</ul>

<a href="form.html">Заполнить форму</a>
