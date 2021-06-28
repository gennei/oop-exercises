<?php

class Drink {

    const COKE      = 0;
    const DIET_COKE = 1;
    const TEA       = 2;

    private $kind;

    public function __construct(int $kind) {
        $this->kind = $kind;
    }

    public function getKind(): int {
        return $this->kind;
    }
}
