<?php

class VendingMachine {

    // 在庫
    private $quantityOfCoke = 5;
    private $quantityOfDietCoke = 5;
    private $quantityOfTea = 5;

    // 100円の在庫
    private $numberOf100Yen = 10;
    // お釣り
    private $charge = 0;

    public function buy(int $i, int $kindOfDrink) {
        // 100円と500円だけ受け付ける
        if (($i != 100) && ($i != 500)) {
            $this->charge += $i;
            return null;
        }

        if (($kindOfDrink == Drink::COKE) && ($this->quantityOfCoke == 0)) {
            $this->charge += $i;
            return null;
        } else if (($kindOfDrink == Drink::DIET_COKE) && ($this->quantityOfDietCoke == 0)) {
            $this->charge += $i;
            return null;
        } else if (($kindOfDrink == Drink::TEA) && ($this->quantityOfTea == 0)) {
            $this->charge += $i;
            return null;
        }

        // 釣り銭不足
        if ($i == 500 && $this->numberOf100Yen < 4) {
            $this->charge += $i;
            return null;
        }

        if ($i == 100) {
            // 100円玉を釣り銭に使える
            $this->numberOf100Yen ++;
        } else if ($i == 500) {
            // 400円のお釣り
            $this->charge += ($i - 100);
            // 100円玉を釣り銭に使える
            $this->numberOf100Yen  -= ($i - 100) / 100;
        }

        if ($kindOfDrink == Drink::COKE) {
            $this->quantityOfCoke--;
        } else if ($kindOfDrink == Drink::DIET_COKE) {
            $this->quantityOfDietCoke--;
        } else {
            $this->quantityOfTea--;
        }

        return new Drink($kindOfDrink);
    }

    /**
     * お釣りを取り出す.
     *
     * @return int お釣りの金額
     */
    public function refund(): int  {
        $result = $this->charge;
        $this->charge = 0;
        return $result;
    }
}
