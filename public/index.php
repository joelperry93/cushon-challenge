<?php
$container = require '../bootstrap.php';

use Cushon\RequestHandler\AccountBalanceRequestHandler;
use Slim\App;

$app = $container->get(App::class);
$app->get('/', AccountBalanceRequestHandler::class);
$app->run();
