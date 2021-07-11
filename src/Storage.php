<?php

class Storage {

    private $stocks;

    public function __construct() {
        $this->stocks = [
            DrinkType::COKE()
                     ->valueOf() => new Stock(5),
            DrinkType::DIET_COKE()
                     ->valueOf() => new Stock(5),
            DrinkType::TEA()
                     ->valueOf() => new Stock(5),
        ];
    }

    public function isEmpty(DrinkType $drink_type): bool {
        return $this->stocks[$drink_type->valueOf()]->isEmpty();
    }

    public function takeOut(DrinkType $drink_type): Drink {
        $this->stocks[$drink_type->valueOf()]->decrement();
        return new Drink($drink_type);
    }
}
