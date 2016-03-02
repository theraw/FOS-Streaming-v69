<?php

include('_start.php');
$databasemanagar->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'xxx',
    'username' => 'ttt',
    'password' => 'zzz',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);
$debug = false;
include('_load.php');
