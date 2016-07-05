<?php
/*
 * Copyright (c) 2016 Tecom LLC
 * All rights reserved
 *
 * Исключительное право (c) 2016 пренадлежит ООО Теком
 * Все права защищены
 */		

include_once 'Configuration.php';
include_once 'Logger.php';

/**
 Класс Старт приложения.

 @author ershov.v
 */
class ApplicationInit
{
	public static function init()
	{

		$configForLogger = Configuration::instance()->config;
		$osType = PHP_OS;
		if ($osType = 'WINNT') {
			Logger::configure ( $configForLogger ['loggerConfigWindows'] );
		} else {
			if ($osType = 'LINUX') {
				Logger::configure ( $configForLogger ['loggerConfigLinux'] );
			}
		}
	}
	
}
?>