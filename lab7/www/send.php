<?php
require 'vendor/autoload.php';
use App\QueueManager;
use App\Order;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$name = $input['product'] ?? 'Товар';
$price = (float)($input['price'] ?? 0);
$qty = (int)($input['quantity'] ?? 1);

if ($price <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid price']);
    exit;
}

$order = new Order($name, $price, $qty);
$qm = new QueueManager();
$qm->publish($order->toArray());

echo json_encode(['success' => true, 'order_id' => $order->id, 'message' => 'Заказ отправлен в очередь']);