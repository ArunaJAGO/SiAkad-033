<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Filesystem Vercel read-only, kecuali /tmp
foreach ([
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
] as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->useStoragePath('/tmp/storage');

$app->handleRequest(Request::capture());