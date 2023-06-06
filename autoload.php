<?php

spl_autoload_register(function ($className) {
    $namespace = 'App\\';
    $basePath = __DIR__ . '/app/';

    $className = str_replace($namespace, '', $className);
    $filePath = $basePath . str_replace('\\', '/', $className) . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;
    }
});
