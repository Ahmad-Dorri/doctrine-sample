<?php

declare(strict_types=1);

$connection = require dirname(__DIR__) . '/config/database.php';

$result = $connection->fetchOne('SELECT 1');

echo $result === 1
    ? "Database connection successful.\n"
    : "Database connection failed.\n";
