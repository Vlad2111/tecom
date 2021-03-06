<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/

/*Регистрация собственного автозагрузчика*/
spl_autoload_register(array('SiteAutoloader', 'autoload'));

/**
Класс автозагрузок.

@author ershov.v
*/
class SiteAutoloader 
{
	
	/** Автозагрузка классов.*/
	public static function autoload($className){

		$filename = $className . '.php';
		$expArr = explode('_', $className);
		if((empty($expArr[1])) AND ($expArr[0] == 'Logger')){
			$folder = '3pty/apache-log4php-2.3.0';
		}else{
			if((empty($expArr[1])) AND ($expArr[0] == 'PostgreSQLOperations')){
				$folder = 'src/dao';
			}else{
				$folder = 'src';			
			}
		}
		$file = $folder . '/' . $filename;
		if (file_exists($file) == false) {
			return false;
		}
		include ($file);
	}
}
