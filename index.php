<?php
error_reporting (E_ALL);

require_once('autoload/autoload.php');

$configForLogger = Configuration::instance()->config;
$osType = PHP_OS;
if ($osType = 'WINNT') {
	Logger::configure ( $_SERVER['DOCUMENT_ROOT']."/../".$configForLogger['loggerConfigWindows'] );
} else {
	if ($osType = 'LINUX') {
		Logger::configure ( $_SERVER['DOCUMENT_ROOT']."/../".$configForLogger['loggerConfigLinux'] );
	}
}
$router = new Router($registry);
$router->setPath ('controllers');
$registry['sitePath'] = $_SERVER['DOCUMENT_ROOT'];
$registry['POST']=$_POST;
$registry['GET']=$_GET;
print_r($registry['POST']);
print_r($registry['GET']);
$router->start();
