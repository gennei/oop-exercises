<?php

class StockOf100Yen {

    private $numberOf100Yen = [];

    public function add(Coin $coin) {
        $this->numberOf100Yen[] = $coin;
    }

    public function size(): int {
        return count($this->numberOf100Yen);
    }

    public function pop(): Coin {
        return array_pop($this->numberOf100Yen);
    }

    public function doesNotHaveChange(): bool {
        return $this->size() < 4;
    }

    public function takeOutChange(): Change {
        $change = new Change();

        foreach (range(0,3) as $value) {
            $change->add(array_pop($this->numberOf100Yen));
        }

        return $change;
    }
}
