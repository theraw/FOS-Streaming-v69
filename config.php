<?php
include('_start.php');

$databasemanagar->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'fos',
    'username'  => 'root',
    'password'  => 'zadik',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$debug = false;
include('_load.php');
