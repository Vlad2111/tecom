﻿<?php
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
	
	/** Подключение к базе данных. */
	public function connect()
	{ 
		$dbConnect = null;
		$DBConfiguration = Configuration::instance()->config;
		$DBConfigurationString = "host={$DBConfiguration['dbhost']} ".
				"port={$DBConfiguration['dbport']} ".
				"dbname={$DBConfiguration['dbname']} ".
				"user={$DBConfiguration['dbuser']} ". 
				"password={$DBConfiguration['dbpassword']}";
		$this->dbConnect = pg_pconnect($DBConfigurationString);
		if (!$this->dbConnect) {
			$this->log->error("Не удается подключится к базе данных. ".$DBConfigurationString." ");
			throw new Exception("Не удается подключится к базе данных. ".$DBConfigurationString." ");
		}
		return $this->dbConnect;
	}
	
	/** Начало транзакции. */
	public function beginTran()
	{
		pg_query($this->dbConnect, 'BEGIN TRANSACTION');
	}
	
	/** Закрытие транзакции. */
	public function commitTran()
	{
		pg_query($this->dbConnect, 'COMMIT TRANSACTION');
	}
	
	/** Откат транзакции. */
	public function rollbackTran()
	{
		pg_query($this->dbConnect, 'ROLLBACK TRANSACTION');
	}
	
	/** Сохранение транзакции. */
	public function saveTran()
	{
		pg_query($this->dbConnect, 'SAVEPOINT complete');
	}
	
	/** Откат к сохранению транзакции. */
	public function rollbackSaveTran()
	{
		pg_query($this->dbConnect, 'ROLLBACK TRANSACTION TO SAVEPOINT complete');
	}
	
	/** Запрос роли пользователя. */
	public function getRoleName($userId)
	{
		$result = pg_query_params($this->dbConnect, 'SELECT rd.role_name, rd.role_id FROM "Role" '.
				'AS r inner join "Role_def" AS rd on r.role_id = rd.role_id WHERE r.employee_id = (SELECT '.
					'employee_id FROM "Employee" WHERE user_id = $1 ORDER BY "date" desc limit 1)', 
						array($userId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос роли для пользователя: ". $userId.
					" ". pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос роли для пользователя: ". $userId.
					" ". pg_last_error($this->dbConnect));
		}
		if (pg_num_rows($result)<1) {
			$this->log->error("Нет данных о данном пользователе: ". $userId ." ". 
					pg_last_error($this->dbConnect));
			throw new Exception("Нет данных о данном пользователе: ". $userId ." ". 
					pg_last_error($this->dbConnect));
		}
		if (pg_num_rows($result)>1) {
			$this->log->error("Ошибка запроса. Получено несколько результатов");
			throw new Exception("Ошибка запроса. Получено несколько результатов");
		}
		$roleNameAndId = pg_fetch_all($result);
		return $roleNameAndId;
	}
	
	/** Запрос роли главы отдела. */
	public function getDepartmentHead(DateTime $date ,$userId)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT r.department_id, rd.department_name FROM '.
				'"Head_departments" AS r inner join "Departments" AS rd on r.date = rd.date AND '.
					'r.department_id = rd.department_id WHERE date_part(\'epoch\', date_trunc(\'month\','.
						' rd.date)) = $1 AND r.employee_id = (SELECT employee_id FROM "Employee" WHERE '.
							'user_id = $2 AND date_part(\'epoch\', date_trunc(\'month\', date)) = $1)',
								array($date->format("U"), $userId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос информации отдела для роли ".
					"\"Директор подразделения\". Id пользователя: ". $userId ." ". 
						pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос информации отдела для роли ".
					"\"Директор подразделения\". Id пользователя: ". $userId ." ". 
						pg_last_error($this->dbConnect));
		}
		if (pg_num_rows($result)<1) {
			$this->log->error("Нет данных о данном пользователе. Id: ". $userId ." ".
					pg_last_error($this->dbConnect));
			throw new Exception("Нет данных о данном пользователе. Id: ". $userId ." ".
					pg_last_error($this->dbConnect));
		}
		$departmentNameAndId = pg_fetch_all($result);
		return $departmentNameAndId;
	}
	
	/** Запрос списка ролей пользователей. */
	public function getEmployeeRoleNamesAndId(DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT r.employee_id, r.user_id, r.user_name, '.
				'r.department_id, rd.department_name, rddd.role_name, rdd.role_id FROM "Departments" '.
					'AS rd inner join ("Employee" AS r inner join ("Role" AS rdd inner join "Role_def" '.
						'AS rddd on rdd.role_id = rddd.role_id) on r.employee_id = rdd.employee_id) on '.
							'r.department_id = rd.department_id AND r.date = rd.date WHERE date_part'.
								'(\'epoch\', date_trunc(\'month\', r.date)) = $1',
									array($date->format("U")));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка сотрудников. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка сотрудников. ".
					pg_last_error($this->dbConnect));
		}
		$employeeNamesAndRoles = pg_fetch_all($result);
		foreach ($employeeNamesAndRoles as $key=>$arr){
			if ($arr['role_id'] == 1){
				$departmentNameAndId = $this->getDepartmentHead($date, $arr['user_id']);
				foreach ($departmentNameAndId as $key1=>$arr1){
					$employeeNamesAndRoles[$key]['head'][$key1]['department_name'] = $arr1['department_name'];
					$employeeNamesAndRoles[$key]['head'][$key1]['department_id'] = $arr1['department_id'];
				}
			}
		}
