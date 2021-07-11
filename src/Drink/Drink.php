<?php

namespace App\Drink;

class Drink {

    private $kind;

    public function __construct(DrinkType $kind) {
        $this->kind = $kind;
    }

    public function isCoke(): bool {
        return $this->kind == DrinkType::COKE();
    }

    public function isDietCoke(): bool {
        return $this->kind == DrinkType::DIET_COKE();
    }

    public function isTea(): bool {
        return $this->kind == DrinkType::TEA();
    }

    public function isCoffee(): bool {
        return $this->kind == DrinkType::COFFEE();
    }

    public function __toString() {
        return $this->kind->valueOf();
    }
}
