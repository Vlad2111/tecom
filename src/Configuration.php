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
class Configuration
{
	public $config = array();
	static $instance = null;
	
	function __construct() {
	}

	/** Фиксирование подключения к базе данных PostgreSQL.*/
	public static function instance()
	{
		if ($instance == null) {
			$instance = new Configuration();
  			$instance->readConfig();
		}
		return $instance;
	}
	
	/** Чтение переменных из файла config.*/
	private function readConfig()
	{
		$this->config = parse_ini_file("config.ini");
	}
}

?>