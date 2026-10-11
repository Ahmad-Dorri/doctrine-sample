<?php

declare(strict_types=1);

return [
    "migrations_paths" => [
        "DoctrineMigrations" => __DIR__ . "/migrations",
    ],

    "table_storage" => [
        "table_name" => "doctrine_migration_versions",
    ],

    "all_or_nothing" => true,
];
