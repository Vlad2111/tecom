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
	
	/* Отображение списков. */
	/** -->Список отделов. */
	function viewListDepartment() {
		$date = $this->getDate();
		$this->template->vars('date', $date);
		
		$arrayDepartmentNames = $this->postgreSQL->getDepartmentNames($date);
		$this->template->vars('arrayDepartmentNames', $arrayDepartmentNames);
		
		$this->template->view('listDepartments', 'listDepartmentLayout');
	}
	
	/** -->Список сотрудников. */
	function viewListEmployee() {
		$date = $this->getDate();
		$this->template->vars('date', $date);
		
		$arrayDepartmentNames = $this->postgreSQL->getDepartmentNames($date);
		$this->template->vars('arrayDepartmentNames', $arrayDepartmentNames);
		
		$arrayEmployeeNames = $this->postgreSQL->getEmployeeNames($date);
		$this->template->vars('arrayEmployeeNames', $arrayEmployeeNames);
		
		$this->template->view('listEmployees', 'listEmployeeLayout');
	}
	
	/** -->Список проектов. */
	function viewListProject() {
		$date = $this->getDate();
		$this->template->vars('date', $date);
		
		$arrayDepartmentNames = $this->postgreSQL->getDepartmentNames($date);
		$this->template->vars('arrayDepartmentNames', $arrayDepartmentNames);
		
		$arrayProjectNames = $this->postgreSQL->getProjectNames($date);
		$this->template->vars('arrayProjectNames', $arrayProjectNames);
		
		$this->template->view('listProjects', 'listProjectLayout');
	}
		
	/** Получение даты. */
	private function getDate() {
		if (($_GET['Month']!=null)AND($_GET['Year']!=null)){
			$date = new DateTime('01.'.$_GET['Month'].'.'.$_GET['Year'], 
					new DateTimeZone('UTC'));
		}else{
			if ($_GET['date']!=null){
				$dayMonthYear = explode('/', $_GET['date']);
				$date = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'],
						new DateTimeZone('UTC'));
			}else{
				$date = new DateTime();
			}
		}
		return $date;
	}
	/**Клонирование информации в новый месяц*/
	function cloneData() {
		if (($_GET['dateFrom']!=null)AND($_GET['dateTo']!=null)){
			$dayMonthYear = explode('/', $_GET['dateFrom']);
			$dateFrom = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'],
					new DateTimeZone('UTC'));
					
			$dayMonthYear = explode('/', $_GET['dateTo']);
			$dateTo = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['2'],
					new DateTimeZone('UTC'));
					
			$this->postgreSQL->cloneModelData($dateFrom, $dateTo);
			
			$this->template->vars('dateTo', $dateTo);
			$this->viewListDepartment();
		}
	}
	
	/* Действия с отделами */
	/** -->Добавление отдела. */
	function newDepartment(){
		$date = $this->getDate();
		$this->postgreSQL->newDepartment($date, $_GET['newName']);
		$this->viewListDepartment();
	}
	
	/** -->Редактирование отдела. */
	function editDepartment(){
		$date = $this->getDate();
		$this->postgreSQL->changeDepartmentName($_GET['editId'], $date, $_GET['newName']);
		$this->viewListDepartment();
	}
	
	/** -->Удаление отдела. */
	function removeDepartment() {
		$date = $this->getDate();
		$this->postgreSQL->deleteDepartment($date, $_GET['departmentId']);
		$this->viewListDepartment();
	}
	
	/* Действия с сотрудниками */
	/** -->Добавление сотрудника. */
	function newEmployee(){
		$date = $this->getDate();
		$user = $this->checkLoginLdapForEmployee();
		$this->postgreSQL->newEmployee($date, $user['Login'], $user['Name'], $_GET['newDepartmwent']);
		$this->viewListEmployee();
	}
	
	/** -->Редактирование информации сотрудника. */
	function editEmployee(){
		$date = $this->getDate();
		$user = $this->checkLoginLdapForEmployee();
		if ($user != null){
			$idNameDepartment = explode('*-*', $_GET['newDepartmwent']);
			if($idNameDepartment['1']!=null){
				$departmentId = $idNameDepartment['0'];
				$departmentName = $idNameDepartment['1'];
			}else{
				$departmentId=$_GET['newDepartmwent'];
			}
			$this->postgreSQL->changeEmployeeInfo($_GET['editId'], $date, $user['Login'], $user['Name'], $departmentId);
			$this->viewListEmployee();
		}
	}
	
	/** -->Удаление информации сотрудника. */
	function removeEmployee() {
		$date = $this->getDate();
		$this->postgreSQL->deleteEmployee($date, $_GET['employeeId']);
		$this->viewListEmployee();
	}
	
	/** Проверка логина сотрудника в LDAP при создании и редактировании. */
	private function checkLoginLdapForEmployee() {
		$ldap = new LdapOperations();
		$ldap->connect();
		$arrayLDAPAccountNames = $ldap->getLDAPAccountNamesByPrefix($_GET['newLogin']);
		if (count($arrayLDAPAccountNames)>1){
			$date = $this->getDate();
			$this->template->vars('date', $date);
			$this->template->vars('arrayLDAPAccountNames', $arrayLDAPAccountNames);
			$this->template->view('selectLoginInLDAP', 'selectLoginInLDAPLayout');
		}else{
			$user['Name'] = $arrayLDAPAccountNames['0']['sn'].' '.$arrayLDAPAccountNames['0']['givenName'];
			$user['Login'] = $arrayLDAPAccountNames['0']['sAMAccountName'];
			return $user;
		}
	}
	
	/* Действия с проектами */
	/** -->Добавление проекта. */
	function newProject(){
		$date = $this->getDate();
		$this->postgreSQL->newProject($date, $_GET['newName'], $_GET['newDepartmwent']);
		$this->viewListProject();
	}
	
	/** -->Редактирование проекта. */
	function editProject(){
		$date = $this->getDate();
		$idNameDepartment = explode('*-*', $_GET['newDepartmwent']);
		if($idNameDepartment['1'] != null){
			$departmentId = $idNameDepartment['0'];
			$departmentName = $idNameDepartment['1'];
		}else{
			$departmentId = $_GET['newDepartmwent'];
		}
		$this->postgreSQL->changeProjectNameAndDepartmentId($_GET['editId'], $date, $_GET['newName'], $departmentId);
		$this->viewListProject();
	}
	
	/** -->Удаление проекта. */
	function removeProject() {
		$date = $this->getDate();
		$this->postgreSQL->deleteProject($date, $_GET['projectId']);
		$this->viewListProject();
	}
	
}