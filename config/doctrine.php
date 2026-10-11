<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$connection = require __DIR__ . "/database.php";

$config = ORMSetup::createAttributeMetadataConfig(paths: [dirname(__DIR__) . "/app/Entity"], isDevMode: true);

$config->enableNativeLazyObjects(true);

return new EntityManager($connection, $config);
