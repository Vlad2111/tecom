<?php
echo "Template";
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

	private $registry;
	private $template;
	private $controller;
	private $layouts;
	private $vars = array();
	private $log;
	
	function __construct($layouts, $controllerName, $registry) {
		$this->registry = $registry;
		$this->layouts = $layouts;
		$arr = explode('_', $controllerName);
		$this->controller = strtolower($arr[1]);
		$this->log = Logger::getLogger(__CLASS__);
	}
	
	/** Подключение отображаемого контента.*/
	function vars($varname, $value) {
		if (isset($this->vars[$varname]) == true) {
			$this->log->info("Контент не выбран.");
			return false;
		}
		$this->vars[$varname] = $value;
		return true;
	}
	
	/** Подключение основы отображаемого контента.*/
	function view($name) {
		$pathLayout = '3pty/Smarty/demo/' . $this->layouts . '.php';
		$contentPage = '3pty/Smarty/demo/templates/' . $name . '.tpl';
		if (file_exists($pathLayout) == false) {
			$this->log->error("Шаблон основы ".$this->layouts." не найден.");
			throw new Exception("Шаблон основы ".$this->layouts." не найден.");
			return false;
		}
		if (file_exists($contentPage) == false) {
			$this->log->error("Шаблон контента ".$name." не найден.");
			throw new Exception("Шаблон контента ".$name." не найден.");
			return false;
		}
	
		foreach ($this->vars as $key => $value) {
			$$key = $value;
		}

		$registry = $this->registry;
		include ($pathLayout);                
	}
	
}