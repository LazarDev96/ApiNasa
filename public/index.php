<?php


//Composer

require dirname(__DIR__) . '/vendor/autoload.php';

//Error report

error_reporting(E_ALL);

//Routing

$router = new Core\Router();

if (!array_key_exists('QUERY_STRING', $_SERVER) || empty($_SERVER['QUERY_STRING'])) {
    //default route
    $_SERVER['QUERY_STRING'] = 'nasa/rovers';
}

// Add the routes
$router->add('nasa/rovers', 'NasaApi', 'index');
$router->dispatch($_SERVER['QUERY_STRING']);
