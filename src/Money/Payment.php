<?php

namespace App\Money;

class Payment {

    private $coin;
    private $change;

    public function __construct(Coin $coin) {
        $this->coin = $coin;
    }

    public function needChange(): bool {
        return $this->coin->get() === Coin::FIVE_HUNDRED;
    }

    public function commit(CashBox $cashbox) {
        if ($this->coin->get() == Coin::ONE_HUNDRED) {
            $cashbox->add($this->coin);
            $this->change = new Change();
        }

        if ($this->coin->get() == Coin::FIVE_HUNDRED) {
            $this->change = $cashbox->takeOutChange();
        }

        $this->coin = null;
    }

    public function refund(): Change {
        if ($this->isNotCommitted()) {
            $change = new Change();
            $change->add($this->coin);

            return $change;
        }

        return $this->change;
    }

    private function isNotCommitted(): bool {
        return !is_null($this->coin);
    }
}
