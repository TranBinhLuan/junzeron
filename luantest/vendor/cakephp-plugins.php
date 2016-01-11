<?php
$baseDir = dirname(dirname(__FILE__));
return [
    'plugins' => [
        'Bake' => $baseDir . '/vendor/cakephp/bake/',
        'DebugKit' => $baseDir . '/vendor/cakephp/debug_kit/',
        'Exchange' => $baseDir . '/plugins/Exchange/',
        'Migrations' => $baseDir . '/vendor/cakephp/migrations/'
    ]
];
