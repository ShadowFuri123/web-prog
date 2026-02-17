<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <style>
        .msg { padding: 10px; margin-bottom: 15px; border-radius: 5px; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="msg error"><?= $_SESSION['error_message'] ?></div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="msg success"><?= $_SESSION['success_message'] ?></div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['username'])): ?>
        <h3>Данные из сессии:</h3>
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

    <hr>
    <a href="form.html">Заполнить форму</a> |
    <a href="view.php">Посмотреть все данные</a>
</body>
</html>