<?php
require 'vendor/autoload.php';
use App\RedisExample;

header('Content-Type: text/html; charset=utf-8');

try {
    $redis = new RedisExample();

    // --- Добавление товаров в каталог  ---
    echo "<h3>📦 1. Каталог товаров</h3>";

    $products = [
        ['id' => 1, 'name' => 'Ноутбук', 'price' => 89990, 'stock' => 15, 'category' => 'electronics'],
        ['id' => 2, 'name' => 'Смартфон', 'price' => 45990, 'stock' => 32, 'category' => 'electronics'],
        ['id' => 3, 'name' => 'Наушники', 'price' => 7990, 'stock' => 50, 'category' => 'accessories'],
        ['id' => 4, 'name' => 'Клавиатура', 'price' => 3490, 'stock' => 20, 'category' => 'accessories'],
    ];

    foreach ($products as $product) {
        $key = "product:{$product['id']}";
        $redis->getClient()->hMSet($key, $product);
        $redis->getClient()->sAdd("products:all", $product['id']); // индекс всех товаров
        $redis->getClient()->sAdd("products:category:{$product['category']}", $product['id']); // индекс по категории
        echo "✅ Товар добавлен: <b>{$product['name']}</b> ({$product['price']} ₽)<br>";
    }
    echo "<br>";

    // --- Получение информации о товаре ---
    echo "<h3>🔍 2. Просмотр товара</h3>";
    $productId = 2;
    $product = $redis->getClient()->hGetAll("product:{$productId}");
    if ($product) {
        echo "<p><b>Товар #{$productId}:</b><br>";
        echo "Название: {$product['name']}<br>";
        echo "Цена: {$product['price']} ₽<br>";
        echo "На складе: {$product['stock']} шт.<br>";
        echo "Категория: {$product['category']}</p>";
    }
    echo "<br>";

    // --- Счётчик просмотров товара ---
    echo "<h3>👁 3. Счётчик просмотров</h3>";
    $viewKey = "product:{$productId}:views";
    $redis->getClient()->incr($viewKey);
    $views = $redis->getClient()->get($viewKey);
    echo "Просмотров товара #{$productId}: <b>{$views}</b><br><br>";

    // --- Корзина покупателя (список) ---
    echo "<h3>🛒 4. Корзина покупателя</h3>";
    $cartKey = "cart:user:1001";

    // Добавляем товары в корзину
    $cartItems = [1, 3, 3]; // товар 3 добавлен дважды
    foreach ($cartItems as $itemId) {
        $redis->getClient()->rPush($cartKey, $itemId);
        echo "➕ Товар #{$itemId} добавлен в корзину<br>";
    }

    // Получаем содержимое корзины
    $cart = $redis->getClient()->lRange($cartKey, 0, -1);
    echo "<p><b>Содержимое корзины:</b> " . implode(', ', $cart) . "</p>";

    // Считаем количество уникальных товаров
    $uniqueItems = array_unique($cart);
    echo "Уникальных товаров: <b>" . count($uniqueItems) . "</b><br>";
    echo "Всего позиций: <b>" . count($cart) . "</b><br><br>";

    // --- Фильтрация по категории ---
    echo "<h3>🏷 5. Товары по категории</h3>";
    $category = 'electronics';
    $ids = $redis->getClient()->sMembers("products:category:{$category}");
    echo "<p>Товары в категории <b>{$category}</b>:</p><ul>";
    foreach ($ids as $id) {
        $prod = $redis->getClient()->hGetAll("product:{$id}");
        echo "<li>{$prod['name']} — {$prod['price']} ₽</li>";
    }
    echo "</ul>";


} catch (Exception $e) {
    echo "<p style='color:red; font-weight:bold;'>❌ ОШИБКА: " . $e->getMessage() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
?>