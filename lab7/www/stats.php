<?php
require 'vendor/autoload.php';
use App\QueueManager;

header('Content-Type: application/json');

try {
    $qm = new QueueManager();
    // RabbitMQ не имеет прямого метода получения количества сообщений
    // без declaration, поэтому создадим временный канал
    $connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
    $channel = $connection->channel();
    [, $messageCount] = $channel->queue_declare('lab7_queue', true);
    $channel->close();
    $connection->close();

    echo json_encode([
        'queue' => 'lab7_queue',
        'messages' => $messageCount
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}