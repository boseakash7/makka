<?php

date_default_timezone_set("Asia/Kolkata");
define('DS', DIRECTORY_SEPARATOR);
define('ABS_PATH', dirname(__FILE__));

include ABS_PATH . '/System/Autoloader.php';

$autoloader = new Autoloader();
$autoloader->start();

// First preload predefined files,
$autoloader->preload([
    'System/Core/Exceptions',
    'Configs/Application',
    'Configs/Database',
    'Configs/Routes',
    'Configs/Lang',
]);

// Now its time to load extra files
$configs = \System\Core\Application::config();

// before doing anything increase the memory limit
if ( $configs->memory_limit )
{
    ini_set('memory_limit', $configs->memory_limit);
}

if ( is_array($configs->extra_configs) ) $autoloader->preload($configs->extra_configs);

if ( $configs->composer_autoload_path ) require ABS_PATH . DS .  $configs->composer_autoload_path;

if ( !\System\core\Application::isCLI() ) 
{
    $app = new \System\Core\Application();
    $app->init();
}