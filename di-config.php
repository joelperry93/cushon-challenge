<?php
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Slim\App;
use Slim\Factory\AppFactory;
use Psr\Container\ContainerInterface;
use Psr\Clock\ClockInterface;
use Cushon\RequestHandler\AccountSummaryRequestHandler;

return [
    App::class => function (ContainerInterface $container): App {
        AppFactory::setContainer($container);
        $app = AppFactory::create();
        $app->get('/account-summary', AccountSummaryRequestHandler::class);
        return $app;
    },

    ClockInterface::class => function (ContainerInterface $container): ClockInterface {
        return new class implements ClockInterface {
            public function now(): DateTimeImmutable { // A frozen clock makes testing reliable
                return new \DateTimeImmutable('2023-06-02T20:00:00');
            }
        };
    },

    Connection::class => function (ContainerInterface $container): Connection {
        return DriverManager::getConnection([
            'dbname'   => 'cushon',
            'user'     => 'root', // These credentials would not be versioned in the real world
            'password' => 'root',
            'host'     => 'cushon_db',
            'driver'   => 'pdo_mysql',
        ]);
    }
];
