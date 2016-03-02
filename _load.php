<?php
if ($debug) {
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', 1);
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
}

include('_models.php');
include('_functions.php');
