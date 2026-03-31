<?php
require 'vendor/autoload.php';
use App\QueueManager;

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Онлайн-магазин — ЛР-7 (RabbitMQ)</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 2rem auto; padding: 0 1rem; }
        form { background: #f5f5f5; padding: 1rem; border-radius: 8px; }
        input, button { margin: 0.5rem 0; padding: 0.5rem; width: 100%; box-sizing: border-box; }
        button { background: #4CAF50; color: white; border: none; cursor: pointer; }
        #result { margin-top: 1rem; padding: 1rem; background: #e8f5e9; border-radius: 4px; display: none; }
        .stats { background: #e3f2fd; padding: 1rem; border-radius: 4px; margin-top: 1rem; }
    </style>
</head>
<body>
    <h1>🛒 Онлайн-магазин (RabbitMQ)</h1>

    <form id="orderForm">
        <input type="text" id="product" placeholder="Название товара" required>
        <input type="number" id="price" placeholder="Цена (₽)" step="0.01" min="0.01" required>
        <input type="number" id="quantity" placeholder="Количество" min="1" value="1" required>
        <button type="submit">Оформить заказ</button>
    </form>

    <div id="result"></div>

    <div class="stats">
        <h3>📊 Статистика очереди</h3>
        <div id="queueStats">Загрузка...</div>
        <button onclick="loadStats()">Обновить</button>
    </div>

    <script>
    document.getElementById('orderForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const res = await fetch('send.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                product: document.getElementById('product').value,
                price: parseFloat(document.getElementById('price').value),
                quantity: parseInt(document.getElementById('quantity').value)
            })
        });
        const data = await res.json();
        const result = document.getElementById('result');
        result.style.display = 'block';
        result.innerHTML = data.success
            ? `✅ Заказ #${data.order_id} принят!`
            : `❌ Ошибка: ${data.error}`;
    });

    async function loadStats() {
        try {
            const res = await fetch('stats.php');
            const data = await res.json();
            document.getElementById('queueStats').innerHTML =
                `Очередь: <b>${data.queue}</b><br>Сообщений: <b>${data.messages}</b>`;
        } catch(e) {
            document.getElementById('queueStats').textContent = 'Не удалось загрузить статистику';
        }
    }
    loadStats();
    </script>
</body>
</html>