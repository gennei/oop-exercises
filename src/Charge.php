<?php

class Charge {

    /** @var Coin[] */
    private $coins = [];

    public function add(Coin $coin) {
        $this->coins[] = $coin;
    }

    public function addAll(array $coins) {
        $this->coins = $coins;
    }

    public function getAmount(): int {

        $sum = 0;
        foreach ($this->coins as $coin) {
            $sum += $coin->get();
        }

        return $sum;
    }

    public function clear() {
        $this->coins = [];
    }
}
