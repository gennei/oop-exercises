<?php

class VendingMachine {

    // 在庫
    private $stockOfCoke;
    private $stockOfDietCoke;
    private $stockOfTea;

    // 100円の在庫
    private $coins;
    // お釣り
    private $charge;

    public function __construct() {
        $this->stockOfCoke     = new Stock(5);
        $this->stockOfDietCoke = new Stock(5);
        $this->stockOfTea      = new Stock(5);
        $this->coins           = new CoinStack();
        $this->charge          = new Charge();
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

        if (($kindOfDrink == DrinkType::COKE()) && $this->stockOfCoke->isEmpty()) {
            $this->charge->add($payment);

            return null;
        } elseif (($kindOfDrink == DrinkType::DIET_COKE()) && $this->stockOfDietCoke->isEmpty()) {
            $this->charge->add($payment);

            return null;
        } elseif (($kindOfDrink == DrinkType::TEA()) && $this->stockOfTea->isEmpty()) {
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

        if ($kindOfDrink == DrinkType::COKE()) {
            $this->stockOfCoke->decrement();
        } elseif ($kindOfDrink == DrinkType::DIET_COKE()) {
            $this->stockOfDietCoke->decrement();
        } else {
            $this->stockOfTea->decrement();
        }

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
