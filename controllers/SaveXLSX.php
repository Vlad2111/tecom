<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, проверка после авторизации.

@author ershov.v
*/
Class Controller_SaveXLSX Extends Controller_Base {

	public $log;
	public $postgreSQL;

	
	function readerXLSXFile() {
		require_once '3pty/PHPExcel/Classes/PHPExcel.php';
		$file_type = PHPExcel_IOFactory::identify( $_FILES['file']['tmp_name'] );
		$objReader = PHPExcel_IOFactory::createReader( $file_type );
		$objPHPExcel = $objReader->load( $_FILES['file']['tmp_name'] );
		$sheet = $objPHPExcel->getSheetByName($_POST['nameSheet']);
		$sheet1 = $objPHPExcel->getSheetByName('Список проектов');
		
		$date = $this->getDate( $sheet );
		
		$this->columnOfDepartment( $sheet , $date );
		$this->columnOfProject( $sheet1 , $date );
		$this->columnOfEmployee( $sheet , $date );
		$this->columnsOfTimeDistr( $sheet , $date );
		
		$_GET['route']='list/viewListDepartment';
		include 'index.php';
	}
	
	/** Чтение дат из файла. */
	private function getDate( $sheet ){
		for ($i = 4; $i <= 10; $i++) {
			$date[$i] = $sheet->getCellByColumnAndRow($i, 1)->getValue();
			$date[$i] = PHPExcel_Shared_Date::ExcelToPHPObject($date[$i]);
		}
		return $date;
	}
	
	/** Чтение отделов из файла. */
	private function columnOfDepartment( $sheet , $date ){
		for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
			$departmentName = $sheet->getCellByColumnAndRow(2, $i)->getValue();
			rtrim($departmentName);
			if ($departmentName == null){
				$i = $sheet->getHighestRow();
			}else{
				foreach ($date as $datetime){
					$departmentId = $this->postgreSQL->getDepartmentId($datetime, $departmentName);
					if ($departmentId == null){
						$this->postgreSQL->newDepartment($datetime, $departmentName);
					}
				}
			}
		}
	}
	
	/** Чтение проектов из файла. */
	private function columnOfProject( $sheet , $date ){
		for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
			$projectName = $sheet->getCellByColumnAndRow(1, $i)->getValue();
			rtrim($projectName);
			$departmentName = $sheet->getCellByColumnAndRow(2, $i)->getValue();
			rtrim($departmentName);
			foreach ($date as $datetime){
				$departmentId = $this->postgreSQL->getDepartmentId($datetime, $departmentName);
				if ($departmentId == null){
					$this->postgreSQL->newDepartment($datetime, $departmentName);
					$departmentId = $this->postgreSQL->getDepartmentId($datetime, $departmentName);
				}
				$projectId = $this->postgreSQL->getProjectId($datetime, $projectName, $departmentId);
				if ($projectId == null){
					$this->postgreSQL->newProject($datetime, $projectName, $departmentId);
				}
			}
		}
	}
	
	/** Чтение сотрудников из файла. */
	private function columnOfEmployee( $sheet , $date ){
		for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
			$departmentName = $sheet->getCellByColumnAndRow(2, $i)->getValue();
			rtrim($departmentName);
			$employeeName = $sheet->getCellByColumnAndRow(1, $i)->getValue();
			rtrim($employeeName);
			if (($departmentName == null)AND($employeeName == null)){
				$i = $sheet->getHighestRow();
			}else{
				foreach ($date as $datetime){
					$departmentId = $this->postgreSQL->getDepartmentId($datetime, $departmentName);
					$employeeIdAndLogin = $this->postgreSQL->getEmployeeId($datetime, $employeeName);
					if ($employeeIdAndLogin['employee_id'] == null){
						$ldap = new LdapOperations();
						$ldap->connect();
						$login = $ldap->getLDAPAccountNamesByFullName($employeeName);
						$this->postgreSQL->newEmployee($datetime, $login[0]['sAMAccountName'], $employeeName, $departmentId);
					}
				}
			}
		}
	}
	
	/** Чтение распределения времени из файла. */
	private function columnsOfTimeDistr( $sheet , $date ){
		foreach ($date as $key=>$datetime){
			for ($i = 2; $i <= $sheet->getHighestRow(); $i++) {
				$employeeName = $sheet->getCellByColumnAndRow(1, $i)->getValue();
				rtrim($employeeName);
				$projectName = $sheet->getCellByColumnAndRow(3, $i)->getValue();
				rtrim($projectName);
				$time = $sheet->getCellByColumnAndRow($key, $i)->getValue();
				rtrim($time);
				if (($employeeName == null)AND($projectName == null)){
					$i = $sheet->getHighestRow();
				}else{
					if ($time != null){
						$employeeIdAndLogin = $this->postgreSQL->getEmployeeId($datetime, $employeeName);
						$projectId = $this->postgreSQL->getProjectId($datetime, $projectName, $departmentId);
						if ($projectId==null){
							$departmentName = $sheet->getCellByColumnAndRow(2, $i)->getValue();
							rtrim($departmentName);
							$departmentId = $this->postgreSQL->getDepartmentId($datetime, $departmentName);
							$this->postgreSQL->newProject($datetime, $projectName, $departmentId);
							$projectId = $this->postgreSQL->getProjectId($datetime, $projectName, $departmentId);
						}
						$checkTime = $this->postgreSQL->checkTime($datetime, $projectId, $employeeIdAndLogin['employee_id']);
						if ($checkTime==null){
							$time = $time*100;
							$this->postgreSQL->newTimeDistribution($datetime, $projectId, $employeeIdAndLogin['employee_id'], $time);
						}
					}
				}
			}
		}
	}
}