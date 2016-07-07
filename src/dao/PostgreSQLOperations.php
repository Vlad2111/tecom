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
			$this->log->error("Не удается выполнить запрос роли для пользователя: ". $userId.
					" ". pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос роли для пользователя: ". $userId.
					" ". pg_last_error($this->dbConnect));
		}
		if (pg_num_rows($result)<1) {
			$this->log->error("Нет данных о данном пользователе: ". $userId ." ". pg_last_error($this->dbConnect));
			throw new Exception("Нет данных о данном пользователе: ". $userId ." ". pg_last_error($this->dbConnect));
		}
		if (pg_num_rows($result)>1) {
			$this->log->error("Ошибка запроса. Получено несколько результатов");
			throw new Exception("Ошибка запроса. Получено несколько результатов");
		}
		$roleNameAndId = pg_fetch_all($result);
		return $roleNameAndId;
	}
	
	/** Запрос роли главы отдела.*/
	public function getDepartmentHead($userId)
	{
		$result = pg_query_params($this->dbConnect, 'SELECT r.department_id, rd.department_name '.
				'FROM "Head_departments" AS r inner join "Departments" AS rd on '.
				'r.department_id = rd.department_id WHERE r.user_id = $1', array($userId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос информации отдела для роли \"Директор подразделения\". ".
					"Пользователь: ". $userId ." ". pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос информации отдела для роли \"Директор подразделения\". ".
					"Пользователь: ". $userId ." ". pg_last_error($this->dbConnect));
		}
		if (pg_num_rows($result)<1) {
			$this->log->error("Нет данных о данном пользователе: ". $userId ." ". pg_last_error($this->dbConnect));
			throw new Exception("Нет данных о данном пользователе: ". $userId ." ". pg_last_error($this->dbConnect));
		}
		if (pg_num_rows($result)>1) {
			$this->log->error("Ошибка запроса. Получено несколько результатов");
			throw new Exception("Ошибка запроса. Получено несколько результатов");
		}
		$departmentNameAndId = pg_fetch_all($result);
		return $departmentNameAndId;
	}
	
	/** Запрос списка отделов.*/
	public function getDepartmentNames(DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01");
		$result = pg_query_params($this->dbConnect, 'SELECT department_id, department_name FROM "Departments" WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', date)) = $1', array($date->format("U")));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка отделов. ". 
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка отделов. ". 
					pg_last_error($this->dbConnect));
		}
		$departmentNames = pg_fetch_all($result);
		return $departmentNames;
	}
	
	/** Запрос списка сотрудников.*/
	public function getEmployeeNames(DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01");
		$result = pg_query_params($this->dbConnect, 'SELECT employee_id, user_id FROM "Employee" WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', date)) = $1', array($date->format("U")));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка сотрудников. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка сотрудников. ". 
					pg_last_error($this->dbConnect));
		}
		$employeeNames = pg_fetch_all($result);
		return $employeeNames;
	}
	
	/** Запрос списка проектов отдела.*/
	public function getProjectNamesForDepartment($departmentId, DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01");
		$result = pg_query_params($this->dbConnect, 'SELECT project_id, project_name FROM "Projects" WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', date)) = $1 AND department_id = $2',
				array($date->format("U"), $departmentId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка проектов отдела. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка проектов отдела. ".
					pg_last_error($this->dbConnect));
		}
		$projectNamesForDepartment = pg_fetch_all($result);
		return $projectNamesForDepartment;
	}
	
	/** Запрос списка сотрудников отдела.*/
	public function getEmployeeNamesForDepartment($departmentId, DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01");
		$result = pg_query_params($this->dbConnect, 'SELECT employee_id, user_id FROM "Employee" WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', date)) = $1 AND department_id = $2',
				array($date->format("U"), $departmentId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка сотрудников отдела. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка сотрудников отдела. ".
					pg_last_error($this->dbConnect));
		}
		$employeeNamesForDepartment = pg_fetch_all($result);
		return $employeeNamesForDepartment;
	}

	/** Запрос списка сотрудников проекта и распределения времени.*/
	public function getEployeeNamesAndPercentsForProject($projectId, DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01");
		$result = pg_query_params($this->dbConnect, 'SELECT rd.user_id, r.time FROM "Time_distribution" AS r inner join '.
				'"Employee" AS rd on r.employee_id = rd.employee_id WHERE date_part(\'epoch\', date_trunc(\'month\','.
				'r.date)) = $1 AND project_id = $2', array($date->format("U"), $projectId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка сотрудников проекта и распределения ".
					"времени. ". pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка сотрудников проекта и распределения ".
					"времени. ". pg_last_error($this->dbConnect));
		}
		$eployeeNamesPercentsForProject = pg_fetch_all($result);
		return $eployeeNamesPercentsForProject;
	}
	
	/** Запрос информации сотрудника.*/
	public function getEmployeeInfo($employeeId, DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01");
		$result = pg_query_params($this->dbConnect, 'SELECT rd.project_name, r.time FROM "Time_distribution" AS r inner'.
				' join "Projects" AS rd on r.project_id = rd.project_id WHERE date_part(\'epoch\', date_trunc(\'month\','.
				'r.date)) = $1 AND employee_id = $2', array($date->format("U"), $employeeId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение информации о сотруднике. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение информации о сотруднике. ".
					pg_last_error($this->dbConnect));
		}
		$employeeInfo = pg_fetch_all($result);
		return $employeeInfo;
	}
	
	/** Возврат значений.*/
	public function cloneModelData(DateTime $datefrom, DateTime $dateto)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$datefrom->format("d.m.Y H:i:s"));
		$datefrom = new DateTime($convertDate['year']."-".$convertDate['month']."-01");
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$dateto->format("d.m.Y H:i:s"));
		$dateto = new DateTime($convertDate['year']."-".$convertDate['month']."-01");
	
		/** Возврат отделов.*/
		$result = pg_query_params($this->dbConnect, 'SELECT * FROM "Departments" WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', date)) = $1', array($dateto->format("U")));
		if (!$result) {
			$result = pg_query_params($this->dbConnect, 'SELECT department_name FROM "Departments" WHERE '.
					'date_part(\'epoch\', date_trunc(\'month\', date)) = $1', array($datefrom->format("U")));
			if (!$result) {
				$this->log->error("Не удается выполнить запрос на получение списка отделов. ".
						pg_last_error($this->dbConnect));
				throw new Exception("Не удается выполнить запрос на получение списка отделов. ".
						pg_last_error($this->dbConnect));
			}
			$departmentRows = pg_fetch_all($result);
			$rows = pg_num_rows($result);
			for ($i = 0; $i < $rows; $i++) {
				$result = pg_query_params($this->dbConnect, 'INSERT INTO "Depa_rtments" (date, department_name) '.
						'VALUES ($1, $2)', array($dateto->format("Y-m-d"), $departmentRows[$i]['department_name']));
				if (!$result) {
					$this->log->error("Не удается выполнить запись в базу данных. ". pg_last_error($this->dbConnect));
					throw new Exception("Не удается выполнить запись в базу данных. ".pg_last_error($this->dbConnect));
				}
			}
		}
	}
}
?>