<?php

include_once '../vendor/autoload.php';

$config = require('../core/config.php');
$routes = require('../core/routes.php');

$app = new Application($config, $routes);
$app->run();
