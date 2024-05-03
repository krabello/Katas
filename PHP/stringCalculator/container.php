<?php

use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    App\StringCalculator::class => function () {
        $config = require './config.php';
        return new App\StringCalculator(
            $config['string_calculator']['delimiters'],
            $config['string_calculator']['max_number']
        );
    }
]);

$container = $containerBuilder->build();
return $container;
