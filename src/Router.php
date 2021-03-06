<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс Singleton

@author ershov.v
*/
Class Router {

	private $path;
	private $args = array();
	private $log;
	
	function __construct() {
		/**Настройки*/
		{
			$this->setPath();
			$this->setConfigLogger();
		}
		$this->log = Logger::getLogger(__CLASS__);
	}
	
	/** Получение пути к контроллерам.*/
	function setPath() {
		$configForController = Configuration::instance()->config;
		$path = $configForController['pathController'];
		$path = rtrim($path, '/\\');
        	$path .= '/';
        	$this->path = $path;
	}
	
	/** Подключение настроек для логов.*/
	function setConfigLogger() {
		$configForLogger = Configuration::instance()->config;
		$osType = PHP_OS;
		if ($osType = 'WINNT') {
			Logger::configure ( $_SERVER['DOCUMENT_ROOT']."/../".$configForLogger['loggerConfigWindows'] );
		} else {
			if ($osType = 'LINUX') {
				Logger::configure ( $_SERVER['DOCUMENT_ROOT']."/../".$configForLogger['loggerConfigLinux'] );
			}
		}
	}

	/** Подключение контроллера.*/
	private function getController(&$file, &$controller, &$action, &$args) {
        $route = (empty($_GET['route'])) ? '' : $_GET['route'];
        if (empty($route)) {
			$route = 'Index'; 
		}

        $route = trim($route, '/\\');
        $parts = explode('/', $route);

        $cmd_path = $this->path;
        foreach ($parts as $part) {
			$fullpath = $cmd_path . $part;

			if (is_dir($fullpath)) {
				$cmd_path .= $part . '/';
				array_shift($parts);
				continue;
			}

			if (is_file($fullpath . '.php')) {
				$controller = $part;
				array_shift($parts);
				break;
			}
        }

        if (empty($controller)) {
			$controller = 'Index'; 
		}

        $action = array_shift($parts);
        if (empty($action)) { 
			$action = 'index'; 
		}

        $file = $cmd_path . $controller . '.php';
        $args = $parts;
	}
	
	/** Начало работы сайта.**/
	function start() {
        $this->getController($file, $controller, $action, $args);
        if (is_readable($file) == false) {
			$this->log->error('Не существует файл: '.$file.'');
			die ('404 Not Found');
        }
        include ($file);
        $class = 'Controller_'.$controller;
        $controller = new $class();
       
		
        if (is_callable(array($controller, $action)) == false) {
			$this->log->error('Не существует класс контроллера: '.$class.'');
			die ('404 Not Found');
        }
		
        $controller->$action();
	}
}
