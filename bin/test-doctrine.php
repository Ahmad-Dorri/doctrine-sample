<?php

declare(strict_types=1);

$entityManager = require dirname(__DIR__) . '/config/doctrine.php';

echo $entityManager->isOpen()
    ? "Doctrine entity manager is ready.\n"
    : "Doctrine entity manager is closed.\n";
