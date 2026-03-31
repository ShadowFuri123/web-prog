<?php
namespace App;

class Order {
    public int $id;
    public string $productName;
    public float $price;
    public int $quantity;
    public string $status;
    public string $createdAt;

    public function __construct(string $name, float $price, int $qty = 1) {
        $this->id = random_int(1000, 9999);
        $this->productName = $name;
        $this->price = $price;
        $this->quantity = $qty;
        $this->status = 'pending';
        $this->createdAt = date('Y-m-d H:i:s');
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'product' => $this->productName,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'total' => $this->price * $this->quantity,
            'status' => $this->status,
            'created_at' => $this->createdAt
        ];
    }
}