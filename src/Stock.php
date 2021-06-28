<?php

class Stock {

    private $quantity;

    public function __construct(int $quantity) {
        $this->quantity = $quantity;
    }

    public function get(): int {
        return $this->quantity;
    }

    public function decrement() {
        $this->quantity -= 1;
    }
}
