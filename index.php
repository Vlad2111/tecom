<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once('autoload/autoload.php');

$router = new Router();
$router->start();