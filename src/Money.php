<?php

class Money {

    private $amount;

    public function __construct(int $amount) {
        $this->amount = $amount;
    }

    public function add(Money $money) {
        return new Money($this->amount + $money->amount);
    }
}
