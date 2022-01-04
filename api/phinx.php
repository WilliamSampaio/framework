<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' =>      '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'production_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' =>    DATA_LAYER_CONFIG['driver'],
            'host' =>       DATA_LAYER_CONFIG['host'],
            'name' =>       DATA_LAYER_CONFIG['dbname'],
            'user' =>       DATA_LAYER_CONFIG['username'],
            'pass' =>       DATA_LAYER_CONFIG['passwd'],
            'port' =>       DATA_LAYER_CONFIG['port'],
            'charset' =>    'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'testing_db',
            'user' => 'root',
            'pass' => '',
            'port' => '3306',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
