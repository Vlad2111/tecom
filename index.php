<?php
error_reporting (E_ALL);

require_once('autoload/autoload.php');

$configForLogger = Configuration::instance()->config;
$osType = PHP_OS;
if ($osType = 'WINNT') {
	Logger::configure ( $configForLogger ['loggerConfigWindows'] );
} else {
	if ($osType = 'LINUX') {
		Logger::configure ( $configForLogger ['loggerConfigLinux'] );
	}
}
$router = new Router($registry);
$router->setPath ('controllers');
$router->start();
