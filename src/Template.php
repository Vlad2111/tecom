<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс шаблонов.

@author ershov.v
*/
Class Template {

	private $template;
	private $controller;
	private $vars = array();
	private $log;
	
	function __construct($controllerName) {
		$arr = explode('_', $controllerName);
		$this->controller = strtolower($arr[1]);
		$this->log = Logger::getLogger(__CLASS__);
	}
	
	/** Подключение отображаемого контента. (Собирает переменные для Layuot) */
	function vars($varname, $value) {
		if (isset($this->vars[$varname]) == true) {
			$this->log->info("Контент не выбран.");
			return false;
		}
		$this->vars[$varname] = $value;
		return true;
	}
	
	/** Подключение основы отображаемого контента. */
	function view($name, $layouts) {
		$pathLayout = '3pty/Smarty/demo/layouts/' . $layouts . '.php';
		$contentPage = '3pty/Smarty/demo/templates/' . $name . '.tpl';
		if (file_exists($pathLayout) == false) {
			$this->log->error("Шаблон основы ".$layouts." не найден.");
			throw new Exception("Шаблон основы ".$layouts." не найден.");
			return false;
		}
		if (file_exists($contentPage) == false) {
			$this->log->error("Шаблон контента ".$name." не найден.");
			throw new Exception("Шаблон контента ".$name." не найден.");
			return false;
		}
		
		/** Передача данных в Layout. */
		foreach ($this->vars as $key => $value) {
			$$key = $value;
		}

		include ($pathLayout);                
	}
	
}