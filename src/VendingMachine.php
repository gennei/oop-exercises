<?php

class VendingMachine {

    // 在庫
    private $storage;

    // お金
    private $coinmech;

    public function __construct() {
        $this->storage  = new Storage();
        $this->coinmech = new CoinMech();
    }

    public function buy(Coin $payment, DrinkType $kindOfDrink): ?Drink {

        $this->coinmech->put($payment);
        if ($this->coinmech->doesNotHaveChange()) {
            return null;
        }

        if ($this->storage->isEmpty($kindOfDrink)) {
            return null;
        }
        $this->coinmech->commit();
        $this->storage->decrement($kindOfDrink);

        return new Drink($kindOfDrink);
    }

    /**
     * お釣りを取り出す.
     *
     * @return int お釣りの金額
     */
    public function refund(): int {
        return $this->coinmech->refund();
    }
}
