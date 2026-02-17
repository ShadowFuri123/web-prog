<?php session_start(); ?>

<?php if(isset($_SESSION['username'])): ?>
    <p>Данные из сессии:</p>
    <ul>
        <li>Имя: <?= $_SESSION['username'] ?></li>
        <li>Дата рождения: <?= $_SESSION['date_birth'] ?></li>
        <li>Направление: <?= $_SESSION['direction'] ?></li>
        <li>Вид помощи: <?= $_SESSION['type_help'] ?></li>
        <li>Опыт: <?= $_SESSION['experience'] ?></li>
    </ul>
<?php else: ?>
    <p>Данных пока нет.</p>
<?php endif; ?>

<a href="form.html">Заполнить форму</a> |
<a href="view.php">Посмотреть все данные</a>