<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use App\Router\Router;

$router = new Router();
$router->run();