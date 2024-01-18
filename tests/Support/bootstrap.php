<?php

declare(strict_types=1);

define('YII_ENV', 'test');

$root = dirname(__DIR__, 2);
$autoload = $root . '/vendor/autoload.php';

if (!is_file($autoload)) {
    die('You need to set up the project dependencies using Composer');
}

require_once $autoload;
