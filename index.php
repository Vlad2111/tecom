<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

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
$registry['POST']=$_POST;
$registry['GET']=$_GET;
print_r($registry['POST']);
print_r($registry['GET']);
$router->start();
