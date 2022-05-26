<?php

use System\Core\Config;

$database = Config::get('Database');

$database->set(array(
    'host' => 'mysql',
    'user' => getenv('MYSQL_USER'),
    'password' => getenv('MYSQL_PASSWORD'),
    'database' => getenv('MYSQL_DATABASE'),
    'port' => 3306,

    // Connection options
    'options' => [
        // Database options here
    ]
));