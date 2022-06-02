<?php
include_once '../vendor/autoload.php';
use DRN\Structure\Car;
use DRN\Container\AppContainer;
$container = new AppContainer();

$instance = $container->get(Car::class);
var_export($instance);