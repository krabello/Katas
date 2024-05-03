<?php

require_once "./vendor/autoload.php";
$container = require './container.php';

try {
    $calculator = $container->get(App\StringCalculator::class);
    echo $calculator->add('1;2,3') . PHP_EOL; // 6
    echo $calculator->add('1***2****3') . PHP_EOL; // 6
    echo $calculator->add('4\n2\n4') . PHP_EOL; // 10
    echo $calculator->add('4***2;3,7') . PHP_EOL; // 16
    echo $calculator->add('4000***2;3,7') . PHP_EOL; // 12
    echo $calculator->add('-40***2;3,7') . PHP_EOL; // Negatives not allowed: -40
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
} finally {
    echo "Total times called: " . $calculator->getCalledCount() . PHP_EOL;
}