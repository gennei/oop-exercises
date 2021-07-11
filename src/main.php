<?php

use App\Drink\DrinkType;
use App\Money\Coin;
use App\VendingMachine;

require_once(__DIR__ . "/../vendor/autoload.php");

class main {

    public static function exec() {
        $vending_machine = new VendingMachine();

        $drink  = $vending_machine->buy(new Coin(500), DrinkType::COFFEE());
        $charge = $vending_machine->refund();

        if ($drink != null) {
            echo $drink . "を購入しました。" . PHP_EOL;
            echo "おつりは{$charge}円です" . PHP_EOL;
        } else {
            throw new Exception("コーラは買えなかった。ぴえん");
        }
    }
}

main::exec();
