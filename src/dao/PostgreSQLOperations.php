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
Класс, операции с базами данных PostgreSQL

@author ershov.v
*/
class PostgreSQLOperations
{
	private $dbConnect;
	
	/** Подключение к базе данных.*/
	public function connect()
	{ 
		$dbConnect = null;
		$DBConfiguration = Configuration::instance()->config;
		$DBConfigurationString = "host={$DBConfiguration['host']} ".
				"port={$DBConfiguration['port']} ".
				"dbname={$DBConfiguration['dbName']} ".
				"user={$DBConfiguration['user']} ". 
				"password={$DBConfiguration['password']}";
		$this->dbConnect = pg_pconnect($DBConfigurationString);
		if (!$this->dbConnect) {
			throw new Exception("Не удается подключится к базе данных.");
		}
		return $this->dbConnect;
	}
	
	/** Запрос роли пользователя.*/
	public function getRoleNameAndId($userId)
	{
		$result = pg_query_params($this->dbConnect, 'SELECT r.role_id, rd.role_name FROM "Role" '.
				'AS r inner join "Role_def" AS rd on r.role_id = rd.role_id WHERE r.user_id = $1', 
				array($userId));
		if (!$result) {
			throw new Exception("Не удается выполнить запрос роли.");
		}
		if (pg_num_rows($result)<1) {
			throw new Exception("Нет данных о данном пользователе.");
		}
		if (pg_num_rows($result)>1) {
			throw new Exception("Ошибка запроса.");
		}
		$roleIdName = pg_fetch_all($result);
		return $roleIdName;
	}
	
	/** Запрос роли главы отдела.*/
	public function getDepartmentHead($userId)
	{
		$result = pg_query_params($this->dbConnect, 'SELECT r.department_id, rd.department_name '.
				'FROM "Head_departments" AS r inner join "Departments" AS rd on '.
				'r.department_id = rd.department_id WHERE r.user_id = $1', array($userId));
		if (!$result) {
			throw new Exception("Не удается выполнить запрос отдела.");
		}
		if (pg_num_rows($result)<1) {
			throw new Exception("Нет данных о данном пользователе.");
		}
		if (pg_num_rows($result)>1) {
			throw new Exception("Ошибка запроса.");
		}
		$departmentNameAndId = pg_fetch_all($result);
		return $departmentNameAndId;
	}
	
	/** Возврат значений.*/
	public function returnInformation($month)
	{
		$month = $month - 1;
		/** Возврат отделов.*/
		$result = pg_query_params($this->dbConnect, 'SELECT department_id, department_name '.
				'FROM "Departments" WHERE date = $1', array($month));
		$departmentRows = pg_fetch_all($result);
		array_unshift($departmentsTable, "date" -> $month);
		pg_copy_from($this->dbConnect, "Departments", $departmentRows);
		
	}
	
	/** Запрос списка отделов.*/
	public function getDepartmentNames(DateTime $month)
	{
		$result = pg_query($this->dbConnect, 'SELECT date_part(\'epoch\', date), department_id, department_name '.
				'FROM "Departments" WHERE date = $1', array($month));
		if (!$result) {
			throw new Exception("Не удается выполнить запрос на получение списка отделов. Ошибка: ". pg_last_error());
		}
		$departmentNameAndId = pg_fetch_all($result);
		return $departmentNameAndId;
	}
}
?>