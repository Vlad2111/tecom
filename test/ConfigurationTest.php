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
class ConfigurationTest
{
	public $config = array();
	static $instance = null;
	
	function __construct() {
	}

	/** Фиксирование настроек из config. */
	public static function instance()
	{
		if (ConfigurationTest::$instance == null) {
			ConfigurationTest::$instance = new ConfigurationTest();
  			ConfigurationTest::$instance->readConfig();
		}
		return ConfigurationTest::$instance;
	}
	
	/** Чтение переменных из файла config. */
	private function readConfig()
	{
		$this->config = parse_ini_file("config.ini");
	}
}
