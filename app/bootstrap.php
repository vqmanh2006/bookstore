<?php
include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../config/database.php';
include_once __DIR__ . '/../config/Helper.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

spl_autoload_register(function ($className) {
    $prefixes = [
        'App\\Models\\' => __DIR__ . '/Models/',
        'App\\Controllers\\' => __DIR__ . '/Controllers/',
        'App\\Core\\' => __DIR__ . '/Core/',
    ];

    foreach ($prefixes as $prefix => $directory) {
        if (strpos($className, $prefix) === 0) {
            $relative = substr($className, strlen($prefix));
            $file = $directory . str_replace('\\', '/', $relative) . '.php';
            if (is_file($file)) {
                require $file;
            }
        }
    }
});
