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

	function __construct() {
	}

	/** Фиксирование подключения к базе данных PostgreSQL.*/
	public static function instance()
	{
		static $instance = null;
		if ($instance === null) {
			$instance = new Configuration();
  			$instance->readConfigAndDBConnection();
		}
		return $instance;
	}
	
	/** Чтение переменных из файла config.php и подключение к базе данных.*/
	private function readConfigAndDBConnection()
	{
		$dbConnect = null;
		
		$ConfigurationArray= parse_ini_file("config.ini");
		$dbConnect = pg_connect($ConfigurationArray);
		if (!$dbConnect) {
			throw new Exception("Не удается подключится к базе данных");
		}
		return $dbConnect;
	}
}

Configuration::instance()->config;
?>