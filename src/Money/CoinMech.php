<?php

namespace App\Money;

class CoinMech {

    // 準備金
    private $cashbox;

    /** @var Payment */
    private $payment;

    public function __construct() {
        $this->cashbox = new CashBox();
        foreach (range(0, 9) as $value) {
            $this->cashbox->add(new Coin(100));
        }
    }

    public function put(Coin $payment) {
        $this->payment = new Payment($payment);
    }

    public function doesNotHaveChange(): bool {
        return $this->payment->needChange() && $this->cashbox->doesNotHaveChange();
    }

    public function refund(): int {
        return $this->payment->refund()
                             ->getAmount();
    }

    public function commit() {
        $this->payment->commit($this->cashbox);
    }
}
