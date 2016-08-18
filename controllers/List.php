<?php
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, списки отделов, сотрудников и проетов.

@author ershov.v
*/
Class Controller_List Extends Controller_Base {

	public $log;
	public $postgreSQL;
	
	/** Первая страничка после авторизации */
	function index($registry){
		$rows = $this->postgreSQL->getDepartmentNames($registry['date']);
		$this->template->vars('rows', $rows);
		$this->template->view('listDepartments', 'listDepartmentLayout');
	}
	
	/* Отображение списков. */
	/** -->Список отделов. */
	function listDepartment($registry) {
		if($registry['date']==null){
			$this->getDate($registry);
		}
		$rows = $this->postgreSQL->getDepartmentNames($registry['date']);
		$this->template->vars('rows', $rows);
		$this->template->view('listDepartments', 'listDepartmentLayout');
	}
	
	/** -->Список сотрудников. */
	function listEmployee($registry) {
		if($registry['date']==null){
			$this->getDate($registry);
		}
		$rows = $this->postgreSQL->getDepartmentNames($registry['date']);
		$registry['selectDepartment'] = $rows;
		$rows = $this->postgreSQL->getEmployeeNames($registry['date']);
		$this->template->vars('rows', $rows);
		$this->template->view('listEmployees', 'listEmployeeLayout');
	}
	
	/** -->Список проектов. */
	function listProject($registry) {
		if($registry['date']==null){
			$this->getDate($registry);
		}
		$rows = $this->postgreSQL->getDepartmentNames($registry['date']);
		$registry['selectDepartment'] = $rows;
		$rows = $this->postgreSQL->getProjectNames($registry['date']);
		$this->template->vars('rows', $rows);
		$this->template->view('listProjects', 'listProjectLayout');
	}
		
	/** Получение даты. */
	private function getDate($registry) {
		if (($registry['GET']['Month']!=null)AND($registry['GET']['Year']!=null)){
			$registry['date'] = new DateTime('01.'.$registry['GET']['Month'].'.'.$registry['GET']['Year'], 
					new DateTimeZone('UTC'));
		}else{
			if ($registry['GET']['date']!=null){
				$dayMonthYear = explode('/', $registry['GET']['date']);
				$registry['date'] = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'],
						new DateTimeZone('UTC'));
			}else{
				$registry['date'] = new DateTime();
			}
		}
	}
	/**Клонирование информации в новый месяц*/
	function cloneData($registry) {
		if (($registry['GET']['dateFrom']!=null)AND($registry['GET']['dateTo']!=null)){
			$dayMonthYear = explode('/', $registry['GET']['dateFrom']);
			$dateFrom = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'],
					new DateTimeZone('UTC'));
			$dayMonthYear = explode('/', $registry['GET']['dateTo']);
			$dateTo = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'],
					new DateTimeZone('UTC'));
			$this->postgreSQL->cloneModelData($dateFrom, $dateTo);
			$registry['date'] = $dateTo;
			$this->listDepartment($registry);
		}
	}
	
	/* Действия с отделами */
	/** -->Добавление отдела. */
	function newDepartment($registry){
		$this->getDate($registry);
		$this->postgreSQL->newDepartment($registry['date'], $registry['GET']['newName']);
		$this->listDepartment($registry);
	}
	
	/** -->Редактирование отдела. */
	function editDepartment($registry){
		$this->getDate($registry);
		$this->postgreSQL->changeDepartmentName($registry['GET']['editId'], $registry['date'],
				$registry['GET']['newName']);
		$registry['newNameDepForDep']=$registry['GET']['newName'];
		$this->listDepartment($registry);
	}
	
	/** -->Удаление отдела. */
	function removeDepartment($registry) {
		$this->getDate($registry);
		$this->postgreSQL->deleteDepartment($registry['date'], $registry['GET']['departmentId']);
		$this->listDepartment($registry);
	}
	
	/* Действия с сотрудниками */
	/** -->Добавление сотрудника. */
	function newEmployee($registry){
		$this->getDate($registry);
		$user=$this->checkLoginLdapForEmployee($registry);
		$this->postgreSQL->newEmployee($registry['date'], $user['Login'], $user['Name'],
				$registry['GET']['newDepartmwent']);
		$this->listEmployee($registry);
	}
	
	/** -->Редактирование информации сотрудника. */
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
		$this->listEmployee($registry);
	}
	
	/** -->Удаление информации сотрудника. */
	function removeEmployee($registry) {
		$this->getDate($registry);
		$this->postgreSQL->deleteEmployee($registry['date'], $registry['GET']['employeeId']);
		$this->listEmployee($registry);
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
	
	/* Действия с проектами */
	/** -->Добавление проекта. */
	function newProject($registry){
		$this->getDate($registry);
		$this->postgreSQL->newProject($registry['date'], $registry['GET']['newName'],
				$registry['GET']['newDepartmwent']);
		$this->listProject($registry);
	}
	
	/** -->Редактирование проекта. */
	function editProject($registry){
		$this->getDate($registry);
		$idNameDepartment = explode('*-*', $registry['GET']['newDepartmwent']);
		if($idNameDepartment['1']!=null){
			$departmentId=$idNameDepartment['0'];
			$departmentName=$idNameDepartment['1'];
		}else{
			$departmentId=$registry['GET']['newDepartmwent'];
		}
		$this->postgreSQL->changeProjectNameAndDepartmentId($registry['GET']['editId'],
				$registry['date'], $registry['GET']['newName'], $departmentId);
		$registry['newIdDepForPro']=$departmentId;
		$registry['newNameDepForPro']=$departmentName;
		$this->listProject($registry);
	}
	
	/** -->Удаление проекта. */
	function removeProject($registry) {
		$this->getDate($registry);
		$this->postgreSQL->deleteProject($registry['date'], $registry['GET']['projectId']);
		$this->listProject($registry);
	}
	
}