<?php

namespace App\Drink;

/**
 * @method static COKE()
 * @method static DIET_COKE()
 * @method static TEA()
 */
class DrinkType {

    use EnumTrait;

    const ENUM = [
        'COKE',
        'DIET_COKE',
        'TEA',
    ];
}

trait EnumTrait {
    private $scalar;

    final public function __construct($key) {
        if (!self::isValidValue($key)) {
            throw new \InvalidArgumentException;
        }
        $this->scalar = $key;
    }

    final public static function isValidValue($key): bool {
        return in_array($key, self::ENUM, true);
    }

    final public function __toString() {
        return $this->scalar;
    }

    final public function __invoke() {
        return $this->scalar;
    }

    final public static function __callStatic($method, array $args) {
        return new self($method);
    }

    final public function __set($key, $value) {
        throw new \BadMethodCallException('All setter is forbbiden');
    }

    final public function valueOf(): string {
        return (string)$this->scalar;
    }
}
