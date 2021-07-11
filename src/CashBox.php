<?php

class CashBox {

    private $coins = [];

    public function add(Coin $coin) {
        $this->coins[] = $coin;
    }

    public function doesNotHaveChange(): bool {
        return count($this->coins) < 4;
    }

    public function takeOutChange(): Change {
        $change = new Change();

        foreach (range(0, 3) as $value) {
            $change->add(array_pop($this->coins));
        }

        return $change;
    }
}
