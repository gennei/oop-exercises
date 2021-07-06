<?php

class VendingMachine {

    // 在庫
    private $storage;
    // 100円の在庫
    private $coins;
    // お釣り
    private $charge;

    public function __construct() {
        $this->storage = new Storage();
        $this->coins   = new CoinStack();
        $this->charge  = new Charge();
        $this->coins->add(new Coin(100));
        $this->coins->add(new Coin(100));
        $this->coins->add(new Coin(100));
        $this->coins->add(new Coin(100));
        $this->coins->add(new Coin(100));
        $this->coins->add(new Coin(100));
        $this->coins->add(new Coin(100));
        $this->coins->add(new Coin(100));
        $this->coins->add(new Coin(100));
    }

    public function buy(Coin $payment, DrinkType $kindOfDrink): ?Drink {
        // 100円と500円だけ受け付ける
        if (($payment->get() != Coin::ONE_HUNDRED) && ($payment->get() != Coin::FIVE_HUNDRED)) {
            $this->charge->add($payment);

            return null;
        }

        if ($this->storage->isEmpty($kindOfDrink)) {
            $this->charge->add($payment);

            return null;

        }

        // 釣り銭不足
        if ($payment->get() == 500 && $this->coins->doesNotHaveChange()) {
            $this->charge->add($payment);

            return null;
        }

        if ($payment->get() == 100) {
            // 100円玉を釣り銭に使える
            $this->charge->add(new Coin(100));
        } elseif ($payment->get() == 500) {
            // 400円のお釣り
            $this->charge->addAll($this->coins->takeOutChange());

            // 雑だけど一旦これで
            $this->coins->pop();
            $this->coins->pop();
            $this->coins->pop();
            $this->coins->pop();
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
        $result       = $this->charge;
        $this->charge = 0;

        return $result->getAmount();
    }
}
