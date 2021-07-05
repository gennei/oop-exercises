<?php

require_once("./Drink.php");
require_once("./DrinkType.php");
require_once("./Stock.php");
require_once("./Charge.php");
require_once("./Coin.php");
require_once ("./CoinStack.php");
require_once("./VendingMachine.php");

class main {

    public static function exec() {
        $vending_machine = new VendingMachine();

        $drink = $vending_machine->buy(new Coin(500), DrinkType::COKE());
        $charge = $vending_machine->refund();

        if ($drink != null && $drink->getKind() == DrinkType::COKE()) {
            echo "コーラを購入しました。" . PHP_EOL;
            echo "おつりは{$charge}円です" . PHP_EOL;
        } else {
            throw new Exception("コーラは買えなかった。ぴえん");
        }
    }
}

main::exec();
