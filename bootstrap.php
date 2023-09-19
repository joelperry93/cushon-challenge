<?php
require dirname(__FILE__) . '/vendor/autoload.php';

use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions(dirname(__FILE__) . '/di-config.php');
return $containerBuilder->build();
