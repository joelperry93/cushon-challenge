<?php
/**
 * @var \Psr\Container\ContainerInterface $container
 */
$container = require 'bootstrap.php';

use Doctrine\DBAL\Connection;

return [
    'environments' => [
        'default_environment' => 'default',
        'default' => [
            'name' => 'cushon',
            'connection' => $container->get(Connection::class)->getNativeConnection()
        ]
    ],
    'container' => $container,
    'paths' => [
        'migrations' => [
            'Cushon\Database\Migration' => '%%PHINX_CONFIG_DIR%%/database/src/Migration'
        ],
        'seeds' => [
            'Cushon\Database\Seeder' => '%%PHINX_CONFIG_DIR%%/database/src/Seeder'
        ]
    ]
];
