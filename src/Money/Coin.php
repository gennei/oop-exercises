<?php

namespace App\Money;

class Coin {

    const ONE_HUNDRED  = 100;
    const FIVE_HUNDRED = 500;

    private $amount;

    public function __construct(int $amount) {
        $this->amount = $amount;
    }

    public function get(): int {
        return $this->amount;
    }
}
