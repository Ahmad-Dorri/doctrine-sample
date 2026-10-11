<?php

declare(strict_types=1);

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

require dirname(__DIR__) . '/vendor/autoload.php';

/** @var Connection $connection */
$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'host' => getenv('DB_HOST'),
    'port' => (int) (getenv('DB_PORT') ?: 3306),
    'dbname' => getenv('MYSQL_DATABASE'),
    'user' => getenv('MYSQL_USER'),
    'password' => getenv('MYSQL_PASSWORD'),
    'charset' => 'utf8mb4',
]);

return $connection;
