<?php

declare(strict_types=1);

use Psr\Container\ContainerInterface;
use Gt\TestDi\SaveDriverFormAction;
use Gt\TestDi\DriverFormDtoDriver;

use function Gt\mydump;

require __DIR__ . '/../vendor/autoload.php';

/** @var ContainerInterface $container */
$container = require __DIR__ . '/../config/container.php';

/** @var SaveDriverFormAction */
$saveDriverFormAction = $container->get(SaveDriverFormAction::class);

$phoneNumber=$argv[1]=== "null" ? null : $argv[1];
// echo mydump($phoneNumber);

// parameter:
// phoneNumber: "+7(456)789-4562"
$driverFormDtoDriver= new DriverFormDtoDriver($phoneNumber);

$saveDriverFormAction->handle(formCommand: $driverFormDtoDriver);
