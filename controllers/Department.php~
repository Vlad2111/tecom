<?php
if(isset($_COOKIE[session_name()])) {session_start();}
/*
* Copyright (c) 2016 Tecom LLC
* All rights reserved
*
* Исключительное право (c) 2016 пренадлежит ООО Теком
* Все права защищены
*/
/**
Класс контроллер, информация об отделе.

@author ershov.v
*/
Class Controller_Department Extends Controller_Base {

	public $log;
	public $postgreSQL;

	/** Отображение списка сотрудников и проектов отдела. */
	function viewDepartment() {
		$this->checkSession();
		
		$date = $this->getDate();
		$this->template->vars('date', $date);
		
		$status = $this->checkDataEditingForDate($date);
		$this->template->vars('statusEditingData', $status);
		
		if ((isset ($_GET['I']))AND($_GET['departmentName']=="C")){
			$_GET['departmentName']=$_GET['departmentName']."&I";
		}
		if ((isset ($_GET['D']))AND($_GET['departmentName']=="R")){
			$_GET['departmentName']=$_GET['departmentName']."&D";
		}
		$this->template->vars('departmentId', $_GET['departmentId']);
		$this->template->vars('departmentName', $_GET['departmentName']);
		
		$arrayDepartmentNames = $this->postgreSQL->getDepartmentNames($date);
		$this->template->vars('arrayDepartmentNames', $arrayDepartmentNames);
		
		$arrayEmployeeNamesForDepartment = $this->postgreSQL->getEmployeeNamesForDepartment($_GET['departmentId'], $date);
		$this->template->vars('arrayEmployeeNamesForDepartment', $arrayEmployeeNamesForDepartment);
		
		$arrayProjectNamesForDepartment = $this->postgreSQL->getProjectNamesForDepartment($_GET['departmentId'], $date);
		$this->template->vars('arrayProjectNamesForDepartment', $arrayProjectNamesForDepartment);
		
		$this->template->view('department', 'DepartmentLayout');
	}
	
	/** Получение даты. */
	private function getDate() {
		if (($_GET['Month']!=null)AND($_GET['Year']!=null)){
			$date = new DateTime('01.'.$_GET['Month'].'.'.$_GET['Year'], new DateTimeZone('UTC'));
		}else{
			if ($_GET['date']!=null){
				$dayMonthYear = explode('/', $_GET['date']);
				$date = new DateTime('01.'.$dayMonthYear['0'].'.'.$dayMonthYear['1'], new DateTimeZone('UTC'));
			}else{
				$date = new DateTime();
				$date->setTimezone(new DateTimeZone('UTC'));
			}
		}
		return $date;
	}
	
	/** Проверка сессии. */
	private function checkSession() {
		if(($_SESSION[session_name()] != $_COOKIE[session_name()])OR(($_SESSION == null)AND($_COOKIE == null))){
			session_start();
			session_unset();
			session_destroy();
			$_GET['route']='Index';
			include 'index.php';
			exit;
		}
	}

	/** Проверка данных для даты на возможность редактирования. */
	private function checkDataEditingForDate(DateTime $date) {
		$status = $this->postgreSQL->getDataStatusForEditing($date);
		if($status == null){
			$this->postgreSQL->newDataStatusForEditing($date, 0);
			return FALSE;
		}else{
			return $status['0']['editing_status'];
		}
	}
	
	/** Изменение возможности редактирования данных. */
	function changeDataStatusForEditing() {
		$date = $this->getDate();
		if($_GET['lastStatus']==FALSE){
			$status = $this->postgreSQL->changeDataStatusForEditing($date, 1);
		}else{
			$status = $this->postgreSQL->changeDataStatusForEditing($date, 0);
		}
		$this->viewDepartment();
	}
	
	/** Редактирование отдела. */
	function editDepartment(){
		$date = $this->getDate();
		$this->postgreSQL->changeDepartmentName($_GET['editId'], $date, $_GET['newName']);
		$_GET['departmentId'] = $_GET['editId'];
		$_GET['departmentName'] = $_GET['newName'];
		$this->viewDepartment();
	}
	
	/* Действия с сотрудниками */
	/** Добавление сотрудника. */
	function newEmployee(){
		$date = $this->getDate();
		$user=$this->checkLoginLdapForEmployee();
		$this->postgreSQL->newEmployee($date, $user['Login'], $user['Name'],
				$_GET['newDepartment']);
		$this->viewDepartment();
	}
	
	/** Редактирование информации сотрудника. */
	function editEmployee(){
		$date = $this->getDate();
		rtrim($_GET['newLogin']);
		rtrim($_GET['nameEmployeeS']);
		rtrim($_GET['nameEmployeeF']);
		rtrim($_GET['nameEmployeeM']);
		$user = $this->checkLoginLdapForEmployee($_GET['newLogin']);
		$checkUser = $this->getLoginLdapForEmployee($_GET['nameEmployeeS'].' '.$_GET['nameEmployeeF']);
		if(($user != 'error')or($checkUser != 'error')){
			if($checkUser != 'error'){
				$correctUser = $checkUser;
			}
			if($user != 'error'){
				$correctUser = $user;
			}
			if($_GET['nameEmployeeM']!=null){
				$correctUser['Name']=$correctUser['Name'].' '.$_GET['nameEmployeeM'];
			}
			$idNameDepartment = explode('*-*', $_GET['newDepartment']);
			if($idNameDepartment['1']!=null){
				$departmentId=$idNameDepartment['0'];
				$departmentName=$idNameDepartment['1'];
			}else{
				$departmentId=$_GET['newDepartment'];
			}
			$this->postgreSQL->changeEmployeeInfo($_GET['editId'], $date, $correctUser['Login'], $correctUser['Name'], $_GET['newDepartment']);
		}else{
			$error['alert']='onload="errorMassage()"';
			$error['message']='Получены некорректные данные при создании/редактировании информации сотрудника: : Фамилия'.$_GET['nameEmployeeS'].'; Имя:'.$_GET['nameEmployeeF'].'; Отчество: '.$_GET['nameEmployeeM'].'; Логин: '.$_GET['newLogin'].'; id Отдела: '.$_GET['newDepartment'].';';			
			$this->template->vars('error', $error);
		}
		$this->viewDepartment();
	}
	
	/** Удаление информации сотрудника. */
	function removeEmployee() {
		$date = $this->getDate();
		$this->postgreSQL->deleteEmployee($date, $_GET['employeeId']);
		$this->viewDepartment();
	}
	
	/** Проверка логина сотрудника в LDAP при создании и редактировании. */
	private function checkLoginLdapForEmployee($login) {
		$ldap = new LdapOperations();
		$ldap->connect();
		$arrayLDAPAccountNames = $ldap->getLDAPAccountNamesByPrefix($login);
		if (count($arrayLDAPAccountNames)!=1){
			return 'error';
		}else{
			$user['Name'] = $arrayLDAPAccountNames['0']['sn'].' '.$arrayLDAPAccountNames['0']['givenName'];
			$user['Login'] = $arrayLDAPAccountNames['0']['sAMAccountName'];
			return $user;
		}
	}
	
	/** Запрос логина сотрудника из LDAP при создании и редактировании. */
	private function getLoginLdapForEmployee($fullName) {
		$ldap = new LdapOperations();
		$ldap->connect();
		$arrayLDAPAccountNames = $ldap->getLDAPAccountNamesByFullName($fullName);
		if (count($arrayLDAPAccountNames)!=1){
			return 'error';
		}else{
			$user['Name'] = $arrayLDAPAccountNames['0']['sn'].' '.$arrayLDAPAccountNames['0']['givenName'];
			$user['Login'] = $arrayLDAPAccountNames['0']['sAMAccountName'];
			return $user;
		}
	}
	
	/* Действия с проектами */
	/** Добавление проекта. */
	function newProject(){
		$date = $this->getDate();
		rtrim($_GET['newName']);
		$this->postgreSQL->newProject($date, $_GET['newName'],
				$_GET['newDepartment']);
		$this->viewDepartment();
	}
	
	/** Редактирование проекта. */
	function editProject(){
		$date = $this->getDate();
		rtrim($_GET['newName']);
		$idNameDepartment = explode('*-*', $_GET['newDepartment']);
		if($idNameDepartment['1']!=null){
			$departmentId=$idNameDepartment['0'];
			$departmentName=$idNameDepartment['1'];
		}else{
			$departmentId=$_GET['newDepartment'];
		}
		$this->postgreSQL->changeProjectNameAndDepartmentId($_GET['editId'],
				$date, $_GET['newName'], $departmentId);
		$this->viewDepartment();
	}
	
	/** Удаление проекта. */
	function removeProject() {
		$date = $this->getDate();
		$this->postgreSQL->deleteProject($date, $_GET['projectId']);
		$this->viewDepartment();
	}
}
