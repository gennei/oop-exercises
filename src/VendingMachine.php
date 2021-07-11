<?php

class VendingMachine {

    // 在庫
    private $storage;
    // お釣り
    private $change;

    private $stock_of_100_yen;

    public function __construct() {
        $this->storage          = new Storage();
        $this->change           = new Change();
        $this->stock_of_100_yen = new StockOf100Yen();

        foreach (range(0, 10) as $value) {
            $this->stock_of_100_yen->add(new Coin(100));
        }
    }

    public function buy(Coin $payment, DrinkType $kindOfDrink): ?Drink {
        // 100円と500円だけ受け付ける
        if (($payment->get() != Coin::ONE_HUNDRED) && ($payment->get() != Coin::FIVE_HUNDRED)) {
            $this->change->add($payment);

            return null;
        }

        if ($this->storage->isEmpty($kindOfDrink)) {
            $this->change->add($payment);

            return null;

        }

        // 釣り銭不足
        if ($payment->get() == 500 && $this->stock_of_100_yen->doesNotHaveChange()) {
            $this->change->add($payment);

            return null;
        }

        if ($payment->get() == 100) {
            // 100円玉を釣り銭に使える
            $this->stock_of_100_yen->add($payment);
        } elseif ($payment->get() == 500) {
            $this->change = $this->stock_of_100_yen->takeOutChange();
        }

        $this->storage->decrement($kindOfDrink);

        return new Drink($kindOfDrink);
    }

    /**
     * お釣りを取り出す.
     *
     * @return int お釣りの金額
     */
    public function refund(): int {
        $result       = $this->change;
        $this->change = 0;

        return $result->getAmount();
    }
}
