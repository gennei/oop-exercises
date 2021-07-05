<?php

class CoinStack {

    private $coins;

    public function __construct() {
    }

    public function add(Coin $coin) {
        $this->coins[] = $coin;
    }

    public function count(): int {
        return count($this->coins);
    }

    public function pop() {
        array_pop($this->coins);
    }

    public function doesNotHaveChange(): bool {
        return $this->count() < 4;
    }
}
