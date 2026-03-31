<?php
require 'vendor/autoload.php';
use App\QueueManager;

$qm = new QueueManager();
$logFile = __DIR__ . '/orders.log';

echo "🚀 Worker запущен. Ожидание заказов...\n";

$qm->consume(function ($msg) use ($logFile) {
    $data = json_decode($msg->body, true);  // ← Теперь $msg — объект AMQPMessage
    $orderId = $data['id'] ?? 'unknown';

    echo "📦 Обработка заказа #{$orderId}: {$data['product']} × {$data['quantity']}\n";

    sleep(1);

    $data['status'] = 'processed';
    $data['processed_at'] = date('Y-m-d H:i:s');

    file_put_contents($logFile, json_encode($data, JSON_UNESCAPED_UNICODE) . PHP_EOL, FILE_APPEND);

    echo "✅ Заказ #{$orderId} обработан\n";

    $msg->ack();
});