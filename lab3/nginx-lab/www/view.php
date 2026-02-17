<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Все данные</title>
</head>
<body>
    <h2>Все сохранённые данные:</h2>
    <ul>
        <?php
        if (file_exists("data.txt")) {
            $lines = file("data.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            foreach ($lines as $line) {
                $parts = explode(",", $line);

                if (count($parts) >= 2) {
                    $name = htmlspecialchars($parts[0]);
                    $date = htmlspecialchars($parts[1] ?? '');
                    $dir = htmlspecialchars($parts[2] ?? '');
                    $help = htmlspecialchars($parts[3] ?? '');
                    $exp = htmlspecialchars($parts[4] ?? '');

                    echo "<li><strong>$name</strong> (Дата: $date, Напр: $dir, Помощь: $help, Опыт: $exp)</li>";
                }
            }
        } else {
            echo "<li>Файл с данными пуст или не найден.</li>";
        }
        ?>
    </ul>
    <a href="index.php">На главную</a>
</body>
</html>