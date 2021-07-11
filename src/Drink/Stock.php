<?php

namespace App\Drink;

class Stock {

    private $quantity;

    public function __construct(int $quantity) {
        $this->quantity = $quantity;
    }

    public function decrement() {
        $this->quantity -= 1;
    }

    public function isEmpty(): bool {
        return $this->quantity === 0;
    }
}