print_r($employeeNamesAndRoles);
		return $employeeNamesAndRoles;
	}
	
	/** Запрос статуса редактирования данных для месяца. */
	public function getDataStatusForEditing(DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT editing_status FROM "Month" '.
				'WHERE date_part(\'epoch\', date_trunc(\'month\', date))'.
				' = $1', array($date->format("U")));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение статуса редактирования для месяца. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение статуса редактирования для месяца. ".
					pg_last_error($this->dbConnect));
		}
		$status = pg_fetch_all($result);
		return $status;
	}
	
	/** Запрос списка ролей. */
	public function getRoleDef()
	{
		$result = pg_query($this->dbConnect, 'SELECT role_id, role_name FROM "Role_def"');
			if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка ролей. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка ролей. ".
					pg_last_error($this->dbConnect));
		}
		$roleDef = pg_fetch_all($result);
		return $roleDef;
	}
	
	/** Запрос списка отделов. */
	public function getDepartmentNames(DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT department_id, department_name'.
				' FROM "Departments" WHERE date_part(\'epoch\', date_trunc(\'month\', date))'.
					' = $1', array($date->format("U")));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка отделов. ". 
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка отделов. ". 
					pg_last_error($this->dbConnect));
		}
		$departmentNames = pg_fetch_all($result);
		return $departmentNames;
	}
	
	/** Запрос списка пользователей без роли. */
	public function getUserNames(DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT r.employee_id, r.user_id, r.user_name, '.
				'r.department_id, rd.department_name FROM "Employee" AS r inner join "Departments" '.
				'AS rd on r.department_id = rd.department_id AND r.date = rd.date WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', r.date)) = $1',	array($date->format("U")));
	if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка пользователей. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка пользователей. ". 
					pg_last_error($this->dbConnect));
		}
		$userNames = pg_fetch_all($result);
		if($userNames!=null){
			foreach ($userNames as $key=>$arr){
				$result = pg_query_params($this->dbConnect, 'SELECT role_id FROM "Role" WHERE employee_id '.
						'=  $1 ',  array($arr['employee_id']));
				$userrole = pg_fetch_result($result, 1, 0);($result);
			}
		}
		return $userNames;
	}
	
	/** Запрос списка сотрудников. */
	public function getEmployeeNames(DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT r.employee_id, r.user_id, r.user_name, '.
				'r.department_id, rd.department_name FROM "Employee" AS r inner join "Departments" '.
				'AS rd on r.department_id = rd.department_id AND r.date = rd.date WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', r.date)) = $1',	array($date->format("U")));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка сотрудников. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка сотрудников. ". 
					pg_last_error($this->dbConnect));
		}
		$employeeNames = pg_fetch_all($result);
		return $employeeNames;
	}
	
	/** Запрос списка проектов. */
	public function getProjectNames(DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT r.project_id, r.project_name, '.
				'r.department_id, rd.department_name FROM "Projects" AS r inner join "Departments" '.
					'AS rd on r.department_id = rd.department_id AND r.date = rd.date WHERE '.
						'date_part(\'epoch\', date_trunc(\'month\', r.date)) = $1',	array($date->format("U")));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка проектов. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка проектов. ".
					pg_last_error($this->dbConnect));
		}
		$projectNames = pg_fetch_all($result);
		return $projectNames;
	}
	
	/** Запрос списка проектов отдела. */
	public function getProjectNamesForDepartment($departmentId, DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
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
	
	/** Запрос списка сотрудников отдела. */
	public function getEmployeeNamesForDepartment($departmentId, DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT employee_id, user_id, user_name FROM '.
				'"Employee" WHERE date_part(\'epoch\', date_trunc(\'month\', date)) = $1 AND '.
					'department_id = $2', array($date->format("U"), $departmentId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка сотрудников отдела. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка сотрудников отдела. ".
					pg_last_error($this->dbConnect));
		}
		$employeeNamesForDepartment = pg_fetch_all($result);
		if($employeeNamesForDepartment!=null){
			foreach ($employeeNamesForDepartment as $key=>$arr){
				$result = pg_query_params($this->dbConnect, 'SELECT time FROM "Time_distribution" WHERE '.
					'date_part(\'epoch\', date_trunc(\'month\', date)) = $1 AND employee_id = $2',
						array($date->format("U"), $arr['employee_id']));
				$percentForEmployee = pg_fetch_all($result);
				$summPercents=0;
				if($percentForEmployee!=null){
					foreach ($percentForEmployee as $keySumm=>$arrSumm){
						$summPercents=$summPercents+$arrSumm['time'];
					}
				}
				$employeeNamesForDepartment[$key]['summ']=$summPercents;
			}
		}
		return $employeeNamesForDepartment;
	}

	/** Запрос списка сотрудников проекта и распределения времени. */
	public function getEployeeNamesAndPercentsForProject($projectId, DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT rd.employee_id, rd.user_id, rd.user_name, '.
				'rdd.department_id, rdd.department_name, r.time FROM "Time_distribution" AS r inner join '.
					'("Employee" AS rd inner join "Departments" AS rdd on rd.department_id = rdd.department_id'.
						' AND rd.date = rdd.date) on r.employee_id = rd.employee_id AND r.date = rd.date WHERE '.
							'date_part(\'epoch\', date_trunc(\'month\', r.date)) = $1 AND r.project_id = $2',
								array($date->format("U"), $projectId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка сотрудников проекта и ".
					"распределения времени. ". pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка сотрудников проекта и ".
					"распределения времени. ". pg_last_error($this->dbConnect));
		}
		$eployeeNamesPercentsForProject = pg_fetch_all($result);
		return $eployeeNamesPercentsForProject;
	}
	
	/** Запрос информации сотрудника. */
	public function getEmployeeInfo($employeeId, DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT rd.project_id, rd.project_name, rdd.department_id,'.
				' rdd.department_name, r.time FROM "Time_distribution" AS r inner join ("Projects" AS rd inner '.
					'join "Departments" AS rdd on rd.department_id = rdd.department_id AND rd.date = rdd.date) on'.
						' r.project_id = rd.project_id AND r.date = rd.date WHERE date_part(\'epoch\', '.
							'date_trunc(\'month\', r.date)) = $1 AND r.employee_id = $2', array($date->format("U"), 
								$employeeId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение информации о сотруднике. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение информации о сотруднике. ".
					pg_last_error($this->dbConnect));
		}
		$employeeInfo = pg_fetch_all($result);
		return $employeeInfo;
	}
	
	/** Списки для редактирования. */
	
	/** Запрос списка проектов для поля редактирования. */
	public function getProjectNamesNotForDepartment($departmentId, DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT project_id, project_name FROM "Projects" WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', date)) = $1 AND department_id != $2',
				array($date->format("U"), $departmentId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка проектов для поля редактирования. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка проектов для поля редактирования. ".
					pg_last_error($this->dbConnect));
		}
		$projectNamesForDepartment = pg_fetch_all($result);
		return $projectNamesForDepartment;
	}
	
	/** Запрос списка сотрудников для поля редактирования. */
	public function getEmployeeNamesNotForDepartment($departmentId, DateTime $date)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT employee_id, user_id, user_name FROM '.
				'"Employee" WHERE date_part(\'epoch\', date_trunc(\'month\', date)) = $1 AND '.
				'department_id != $2', array($date->format("U"), $departmentId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение списка сотрудников для поля редактирования. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение списка сотрудников для поля редактирования. ".
					pg_last_error($this->dbConnect));
		}
		$employeeNamesForDepartment = pg_fetch_all($result);
		return $employeeNamesForDepartment;
	}
	
	/** Возврат значений таблиц. */
	public function cloneModelData(DateTime $datefrom, DateTime $dateto)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$datefrom->format("d.m.Y H:i:s"));
		$datefrom = new DateTime($convertDate['year']."-".$convertDate['month']."-01",
					new DateTimeZone('UTC'));
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$dateto->format("d.m.Y H:i:s"));
		$dateto = new DateTime($convertDate['year']."-".$convertDate['month']."-01",
					new DateTimeZone('UTC'));

		/** Возврат строк таблицы отделов. */
		$result = pg_query_params($this->dbConnect, 'SELECT * FROM "Departments" WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', date)) = $1', array($dateto->format("U")));
		$inspectionData = pg_fetch_all($result);
		if (!$inspectionData) {
			$result = pg_query_params($this->dbConnect, 'SELECT department_id, department_name FROM '.
					'"Departments" WHERE date_part(\'epoch\', date_trunc(\'month\', date)) = $1', 
						array($datefrom->format("U")));
			if (!$result) {
				$this->log->error("Не удается выполнить запрос на получение списка отделов. ".
						pg_last_error($this->dbConnect));
				throw new Exception("Не удается выполнить запрос на получение списка отделов. ".
						pg_last_error($this->dbConnect));
			}
print_r($departmentRows);
			$departmentRows = pg_fetch_all($result);
			$rows = pg_num_rows($result);
			for ($i = 0; $i < $rows; $i++) {
				$result = pg_query_params($this->dbConnect, 'INSERT INTO "Departments" (date, department_id,'.
						' department_name) VALUES ($1, $2, $3)', array($dateto->format("Y-m-d"),
							$departmentRows[$i]['department_id'], $departmentRows[$i]['department_name']));
				if (!$result) {
					$this->log->error("Не удается выполнить запись в базу данных. ". 
							pg_last_error($this->dbConnect));
					throw new Exception("Не удается выполнить запись в базу данных. ".
							pg_last_error($this->dbConnect));
				}
			}
		}
		
		/** Возврат строк таблицы сотрудников. */
		$result = pg_query_params($this->dbConnect, 'SELECT * FROM "Employee" WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', date)) = $1', array($dateto->format("U")));
		$inspectionData = pg_fetch_all($result);
		if (!$inspectionData) {
			$result = pg_query_params($this->dbConnect, 'SELECT employee_id, user_id, user_name, '.
					'department_id FROM "Employee" WHERE date_part(\'epoch\', '.
						'date_trunc(\'month\', date)) = $1', array($datefrom->format("U")));
			if (!$result) {
				$this->log->error("Не удается выполнить запрос на получение списка сотрудников. ".
						pg_last_error($this->dbConnect));
				throw new Exception("Не удается выполнить запрос на получение списка сотрудников. ".
						pg_last_error($this->dbConnect));
			}
			$employeeRows = pg_fetch_all($result);
			$rows = pg_num_rows($result);
			for ($i = 0; $i < $rows; $i++) {
				$result = pg_query_params($this->dbConnect, 'INSERT INTO "Employee" (date, employee_id, '.
						'user_id, user_name, department_id) VALUES ($1, $2, $3, $4, $5)', array($dateto->format("Y-m-d"), 
							$employeeRows[$i]['employee_id'], $employeeRows[$i]['user_id'], $employeeRows[$i]['user_name'],
								$employeeRows[$i]['department_id']));
				if (!$result) {
					$this->log->error("Не удается выполнить запись в базу данных. ". 
							pg_last_error($this->dbConnect));
					throw new Exception("Не удается выполнить запись в базу данных. ".
							pg_last_error($this->dbConnect));
				}
			}
		}
		
		/** Возврат строк таблицы проектов. */
		$result = pg_query_params($this->dbConnect, 'SELECT * FROM "Projects" WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', date)) = $1', array($dateto->format("U")));
		$inspectionData = pg_fetch_all($result);
		if (!$inspectionData) {
			$result = pg_query_params($this->dbConnect, 'SELECT project_id, project_name, department_id FROM '.
					'"Projects" WHERE date_part(\'epoch\', date_trunc(\'month\', date)) = $1', 
						array($datefrom->format("U")));
			if (!$result) {
				$this->log->error("Не удается выполнить запрос на получение списка проектов. ".
						pg_last_error($this->dbConnect));
				throw new Exception("Не удается выполнить запрос на получение списка проектов. ".
						pg_last_error($this->dbConnect));
			}
			$projectRows = pg_fetch_all($result);
			$rows = pg_num_rows($result);
			for ($i = 0; $i < $rows; $i++) {
				$result = pg_query_params($this->dbConnect, 'INSERT INTO "Projects" (date, project_id, '.
						'project_name, department_id) VALUES ($1, $2, $3, $4)', array($dateto->format("Y-m-d"),
							$projectRows[$i]['project_id'],	$projectRows[$i]['project_name'],
								$projectRows[$i]['department_id']));
				if (!$result) {
					$this->log->error("Не удается выполнить запись в базу данных. ". 
							pg_last_error($this->dbConnect));
					throw new Exception("Не удается выполнить запись в базу данных. ".
							pg_last_error($this->dbConnect));
				}
			}
		}
		
		/** Возврат строк таблицы распределения времени. */
		$result = pg_query_params($this->dbConnect, 'SELECT * FROM "Time_distribution" WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', date)) = $1', array($dateto->format("U")));
		$inspectionData = pg_fetch_all($result);
		if (!$inspectionData) {
			$result = pg_query_params($this->dbConnect, 'SELECT project_id, employee_id, time FROM '.
					'"Time_distribution" WHERE date_part(\'epoch\', date_trunc(\'month\', date)) = $1', 
						array($datefrom->format("U")));
			if (!$result) {
				$this->log->error("Не удается выполнить запрос на получение списка проектов. ".
						pg_last_error($this->dbConnect));
				throw new Exception("Не удается выполнить запрос на получение списка проектов. ".
						pg_last_error($this->dbConnect));
			}
			$timeRows = pg_fetch_all($result);
			$rows = pg_num_rows($result);
			for ($i = 0; $i < $rows; $i++) {
				$result = pg_query_params($this->dbConnect, 'INSERT INTO "Time_distribution" (date, '.
						'project_id, employee_id, time) VALUES ($1, $2, $3, $4)', 
							array($dateto->format("Y-m-d"), $timeRows[$i]['project_id'],
								$timeRows[$i]['employee_id'], $timeRows[$i]['time']));
				if (!$result) {
					$this->log->error("Не удается выполнить запись в базу данных. ". 
							pg_last_error($this->dbConnect));
					throw new Exception("Не удается выполнить запись в базу данных. ".
							pg_last_error($this->dbConnect));
				}
			}
		}
		
		/** Возврат строк таблицы глав департаментов. */
		$result = pg_query_params($this->dbConnect, 'SELECT * FROM "Head_departments" WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', date)) = $1', array($dateto->format("U")));
		$inspectionData = pg_fetch_all($result);
		if (!$inspectionData) {
			$result = pg_query_params($this->dbConnect, 'SELECT employee_id, department_id FROM '.
					'"Head_departments" WHERE date_part(\'epoch\', date_trunc(\'month\', date)) = $1', 
						array($datefrom->format("U")));
			if (!$result) {
				$this->log->error("Не удается выполнить запрос на получение списка проектов. ".
						pg_last_error($this->dbConnect));
				throw new Exception("Не удается выполнить запрос на получение списка проектов. ".
						pg_last_error($this->dbConnect));
			}
			$headDepartmentRows = pg_fetch_all($result);
			$rows = pg_num_rows($result);
			for ($i = 0; $i < $rows; $i++) {
				$result = pg_query_params($this->dbConnect, 'INSERT INTO "Head_departments" (date, '.
						'employee_id, department_id) VALUES ($1, $2, $3)', array($dateto->format("Y-m-d"), 
							$headDepartmentRows[$i]['employee_id'], $headDepartmentRows[$i]['department_id']));
				if (!$result) {
					$this->log->error("Не удается выполнить запись в базу данных. ". 
							pg_last_error($this->dbConnect));
					throw new Exception("Не удается выполнить запись в базу данных. ".
							pg_last_error($this->dbConnect));
				}
			}
		}
	}
	
	/** Обновление названия отдела. */
	public function changeDepartmentName($departmentId, DateTime $date, $newDepartmentName)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'UPDATE "Departments" SET department_name = $3 WHERE'.
				' date_part(\'epoch\', date_trunc(\'month\', date)) = $1 AND department_id = $2',
					array($date->format("U"), $departmentId, $newDepartmentName));
		if (!$result) {
			$this->log->error("Не удается выполнить обновление названия отдела. ". 
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить обновление названия отдела. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Обновление названия проекта и привязки его к отделу. */
	public function changeProjectNameAndDepartmentId($projectId, DateTime $date, $newProjectName,
			$newDepartmentId)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'UPDATE "Projects" SET project_name = $3, department_id = '.
				'$4 WHERE date_part(\'epoch\', date_trunc(\'month\', date)) = $1 AND project_id = $2',
					array($date->format("U"), $projectId, $newProjectName, $newDepartmentId));
		if (!$result) {
			$this->log->error("Не удается выполнить обновление названия проекта и привязки его к отделу. ". 
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить обновление названия проекта и привязки его к отделу. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Обновление распределения времени сотрудника. */
	public function changeEployeeTimeForProject($employeeId, $projectId, DateTime $date, $newTime)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'UPDATE "Time_distribution" SET time = $4 WHERE'.
				' date_part(\'epoch\', date_trunc(\'month\', date)) = $1 AND employee_id = $2 AND project_id = $3',
				array($date->format("U"), $employeeId, $projectId, $newTime));
		if (!$result) {
			$this->log->error("Не удается выполнить обновление распределения времени сотрудника. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить обновление распределения времени сотрудника. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Обновление информации о сотруднике. */
	public function changeEmployeeInfo($employeeId, DateTime $date, $userId, $userName, $newDepartmentId)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'UPDATE "Employee" SET user_id = $4, user_name=$5,'.
				'department_id = $3 WHERE date_part(\'epoch\', date_trunc(\'month\', date)) = '.
					'$1 AND employee_id = $2 ',	array($date->format("U"), $employeeId,
						$newDepartmentId, $userId, $userName));
		if (!$result) {
			$this->log->error("Не удается выполнить обновление информации о сотруднике. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить обновление информации о сотруднике. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Обновление роли пользователя. */
	public function changeRole($employeeId, $newRoleId)
	{
		$result = pg_query_params($this->dbConnect, 'UPDATE "Role" SET role_id = $2 WHERE employee_id = $1 ',
				array($employeeId, $newRoleId));
		if (!$result) {
			$this->log->error("Не удается выполнить обновление роли пользователя. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить обновление роли пользователя. ". 
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Обновление статуса редактирования данных для месяца. */
	public function changeDataStatusForEditing(DateTime $date, $newStatus)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'UPDATE "Month" SET editing_status = $2 '.
				'WHERE date_part(\'epoch\', date_trunc(\'month\', date)) = $1 ', 
					array($date->format("U"), $newStatus));
		if (!$result) {
			$this->log->error("Не удается выполнить обновление статуса редактирования для месяца. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить обновление статуса редактирования для месяца. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Добавление статуса редактирования данных для месяца. */
	public function newDataStatusForEditing(DateTime $date, $status)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'INSERT INTO "Month" (date, editing_status)'.
				' VALUES ($1, $2)', array($date->format("Y-m-d"), $status));
		if (!$result) {
			$this->log->error("Не удается выполнить запись нового статуса редактирования для месяца. ". 
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запись нового статуса редактирования для месяца. ". 
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Добавление нового отдела. */
	public function newDepartment(DateTime $date, $departmentName)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT department_id FROM "Departments" WHERE department_name '.
				'= $1', array($departmentName));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение id отдела. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение id отдела. ".
					pg_last_error($this->dbConnect));
		}
		if (pg_num_rows($result)>0){
			$departmentId = pg_fetch_result($result,0,0);
		}else{
			$result = pg_query($this->dbConnect, 'SELECT department_id FROM "Departments"');
			if (!$result) {
				$this->log->error("Не удается выполнить запрос на получение списка id отделов. ".
						pg_last_error($this->dbConnect));
				throw new Exception("Не удается выполнить запрос на получение списка id отделов. ".
						pg_last_error($this->dbConnect));
			}
			$departmentIdArray = pg_fetch_all($result);
			$rows = pg_num_rows($result);
			if ($rows == 0){
				$departmentId = 0;
			}else{
				$departmentId = $departmentIdArray[0]['department_id'];
				for($i = 1; $i < $rows; $i++){
					if ($departmentId < $departmentIdArray[$i]['department_id']){
						$departmentId = $departmentIdArray[$i]['department_id'];
					}
				}
				$departmentId = $departmentId + 1;  
			}
		}
		$result = pg_query_params($this->dbConnect, 'INSERT INTO "Departments" (date, department_id, '.
				'department_name) VALUES ($1, $2, $3)', array($date->format("Y-m-d"), $departmentId, 
					$departmentName));
		if (!$result) {
			$this->log->error("Не удается выполнить запись нового отдела. ". pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запись нового отдела. ". pg_last_error($this->dbConnect));
		}
	}
	
	/** Добавление нового сотрудника. */
	public function newEmployee(DateTime $date, $userId, $userName, $departmentId)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT employee_id, department_id FROM "Employee" WHERE user_id '.
				'= $1 OR user_name = $2', array($userId, $userName));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение id сотрудника. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение id сотрудника. ".
					pg_last_error($this->dbConnect));
		}
		$employeeIdLast = pg_fetch_all($result);
		if (pg_num_rows($result)>0){
			$employeeId = $employeeIdLast['0']['employee_id'];
			if($_GET['route']=="SaveXLSX/readerXLSXFile"){
				$departmentId = $employeeIdLast['0']['department_id'];
			}
		}else{
			$result = pg_query($this->dbConnect, 'SELECT employee_id FROM "Employee"');
			if (!$result) {
				$this->log->error("Не удается выполнить запрос на получение списка id сотрудников. ".
						pg_last_error($this->dbConnect));
				throw new Exception("Не удается выполнить запрос на получение списка id сотрудников. ".
						pg_last_error($this->dbConnect));
			}
			$employeeIdArray = pg_fetch_all($result);
			$rows = pg_num_rows($result);
			if ($rows == 0){
				$employeeId = 0;
			}else{
				$employeeId = $employeeIdArray[0]['employee_id'];
				for($i = 1; $i < $rows; $i++){
					if ($employeeId < $employeeIdArray[$i]['employee_id']){
						$employeeId = $employeeIdArray[$i]['employee_id'];
					}
				}
				$employeeId = $employeeId + 1;  
			}
		}
		$result = pg_query_params($this->dbConnect, 'INSERT INTO "Employee" (date, employee_id, '.
				'user_id, user_name, department_id) VALUES ($1, $2, $3, $4, $5)', array($date->format("Y-m-d"), $employeeId, 
						$userId, $userName, $departmentId));
		if (!$result) {
			$this->log->error("Не удается выполнить запись нового сотрудника. ". pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запись нового сотрудника. ". 
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Добавление нового проекта. */
	public function newProject(DateTime $date, $projectName, $departmentId)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT project_id, department_id FROM "Projects" WHERE project_name '.
				'= $1 AND department_id = $2', array($projectName, $departmentId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос на получение id проекта. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос на получение id проекта. ".
					pg_last_error($this->dbConnect));
		}
		$projectIdLast = pg_fetch_all($result);
		if (pg_num_rows($result)>0){
			$projectId = $projectIdLast['0']['project_id'];
			if($_GET['route']=="SaveXLSX/readerXLSXFile"){
				$departmentId = $projectIdLast['0']['department_id'];
			}
		}else{
			$result = pg_query($this->dbConnect, 'SELECT project_id FROM "Projects"');
			if (!$result) {
				$this->log->error("Не удается выполнить запрос на получение списка id проектов. ".
						pg_last_error($this->dbConnect));
				throw new Exception("Не удается выполнить запрос на получение списка id проектов. ".
						pg_last_error($this->dbConnect));
			}
			$projectIdArray = pg_fetch_all($result);
			$rows = pg_num_rows($result);
			if ($rows == 0){
				$projectId = 0;
			}else{
				$projectId = $projectIdArray[0]['project_id'];
				for($i = 1; $i < $rows; $i++){
					if ($projectId < $projectIdArray[$i]['project_id']){
						$projectId = $projectIdArray[$i]['project_id'];
					}
				}
				$projectId = $projectId + 1;  
			}
		}
		$result = pg_query_params($this->dbConnect, 'INSERT INTO "Projects" (date, project_id, '.
				'project_name, department_id) VALUES ($1, $2, $3, $4)', array($date->format("Y-m-d"), 
						$projectId,	$projectName, $departmentId));
		if (!$result) {
			$this->log->error("Не удается выполнить запись нового проекта. ". pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запись нового проекта. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Добавление нового распределения времени. */
	public function newTimeDistribution(DateTime $date, $projectId, $employeeId, $time)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'INSERT INTO "Time_distribution" (date, project_id, '.
				'employee_id, time) VALUES ($1, $2, $3, $4)', array($date->format("Y-m-d"), $projectId,	
						$employeeId, $time));
		if (!$result) {
			$this->log->error("Не удается выполнить запись нового распределения времени. ". 
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запись нового распределения времени. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Добавление новой роли пользователя. */
	public function newRole($employeeId, $roleId)
	{
		$result = pg_query_params($this->dbConnect, 'INSERT INTO "Role" (employee_id, role_id) VALUES ($1, $2)', 
				array($employeeId, $roleId));
		if (!$result) {
			$this->log->error("Не удается выполнить запись новой роли пользователя. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запись новой роли пользователя. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Добавление нового главу отдела. */
	public function newHeadDepartment(DateTime $date, $employeeId, $departmentId)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'INSERT INTO "Head_departments" (date, employee_id, '.
				'department_id) VALUES ($1, $2, $3)', array($date->format("Y-m-d"), $employeeId, $departmentId));
		if (!$result) {
			$this->log->error("Не удается выполнить запись информации о новом главе отдела. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запись информации о новом главе отдела. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Удаление информации об отделе. */
	public function deleteDepartment(DateTime $date, $departmentId)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'DELETE FROM "Departments" WHERE date_part(\'epoch\', '.
				'date_trunc(\'month\', date)) = $1 AND department_id = $2', array($date->format("U"), 
						$departmentId));
		if (!$result) {
			$this->log->error("Не удается выполнить удаление информации об отделе. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить удаление информации об отделе. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Удаление информации о сотруднике. */
	public function deleteEmployee(DateTime $date, $employeeId)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'DELETE FROM "Employee" WHERE date_part(\'epoch\', '.
				'date_trunc(\'month\', date)) = $1 AND employee_id = $2', array($date->format("U"),
						$employeeId));
		if (!$result) {
			$this->log->error("Не удается выполнить удаление информации о сотруднике. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить удаление информации о сотруднике. ".
					pg_last_error($this->dbConnect));
		}
	}

	/** Удаление информации о проекте. */
	public function deleteProject(DateTime $date, $projectId)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'DELETE FROM "Projects" WHERE date_part(\'epoch\', '.
				'date_trunc(\'month\', date)) = $1 AND project_id = $2', array($date->format("U"),
						$projectId));
		if (!$result) {
			$this->log->error("Не удается выполнить удаление информации о проекте. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить удаление информации о проекте. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Удаление распределения времени. */
	public function deleteTimeDistribution(DateTime $date, $projectId, $employeeId)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'DELETE FROM "Time_distribution" WHERE date_part(\'epoch\', '.
				'date_trunc(\'month\', date)) = $1 AND project_id = $2 AND employee_id = $3', 
					array($date->format("U"), $projectId, $employeeId));
		if (!$result) {
			$this->log->error("Не удается выполнить удаление распределения времени. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить удаление распределения времени. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Удаление роли пользователя. */
	public function deleteRole($employeeId)
	{
		$result = pg_query_params($this->dbConnect, 'DELETE FROM "Role" WHERE employee_id = $1',
				array($employeeId));
		if (!$result) {
			$this->log->error("Не удается выполнить удаление роли пользователя. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить удаление роли пользователя. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Удаление информации о главе отдела. */
	public function deleteHeadDepartment(DateTime $date, $employeeId)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'DELETE FROM "Head_departments" WHERE date_part(\'epoch\', '.
				'date_trunc(\'month\', date)) = $1 AND employee_id = $2 ',
				array($date->format("U"), $employeeId));
		if (!$result) {
			$this->log->error("Не удается выполнить удаление информации о главе отдела. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить удаление информации о главе отдела. ".
					pg_last_error($this->dbConnect));
		}
	}
	
	/** Запрос id отдела. */
	public function getDepartmentId(DateTime $date, $departmentName)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT department_id FROM "Departments" '.
				'WHERE date_part(\'epoch\', date_trunc(\'month\', date))'.
				' = $1 AND department_name = $2', array($date->format("U"), $departmentName));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос Id отдела. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос Id отдела. ".
					pg_last_error($this->dbConnect));
		}
		$departmentId = pg_fetch_all($result);
		return $departmentId['0']['department_id'];
	}
	
	/** Запрос id сотрудника. */
	public function getEmployeeId(DateTime $date, $userName)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT employee_id, user_id FROM "Employee" WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', date)) = $1 AND user_name = $2',
					array($date->format("U"), $userName));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос Id сотрудника. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос Id сотрудника. ".
					pg_last_error($this->dbConnect));
		}
		$employeeId = pg_fetch_all($result);
		return $employeeId['0'];
	}
	
	/** Запрос id проекта. */
	public function getProjectId(DateTime $date, $projectName)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT project_id FROM "Projects" WHERE '.
				'date_part(\'epoch\', date_trunc(\'month\', date)) = $1 AND project_name = $2',
					array($date->format("U"), $projectName));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос Id проекта. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос Id проекта. ".
					pg_last_error($this->dbConnect));
		}
		$projectId = pg_fetch_all($result);
		return $projectId['0']['project_id'];
	}
	
	/** Проверка наличия времени. */
	public function checkTime(DateTime $date, $projectId, $employeeId)
	{
		$convertDate=date_parse_from_format("d.m.Y H:i:s",$date->format("d.m.Y H:i:s"));
		$date = new DateTime($convertDate['year']."-".$convertDate['month']."-01", new DateTimeZone('UTC'));
		$result = pg_query_params($this->dbConnect, 'SELECT time FROM "Time_distribution" WHERE '.
			'date_part(\'epoch\', date_trunc(\'month\', date)) = $1 AND project_id = $2 AND '.
				'employee_id = $3',
				array($date->format("U"), $projectId, $employeeId));
		if (!$result) {
			$this->log->error("Не удается выполнить запрос для проверки времени. ".
					pg_last_error($this->dbConnect));
			throw new Exception("Не удается выполнить запрос для проверки времени. ".
					pg_last_error($this->dbConnect));
		}
		$time = pg_fetch_all($result);
		return $time['0']['time'];
	}
}
