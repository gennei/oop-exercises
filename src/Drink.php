<?php

class Drink {

    private $kind;

    public function __construct(DrinkType $kind) {
        $this->kind = $kind;
    }

    public function getKind(): DrinkType {
        return $this->kind;
    }

    public function isCoke(): bool {
        return $this->kind === DrinkType::COKE();
    }

    public function isDietCoke(): bool {
        return $this->kind === DrinkType::DIET_COKE();
    }

    public function isTea(): bool {
        return $this->kind === DrinkType::TEA();
    }
}
