<?php

declare(strict_types=1);

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;

$entityManager = require __DIR__ . "/config/doctrine.php";

return DependencyFactory::fromEntityManager(
    new PhpFile(__DIR__ . "/migrations.php"),
    new ExistingEntityManager($entityManager),
);
