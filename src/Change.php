<?php

class Change {

    /** @var Coin[] */
    private $coins;

    public function add(Coin $coin) {
        $this->coins[] = $coin;
    }

    public function addChange(Change $change) {
        $this->coins = $change->coins;
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
