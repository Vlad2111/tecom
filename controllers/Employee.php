<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, информация о сотруднике.

@author ershov.v
*/
Class Controller_Employee Extends Controller_Base {

	public $log;
	public $postgreSQL;
	
	/** Отображение списка проетов и время сотрудника. */
	function index($registry) {
		if($registry['date']==null){
			$this->getDate($registry);
		}
		$rows = $model->getDepartmentNames($registry['date']);
		$registry['selectDepartment'] = $rows;
		$rows = $model->getProjectNamesForDepartment($registry['GET']['departmentId'], $registry['date']);
		$registry['selectProject'] = $rows;
		$rows = $model->getProjectNamesNotForDepartment($registry['GET']['departmentId'], $registry['date']);
		$registry['selectProjectNot'] = $rows;
		$rows = $model->getEmployeeInfo($registry['GET']['employeeId'], $registry['date']);
		$employeePercentSum = 0;
		for ($i=0; $i<count($rows); $i++){
			$employeePercentSum = $employeePercentSum + $rows[$i]['time'];
		}
		$registry['employeePercent'] = $employeePercentSum;
		$this->template->vars('rows', $rows);
		$this->template->view('Employee', 'EmployeeLayout');
	}
		
	/** Получение даты. */
	private function getDate($registry) {
		if (($registry['GET']['Month']!=null)AND($registry['GET']['Year']!=null)){
			$registry['date'] = new DateTime('01.'.$registry['GET']['Month'].'.'.$registry['GET']['Year'], new DateTimeZone('UTC'));
		}else{
			if ($registry['GET']['date']!=null){
				$dayMonthYear = explode('/', $registry['GET']['date']);
				$registry['date'] = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'], new DateTimeZone('UTC'));
			}else{
				$registry['date'] = new DateTime();
			}
		}
	}
		
	/** Редактирование информации сотрудника. */
	function editEmployee($registry){
		$this->getDate($registry);
		$user=$this->checkLoginLdapForEmployee($registry);
		$idNameDepartment = explode('*-*', $registry['GET']['newDepartmwent']);
		if($idNameDepartment['1']!=null){
			$departmentId=$idNameDepartment['0'];
			$departmentName=$idNameDepartment['1'];
		}else{
			$departmentId=$registry['GET']['newDepartmwent'];
		}
		$this->postgreSQL->changeEmployeeInfo($registry['GET']['editId'], $registry['date'],
				$user['Login'], $userName, $departmentId);
		$registry['newLoginEmpForEmp']=$user['Login'];
		$registry['newNameEmpForEmp']=$user['Name'];
		$registry['newIdDepForEmp']=$departmentId;
		$registry['newNameDepForEmp']=$departmentName;
		$this->index($registry);
	}
		
	/** Проверка логина сотрудника в LDAP при создании и редактировании. */
	private function checkLoginLdapForEmployee($registry) {
		$ldap = new LdapOperations();
		$ldap->connect();
		$rows = $ldap->getLDAPAccountNamesByPrefix($registry['GET']['newLogin']);
		if (count($rows)>1){
			$this->template->vars('rows', $rows);
			$this->template->view('selectLoginInLDAP', 'index');
		}else{
			$user['Name'] = $rows['0']['sn'].' '.$rows['0']['givenName'];
			$user['Login'] = $rows['0']['sAMAccountName'];
			return $user;
		}
	}
		
	/* Действия с процентами */
	/** Добавление времени. */
	function newPercent($registry){
		$this->getDate($registry);
		$model->newTimeDistribution($registry['date'], $registry['GET']['projectId'],
				$registry['GET']['employeeId'], $registry['GET']['newTime']);
		$this->index($registry);
	}
		
	/** Редактирование времени. */
	function editPercent($registry){
		$this->getDate($registry);
		$model->changeEployeeTimeForProject($registry['GET']['employeeId'], $registry['GET']['projectId'],
				$registry['date'], $registry['GET']['newTime']);
		$this->index($registry);
	}
		
	/** Удаление времени. */
	function removePercent($registry) {
		$this->getDate($registry);
		$this->postgreSQL->deleteTimeDistribution($registry['date'], $registry['GET']['projectId'], $registry['GET']['employeeId']);
		$this->index($registry);
	}
}