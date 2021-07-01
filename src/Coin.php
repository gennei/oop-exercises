<?php

class Coin {

    const ONE_HUNDRED = 100;
    const FIVE_HUNDRED = 500;

    private $amount;

    public function __construct(int $amount) {
        $this->amount = $amount;
    }

    public function get() {
        return $this->amount;
    }
}
