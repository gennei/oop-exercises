<?php

class Drink {

    private $kind;

    public function __construct(DrinkType $kind) {
        $this->kind = $kind;
    }

    public function getKind(): DrinkType {
        return $this->kind;
    }
}
