<?php
$container = require '../bootstrap.php';

use Slim\App;

$container->get(App::class)->run();
