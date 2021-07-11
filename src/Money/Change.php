<?php

namespace App\Money;

class Change {

    /** @var Coin[] */
    private $coins;

    public function add(Coin $coin) {
        $this->coins[] = $coin;
    }

    public function getAmount(): int {
        $sum = 0;
        foreach ($this->coins as $coin) {
            $sum += $coin->get();
        }

        return $sum;
    }
}
