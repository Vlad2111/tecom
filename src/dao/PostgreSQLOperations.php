<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс, операции с базами данных PostgreSQL

@author ershov.v
*/
class PostgreSQLOperations
{
	private $dbConnect;
	private $log;
	
	function __construct() {
		$this->log = Logger::getLogger(__CLASS__);
	}
	
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
			echo pg_connection_status($connection);
			$this->log->error("Не удается подключится к базе данных. ".$DBConfigurationString." ");
			throw new Exception("Не удается подключится к базе данных. ".$DBConfigurationString." ");
		}
		$this->log->info("Успешное подключение к базе данных PostgreSQL: ". $DBConfigurationString);
		return $this->dbConnect;
	}
	
	/** Запрос роли пользователя.*/
	public function getRoleNameAndId($userId)
	{
		$result = pg_query_params($this->dbConnect, 'SELECT r.role_id, rd.role_name FROM "Role" '.
				'AS r inner join "Role_def" AS rd on r.role_id = rd.role_id WHERE r.user_id = $1', 
				array($userId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос роли для пользователя: ". $userId);
			throw new Exception("Не удается выполнить запрос роли для пользователя: ". $userId);
		}
		if (pg_num_rows($result)<1) {
			$this->log->error("Нет данных о данном пользователе: ". $userId);
			throw new Exception("Нет данных о данном пользователе: ". $userId);
		}
		if (pg_num_rows($result)>1) {
			$this->log->error("Ошибка запроса. Получено несколько результатов");
			throw new Exception("Ошибка запроса. Получено несколько результатов");
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
			$this->log->error("Не удается выполнить запрос информации отдела для роли \"Директор подразделения\". Пользователь: ". $userId);
			throw new Exception("Не удается выполнить запрос информации отдела для роли \"Директор подразделения\". Пользователь: ". $userId);
		}
		if (pg_num_rows($result)<1) {
			$this->log->error("Нет данных о данном пользователе: ". $userId);
			throw new Exception("Нет данных о данном пользователе: ". $userId);
		}
		if (pg_num_rows($result)>1) {
			$this->log->error("Ошибка запроса. Получено несколько результатов");
			throw new Exception("Ошибка запроса. Получено несколько результатов");
		}
		$departmentNameAndId = pg_fetch_all($result);
		return $departmentNameAndId;
	}
	
	/** Возврат значений.*/
	public function clonModelData(DateTime $datefrom, DateTime $dateto)
	{
		//разобрать собрать
		$month = $dateTime->format('U');
		/** Возврат отделов.*/
		$result = pg_query($this->dbConnect, 'SELECT department_id, department_name '.
				'FROM "Departments"'/* WHERE date_part(\'epoch\', date_trunc(\'month\', date)) = $1', array($month)*/);
		if (!$result) {
			throw new Exception("Не удается выполнить запрос на получение списка отделов. Ошибка: ". pg_last_error());
		}
		$departmentRows = pg_fetch_all($result);
		return $departmentRows;
		array_unshift($departmentsTable, "date" -> $month);
		pg_copy_from($this->dbConnect, "Departments", $departmentRows);
		
	}
	/** Запрос списка отделов.*/
	public function getDepartmentNames($month)
	{
		$dateTime = new DateTime($month);
		
		$month=$dateTime->format('m.Y');
		echo $month;
		$result = pg_query($this->dbConnect, 'SELECT date_part(\'epoch\', date), department_id, department_name '.
				'FROM "Departments" WHERE date_trunc(\'month\', date) = $1', array($month));
		if (!$result) {
			throw new Exception("Не удается выполнить запрос на получение списка отделов. Ошибка: ". pg_last_error());
		}
		$departmentNameAndId = pg_fetch_all($result);
		return $departmentNameAndId;
	}
}
?>