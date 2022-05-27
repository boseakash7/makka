<?php

use System\Core\Config;

$database = Config::get('Database');

$database->set(array(
    'host' => 'mysql',
    'user' => getenv('MYSQL_USER'),
    'password' => getenv('MYSQL_PASSWORD'),
    'database' => getenv('MYSQL_DATABASE'),
    'port' => 3306,

    // 'host' => 'localhost',
    // 'user' => 'root',
    // 'password' => '',
    // 'database' => 'makka',
    // 'port' => 3306,

    // Connection options
    'options' => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'",
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true
    ]
));